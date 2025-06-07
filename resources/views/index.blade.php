{{-- @extends('layouts.app') --}}

@section('content')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (required for Bootstrap dropdown) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Teachers List</h4>
<!-- Success Message (if any) -->
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
<!--create profile button-->
<a class="btn btn-success float-right" href="{{ route('teachers.create') }}" id="create new profile">Create New Profile</a>
<table id="teachersTable" class="display">
    <thead>
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Experience</th>
            <th>Qualification</th>
            <th>Image</th>
            <th>status</th>
            <th>Action</th>

        </tr>
    </thead>
    </div>
    </div>
    </div>

</table>

<script>
    $(document).ready(function() {
        $('#teachersTable').DataTable({
            "order": [[ 0, "desc" ]]//sorting 
            , processing: true
            , serverSide: true
            , ajax: "{{ route('teachers.index') }}"

            , columns: [{
                    data: "DT_RowIndex",
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false

                , }
                ,{
                    data: 'name'
                    , name: 'name'
                , }
                , {
                    data: 'email'
                    , name: 'email',

                }
                , {
                    data: 'address'
                    , name: 'address',

                }
                , {
                    data: 'phone'
                    , name: 'phone',

                }
                , {
                    data: 'experience'
                    , name: 'experience',

                }
                , {
                    data: 'qualification'
                    , name: 'qualification',

                }
                , {
                    data: 'image'
                    , name: 'image'
                , }
                , {
                    data: 'status'
                    , name: 'status'
                }
                , {
                    data: 'action'
                    , orderable: false
                    , searchable: false,


                }
            ]
        });
    });



</script>
<script>
    function confirmDelete(event) {
        event.preventDefault(); // Prevent form submission

        if (confirm("Are you sure you want to delete this item?")) {
            event.target.submit(); // Submit the form if confirmed
        }
    }
</script>

{{-- @endsection --}}
