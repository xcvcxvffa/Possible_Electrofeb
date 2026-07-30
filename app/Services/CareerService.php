<?php

namespace App\Services;

use App\Repositories\CareerRepository;
use App\Models\Career;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CareerService
{
    protected $repository;

    public function __construct(CareerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createCareer(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data = $this->handleManualTypeInputs($data);
            
            $data['slug'] = $this->generateSlug($data['title']);
            $data['created_by'] = auth()->id();
            
            if (!empty($data['status']) && $data['status'] == 1 && empty($data['published_at'])) {
                $data['published_at'] = now();
            }

            $career = $this->repository->create($data);
            
            $this->syncRelations($career, $data);

            return $career;
        });
    }

    public function updateCareer($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $data = $this->handleManualTypeInputs($data);
            
            $career = $this->repository->getCareerById($id);
            
            if ($career->title !== $data['title'] && !empty($data['title'])) {
                $newSlug = $this->generateSlug($data['title'], $id);
                
                // Track slug history
                if ($career->slug !== $newSlug) {
                    $career->slugHistory()->create(['old_slug' => $career->slug]);
                    $data['slug'] = $newSlug;
                }
            }

            $data['updated_by'] = auth()->id();
            
            if (!empty($data['status']) && $data['status'] == 1 && empty($career->published_at)) {
                $data['published_at'] = now();
            }

            $career = $this->repository->update($id, $data);
            
            $this->syncRelations($career, $data);

            return $career;
        });
    }

    protected function syncRelations(Career $career, array $data)
    {
        // Responsibilities
        if (isset($data['responsibilities'])) {
            $career->responsibilities()->delete();
            foreach ($data['responsibilities'] as $index => $resp) {
                if (!empty(trim($resp))) {
                    $career->responsibilities()->create([
                        'item' => $resp,
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        // Requirements
        if (isset($data['requirements'])) {
            $career->requirements()->delete();
            foreach ($data['requirements'] as $index => $req) {
                if (!empty(trim($req))) {
                    $career->requirements()->create([
                        'item' => $req,
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        // Benefits
        if (isset($data['benefits'])) {
            $career->benefits()->delete();
            foreach ($data['benefits'] as $index => $ben) {
                if (!empty(trim($ben))) {
                    $career->benefits()->create([
                        'item' => $ben,
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        // Skills (Normalized pivot)
        if (isset($data['skills'])) {
            $career->skillItems()->delete();
            foreach ($data['skills'] as $index => $skillId) {
                if (!empty($skillId)) {
                    $career->skillItems()->create([
                        'skill_id' => $skillId,
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        // Documents
        if (isset($data['documents'])) {
            $career->documents()->delete();
            foreach ($data['documents'] as $index => $doc) {
                if (!empty($doc['media_id'])) {
                    $career->documents()->create([
                        'media_id' => $doc['media_id'],
                        'title' => $doc['title'] ?? null,
                        'document_type' => $doc['type'] ?? null,
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        // FAQs
        if (isset($data['faqs'])) {
            $career->faqs()->delete();
            foreach ($data['faqs'] as $index => $faq) {
                if (!empty(trim($faq['question'])) && !empty(trim($faq['answer']))) {
                    $career->faqs()->create([
                        'question' => $faq['question'],
                        'answer' => $faq['answer'],
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        // SEO and JSON-LD
        if (isset($data['seo'])) {
            $seoData = [
                'meta_title' => $data['seo']['meta_title'] ?? null,
                'meta_description' => $data['seo']['meta_description'] ?? null,
                'meta_keywords' => $data['seo']['meta_keywords'] ?? null,
                'og_image_media_id' => $data['seo']['og_image_media_id'] ?? null,
                'schema_json' => $this->generateJobPostingSchema($career),
            ];
            
            $career->seo()->updateOrCreate(['career_id' => $career->id], $seoData);
        } else {
            // Ensure schema is updated even if no SEO data is explicitly passed
            $career->seo()->updateOrCreate(
                ['career_id' => $career->id], 
                ['schema_json' => $this->generateJobPostingSchema($career)]
            );
        }
    }

    protected function generateJobPostingSchema(Career $career)
    {
        // Google JobPosting JSON-LD Schema Generation
        $schema = [
            '@context' => 'https://schema.org/',
            '@type' => 'JobPosting',
            'title' => $career->title,
            'description' => strip_tags($career->description ?? $career->short_description),
            'datePosted' => $career->published_at ? $career->published_at->toIso8601String() : now()->toIso8601String(),
            'validThrough' => $career->application_deadline ? $career->application_deadline->toIso8601String() : null,
            'employmentType' => $this->mapEmploymentType($career->jobType?->name),
            'hiringOrganization' => [
                '@type' => 'Organization',
                'name' => 'Possible Electrofeb LLP',
                'sameAs' => url('/'),
                'logo' => asset('assets/img/logo/logo.png'), // Default logo path
            ],
            'jobLocation' => [
                '@type' => 'Place',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => $career->location?->city,
                    'addressRegion' => $career->location?->state,
                    'addressCountry' => $career->location?->country ?? 'IN',
                ]
            ],
        ];

        if ($career->salary_type === 'fixed' || $career->salary_type === 'range') {
            $schema['baseSalary'] = [
                '@type' => 'MonetaryAmount',
                'currency' => $career->currency ?? 'INR',
                'value' => [
                    '@type' => 'QuantitativeValue',
                    'value' => $career->salary_type === 'fixed' ? $career->salary_min : null,
                    'minValue' => $career->salary_type === 'range' ? $career->salary_min : null,
                    'maxValue' => $career->salary_type === 'range' ? $career->salary_max : null,
                    'unitText' => 'YEAR'
                ]
            ];
        }

        return $schema;
    }

    protected function mapEmploymentType($typeName)
    {
        $map = [
            'Full Time' => 'FULL_TIME',
            'Part Time' => 'PART_TIME',
            'Contract' => 'CONTRACTOR',
            'Internship' => 'INTERN',
            'Temporary' => 'TEMPORARY',
        ];
        return $map[$typeName ?? 'Full Time'] ?? 'FULL_TIME';
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $career = $this->repository->getCareerById($id);
            $career->update(['deleted_by' => auth()->id()]);
            $this->repository->delete($id);
        });
    }

    public function bulkDelete(array $ids)
    {
        return DB::transaction(function () use ($ids) {
            Career::whereIn('id', $ids)->update(['deleted_by' => auth()->id()]);
            $this->repository->bulkDelete($ids);
        });
    }

    protected function generateSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        $query = Career::withTrashed()->where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $query = Career::withTrashed()->where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
            $count++;
        }

        return $slug;
    }

    protected function handleManualTypeInputs(array $data)
    {
        if (!empty($data['department_name'])) {
            $dept = \App\Models\Department::firstOrCreate(['name' => trim($data['department_name'])], ['slug' => Str::slug($data['department_name'])]);
            $data['department_id'] = $dept->id;
        }

        if (!empty($data['location_name'])) {
            $loc = \App\Models\JobLocation::firstOrCreate(['city' => trim($data['location_name'])], ['country' => 'Any', 'state' => 'Any']);
            $data['job_location_id'] = $loc->id;
        }

        if (!empty($data['job_type_name'])) {
            $type = \App\Models\JobType::firstOrCreate(['name' => trim($data['job_type_name'])], ['color' => '#6366f1']);
            $data['job_type_id'] = $type->id;
        }

        if (!empty($data['category_name'])) {
            $cat = \App\Models\CareerCategory::firstOrCreate(['name' => trim($data['category_name'])], ['slug' => Str::slug($data['category_name'])]);
            $data['career_category_id'] = $cat->id;
        }

        return $data;
    }
}
