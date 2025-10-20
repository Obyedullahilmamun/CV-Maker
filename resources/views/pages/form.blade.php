{{-- resources/views/pages/form.blade.php --}}
@extends('layouts.master')

@section('title', isset($user) ? 'Edit Application' : 'Create Application')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                    <h4 class="page-title">{{ isset($user) ? 'Edit Application' : 'CV Submission Form' }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ isset($user) ? route('form.update', $user->id) : route('form.submit') }}" method="POST"
                        enctype="multipart/form-data" class="p-3 p-md-4 rounded shadow bg-body text-body">
                        @csrf
                        @if (isset($user))
                            @method('PUT')
                        @endif

                        <!-- Header -->
                        <h4 class="mb-4 text-primary">Application Form</h4>

                        <!-- First Row -->
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="fullName">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="full_name"
                                    placeholder="Full Name" required
                                    value="{{ isset($user) ? $user->full_name : old('full_name') }}">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="example@mail.com" value="{{ isset($user) ? $user->email : old('email') }}">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="phone">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    placeholder="+1234567890" value="{{ isset($user) ? $user->phone : old('phone') }}">
                            </div>
                        </div>

                        <!-- Second Row -->
                        <div class="row g-3 mt-3">
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="summary">Professional Summary</label>
                                <textarea class="form-control" id="summary" name="summary" placeholder="Brief summary or objective..." rows="4">{{ isset($user) ? $user->summary : old('summary') }}</textarea>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    placeholder="City, Country"
                                    value="{{ isset($user) ? $user->location : old('location') }}">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="linkedin">LinkedIn Profile</label>
                                <input type="url" class="form-control" id="linkedin" name="linkedin"
                                    placeholder="https://linkedin.com/in/yourprofile"
                                    value="{{ isset($user) ? $user->linkedin : old('linkedin') }}">
                            </div>
                        </div>

                        <!-- Education Section -->
                        <div class="mt-4">
                            <label class="form-label">Education</label>
                            <div id="educationContainer">
                                @if (isset($user) && $user->education)
                                    @foreach (json_decode($user->education, true) as $index => $edu)
                                        <div class="education-entry mb-3 border p-3 rounded">
                                            <div class="row g-2">
                                                <div class="col-12 col-md-4 mb-2 mb-md-0">
                                                    <label class="form-label">Institute</label>
                                                    <input type="text" class="form-control" name="education_institute[]"
                                                        value="{{ $edu['institute'] ?? '' }}" required>
                                                </div>
                                                <div class="col-12 col-md-3 mb-2 mb-md-0">
                                                    <label class="form-label">Department</label>
                                                    <input type="text" class="form-control" name="education_department[]"
                                                        value="{{ $edu['department'] ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-2 mb-2 mb-md-0">
                                                    <label class="form-label">Result</label>
                                                    <input type="text" class="form-control" name="education_result[]"
                                                        value="{{ $edu['result'] ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-2 mb-2 mb-md-0">
                                                    <label class="form-label">Year</label>
                                                    <input type="text" class="form-control" name="education_year[]"
                                                        value="{{ $edu['year'] ?? '' }}">
                                                </div>
                                                <div
                                                    class="col-12 col-md-1 d-flex align-items-end justify-content-start justify-content-md-center">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-education mt-2 mt-md-0">×</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="addEducationBtn">+ Add
                                Education</button>
                        </div>

                        <!-- Work Experience Section -->
                        <div class="mt-4">
                            <label class="form-label">Work Experience</label>
                            <div id="workExperienceContainer">
                                @if (isset($user) && $user->experience)
                                    @foreach (json_decode($user->experience, true) as $index => $exp)
                                        <div class="experience-entry mb-3 border p-3 rounded">
                                            <div class="row g-2">
                                                <div class="col-12 col-md-3 mb-2 mb-md-0">
                                                    <label class="form-label">Job Title</label>
                                                    <input type="text" class="form-control" name="job_title[]"
                                                        value="{{ $exp['title'] ?? '' }}" required>
                                                </div>
                                                <div class="col-12 col-md-3 mb-2 mb-md-0">
                                                    <label class="form-label">Company</label>
                                                    <input type="text" class="form-control" name="job_company[]"
                                                        value="{{ $exp['company'] ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-2 mb-2 mb-md-0">
                                                    <label class="form-label">Duration</label>
                                                    <input type="text" class="form-control" name="job_duration[]"
                                                        value="{{ $exp['duration'] ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-3 mb-2 mb-md-0">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control" name="job_description[]" rows="1">{{ $exp['description'] ?? '' }}</textarea>
                                                </div>
                                                <div
                                                    class="col-12 col-md-1 d-flex align-items-end justify-content-start justify-content-md-center">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-experience mt-2 mt-md-0">×</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="addExperienceBtn">+
                                Add Work Experience</button>
                        </div>

                        <!-- Skills and References Row -->
                        <div class="row g-3 mt-4">
                            <!-- Skills -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="form-label" for="skillsInput">Skills</label>
                                <div class="form-control p-2" id="skills-box" style="min-height: 50px;">
                                    @if (isset($user) && $user->skills)
                                        @php
                                            $skills = explode(',', $user->skills);
                                        @endphp
                                        @foreach ($skills as $skill)
                                            <span class="badge bg-primary me-1 mb-1 skill-tag">
                                                {{ trim($skill) }}
                                                <span class="remove-skill" style="cursor:pointer;">×</span>
                                            </span>
                                        @endforeach
                                    @endif
                                    <input type="text" id="skillsInput" class="border-0 w-100"
                                        placeholder="Type a skill and press Enter">
                                </div>
                                <input type="hidden" name="skills" id="skillsHidden"
                                    value="{{ isset($user) ? $user->skills : '' }}">
                            </div>

                            <!-- Reference -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="form-label">References</label>
                                <div id="referenceContainer">
                                    @if (isset($user) && $user->references)
                                        @foreach (json_decode($user->references, true) as $ref)
                                            <div class="reference-entry mb-2">
                                                <input type="text" class="form-control mb-1" name="references[]"
                                                    value="{{ $ref }}" placeholder="Reference">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="addReferenceBtn">+
                                    Add Reference</button>
                            </div>

                            <!-- Image Upload -->
                            <div class="col-12 col-md-12 col-lg-4">
                                <label class="form-label">Upload & Crop Image</label>
                                <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#imageCropModal">
                                    Open Image Cropper
                                </button>

                                <!-- Existing Image Display -->
                                @if (isset($user) && $user->images)
                                    @php
                                        $images = json_decode($user->images, true);
                                        $existingImage = $images[0] ?? null;
                                    @endphp
                                    @if ($existingImage)
                                        <div class="card mt-3">
                                            <div class="card-header">
                                                <strong>Current Image</strong>
                                            </div>
                                            <div class="card-body p-2 text-center">
                                                <img src="{{ asset('storage/' . $existingImage) }}"
                                                    class="img-fluid rounded" style="max-height: 150px; width: auto;" />
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                <!-- Hidden field for cropped image -->
                                <input type="hidden" name="cropped_image" id="croppedImageInput">

                                <!-- Cropped preview shown outside modal -->
                                <div id="croppedPreviewCard" class="card mt-3" style="display: none;">
                                    <div class="card-header">
                                        <strong>Cropped Image</strong>
                                    </div>
                                    <div class="card-body p-2 text-center">
                                        <img id="croppedPreviewImage" src="" class="img-fluid rounded"
                                            style="max-height: 150px; width: auto;" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bootstrap Modal -->
                        <div class="modal fade" id="imageCropModal" tabindex="-1" aria-labelledby="imageCropModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Upload & Crop Image</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <input type="file" id="imageInput" accept="image/*"
                                            class="form-control mb-3">
                                        <div id="cropperContainer" style="max-height: 400px; overflow: hidden;">
                                            <img id="cropperPreview" style="max-width: 100%; display: none;" />
                                        </div>
                                    </div>

                                    <div class="modal-footer d-flex justify-content-between">
                                        <div class="me-auto d-flex align-items-center">
                                            <span id="cropDimensions" class="text-muted small"
                                                style="display: none;"></span>
                                        </div>
                                        <div>
                                            <button type="button" id="cropButton" class="btn btn-primary"
                                                style="display:none;">Crop & Save</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Declaration -->
                        <div class="form-check mt-4">
                            <input type="checkbox" class="form-check-input" id="declarationCheck"
                                name="declarationCheck" required>
                            <label class="form-check-label" for="declarationCheck">
                                I declare that all the information provided is correct to the best of my
                                knowledge.
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button class="btn btn-primary w-100 w-md-auto" type="submit">
                                {{ isset($user) ? 'Update Application' : 'Submit Form' }}
                            </button>
                        </div>
                    </form>
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div> <!-- container -->
    </div> <!-- content -->

    <!-- Education Entry Template (for JavaScript) -->
    <div id="educationTemplate" style="display: none;">
        <div class="education-entry mb-3 border p-3 rounded">
            <div class="row g-2">
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <label class="form-label">Institute</label>
                    <input type="text" class="form-control" name="education_institute[]" required>
                </div>
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <label class="form-label">Department</label>
                    <input type="text" class="form-control" name="education_department[]">
                </div>
                <div class="col-12 col-md-2 mb-2 mb-md-0">
                    <label class="form-label">Result</label>
                    <input type="text" class="form-control" name="education_result[]">
                </div>
                <div class="col-12 col-md-2 mb-2 mb-md-0">
                    <label class="form-label">Year</label>
                    <input type="text" class="form-control" name="education_year[]">
                </div>
                <div class="col-12 col-md-1 d-flex align-items-end justify-content-start justify-content-md-center">
                    <button type="button" class="btn btn-danger btn-sm remove-education mt-2 mt-md-0">×</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Experience Entry Template (for JavaScript) -->
    <div id="experienceTemplate" style="display: none;">
        <div class="experience-entry mb-3 border p-3 rounded">
            <div class="row g-2">
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <label class="form-label">Job Title</label>
                    <input type="text" class="form-control" name="job_title[]" required>
                </div>
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <label class="form-label">Company</label>
                    <input type="text" class="form-control" name="job_company[]">
                </div>
                <div class="col-12 col-md-2 mb-2 mb-md-0">
                    <label class="form-label">Duration</label>
                    <input type="text" class="form-control" name="job_duration[]">
                </div>
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="job_description[]" rows="1"></textarea>
                </div>
                <div class="col-12 col-md-1 d-flex align-items-end justify-content-start justify-content-md-center">
                    <button type="button" class="btn btn-danger btn-sm remove-experience mt-2 mt-md-0">×</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Additional responsive styles */
        @media (max-width: 768px) {

            .education-entry .row,
            .experience-entry .row {
                margin-bottom: 0.5rem;
            }

            .education-entry .col-12,
            .experience-entry .col-12 {
                margin-bottom: 0.5rem;
            }

            .card {
                margin: 0 -0.75rem;
            }
        }

        @media (max-width: 576px) {
            .p-md-4 {
                padding: 1rem !important;
            }

            .education-entry,
            .experience-entry {
                padding: 1rem !important;
            }

            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
            }
        }
    </style>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Initialize skills tags
                initSkills();

                // Add education entry
                $('#addEducationBtn').click(function() {
                    var template = $('#educationTemplate').html();
                    $('#educationContainer').append(template);
                });

                // Add experience entry
                $('#addExperienceBtn').click(function() {
                    var template = $('#experienceTemplate').html();
                    $('#workExperienceContainer').append(template);
                });

                // Remove education entry
                $(document).on('click', '.remove-education', function() {
                    $(this).closest('.education-entry').remove();
                });

                // Remove experience entry
                $(document).on('click', '.remove-experience', function() {
                    $(this).closest('.experience-entry').remove();
                });

                // Add reference
                $('#addReferenceBtn').click(function() {
                    $('#referenceContainer').append(
                        '<div class="reference-entry mb-2"><input type="text" class="form-control mb-1" name="references[]" placeholder="Reference"></div>'
                    );
                });

                function initSkills() {
                    const skillsBox = $('#skills-box');
                    const skillsInput = $('#skillsInput');
                    const skillsHidden = $('#skillsHidden');

                    // Remove skill tag
                    $(document).on('click', '.remove-skill', function() {
                        $(this).parent().remove();
                        updateSkillsHidden();
                    });

                    // Add new skill
                    skillsInput.keypress(function(e) {
                        if (e.which === 13 && $(this).val().trim() !== '') {
                            const skill = $(this).val().trim();
                            const skillTag =
                                `<span class="badge bg-primary me-1 mb-1 skill-tag">${skill} <span class="remove-skill" style="cursor:pointer;">×</span></span>`;
                            skillsBox.prepend(skillTag);
                            $(this).val('');
                            updateSkillsHidden();
                            return false;
                        }
                    });

                    function updateSkillsHidden() {
                        const skills = [];
                        $('.skill-tag').each(function() {
                            skills.push($(this).clone().children().remove().end().text().trim());
                        });
                        skillsHidden.val(skills.join(','));
                    }
                }

                // Image cropper initialization
                let cropper;
                const imageInput = document.getElementById('imageInput');
                const cropperPreview = document.getElementById('cropperPreview');
                const cropButton = document.getElementById('cropButton');
                const croppedImageInput = document.getElementById('croppedImageInput');
                const croppedPreviewImage = document.getElementById('croppedPreviewImage');
                const croppedPreviewCard = document.getElementById('croppedPreviewCard');
                const cropDimensions = document.getElementById('cropDimensions');
                const modalEl = document.getElementById('imageCropModal');

                imageInput.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = () => {
                            cropperPreview.onload = () => {
                                if (cropper) {
                                    cropper.destroy();
                                }

                                cropper = new Cropper(cropperPreview, {
                                    aspectRatio: 1,
                                    viewMode: 1,
                                    autoCrop: true,
                                    autoCropArea: 1,
                                    responsive: true,
                                    background: false,
                                    crop(event) {
                                        const width = Math.round(event.detail.width);
                                        const height = Math.round(event.detail.height);
                                        cropDimensions.textContent = `${width} × ${height} px`;
                                        cropDimensions.style.display =
                                            'inline'; // Show once available
                                    }
                                });

                                cropButton.style.display = 'inline-block';

                                setTimeout(() => {
                                    const data = cropper.getData(true);
                                    const width = Math.round(data.width);
                                    const height = Math.round(data.height);
                                    cropDimensions.textContent = `${width} × ${height} px`;
                                    cropDimensions.style.display = 'inline'; 
                                }, 100);
                            };

                            cropperPreview.src = reader.result;
                            cropperPreview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    }
                });

                cropButton.addEventListener('click', () => {
                    const canvas = cropper.getCroppedCanvas({
                        width: 300,
                        height: 300,
                    });
                    const croppedDataURL = canvas.toDataURL('image/png');

                    croppedImageInput.value = croppedDataURL;
                    croppedPreviewImage.src = croppedDataURL;
                    croppedPreviewCard.style.display = 'block';

                    const modal = bootstrap.Modal.getInstance(modalEl);
                    modal.hide();
                });

            });
        </script>
    @endpush
@endsection
