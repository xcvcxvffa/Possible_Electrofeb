@extends('layouts.master')

@php
    $rawSlug = request()->route('slug') ?? ($slug ?? request()->query('id', 'lt-pcc-panels'));
    
    $aliasMap = [
        'lt-pcc' => 'lt-pcc-panels',
        'lt-ac-combiner' => 'lt-ac-combiner-panels',
        'lt-mcc' => 'lt-mcc-panel',
        'apfc' => 'apfc-panel',
        'meter' => 'meter-panel',
        'solar-acdb-dcdb' => 'solar-acdb-dcdb-panel',
        'cable-tray' => 'cable-tray-system',
    ];

    $productId = $aliasMap[$rawSlug] ?? $rawSlug;
    
    $productsData = [
        'lt-pcc-panels' => [
            'name' => 'LT PCC PANELS',
            'img' => asset('assets/img/service/service-img-2.png'),
            'desc' => 'LT Power Control Center (PCC) Panels are designed for main power distribution and control in heavy industrial plants, commercial complexes, and infrastructure projects. Featuring robust modular enclosure construction, ACB/MCCB centralized power control, high-current copper busbars, and floor-mounted installation.',
            'features' => [
                'Robust modular enclosure construction',
                'ACB / MCCB based centralized power control',
                'High-current copper busbar arrangement',
                'Safe cable management and segregation',
                'Precision metering and monitoring system',
                'Easy expandability and maintenance'
            ],
            'applications' => [
                'Main Power Distribution Systems',
                'Industrial Processing Units',
                'Commercial Complexes',
                'Infrastructure & Utility Projects',
                'Captive Power Plants',
                'Solar & Renewable Energy Systems'
            ],
            'specs' => [
                'Operating Current :' => 'Up to 6300A',
                'Voltage Rating :' => '415V AC',
                'Frequency :' => '50Hz',
                'Short Circuit Capacity :' => '50KA - 100KA',
                'Protection Degree :' => 'IP42 / IP54 / IP65',
                'Busbar Type :' => 'Electrolytic Copper / Aluminum',
                'Mounting Type :' => 'Floor Mounted',
                'Compliance :' => 'IEC 61439 / IS Standards'
            ]
        ],
        'lt-ac-combiner-panels' => [
            'name' => 'LT AC COMBINER PANELS',
            'img' => asset('assets/img/service/service-details-img-1.png'),
            'desc' => 'Our LT AC Combiner Panels are heavy-duty, precision-engineered electrical enclosures designed for robust power integration, centralized feeder management, and solar generation combining. Built with high-conductivity busbar systems, MCCB/ACB protection, and comprehensive metering, these panels ensure maximum operational safety and energy efficiency across demanding applications.',
            'features' => [
                'Heavy-duty CRCA / GI fabricated enclosure',
                'Powder-coated indoor & outdoor finish',
                'High conductivity copper / aluminum busbar system',
                'MCCB / ACB based incomer & outgoing feeders',
                'Integrated metering & monitoring arrangement',
                'Short-circuit & overload protection'
            ],
            'applications' => [
                'Industrial Manufacturing Plants',
                'Commercial & Residential Buildings',
                'Utility & Infrastructure Projects',
                'Data Centers & IT Facilities',
                'Renewable Energy Installations',
                'Institutional & Government Facilities'
            ],
            'specs' => [
                'Operating Voltage :' => 'Up to 690V AC',
                'Current Rating :' => 'Up to 6300A',
                'Frequency :' => '50Hz',
                'Short Circuit Withstand Capacity :' => 'Up to 100KA for 1 Sec',
                'Protection Class :' => 'IP20 / IP44 / IP54 / IP65',
                'Busbar Material :' => 'Copper / Aluminum',
                'Installation Type :' => 'Indoor / Outdoor',
                'Standards :' => 'IEC / IS Standards'
            ]
        ],
        'lt-mcc-panel' => [
            'name' => 'LT MCC PANEL',
            'img' => asset('assets/img/service/service-img-3.png'),
            'desc' => 'LT Motor Control Center (MCC) Panels are designed for efficient motor feeder management, automated industrial operations, and safe motor control. Featuring DOL, Star Delta, and VFD feeder compatibility, integrated indication systems, and robust compartmentalized protection.',
            'features' => [
                'Efficient motor feeder management',
                'DOL / Star Delta / VFD feeder compatibility',
                'Integrated control and indication system',
                'Easy troubleshooting and maintenance',
                'Safe operation and cable segregation',
                'Suitable for continuous industrial operation'
            ],
            'applications' => [
                'Motor Control Systems',
                'Industrial Automation Plants',
                'HVAC & Pumping Applications',
                'Water Treatment Facilities',
                'Conveyor & Process Industries',
                'Manufacturing & Production Units'
            ],
            'specs' => [
                'Operating Voltage :' => '415V AC',
                'Current Rating :' => 'Up to 4000A',
                'Frequency :' => '50Hz',
                'Feeder Type :' => 'DOL / Star Delta / VFD',
                'Protection Class :' => 'IP42 / IP54 / IP65',
                'Short Circuit Rating :' => 'Up to 65KA',
                'Communication :' => 'Modbus / RS485 Optional',
                'Standard Compliance :' => 'IEC / IS Standards'
            ]
        ],
        'apfc-panel' => [
            'name' => 'APFC PANEL',
            'img' => asset('assets/img/service/service-img-4.png'),
            'desc' => 'Automatic Power Factor Correction (APFC) Panels are engineered to continuously monitor lag power factors, automatically switch capacitor banks, eliminate power utility penalties, and optimize energy costs in commercial and industrial installations.',
            'features' => [
                'Automatic power factor correction system',
                'Intelligent APFC relay control',
                'Heavy-duty capacitor bank arrangement',
                'Reduced electricity penalty and losses',
                'Improved system efficiency',
                'Safe and reliable operation'
            ],
            'applications' => [
                'Industrial Power Factor Correction',
                'Commercial Electrical Systems',
                'Manufacturing Plants',
                'Textile & Engineering Industries',
                'HVAC Systems',
                'Energy Saving Applications'
            ],
            'specs' => [
                'Operating Voltage :' => '415V AC',
                'Capacity Range :' => '25 KVAR to 1000 KVAR',
                'Capacitor Type :' => 'Heavy-duty polypropylene capacitor',
                'Switching Type :' => 'Contactor / Thyristor Based',
                'Protection Class :' => 'IP42 / IP54 / IP65',
                'Frequency :' => '50Hz',
                'Power Factor Improvement :' => 'Up to 0.99 PF',
                'Standard Compliance :' => 'IEC / IS Standards'
            ]
        ],
        'meter-panel' => [
            'name' => 'METER PANEL',
            'img' => asset('assets/img/service/service-img-5.png'),
            'desc' => 'Precision Meter Panels are designed for centralized electrical metering, multi-tenant billing, sub-metering, and utility energy distribution in residential, commercial, and industrial infrastructure.',
            'features' => [
                'Compact and durable enclosure design',
                'Multi-meter installation provision',
                'Safe cable termination arrangement',
                'Powder-coated corrosion-resistant finish',
                'Easy access for maintenance and inspection',
                'Indoor and outdoor installation suitability'
            ],
            'applications' => [
                'Utility Metering Systems',
                'Residential & Commercial Projects',
                'Industrial Distribution Networks',
                'Multi-Tenant Buildings',
                'Infrastructure & Government Projects',
                'Solar Net Metering Applications'
            ],
            'specs' => [
                'Operating Voltage :' => '240V / 415V AC',
                'Meter Type :' => 'Single Phase / Three Phase',
                'Protection Class :' => 'IP42 / IP54 / IP65',
                'Enclosure Material :' => 'CRCA / GI',
                'Mounting Type :' => 'Wall Mounted / Floor Mounted',
                'Current Rating :' => 'As per application',
                'Surface Finish :' => 'Powder Coated',
                'Compliance :' => 'Utility & IS Standards'
            ]
        ],
        'solar-acdb-dcdb-panel' => [
            'name' => 'SOLAR ACDB / DCDB PANEL',
            'img' => asset('assets/img/service/service-img-6.png'),
            'desc' => 'Solar ACDB (AC Distribution Box) and DCDB (DC Distribution Box) Panels are engineered specifically for solar photovoltaic power plants, providing solar array protection, surge suppression, and safe AC/DC isolation.',
            'features' => [
                'Solar-specific protection system',
                'AC / DC surge protection devices',
                'UV-resistant and weatherproof enclosure',
                'MCCB / MCB based protection',
                'Safe cable termination arrangement',
                'Indoor and outdoor installation capability'
            ],
            'applications' => [
                'Rooftop Solar Power Plants',
                'Ground Mounted Solar Projects',
                'Industrial Solar Systems',
                'Commercial Solar Installations',
                'Solar Pumping Applications',
                'Renewable Energy Infrastructure'
            ],
            'specs' => [
                'System Voltage :' => 'Up to 1000V DC / 415V AC',
                'Protection Degree :' => 'IP54 / IP65',
                'SPD Type :' => 'Type I / Type II',
                'Enclosure Material :' => 'CRCA / GI / FRP',
                'Frequency :' => '50Hz',
                'Installation Type :' => 'Indoor / Outdoor',
                'Standards :' => 'IEC / MNRE Compliant',
                'Cable Entry :' => 'Top / Bottom Gland Plate'
            ]
        ],
        'cable-tray-system' => [
            'name' => 'CABLE TRAY SYSTEM',
            'img' => asset('assets/img/service/service-img-1.png'),
            'desc' => 'Industrial Cable Tray Systems are heavy-duty fabricated cable support systems engineered for organized electrical cable routing, excellent load carrying capacity, and high corrosion resistance across indoor and outdoor environments.',
            'features' => [
                'Heavy-duty fabricated construction',
                'Ladder type & perforated tray options',
                'Excellent load carrying capacity',
                'Corrosion-resistant finish',
                'Customized sizes and thickness available',
                'Suitable for indoor and outdoor use'
            ],
            'applications' => [
                'Industrial Cable Routing',
                'Commercial Buildings',
                'Solar Power Projects',
                'Telecom Infrastructure',
                'Utility & Process Plants',
                'Data Centers & Warehousing Facilities'
            ],
            'specs' => [
                'Width Range :' => '50 mm to 1000 mm',
                'Side Rail Height :' => '25 mm to 150 mm',
                'Thickness :' => '1.2 mm to 3 mm',
                'Material :' => 'GI / HDG / MS / SS / Aluminum',
                'Finish :' => 'Powder Coated / Hot Dip Galvanized',
                'Type :' => 'Ladder / Perforated / Raceway',
                'Length :' => 'Standard 2500 mm / 3000 mm',
                'Compliance :' => 'IEC / IS Standards'
            ]
        ]
    ];

    $currentProduct = $productsData[$productId] ?? $productsData['lt-pcc-panels'];
@endphp

@section('title', $currentProduct['name'] . ' - Product Details | Possible Electrofeb LLP')
@section('meta_description', $currentProduct['desc'])

@section('content')
        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">{{ $currentProduct['name'] }}</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("products") }}'> Products</a><span class="icon">-</span><span class="inner-page"> {{ $currentProduct['name'] }}</span></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="service-details pt-130 pb-130">
            <div class="container container-2">
                <div class="row pin-inner">
                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                        <div class="service-details-left-content pin-box mb-0">
                            <div class="service-category-list mb-0">
                                <h3 class="list-title">Our Products</h3>
                                <ul>
                                    <li class="{{ $productId == 'lt-pcc-panels' ? 'active' : '' }}"><a href="{{ route('product.single', ['slug' => 'lt-pcc-panels']) }}">LT PCC PANELS</a></li>
                                    <li class="{{ $productId == 'lt-ac-combiner-panels' ? 'active' : '' }}"><a href="{{ route('product.single', ['slug' => 'lt-ac-combiner-panels']) }}">LT AC COMBINER PANELS</a></li>
                                    <li class="{{ $productId == 'lt-mcc-panel' ? 'active' : '' }}"><a href="{{ route('product.single', ['slug' => 'lt-mcc-panel']) }}">LT MCC PANEL</a></li>
                                    <li class="{{ $productId == 'apfc-panel' ? 'active' : '' }}"><a href="{{ route('product.single', ['slug' => 'apfc-panel']) }}">APFC PANEL</a></li>
                                    <li class="{{ $productId == 'meter-panel' ? 'active' : '' }}"><a href="{{ route('product.single', ['slug' => 'meter-panel']) }}">METER PANEL</a></li>
                                    <li class="{{ $productId == 'solar-acdb-dcdb-panel' ? 'active' : '' }}"><a href="{{ route('product.single', ['slug' => 'solar-acdb-dcdb-panel']) }}">SOLAR ACDB / DCDB PANEL</a></li>
                                    <li class="{{ $productId == 'cable-tray-system' ? 'active' : '' }}"><a href="{{ route('product.single', ['slug' => 'cable-tray-system']) }}">CABLE TRAY SYSTEM</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="service-details-content scroll-content">
                            <div class="service-details-img overflow-hidden shadow-sm" style="border-radius: 20px;">
                                <img src="{{ $currentProduct['img'] }}" alt="{{ $currentProduct['name'] }}" style="width: 100%; border-radius: 20px; object-fit: cover;">
                            </div>
                            
                            <h1 class="details-title mt-4" style="color: #0097A0; font-weight: 500; letter-spacing: 0.5px;">{{ $currentProduct['name'] }}</h1>
                            <p class="fs-6" style="line-height: 1.8; color: #4a4a4a;">{{ $currentProduct['desc'] }}</p>
                            
                            <!-- Key Features & Applications Grid -->
                            <div class="row gy-4 my-4">
                                <div class="col-md-6">
                                    <div class="p-0 rounded-4 bg-white shadow-sm h-100 overflow-hidden border">
                                        <div class="px-4 py-3 text-white fw-bold" style="background: #0097A0; font-size: 16px; letter-spacing: 0.5px;">
                                            <span>KEY FEATURES :</span>
                                        </div>
                                        <div class="p-4">
                                            <ul class="list-unstyled mb-0" style="font-size: 14.5px; color: #333333; line-height: 1.8;">
                                                @foreach($currentProduct['features'] as $feature)
                                                    <li class="mb-3 d-flex align-items-start gap-2"><i class="fa-solid fa-circle-check mt-1" style="color: #0097A0;"></i> <span>{{ $feature }}</span></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="p-0 rounded-4 bg-white shadow-sm h-100 overflow-hidden border">
                                        <div class="px-4 py-3 text-white fw-bold" style="background: #0097A0; font-size: 16px; letter-spacing: 0.5px;">
                                            <span>APPLICATIONS :</span>
                                        </div>
                                        <div class="p-4">
                                            <ul class="list-unstyled mb-0" style="font-size: 14.5px; color: #333333; line-height: 1.8;">
                                                @foreach($currentProduct['applications'] as $app)
                                                    <li class="mb-3 d-flex align-items-start gap-2"><i class="fa-solid fa-circle-arrow-right mt-1" style="color: #0097A0;"></i> <span>{{ $app }}</span></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Technical Details Section -->
                            <div class="my-4">
                                <div class="rounded-4 overflow-hidden shadow-sm border bg-white" style="border-color: #e2e8f0 !important;">
                                    <div class="px-4 py-3 text-white fw-bold" style="background: #0097A0; font-size: 16px; letter-spacing: 0.5px;">
                                        <span>TECHNICAL DETAILS :</span>
                                    </div>
                                    
                                    <div class="tech-spec-list">
                                        @foreach($currentProduct['specs'] as $param => $val)
                                            <div class="d-flex align-items-center px-4 py-3 tech-spec-item" style="background-color: {{ $loop->odd ? '#f7fafc' : '#ffffff' }}; {{ !$loop->last ? 'border-bottom: 1px solid #edf2f7;' : '' }}">
                                                <div class="spec-label" style="width: 44%; font-weight: 700; color: #1a202c; font-size: 14.5px;">{{ $param }}</div>
                                                <div class="spec-value" style="width: 56%; color: #4a5568; font-weight: 500; font-size: 14.5px;">{{ $val }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ service-details -->
@endsection
