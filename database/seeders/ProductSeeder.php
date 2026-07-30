<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductFeature;
use App\Models\ProductApplication;
use App\Models\ProductSpecification;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $productsData = [
            [
                'name' => 'LT AC COMBINER PANELS',
                'slug' => 'lt-ac-combiner-panels',
                'short_description' => 'Our LT AC Combiner Panels are heavy-duty, precision-engineered electrical enclosures designed for robust power integration, centralized feeder management, and solar generation combining.',
                'description' => 'Our LT AC Combiner Panels are heavy-duty, precision-engineered electrical enclosures designed for robust power integration, centralized feeder management, and solar generation combining. Built with high-conductivity busbar systems, MCCB/ACB protection, and comprehensive metering, these panels ensure maximum operational safety and energy efficiency across demanding applications.',
                'sort_order' => 1,
                'status' => true,
                'features' => [
                    'Heavy-duty CRCA / GI fabricated enclosure',
                    'Powder-coated indoor & outdoor finish',
                    'High conductivity copper / aluminum busbar system',
                    'MCCB / ACB based incomer & outgoing feeders',
                    'Integrated metering & monitoring arrangement',
                    'Short-circuit & overload protection',
                ],
                'applications' => [
                    'Industrial Manufacturing Plants',
                    'Commercial & Residential Buildings',
                    'Utility & Infrastructure Projects',
                    'Data Centers & IT Facilities',
                    'Renewable Energy Installations',
                    'Institutional & Government Facilities',
                ],
                'specifications' => [
                    'Operating Voltage' => 'Up to 690V AC',
                    'Current Rating' => 'Up to 6300A',
                    'Frequency' => '50Hz',
                    'Short Circuit Withstand Capacity' => 'Up to 100KA for 1 Sec',
                    'Protection Class' => 'IP20 / IP44 / IP54 / IP65',
                    'Busbar Material' => 'Copper / Aluminum',
                    'Installation Type' => 'Indoor / Outdoor',
                    'Standards' => 'IEC / IS Standards',
                ],
            ],
            [
                'name' => 'LT MCC PANEL',
                'slug' => 'lt-mcc-panel',
                'short_description' => 'LT Motor Control Center (MCC) Panels are designed for efficient motor feeder management, automated industrial operations, and safe motor control.',
                'description' => 'LT Motor Control Center (MCC) Panels are designed for efficient motor feeder management, automated industrial operations, and safe motor control. Featuring DOL, Star Delta, and VFD feeder compatibility, integrated indication systems, and robust compartmentalized protection.',
                'sort_order' => 2,
                'status' => true,
                'features' => [
                    'Efficient motor feeder management',
                    'DOL / Star Delta / VFD feeder compatibility',
                    'Integrated control and indication system',
                    'Easy troubleshooting and maintenance',
                    'Safe operation and cable segregation',
                    'Suitable for continuous industrial operation',
                ],
                'applications' => [
                    'Motor Control Systems',
                    'Industrial Automation Plants',
                    'HVAC & Pumping Applications',
                    'Water Treatment Facilities',
                    'Conveyor & Process Industries',
                    'Manufacturing & Production Units',
                ],
                'specifications' => [
                    'Operating Voltage' => '415V AC',
                    'Current Rating' => 'Up to 4000A',
                    'Frequency' => '50Hz',
                    'Feeder Type' => 'DOL / Star Delta / VFD',
                    'Protection Class' => 'IP42 / IP54 / IP65',
                    'Short Circuit Rating' => 'Up to 65KA',
                    'Communication' => 'Modbus / RS485 Optional',
                    'Standard Compliance' => 'IEC / IS Standards',
                ],
            ],
            [
                'name' => 'LT PCC PANELS',
                'slug' => 'lt-pcc-panels',
                'short_description' => 'LT Power Control Center (PCC) Panels are designed for main power distribution and control in heavy industrial plants, commercial complexes, and infrastructure projects.',
                'description' => 'LT Power Control Center (PCC) Panels are designed for main power distribution and control in heavy industrial plants, commercial complexes, and infrastructure projects. Featuring robust modular enclosure construction, ACB/MCCB centralized power control, high-current copper busbars, and floor-mounted installation.',
                'sort_order' => 3,
                'status' => true,
                'features' => [
                    'Modular floor-mounted extendable construction',
                    'High short-circuit withstand capacity up to 100KA',
                    'Air Circuit Breaker (ACB) & MCCB based incomers',
                    'High conductivity electrolytic copper/aluminum busbars',
                    'Advanced digital metering and power quality monitoring',
                    'Comprehensive safety interlocks and shrouding',
                ],
                'applications' => [
                    'Heavy Industrial Manufacturing Plants',
                    'Power Generation & Distribution Stations',
                    'Commercial Complexes & IT Parks',
                    'Steel, Cement & Petrochemical Industries',
                    'High-rise Residential & Commercial Buildings',
                    'Infrastructure & Airport Projects',
                ],
                'specifications' => [
                    'Operating Voltage' => '415V / 690V AC',
                    'Current Rating' => 'Up to 6300A',
                    'Frequency' => '50Hz',
                    'Short Circuit Withstand Capacity' => 'Up to 100KA for 1 Sec',
                    'Protection Class' => 'IP42 / IP52 / IP54',
                    'Busbar Material' => 'Electrolytic Copper / Aluminum',
                    'Enclosure Material' => 'CRCA Sheet Steel (1.6mm / 2.0mm)',
                    'Standards' => 'IEC 61439 / IS 8623',
                ],
            ],
            [
                'name' => 'APFC PANEL',
                'slug' => 'apfc-panel',
                'short_description' => 'Automatic Power Factor Correction (APFC) Panels are engineered to continuously monitor lag power factors, automatically switch capacitor banks, eliminate power utility penalties, and optimize energy costs in commercial and industrial installations.',
                'description' => 'Automatic Power Factor Correction (APFC) Panels are engineered to continuously monitor lag power factors, automatically switch capacitor banks, eliminate power utility penalties, and optimize energy costs in commercial and industrial installations.',
                'sort_order' => 4,
                'status' => true,
                'features' => [
                    'Automatic power factor correction system',
                    'Intelligent APFC relay control',
                    'Heavy-duty capacitor bank arrangement',
                    'Reduced electricity penalty and losses',
                    'Improved system efficiency',
                    'Safe and reliable operation',
                ],
                'applications' => [
                    'Industrial Power Factor Correction',
                    'Commercial Electrical Systems',
                    'Manufacturing Plants',
                    'Textile & Engineering Industries',
                    'HVAC Systems',
                    'Energy Saving Applications',
                ],
                'specifications' => [
                    'Operating Voltage' => '415V AC',
                    'Capacity Range' => '25 KVAR to 1000 KVAR',
                    'Capacitor Type' => 'Heavy-duty polypropylene capacitor',
                    'Switching Type' => 'Contactor / Thyristor Based',
                    'Protection Class' => 'IP42 / IP54 / IP65',
                    'Frequency' => '50Hz',
                    'Power Factor Improvement' => 'Up to 0.99 PF',
                    'Standard Compliance' => 'IEC / IS Standards',
                ],
            ],
            [
                'name' => 'METER PANEL',
                'slug' => 'meter-panel',
                'short_description' => 'Precision Meter Panels are designed for centralized electrical metering, multi-tenant billing, sub-metering, and utility energy distribution in residential, commercial, and industrial infrastructure.',
                'description' => 'Precision Meter Panels are designed for centralized electrical metering, multi-tenant billing, sub-metering, and utility energy distribution in residential, commercial, and industrial infrastructure.',
                'sort_order' => 5,
                'status' => true,
                'features' => [
                    'Compact and durable enclosure design',
                    'Multi-meter installation provision',
                    'Safe cable termination arrangement',
                    'Powder-coated corrosion-resistant finish',
                    'Easy access for maintenance and inspection',
                    'Indoor and outdoor installation suitability',
                ],
                'applications' => [
                    'Utility Metering Systems',
                    'Residential & Commercial Projects',
                    'Industrial Distribution Networks',
                    'Multi-Tenant Buildings',
                    'Infrastructure & Government Projects',
                    'Solar Net Metering Applications',
                ],
                'specifications' => [
                    'Operating Voltage' => '240V / 415V AC',
                    'Meter Type' => 'Single Phase / Three Phase',
                    'Protection Class' => 'IP42 / IP54 / IP65',
                    'Enclosure Material' => 'CRCA / GI',
                    'Mounting Type' => 'Wall Mounted / Floor Mounted',
                    'Current Rating' => 'As per application',
                    'Surface Finish' => 'Powder Coated',
                    'Compliance' => 'Utility & IS Standards',
                ],
            ],
            [
                'name' => 'SOLAR ACDB / DCDB PANEL',
                'slug' => 'solar-acdb-dcdb-panel',
                'short_description' => 'Solar ACDB (AC Distribution Box) and DCDB (DC Distribution Box) Panels are engineered specifically for solar photovoltaic power plants, providing solar array protection, surge suppression, and safe AC/DC isolation.',
                'description' => 'Solar ACDB (AC Distribution Box) and DCDB (DC Distribution Box) Panels are engineered specifically for solar photovoltaic power plants, providing solar array protection, surge suppression, and safe AC/DC isolation.',
                'sort_order' => 6,
                'status' => true,
                'features' => [
                    'Solar-specific protection system',
                    'AC / DC surge protection devices',
                    'UV-resistant and weatherproof enclosure',
                    'MCCB / MCB based protection',
                    'Safe cable termination arrangement',
                    'Indoor and outdoor installation capability',
                ],
                'applications' => [
                    'Rooftop Solar Power Plants',
                    'Ground Mounted Solar Projects',
                    'Industrial Solar Systems',
                    'Commercial Solar Installations',
                    'Solar Pumping Applications',
                    'Renewable Energy Infrastructure',
                ],
                'specifications' => [
                    'System Voltage' => 'Up to 1000V DC / 415V AC',
                    'Protection Degree' => 'IP54 / IP65',
                    'SPD Type' => 'Type I / Type II',
                    'Enclosure Material' => 'CRCA / GI / FRP',
                    'Frequency' => '50Hz',
                    'Installation Type' => 'Indoor / Outdoor',
                    'Standards' => 'IEC / MNRE Compliant',
                    'Cable Entry' => 'Top / Bottom Gland Plate',
                ],
            ],
            [
                'name' => 'CABLE TRAY SYSTEM',
                'slug' => 'cable-tray-system',
                'short_description' => 'Industrial Cable Tray Systems are heavy-duty fabricated cable support systems engineered for organized electrical cable routing, excellent load carrying capacity, and high corrosion resistance across indoor and outdoor environments.',
                'description' => 'Industrial Cable Tray Systems are heavy-duty fabricated cable support systems engineered for organized electrical cable routing, excellent load carrying capacity, and high corrosion resistance across indoor and outdoor environments.',
                'sort_order' => 7,
                'status' => true,
                'features' => [
                    'Heavy-duty fabricated construction',
                    'Ladder type & perforated tray options',
                    'Excellent load carrying capacity',
                    'Corrosion-resistant finish',
                    'Customized sizes and thickness available',
                    'Suitable for indoor and outdoor use',
                ],
                'applications' => [
                    'Industrial Cable Routing',
                    'Commercial Buildings',
                    'Solar Power Projects',
                    'Telecom Infrastructure',
                    'Utility & Process Plants',
                    'Data Centers & Warehousing Facilities',
                ],
                'specifications' => [
                    'Width Range' => '50 mm to 1000 mm',
                    'Side Rail Height' => '25 mm to 150 mm',
                    'Thickness' => '1.2 mm to 3 mm',
                    'Material' => 'GI / HDG / MS / SS / Aluminum',
                    'Finish' => 'Powder Coated / Hot Dip Galvanized',
                    'Type' => 'Ladder / Perforated / Raceway',
                    'Length' => 'Standard 2500 mm / 3000 mm',
                    'Compliance' => 'IEC / IS Standards',
                ],
            ],
        ];

        foreach ($productsData as $dp) {
            $product = Product::updateOrCreate(
                ['slug' => $dp['slug']],
                [
                    'name' => $dp['name'],
                    'short_description' => $dp['short_description'],
                    'description' => $dp['description'],
                    'sort_order' => $dp['sort_order'],
                    'status' => $dp['status'],
                ]
            );

            // Clear old child records before re-seeding
            $product->features()->delete();
            $product->applications()->delete();
            $product->specifications()->delete();

            // Insert Features
            if (!empty($dp['features'])) {
                foreach ($dp['features'] as $idx => $featText) {
                    ProductFeature::create([
                        'product_id' => $product->id,
                        'feature_text' => $featText,
                        'sort_order' => $idx + 1,
                    ]);
                }
            }

            // Insert Applications
            if (!empty($dp['applications'])) {
                foreach ($dp['applications'] as $idx => $appText) {
                    ProductApplication::create([
                        'product_id' => $product->id,
                        'application_text' => $appText,
                        'sort_order' => $idx + 1,
                    ]);
                }
            }

            // Insert Specifications
            if (!empty($dp['specifications'])) {
                $sortIdx = 1;
                foreach ($dp['specifications'] as $label => $value) {
                    ProductSpecification::create([
                        'product_id' => $product->id,
                        'spec_label' => rtrim(trim($label), ':'),
                        'spec_value' => rtrim(trim($value), ':'),
                        'sort_order' => $sortIdx++,
                    ]);
                }
            }
        }
    }
}
