<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\ProductSlugHistory;
use App\Models\ProductSeo;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function getProductById($id)
    {
        return $this->productRepository->getProductById($id);
    }
    
    public function createProduct(array $data)
    {
        DB::beginTransaction();
        try {
            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }
            
            $product = $this->productRepository->createProduct($data);
            
            $this->syncRelations($product, $data);

            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateProduct($id, array $data)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->getProductById($id);

            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }

            $product = $this->productRepository->updateProduct($id, $data);
            
            $this->syncRelations($product, $data);
            
            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->deleteProduct($id);
    }
    
    protected function syncRelations($product, array $data)
    {
        if (isset($data['features'])) {
            $product->features()->delete();
            $sort = 0;
            foreach ($data['features'] as $feature) {
                if (!empty($feature['feature_text'])) {
                    $product->features()->create([
                        'feature_text' => $feature['feature_text'],
                        'sort_order' => $sort++
                    ]);
                }
            }
        }
        
        if (isset($data['applications'])) {
            $product->applications()->delete();
            $sort = 0;
            foreach ($data['applications'] as $app) {
                if (!empty($app['application_text'])) {
                    $product->applications()->create([
                        'application_text' => $app['application_text'],
                        'sort_order' => $sort++
                    ]);
                }
            }
        }

        if (isset($data['specifications'])) {
            $product->specifications()->delete();
            $sort = 0;
            foreach ($data['specifications'] as $spec) {
                if (!empty($spec['spec_label'])) {
                    $product->specifications()->create([
                        'spec_label' => $spec['spec_label'],
                        'spec_value' => $spec['spec_value'] ?? null,
                        'sort_order' => $sort++
                    ]);
                }
            }
        }
    }
}
