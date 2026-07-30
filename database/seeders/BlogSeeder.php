<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\BlogTagItem;
use App\Models\BlogFaq;
use App\Models\BlogSeo;
use App\Models\BlogComment;
use App\Models\BlogRelated;
use App\Models\MediaFile;
use App\Models\User;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::first();
        $authorId = $adminUser ? $adminUser->id : 1;

        // Retrieve sample media IDs if available in Media Library
        $mediaIds = MediaFile::pluck('id')->toArray();
        $featuredMediaId = !empty($mediaIds) ? $mediaIds[0] : null;
        $bannerMediaId = !empty($mediaIds) ? (isset($mediaIds[1]) ? $mediaIds[1] : $mediaIds[0]) : null;

        // 1. Create Enterprise Blog Categories
        $categoriesData = [
            [
                'name' => 'Electrical & Switchgear Technology',
                'slug' => 'electrical-switchgear-technology',
                'description' => 'Technical insights on low-voltage and medium-voltage industrial switchgear systems, protective relays, and standards.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Industrial Power Systems',
                'slug' => 'industrial-power-systems',
                'description' => 'Comprehensive engineering guides on Power Control Centers (PCC), Motor Control Centers (MCC), and feeder distribution.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Renewable Energy & Solar Grid',
                'slug' => 'renewable-energy-solar-grid',
                'description' => 'Innovations in AC/DC combiner boxes, solar grid integration, and industrial solar power plants.',
                'sort_order' => 3,
            ],
        ];

        $createdCategories = [];
        foreach ($categoriesData as $catData) {
            $createdCategories[] = BlogCategory::updateOrCreate(
                ['slug' => $catData['slug']],
                array_merge($catData, ['status' => true])
            );
        }

        // 2. Create Tags
        $tagsList = ['Switchgear', 'Industrial Safety', 'Power Panels', 'Renewables', 'Automation', 'PCC Panels', 'Solar Grid'];
        $createdTags = [];
        foreach ($tagsList as $tagName) {
            $createdTags[] = BlogTag::updateOrCreate(
                ['slug' => Str::slug($tagName)],
                ['name' => $tagName, 'status' => true]
            );
        }

        // 3. Create Enterprise Industrial Blogs
        $blogsData = [
            [
                'title' => 'Innovations in LT Switchgear: Advancing Industrial Electrical Safety',
                'slug' => 'innovations-in-lt-switchgear-advancing-industrial-electrical-safety',
                'category_id' => $createdCategories[0]->id,
                'author_id' => $authorId,
                'excerpt' => 'An in-depth technical analysis of low-tension switchgear engineering, arc-flash mitigation, and modern IEC 61439 compliance for manufacturing plants.',
                'content' => '
                    <p class="mb-30">Modern industrial electrical infrastructure demands uncompromising safety, reliability, and precision. Low-Tension (LT) switchgear plays a paramount role in protecting high-value industrial machinery, distributing electrical loads, and mitigating arc-flash hazards across commercial and manufacturing facilities.</p>
                    <h3 class="details-title-2">The Evolution of IEC 61439 Standards in LT Panels</h3>
                    <p class="mb-40">Compliance with the IEC 61439 standard ensures that low-voltage switchgear and controlgear assemblies meet rigorous thermal, dielectric, and mechanical withstand criteria. By testing temperature rise and short-circuit withstand capacities up to 100kA for 1 second, modern LT panels provide verified operator safety under extreme electrical stress.</p>
                    <h3 class="details-title-2">Intelligent Trip Units & Remote Monitoring</h3>
                    <p class="mb-40">Integrating micro-processor based trip units into Air Circuit Breakers (ACBs) and Molded Case Circuit Breakers (MCCBs) allows real-time diagnostics via Modbus/RS485 and Ethernet protocols. Engineering teams can now monitor harmonic distortion, phase imbalance, and predictive wear analytics without opening panel doors.</p>
                    <blockquote class="mb-40">
                        <div class="shape"><img src="' . asset('assets/img/icon/blog-details-1.png') . '" alt="icon"></div>
                        <div class="icon"><img src="' . asset('assets/img/icon/quote-2.png') . '" alt="quote"></div>
                        <div class="content">
                            <p>“Safety in electrical engineering is not merely compliance—it is an active architecture designed to protect human lives and prevent catastrophic downtime.”</p>
                            <h4 class="author">Engr. Rajesh Sharma</h4>
                        </div>
                    </blockquote>
                    <h3 class="details-title-2">Best Practices for Industrial Enclosure Fabrication</h3>
                    <p>High-grade CRCA (Cold Rolled Close Annealed) sheet steel with seven-tank phosphate surface treatment and polyurethane powder coating ensures longevity in corrosive industrial environments. Proper IP54/IP65 ingress protection seals cabinets against airborne metallic dust and moisture.</p>
                ',
                'status' => true,
                'featured' => true,
                'trending' => true,
                'allow_comments' => true,
                'sort_order' => 1,
                'published_at' => now()->subDays(2),
                'faqs' => [
                    [
                        'question' => 'What is the standard short-circuit rating for heavy industrial LT panels?',
                        'answer' => 'Typical heavy industrial LT panels are engineered for a short-circuit withstand rating of 50kA to 100kA for 1 second, complying with IEC 61439 standards.'
                    ],
                    [
                        'question' => 'Why is seven-tank surface treatment critical for switchgear enclosures?',
                        'answer' => 'It eliminates grease, rust, and scale while depositing an even zinc-phosphate layer that prevents corrosion and guarantees superior powder coat adhesion.'
                    ]
                ],
                'tags' => ['Switchgear', 'Industrial Safety', 'Power Panels'],
                'seo' => [
                    'meta_title' => 'Innovations in LT Switchgear & IEC 61439 Safety Standards',
                    'meta_description' => 'Discover the latest engineering advancements in Low-Tension switchgear, IEC 61439 compliance, and intelligent trip units for industrial plants.',
                    'meta_keywords' => 'LT switchgear, IEC 61439, industrial safety, electrical control panels'
                ],
                'comments' => [
                    [
                        'name' => 'Vikram Desai (Plant Chief Engineer)',
                        'email' => 'vikram@desaimetals.com',
                        'comment' => 'Excellent breakdown of the IEC 61439 thermal withstand criteria. We recently upgraded our 4000A PCC incomer to microprocessor-based trip units and the real-time diagnostics have already saved us from a Phase-to-Ground fault.'
                    ]
                ]
            ],
            [
                'title' => 'Optimizing Power Control Centers (PCC Panels) for Heavy Manufacturing Plants',
                'slug' => 'optimizing-power-control-centers-pcc-panels-for-heavy-manufacturing-plants',
                'category_id' => $createdCategories[1]->id,
                'author_id' => $authorId,
                'excerpt' => 'A guide to architectural busbar sizing, Form-4b compartmentalization, and fault-level coordination in high-amperage PCC panels.',
                'content' => '
                    <p class="mb-30">Power Control Centers (PCC Panels) serve as the central nervous system of any industrial facility. They receive power directly from step-down transformers and distribute it across motor control centers, utility feeders, and heavy production machinery.</p>
                    <h3 class="details-title-2">Form 4b Compartmentalization for Zero Operator Risk</h3>
                    <p class="mb-40">In Form 4b construction, individual functional units (breakers, feeders) are separated from the busbar zone and from one another, with external terminals enclosed in dedicated sub-compartments. This prevents accidental contact during maintenance and confines any internal arc blast to a single chamber.</p>
                    <h3 class="details-title-2">Electrolytic Copper Busbar Sizing and Joints</h3>
                    <p class="mb-40">Busbar selection requires factoring in skin effect, ambient temperature rise, and continuous full-load ampacity. Using ETP grade 99.9% pure copper with silver-plated or tin-plated joint interfaces minimizes contact resistance and prevents thermal hotspots.</p>
                    <h3 class="details-title-2">Digital Metering & Energy Management Integration</h3>
                    <p>Modern PCC panels integrate multifunction digital energy meters that communicate over RS485 Modbus with factory SCADA systems, enabling continuous power factor correction and automated peak-demand load shedding.</p>
                ',
                'status' => true,
                'featured' => true,
                'trending' => false,
                'allow_comments' => true,
                'sort_order' => 2,
                'published_at' => now()->subDays(5),
                'faqs' => [
                    [
                        'question' => 'What is the difference between Form 3 and Form 4b PCC panel construction?',
                        'answer' => 'Form 4b provides complete separation of busbars from functional units, and separation of all functional units from each other, including individual isolation of outgoing terminals.'
                    ]
                ],
                'tags' => ['Power Panels', 'PCC Panels', 'Automation'],
                'seo' => [
                    'meta_title' => 'Optimizing Industrial PCC Panels & Form 4b Enclosures',
                    'meta_description' => 'Learn how to optimize Power Control Centers (PCC panels) with proper copper busbar sizing, Form 4b compartmentalization, and digital SCADA integration.',
                    'meta_keywords' => 'PCC panels, Form 4b, copper busbar sizing, industrial power control'
                ],
                'comments' => [
                    [
                        'name' => 'Suresh Nair (Electrical Inspector)',
                        'email' => 's.nair@powergrid-inspections.in',
                        'comment' => 'Form 4b construction is an absolute must for 6300A installations. Very well explained article!'
                    ]
                ]
            ],
            [
                'title' => 'Best Practices for AC & DC Solar Combiner Box Integration in Multi-Megawatt Utility Installations',
                'slug' => 'best-practices-for-ac-dc-solar-combiner-box-integration-in-multi-megawatt-utility-installations',
                'category_id' => $createdCategories[2]->id,
                'author_id' => $authorId,
                'excerpt' => 'Engineering considerations for string fusing, surge protection devices (SPDs), and IP65 weatherproof enclosures in utility-scale solar farms.',
                'content' => '
                    <p class="mb-30">In utility-scale photovoltaic installations, solar combiner boxes bridge the gap between thousands of PV strings and central inverters. Proper combiner box engineering directly dictates solar plant availability and fire safety.</p>
                    <h3 class="details-title-2">Selecting Type 1 + Type 2 Surge Protection Devices (SPDs)</h3>
                    <p class="mb-40">Lightning strikes and atmospheric overvoltages pose significant risks to PV arrays. Implementing Type 1+2 DC SPDs rated up to 1500V DC at string combining nodes shunts transient energy safely to ground before reaching sensitive IGBT inverter bridges.</p>
                    <h3 class="details-title-2">String Fusing & Reverse Current Protection</h3>
                    <p class="mb-40">Using gPV cylindrical fuses on both positive and negative strings prevents reverse-current faults in parallel strings from overheating and igniting solar panels.</p>
                    <h3 class="details-title-2">IP65 Polycarbonate & Powder-Coated Metal Enclosures</h3>
                    <p>Combiner boxes operate under intense UV radiation and harsh weather. High-impact polycarbonate or epoxy-powder-coated stainless steel enclosures with breather glands prevent condensation buildup and withstand coastal salt-fog environments.</p>
                ',
                'status' => true,
                'featured' => false,
                'trending' => true,
                'allow_comments' => true,
                'sort_order' => 3,
                'published_at' => now()->subDays(10),
                'faqs' => [
                    [
                        'question' => 'Why are gPV fuses required for both positive and negative strings in solar combiner boxes?',
                        'answer' => 'In ungrounded or floating PV array systems, short-circuit faults can occur on either leg; fusing both conductors ensures complete isolation.'
                    ]
                ],
                'tags' => ['Renewables', 'Solar Grid', 'Industrial Safety'],
                'seo' => [
                    'meta_title' => 'AC & DC Solar Combiner Box Integration Guide',
                    'meta_description' => 'Technical guide on AC/DC solar combiner boxes, 1500V DC SPDs, gPV fusing, and IP65 outdoor enclosure standards for solar farms.',
                    'meta_keywords' => 'solar combiner box, AC combiner panel, DC combiner box, solar SPDs'
                ],
                'comments' => []
            ],
            [
                'title' => 'Next-Generation Intelligent Motor Control Centers (MCC) for Automated Processing Facilities',
                'slug' => 'next-generation-intelligent-motor-control-centers-mcc-for-automated-processing-facilities',
                'category_id' => $createdCategories[1]->id,
                'author_id' => $authorId,
                'excerpt' => 'Exploring draw-out MCC modules, VFD harmonic suppression, and intelligent electronic overload relays for automated industrial plants.',
                'content' => '
                    <p class="mb-30">Modern process industries—including steel, pharmaceuticals, and cement—rely on continuous motor operation. Intelligent Motor Control Centers (iMCC) transform traditional contactor panels into smart automation nodes.</p>
                    <h3 class="details-title-2">Draw-Out Modules for Rapid Hot-Swapping</h3>
                    <p class="mb-40">In a draw-out MCC panel, individual feeder buckets can be racked out and replaced within minutes without shutting down the entire busbar section, reducing Mean Time to Repair (MTTR) to near zero.</p>
                    <h3 class="details-title-2">Harmonic Mitigation for Heavy VFD Loads</h3>
                    <p>When incorporating multiple Variable Frequency Drives (VFDs) into an MCC, integrating active harmonic filters and line reactors is essential to prevent voltage wave distortion and capacitor overheating across the plant electrical network.</p>
                ',
                'status' => true,
                'featured' => false,
                'trending' => false,
                'allow_comments' => true,
                'sort_order' => 4,
                'published_at' => now()->subDays(15),
                'faqs' => [],
                'tags' => ['Automation', 'Power Panels'],
                'seo' => [
                    'meta_title' => 'Intelligent Motor Control Centers (iMCC) for Automation',
                    'meta_description' => 'Explore intelligent MCC panels, draw-out feeder modules, VFD harmonic filtering, and automated motor control engineering.',
                    'meta_keywords' => 'MCC panels, motor control center, iMCC, draw out MCC'
                ],
                'comments' => []
            ]
        ];

        $createdBlogs = [];

        foreach ($blogsData as $bData) {
            $faqs = $bData['faqs'];
            $tags = $bData['tags'];
            $seo = $bData['seo'];
            $comments = $bData['comments'];

            unset($bData['faqs'], $bData['tags'], $bData['seo'], $bData['comments']);

            $bData['featured_image_media_id'] = $featuredMediaId;
            $bData['banner_image_media_id'] = $bannerMediaId;

            $blog = Blog::updateOrCreate(
                ['slug' => $bData['slug']],
                $bData
            );

            // Sync tags
            $tagIds = [];
            foreach ($tags as $tName) {
                $tagModel = BlogTag::where('name', $tName)->first();
                if ($tagModel) {
                    $tagIds[] = $tagModel->id;
                }
            }
            if (!empty($tagIds)) {
                $blog->tags()->sync($tagIds);
            }

            // Sync FAQs
            BlogFaq::where('blog_id', $blog->id)->delete();
            foreach ($faqs as $idx => $faq) {
                BlogFaq::create([
                    'blog_id' => $blog->id,
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                    'sort_order' => $idx + 1
                ]);
            }

            // Sync SEO
            BlogSeo::updateOrCreate(
                ['blog_id' => $blog->id],
                $seo
            );

            // Insert Comments
            foreach ($comments as $comment) {
                BlogComment::updateOrCreate(
                    [
                        'blog_id' => $blog->id,
                        'email' => $comment['email']
                    ],
                    [
                        'name' => $comment['name'],
                        'comment' => $comment['comment'],
                        'status' => 'approved',
                        'created_at' => now()->subHours(12),
                    ]
                );
            }

            $createdBlogs[] = $blog;
        }

        // 4. Create Related Blog Links
        if (count($createdBlogs) >= 2) {
            foreach ($createdBlogs as $idx => $cBlog) {
                $relatedId = $createdBlogs[($idx + 1) % count($createdBlogs)]->id;
                BlogRelated::updateOrCreate([
                    'blog_id' => $cBlog->id,
                    'related_blog_id' => $relatedId
                ]);
            }
        }
    }
}
