@extends('layout')

@section('content')
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <h1> Admin Dashboard</h1>
        </div>

        <!-- Navbar -->

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin Dashboard</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->


                <!-- SidebarSearch Form -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="students" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Student Register</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="studentperformance" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Student Performance.</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Students Registration</h1>
                            <br>
                            <a class="btn btn-success" href="javascript:void(0)" id="createNewStudent"> Create New Student</a>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Student Registration</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <table class="table table-bordered student-table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Registration Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="280px">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <!-- Main content -->
            <div class="modal fade" id="StudentModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">

                                <form id="studentForm" method="POST">
                                    <input type="hidden" name="studentid" id="studentid">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Registration Number</label>
                                        <div class="col-md-6">
                                            <input type="text" id="registrationnumber" class="subject-label" name="registrationno" required>


                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                        <div class="col-md-6">
                                            <input type="text" id="name" class="form-control" name="name" required autofocus>
                                            <span id="errorname" class="text-danger"></span>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                        <div class="col-md-6">
                                            <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                            <span id="erroremail" class="text-danger"></span>
                                        </div>
                                    </div>




                                    <div class="col-md-6 offset-md-4">
                                        <button id="saveBtn" type="submit" class="btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Developed by Manoj Perera.</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('scripts')
    <script type="text/javascript">
        function generateRegistrationNumber() {
            var prefix = "SC"; // Prefix for the registration number
            var randomNumber = Math.floor(Math.random() * 10000); // Generate a random number between 0 and 9999
            var paddedNumber = randomNumber.toString().padStart(5, '0'); // Pad the random number with leading zeros to make it 4 digits long
            var noval = prefix + paddedNumber; // Concatenate the prefix and padded number
            return noval;
        }
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#createNewStudent').click(function () {
                $('#studentForm').trigger("reset");
                $('#saveBtn').val("create-student");
                $('#registrationnumber').val(generateRegistrationNumber());
                $('#studentid').val('');
                $('#modelHeading').html("Create New Student");
                $('#errorname').text('');
                $('#erroremail').text('');
                $('#StudentModel').modal('show');
            });


            var table = $('.student-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('allstudents') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'registrationno', name: 'Registration Number'},
                    {data: 'name', name: 'Name',searchable: true},
                    {data: 'email', name: 'Email'},
                    {data: 'action', name: 'Action', orderable: false, searchable: false},
                ]
            });


            $('body').on('click','.deleteStudent',function(){
                var id= $(this).data("id");
                confirm("Are You sure want to delete this Record.This will Delete records including Subjects and Marks Also!");
                $.ajax({
                    type:'DELETE',
                    url: "{{ route('allstudents') }}"+'/'+id,
                    success: function(data){
                        table.draw();
                    },
                    error: function (data){
                        console.log('Error:', data);
                    }
                });
            });



            $('body').on('click','.editStudent',function(){
                var id= $(this).data("id");
                var apiurl=$(this).data("url");
                $.ajax({
                    type:'GET',
                    url: apiurl,
                    success: function(data){
                       console.log(data)
                        $("#name").val(data.name);
                        $("#studentid").val(data.id);
                        $("#email_address").val(data.email);
                        $('#registrationnumber').val(data.registrationno);
                        $('#modelHeading').html('Edit Customer Data');
                        $('#saveBtn').text('Update Changes');
                        $('#StudentModel').modal("show");
                    },
                    error: function (data){
                        console.log('Error:', data);
                    }
                });
            });

            $('#saveBtn').click(function (e) {
              e.preventDefault();
                var formData=$('#studentForm').serialize();
                var params = new URLSearchParams(formData);

                var studentId = params.get('studentid');

                if(studentId == ''){
                    var api="{{ route('register.post') }}";
                    var type= "POST";
                }
                else{
                    var api="{{ route('allstudents') }}"+'/'+studentId;
                    var type= "PATCH";
                }
                $.ajax({
                    data: $('#studentForm').serialize(),
                    url:api,
                    type: type,
                    dataType: 'json',
                    success: function (data) {
                         console.log(data)
                        $('#studentForm').trigger("reset");
                        $('#StudentModel').modal("hide");
                        table.draw();



                    },
                    error: function (data) {

                        var errors=JSON.parse(data.responseText);
                        var newerrors=errors.errors;
                        for (var key in newerrors) {
                            if (newerrors.hasOwnProperty(key)) {
                                if(key=='email'){
                                    $('#erroremail').text(newerrors[key])
                                }
                                if(key=='name'){
                                    $('#errorname').text(newerrors[key])
                                }

                            }
                        }

                    }
                });
            });
        });
    </script>
    </body>
    </html>
@endsection
