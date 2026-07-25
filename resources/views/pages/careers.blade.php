@extends('layouts.master')

@section('title', 'Careers - Possible Electrofeb LLP')
@section('meta_description', 'Join our team of electrical engineering experts at Possible Electrofeb LLP.')
@section('meta_keywords', 'careers, jobs, hiring, electrical engineering, possible electrofeb')

@section('content')
        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Careers</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("careers") }}'> Careers</a></h4>
                </div>
            </div>
        </section>
        <section class="about-section-9 pt-130 pb-130 overflow-hidden fade-wrapper tl-bg-color" id="available-positions">
            <div class="shape-1"><img src="{{ asset('assets/img/shapes/about-shape-8.png') }}" alt="shape"></div>
            <div class="container container-2">
                <div class="row section-heading-wrap fade-top ml-0 mw-100 mb-50">  
                    <div class="shape"><img src="{{ asset('assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">JOIN OUR TEAM</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect title-2">Explore <span>Career Opportunities</span> at Possible Electrofeb</h2>
                        </div>
                    </div>
                </div>

                <!-- Job List Container -->
                <div class="row fade-top">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="job-list-card" style="background: #ffffff; border-radius: 12px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.05); position: relative; z-index: 1;">
                            
                            <!-- Filter Row -->
                            <div class="d-flex flex-wrap align-items-center mb-40" style="gap: 15px;">
                                <div class="d-flex align-items-center flex-grow-1 custom-gray-box">
                                    <i class="fa-regular fa-magnifying-glass" style="color: #9ca3af; font-size: 16px; margin-right: 12px;"></i>
                                    <input type="text" id="jobSearchInput" class="custom-search-input" placeholder="Search positions..." style="border: none; outline: none; background: transparent; width: 100%; font-size: 14.5px; color: #111827;">
                                </div>
                                
                                <div class="flex-shrink-0">
                                    <select id="jobLocationSelect" class="nice-select custom-gray-box" style="min-width: 220px;">
                                        <option value="">All Locations</option>
                                        <option value="rajkot">Rajkot, Gujarat</option>
                                        <option value="ahmedabad">Ahmedabad, Gujarat</option>
                                    </select>
                                </div>
                            </div>

                            <style>
                                /* Exact Search & Filter Box Design */
                                .custom-gray-box {
                                    background-color: #f4f5f7 !important;
                                    border: none !important;
                                    border-radius: 8px !important;
                                    height: 48px !important;
                                    padding: 0 20px !important;
                                    display: flex;
                                    align-items: center;
                                }
                                .custom-search-input::placeholder {
                                    color: #9ca3af;
                                    font-weight: 400;
                                }
                                
                                /* Filter Dropdown (nice-select) Specifics */
                                .job-list-card .nice-select.custom-gray-box {
                                    line-height: 48px !important;
                                    color: #71757f !important;
                                    font-size: 14.5px !important;
                                    box-shadow: none !important;
                                    float: none !important;
                                    width: auto !important;
                                    padding-right: 40px !important;
                                }
                                .job-list-card .nice-select.custom-gray-box::after {
                                    border-bottom: 1.5px solid #9ca3af !important;
                                    border-right: 1.5px solid #9ca3af !important;
                                    height: 6px !important;
                                    width: 6px !important;
                                    right: 20px !important;
                                    margin-top: -4px !important;
                                }
                                .job-list-card .nice-select .list {
                                    border-radius: 8px !important;
                                    box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
                                    border: 1px solid #f3f4f6 !important;
                                    margin-top: 5px !important;
                                    width: auto !important;
                                    min-width: 100% !important;
                                    padding: 8px 0 !important;
                                    white-space: nowrap !important;
                                }
                                .job-list-card .nice-select .option {
                                    padding: 8px 25px !important;
                                    font-size: 14.5px !important;
                                    color: #6b7280 !important;
                                    line-height: 24px !important;
                                    min-height: auto !important;
                                    transition: all 0.2s !important;
                                    white-space: nowrap !important;
                                }
                                .job-list-card .nice-select .option:hover {
                                    background-color: #f9fafb !important;
                                    color: #111827 !important;
                                }
                                .job-list-card .nice-select .option[data-value=""] {
                                    font-weight: 600 !important;
                                    color: #374151 !important;
                                    margin-bottom: 4px !important;
                                }

                                /* Job List General */
                                .clean-job-row {
                                    border-bottom: 1px solid #f0f0f0;
                                    padding: 25px 0;
                                    transition: all 0.3s ease;
                                }
                                .clean-job-row:last-child {
                                    border-bottom: none;
                                    padding-bottom: 0;
                                }
                                .job-icon-text {
                                    font-size: 13px;
                                    color: #777;
                                    display: flex;
                                    align-items: center;
                                    margin-right: 25px;
                                }
                                .job-icon-text i {
                                    color: var(--tl-color-theme-primary);
                                    margin-right: 6px;
                                    font-size: 15px;
                                }
                                
                                /* Buttons */
                                .btn-job-outline {
                                    display: inline-flex;
                                    align-items: center;
                                    justify-content: center;
                                    height: 40px;
                                    border-radius: 4px;
                                    background: transparent;
                                    font-weight: 500;
                                    font-size: 14px;
                                    transition: all 0.3s ease;
                                }
                                .btn-eye {
                                    width: 45px;
                                    border: 1px solid var(--tl-color-theme-primary);
                                    color: var(--tl-color-theme-primary);
                                    margin-right: 12px;
                                }
                                .btn-eye:hover {
                                    background: var(--tl-color-theme-primary);
                                    color: #fff;
                                }
                                .btn-apply {
                                    padding: 0 30px;
                                    border: 1px solid var(--tl-color-theme-primary);
                                    color: var(--tl-color-theme-primary);
                                }
                                .btn-apply:hover {
                                    background: var(--tl-color-theme-primary);
                                    color: #fff;
                                }

                                /* Mobile Responsiveness */
                                @media (max-width: 767px) {
                                    .job-list-card { 
                                        padding: 25px 20px !important; 
                                    }
                                    .job-list-card > .d-flex.flex-wrap.mb-40 {
                                        flex-direction: column;
                                        align-items: stretch !important;
                                        gap: 12px !important;
                                        margin-bottom: 25px !important;
                                    }
                                    .job-list-card .flex-shrink-0,
                                    .job-list-card .nice-select.custom-gray-box {
                                        width: 100% !important;
                                        min-width: 100% !important;
                                    }
                                    .job-icon-text {
                                        margin-bottom: 8px;
                                    }
                                    .modal-header, .modal-body, .modal-footer {
                                        padding: 20px !important;
                                    }
                                    .modal-header h2 {
                                        font-size: 20px !important;
                                    }
                                    .modal-footer {
                                        flex-direction: column;
                                        align-items: stretch !important;
                                        gap: 10px !important;
                                    }
                                    .modal-footer button {
                                        width: 100% !important;
                                        justify-content: center !important;
                                        margin: 0 !important;
                                    }
                                }
                            </style>

                            <!-- Jobs List -->
                            <div class="jobs-wrapper" id="jobsListContainer">
                                <!-- Jobs will be dynamically rendered here via JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Career Details Modal -->
        <div class="modal fade" id="jobModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 15px 40px rgba(0,0,0,0.1);">
                    
                    <!-- Modal Header -->
                    <div class="modal-header" style="border-bottom: 1px solid #eee; padding: 25px 40px; border-radius: 12px 12px 0 0;">
                        <div>
                            <h2 id="modalJobTitle" style="font-size: 24px; font-weight: 500; color: var(--tl-color-theme-primary); margin-bottom: 5px;">Project Engineer (Electrical)</h2>
                            <div style="font-size: 15px; color: #6b7280; display: flex; align-items: center;">
                                <i class="fa-regular fa-location-dot" style="margin-right: 8px;"></i> <span id="modalJobLocation">Rajkot, Gujarat</span>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px; color: #9ca3af; margin-top: -15px;"><i class="fa-regular fa-xmark"></i></button>
                    </div>

                    <!-- Modal Body - Details View -->
                    <div class="modal-body" id="modalDetailsView" style="padding: 30px 40px;">
                        
                        <div style="font-size: 13px; color: #374151; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 15px;">ROLE INFO:</div>
                        
                        <div style="font-size: 15px; color: #4b5563; margin-bottom: 30px; line-height: 1.8;">
                            <strong>Position:</strong> <span id="modalPos">Project Engineer</span><br>
                            <strong>Location:</strong> <span id="modalLoc">Rajkot, Gujarat</span><br>
                            <strong>Number of Positions:</strong> <span id="modalNumPos">1</span>
                        </div>

                        <div style="font-size: 13px; color: #374151; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 15px;">RESPONSIBILITIES:</div>
                        <ul id="modalResponsibilities" style="list-style-type: none; padding-left: 0; color: #6b7280; font-size: 15px; line-height: 1.8; margin-bottom: 30px;">
                            <!-- Injected via JS -->
                        </ul>

                        <div style="font-size: 13px; color: #374151; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 15px;">EXPERIENCE:</div>
                        <div id="modalExperience" style="font-size: 15px; color: #6b7280; margin-bottom: 30px;">
                        </div>

                        <div style="font-size: 13px; color: #374151; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 15px;">QUALIFICATIONS:</div>
                        <div id="modalQualifications" style="font-size: 15px; color: #6b7280; margin-bottom: 15px;">
                        </div>
                    </div>

                    <!-- Modal Footer - Details View -->
                    <div class="modal-footer" id="modalDetailsFooter" style="border-top: 1px solid #eee; padding: 20px 40px; display: flex; justify-content: flex-end;">
                        <button type="button" class="tl-primary-btn" onclick="showApplyForm()">
                            Apply Now <span class="icon"><i class="fa-regular fa-arrow-right"></i></span>
                        </button>
                    </div>

                    <!-- Modal Body - Apply View -->
                    <div class="modal-body" id="modalApplyView" style="padding: 30px 40px; display: none;">
                        <h3 style="font-size: 22px; font-weight: 500; color: #111827; margin-bottom: 25px;">Apply for <span id="applyJobTitle">Project Engineer (Electrical)</span></h3>
                        
                        <form id="applyForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label style="font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 8px;">First Name *</label>
                                    <input type="text" class="form-control custom-modal-input" placeholder="John" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label style="font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 8px;">Last Name *</label>
                                    <input type="text" class="form-control custom-modal-input" placeholder="Doe" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label style="font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 8px;">Email Address *</label>
                                    <input type="email" class="form-control custom-modal-input" placeholder="john.doe@example.com" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label style="font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 8px;">Phone Number *</label>
                                    <input type="tel" class="form-control custom-modal-input" placeholder="+91 98765 43210" required>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <label style="font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 8px;">Upload Resume (PDF, DOCX) *</label>
                                <input type="file" class="form-control custom-modal-input" style="padding: 10px; border-style: dashed; background-color: #f9fafb;" required>
                            </div>
                            <div class="mb-3 mt-4">
                                <label style="font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 8px;">Cover Letter / Additional Info</label>
                                <textarea class="form-control custom-modal-input" rows="4" placeholder="Briefly describe why you are a good fit for this role..."></textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Footer - Apply View -->
                    <div class="modal-footer" id="modalApplyFooter" style="border-top: 1px solid #eee; padding: 20px 40px; display: none; justify-content: flex-end; gap: 15px;">
                        <button type="button" onclick="showDetailsView()" style="background-color: #f3f4f6; padding: 12px 25px; border-radius: 50px; color: #374151; font-weight: 500; font-size: 15px; border: none; transition: 0.3s;">Back to Details</button>
                        <button type="button" class="tl-primary-btn" onclick="submitApplication()">
                            Submit Application <span class="icon"><i class="fa-regular fa-arrow-right"></i></span>
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <style>
            .custom-modal-input {
                border: 1px solid #e5e7eb !important;
                border-radius: 8px !important;
                padding: 12px 15px !important;
                font-size: 14.5px !important;
                color: #4b5563 !important;
                transition: all 0.3s ease !important;
                box-shadow: none !important;
            }
            .custom-modal-input:focus {
                border-color: var(--tl-color-theme-primary) !important;
                box-shadow: 0 0 0 3px rgba(35, 56, 87, 0.1) !important;
                outline: none !important;
            }
            .custom-modal-input::placeholder {
                color: #9ca3af !important;
            }
            
            ul#modalResponsibilities li {
                position: relative;
                padding-left: 20px;
                margin-bottom: 12px;
            }
            ul#modalResponsibilities li::before {
                content: "";
                position: absolute;
                left: 0;
                top: 9px;
                width: 5px;
                height: 5px;
                border-radius: 50%;
                background-color: #9ca3af;
            }
        </style>

        <script>
            // Dummy job data for modal details and dynamic rendering
            const jobData = {
                "Electrical Panel Designer": {
                    location: "Rajkot, Gujarat",
                    numPositions: 2,
                    type: "Full-time",
                    details: [
                        "Design low voltage (LV) and medium voltage (MV) electrical panels.",
                        "Prepare single line diagrams (SLD) and control wiring schematics using AutoCAD.",
                        "Select switchgear components and estimate bill of materials (BOM).",
                        "Coordinate with the production team to ensure accurate panel assembly."
                    ],
                    experience: "2-4 years in electrical panel design and manufacturing.",
                    qualifications: "B.E. / Diploma in Electrical Engineering."
                },
                "Panel Wiring Technician": {
                    location: "Ahmedabad, Gujarat",
                    numPositions: 5,
                    type: "Full-time",
                    details: [
                        "Perform complete wiring of MCC, PCC, and control panels as per drawings.",
                        "Mount switchgear components, busbars, and internal routing.",
                        "Conduct continuity and high voltage (HV) testing of assembled panels.",
                        "Ensure all wiring adheres strictly to safety standards and quality guidelines."
                    ],
                    experience: "1-3 years of hands-on experience in panel wiring.",
                    qualifications: "ITI / Diploma in Electrical."
                }
            };

            function showApplyForm() {
                document.getElementById('modalDetailsView').style.display = 'none';
                document.getElementById('modalDetailsFooter').style.display = 'none';
                document.getElementById('modalApplyView').style.display = 'block';
                document.getElementById('modalApplyFooter').style.display = 'flex';
            }

            function showDetailsView() {
                document.getElementById('modalDetailsView').style.display = 'block';
                document.getElementById('modalDetailsFooter').style.display = 'flex';
                document.getElementById('modalApplyView').style.display = 'none';
                document.getElementById('modalApplyFooter').style.display = 'none';
            }

            function submitApplication() {
                alert('Application submitted successfully!');
                const modalEl = document.getElementById('jobModal');
                // Bootstrap 5 modal instance
                let modal = null;
                if(typeof bootstrap !== 'undefined') {
                    modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();
                } else if(typeof $ !== 'undefined') {
                    $('#jobModal').modal('hide');
                }
            }

            function loadJobDetails(jobTitle) {
                const data = jobData[jobTitle];
                if(data) {
                    document.getElementById('modalJobTitle').innerText = jobTitle;
                    document.getElementById('modalJobLocation').innerText = data.location;
                    document.getElementById('applyJobTitle').innerText = jobTitle;
                    
                    document.getElementById('modalPos').innerText = jobTitle;
                    document.getElementById('modalLoc').innerText = data.location;
                    document.getElementById('modalNumPos').innerText = data.numPositions || '1';
                    
                    document.getElementById('modalExperience').innerText = data.experience || 'Not specified';
                    document.getElementById('modalQualifications').innerText = data.qualifications || 'Not specified';
                    
                    const ul = document.getElementById('modalResponsibilities');
                    ul.innerHTML = '';
                    if(data.details) {
                        data.details.forEach(detail => {
                            const li = document.createElement('li');
                            li.innerText = detail;
                            ul.appendChild(li);
                        });
                    }
                    
                    showDetailsView();
                    const form = document.getElementById('applyForm');
                    if(form) form.reset();
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const modalEl = document.getElementById('jobModal');
                if (modalEl) {
                    document.body.appendChild(modalEl);
                    // Reset modal on close
                    modalEl.addEventListener('hidden.bs.modal', function () {
                        showDetailsView();
                        const form = document.getElementById('applyForm');
                        if(form) form.reset();
                    });
                }

                // Render jobs dynamically
                const jobsListContainer = document.getElementById('jobsListContainer');
                if (jobsListContainer) {
                    jobsListContainer.innerHTML = '';
                    Object.keys(jobData).forEach(title => {
                        const job = jobData[title];
                        const jobHTML = `
                            <div class="clean-job-row row align-items-center">
                                <div class="col-lg-8 col-md-12 mb-3 mb-lg-0">
                                    <h3 class="mb-2" style="font-size: 20px; font-weight: 400; color: #111;">${title}</h3>
                                    <div class="d-flex flex-wrap mt-2">
                                        <span class="job-icon-text"><i class="fa-regular fa-user"></i> ${job.numPositions} Vacanc${job.numPositions > 1 ? 'ies' : 'y'}</span>
                                        <span class="job-icon-text"><i class="fa-regular fa-location-dot"></i> ${job.location}</span>
                                        <span class="job-icon-text"><i class="fa-regular fa-briefcase"></i> ${job.type}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 d-flex justify-content-lg-end mt-3 mt-lg-0">
                                    <button class="btn-job-outline btn-eye" data-bs-toggle="modal" data-bs-target="#jobModal" onclick="loadJobDetails('${title}')"><i class="fa-regular fa-eye"></i></button>
                                    <a href="javascript:void(0)" class="btn-job-outline btn-apply" data-bs-toggle="modal" data-bs-target="#jobModal" onclick="loadJobDetails('${title}'); setTimeout(showApplyForm, 100);">Apply</a>
                                </div>
                            </div>
                        `;
                        jobsListContainer.insertAdjacentHTML('beforeend', jobHTML);
                    });
                }

                // Filter Logic
                const searchInput = document.getElementById('jobSearchInput');
                const locationSelect = document.getElementById('jobLocationSelect');
                let jobRows = document.querySelectorAll('.clean-job-row');

                function filterJobs() {
                    const searchTerm = searchInput.value.toLowerCase();
                    const locationTerm = locationSelect.value.toLowerCase();

                    jobRows.forEach(row => {
                        const titleElement = row.querySelector('h3');
                        const locationElement = row.querySelectorAll('.job-icon-text')[1];
                        
                        const title = titleElement ? titleElement.innerText.toLowerCase() : '';
                        const location = locationElement ? locationElement.innerText.toLowerCase() : '';
                        
                        const matchesSearch = title.includes(searchTerm);
                        const matchesLocation = locationTerm === '' || location.includes(locationTerm);
                        
                        if (matchesSearch && matchesLocation) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                }

                if (searchInput) {
                    searchInput.addEventListener('input', filterJobs);
                }
                
                // If nice-select is used, ensure it updates and triggers change
                if(typeof $ !== 'undefined' && $.fn.niceSelect) {
                    $('#jobLocationSelect').niceSelect('update');
                    $('#jobLocationSelect').on('change', filterJobs);
                } else if (locationSelect) {
                    locationSelect.addEventListener('change', filterJobs);
                }
            });
        </script>

@endsection
