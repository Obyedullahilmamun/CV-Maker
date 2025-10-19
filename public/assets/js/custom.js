// Education Form
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('educationContainer');
    const addButton = document.getElementById('addEducationBtn');

    function addEducationRow() {
        const row = document.createElement('div');
        row.className = 'row mb-2';

        row.innerHTML = `
            <div class="col-md-4">
                <input type="text" name="education_institute[]" class="form-control" placeholder="Institute Name" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="education_department[]" class="form-control" placeholder="Board / Department" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="education_result[]" class="form-control" placeholder="Result" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="education_year[]" class="form-control" placeholder="Passing Year" required>
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <button type="button" class="btn btn-outline-danger remove-education-btn">&times;</button>
            </div>
        `;

        container.appendChild(row);

        // Attach remove logic
        row.querySelector('.remove-education-btn').addEventListener('click', function () {
            row.remove();
        });
    }

    //  Add one education row on page load
    addEducationRow();

    //  Add new row on button click
    addButton?.addEventListener('click', addEducationRow);
});

// Work Experience Form
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('workExperienceContainer');
    const addButton = document.getElementById('addExperienceBtn');

    function addWorkExperienceRow() {
        const row = document.createElement('div');
        row.className = 'row mb-2';

        row.innerHTML = `
            <div class="col-md-3">
                <input type="text" name="job_title[]" class="form-control" placeholder="Job Title" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="job_company[]" class="form-control" placeholder="Company Name" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="job_duration[]" class="form-control" placeholder="Time Period" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="job_description[]" class="form-control" placeholder="Job Description" required>
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <button type="button" class="btn btn-outline-danger remove-exp-btn">&times;</button>
            </div>
        `;

        container.appendChild(row);

        // Add remove functionality for this row
        row.querySelector('.remove-exp-btn').addEventListener('click', function () {
            row.remove();
        });
    }

    // Add one row on page load
    addWorkExperienceRow();

    // Add new row on button click
    addButton?.addEventListener('click', addWorkExperienceRow);
});

// Skills Form 
document.addEventListener("DOMContentLoaded", function () {
        const input = document.getElementById("skillsInput");
        const container = document.getElementById("skills-box");
        const hiddenInput = document.getElementById("skillsHidden");

        let skills = [];

        input.addEventListener("keydown", function (e) {
            if (e.key === "Enter" && input.value.trim() !== "") {
                e.preventDefault();
                addSkill(input.value.trim());
                input.value = "";
            }
        });

        function addSkill(skill) {
            if (skills.includes(skill)) return;

            skills.push(skill);
            updateHiddenInput();

            const tag = document.createElement("span");
            tag.className = "badge bg-primary text-white me-1 mb-1 px-2 py-1 rounded-pill d-inline-flex align-items-center";
            tag.textContent = skill;

            const removeBtn = document.createElement("span");
            removeBtn.className = "ms-2 cursor-pointer";
            removeBtn.style.cursor = "pointer";
            removeBtn.innerHTML = "&times;";
            removeBtn.onclick = function () {
                container.removeChild(tag);
                skills = skills.filter(s => s !== skill);
                updateHiddenInput();
            };

            tag.appendChild(removeBtn);
            container.insertBefore(tag, input);
        }

        function updateHiddenInput() {
            hiddenInput.value = skills.join(",");
        }
    });

// Image and Cropper
document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('imageInput');
    const cropperPreview = document.getElementById('cropperPreview');
    const cropperContainer = document.getElementById('cropperContainer');
    const croppedImageInput = document.getElementById('croppedImageInput');
    const cropButton = document.getElementById('cropButton');
    const croppedPreviewCard = document.getElementById('croppedPreviewCard');
    const croppedPreviewImage = document.getElementById('croppedPreviewImage');
    const cropDimensions = document.getElementById('cropDimensions');
    let cropper;

    imageInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (event) {
            cropperPreview.src = event.target.result;
            cropperPreview.style.display = 'block';
            cropButton.style.display = 'inline-block';
            cropButton.textContent = 'Crop & Save';

            // Reset preview and dimensions
            croppedPreviewCard.style.display = 'none';
            croppedPreviewImage.src = '';
            cropDimensions.textContent = '';
            cropDimensions.style.display = 'none'; // Hide by default

            // Initialize Cropper
            if (cropper) cropper.destroy();
            cropper = new Cropper(cropperPreview, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
                crop(event) {
                    const width = Math.round(event.detail.width);
                    const height = Math.round(event.detail.height);
                    cropDimensions.textContent = `${width} × ${height} px`;
                    cropDimensions.style.display = 'inline'; // Show when ready
                }
            });
        };
        reader.readAsDataURL(file);
    });

    cropButton.addEventListener('click', function () {
        if (!cropper) return;

        cropper.getCroppedCanvas().toBlob(function (blob) {
            const reader = new FileReader();
            reader.onloadend = function () {
                const base64 = reader.result;
                croppedImageInput.value = base64;

                // Show cropped image preview
                croppedPreviewImage.src = base64;
                croppedPreviewCard.style.display = 'block';

                // Update button text
                cropButton.textContent = 'Crop Image';

                // Hide cropper and button
                cropper.destroy();
                cropper = null;
                cropperPreview.style.display = 'none';
                cropButton.style.display = 'none';
                cropDimensions.textContent = '';
                cropDimensions.style.display = 'none'; // Hide after crop
            };
            reader.readAsDataURL(blob);
        });
    });
});

    // Reference Section 
    document.addEventListener('DOMContentLoaded', function () {
    function addReferenceRow() {
        const container = document.getElementById('referenceContainer');
        const row = document.createElement('div');
        row.className = 'row mb-2';

        row.innerHTML = `
            <div class="col-md-11">
                <input type="text" class="form-control" name="references[]" placeholder="Enter reference details">
                <div class="invalid-feedback">Please provide reference details if available.</div>
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <button type="button" class="btn btn-outline-danger remove-reference-btn">&times;</button>
            </div>
        `;

        row.querySelector('.remove-reference-btn').addEventListener('click', function () {
            row.remove();
        });

        container.appendChild(row);
    }

    // Add default reference input on page load
    addReferenceRow();

    const addReferenceBtn = document.getElementById('addReferenceBtn');
    if (addReferenceBtn) {
        addReferenceBtn.addEventListener('click', addReferenceRow);
    }
    });
