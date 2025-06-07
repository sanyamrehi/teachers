<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Update Profile</h4>
            </div>
            <div class="card-body">
            <!--edit form -->
                <form action="{{ route('teachers.update',['id' => $data['id']]) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="validationname" class="form-label">name</label>
                        <input type="text" name="name" id="name" class="form-control is-valid" value="{{ $data['name'] }}" pattern="[A-Za-z\s]+" required>
                        <!--validation feedback-->
                        <div class="invalid-feedback">
                            Please provide a valid or update name (letters only).
                        </div>
                    </div>
                    <!-- email -->
                    <div class="mb-3">
                        <label for="validationemail" class="form-label">email</label>
                        <input type="email" name="email" id="email" class="form-control is-valid" value="{{ $data['email'] }}" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[cC][oO][mM]$" required>
                        <!--validation feedback-->
                        <div class="invalid-feedback">
                            Please provide a valid or update email address with '@' and ending in '.com' (e.g., user@example.com).
                        </div>
                    </div>

                    <!-- address -->
                    <div class="mb-3">
                        <label for="validationaddress" class="form-label">address</label>
                        <input type="text" name="address" id="address" class="form-control is-valid" value="{{ $data['address'] }} " required>
                        <!--validation feedback-->
                        <div class="invalid-feedback">
                            Please provide a valid or update address.
                        </div>
                    </div>

                    <!-- Contact Number -->
                    <div class="mb-3">

                            <label for="phone">phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone" value="{{ $data['phone'] }}" pattern="^[0-9]{10}$"  required>

                        <!--validation feedback-->
                        <div class="invalid-feedback">
                            Please provide a valid or update phone(digits only).
                        </div>
                    </div>
                    <!--experience label-->
                    <div class="mb-3">

                            <label for="experience" class="form-label">experience</label>
                            <input type="experience" name="experience" id="experience" class="form-control " placeholder="Enter experience" value="{{ $data['experience'] }}"pattern="^(0|[1-9]|1[0-9]|20)$" required>

                        <!--validation feedback-->
                        <div class="invalid-feedback">
                            Please provide a valid or update experience(digits only).
                        </div>
                    </div>

                    <!--qualification label-->
                    <div class="mb-3">

                            <label for="qualification" class="form-label">qualification</label>
                            <input type="qualification" name="qualification" id="qualification" class="form-control " placeholder="Enter qualification" value="{{ $data['qualification'] }}">

                        <!--validation feedback-->
                        <div class="invalid-feedback">
                            Please provide a valid or update qualification.
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Current Image:</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*" onchange="previewImage(event)" value="{{ $data['image']}}">
                        <img src="{{ asset('teachers_images/' . $data['image']) }}" id="imagePreview" alt="Current Image" width="100">
                        <!--validation feedback-->
                        <div class="invalid-feedback">Update valid form image </div>
                    </div>
                    <input type="hidden" class="form-control" name="hdnimage" id="hdnimage" accept="image/*" value="{{ $data['image']}}">

                    <!--check box-->
                    <div class="form-control">
                        <input type="checkbox" name="status" value="Active" {{ old('status', $data->status ?? '') == 'Active' ? 'checked' : '' }}>
                        <!--current check box -->
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
        function previewImage(event) {
            const image = document.getElementById('imagePreview');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.style.display = 'block';
        }//Displayed the current image


        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    //loop for form is valid
                    form.classList.add('was-validated')
                }, false)
            })
        })()

    </script>
</body>
</html>
