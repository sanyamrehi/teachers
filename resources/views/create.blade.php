<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Create Profile</h4>
            </div>
            <div class="card-body">
            <!--create form-->
                <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <!-- name -->
                    <div class="mb-3">
                        <label for="validationname" class="form-label">name</label>
                        <input type="text" name="name" id="name" class="form-control is-valid" placeholder="Enter name" value="{{ old('name') }}" pattern="[A-Za-z\s]+" required>
                        <!--validation feedback-->
                        <div class="invalid-feedback">
                            Please provide a valid name (letters only).
                        </div>
                    </div>
                    <!-- email -->
                    <div class="mb-3">
                        <label for="validationemail" class="form-label">Email</label>
                        <input type="email" name="email" id="validationemail" class="form-control is-valid" placeholder="Enter email" value="{{ old('email') }}" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"  placeholder="Enter your email" required>
                        <!-- Validation feedback -->
                        <div class="invalid-feedback">
                            Please provide a valid email address (e.g., user@example.com).
                        </div>
                    </div>

                    <!-- address -->
                    <div class="mb-3">
                        <label for="validationaddress" class="form-label">address</label>
                        <input type="text" name="address" id="address" class="form-control is-valid" placeholder="Enter address" value="{{ old('address') }}" required>
                        <!--validation feedback-->
                        <div class="invalid-feedback">
                            Please provide a valid address.
                        </div>
                    </div>

                    <!-- phone Number -->
                    <div class="mb-3">

                        <label for="validationphone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="validationphone" class="form-control is-valid" placeholder="Enter phone" value="{{ old('phone') }}" pattern="^[0-9]{10}$" required>

                        <!-- Validation feedback -->
                        <div class="invalid-feedback">
                            Please provide a valid phone number with exactly 10 digits (e.g., 1234567890).
                        </div>
                    </div>
                    <!--experience label-->
                    <div class="mb-3">

                        <label for="experience" class="form-label">experience</label>
                        <input type="text" name="experience" id="experience" class="form-control is-valid" placeholder="Enter experience" value="{{ old('experience') }}" pattern="^(0|[1-9]|1[0-9]|20)$" required>

                        <!--validation feedback-->
                        <div class="invalid-feedback">
                            Please provide a valid experience(digits only).
                        </div>
                    </div>
                    <!--qualification label-->
                    <div class="mb-3">

                        <label for="qualification" class="form-label">qualification</label>
                        <input type="qualification" name="qualification" id="qualification" class="form-control is-valid" placeholder="Enter qualification" value="{{ old('qualification') }}" required>

                        <!--validation feedback-->
                        <div class="invalid-feedback">
                            Please provide a valid qualification.
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Image (optional)</label>
                        <input type="file" name="image" id="image" class="form-control" onchange="previewImage(event)"multiple>
                        <img id="preview" class="img-thumbnail mt-2" style="max-width: 150px; display: none;">
                        <!--validation feedback-->
                        <div class="invalid-feedback">Example invalid form image feedback</div>
                    </div>
                    <!--check box-->
                    <div class="form-control">
                        <input type="checkbox" name="status" value="Active">
                        <label>Active</label><br /><br />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">Save</button>
                    <!--Dashboard page -->
                    <a href="{{ route('teachers.index') }}" class="btn btn-primary">Dashboard</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('validationphone').addEventListener('input', function() {
            var phoneInput = document.getElementById('validationphone');//checks the phone is valid
            var feedback = phoneInput.nextElementSibling; // Get the invalid-feedback div

            // Check if the phone number matches the pattern
            if (phoneInput.validity.patternMismatch) {
                phoneInput.classList.add('is-invalid'); // Show invalid feedback
                feedback.style.display = 'block'; // Show the invalid-feedback
            } else {
                phoneInput.classList.remove('is-invalid'); // Hide invalid feedback
                feedback.style.display = 'none'; // Hide the invalid-feedback
            }
        });

    </script>
    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        //image display after selecting
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function validateImage(event) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            const preview = document.getElementById("preview");
            const feedback = document.getElementById("imageFeedback");

            // Reset validation feedback
            fileInput.classList.remove("is-invalid");
            feedback.textContent = "";
            preview.style.display = "none";

            if (file) {
                // Validate file type
                const validTypes = ["image/jpeg", "image/png", "image/gif"];
                if (!validTypes.includes(file.type)) {
                    fileInput.classList.add("is-invalid");
                    feedback.textContent = "Please upload a valid image file (JPEG, PNG, or GIF).";
                    return;
                }

                // Validate file size (e.g., max 2MB)
                const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                if (file.size > maxSize) {
                    fileInput.classList.add("is-invalid");
                    feedback.textContent = "File size must not exceed 2MB.";
                    return;
                }

                // Preview the image
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };
                reader.readAsDataURL(file);
            }
        }

    </script>
</body>
</html>
