@extends('layout')

@section('content')
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
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
                            <h1 class="m-0">Students Performance</h1>
                            <br>
                            <a class="btn btn-success" href="javascript:void(0)" id="marksbutton"> Add Marks</a>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Student performance</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <table class="table table-bordered performance-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Subjects</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>


            <!-- Main content -->
            <div class="modal fade" id="MarksModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">

                                <form id="studentPerformanceForm" method="POST">
                                    <input type="hidden" name="studentid" id="studentid">
                                    <div class="form-group row">
                                        <label for="name" class="col-form-label text-md-right">Students</label>

                                            <select name="studentid" class="form-control">
                                                <option value="">Select Student</option>
                                                @foreach ($students as $student)
                                                    <option value="{{ $student->id }}">
                                                        {{ $student->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        <span id="errorstudent" class="text-danger"></span>
                                    </div>
                                    <div class="form-group row">

                                        <table>
                                            <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Marks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($subjects as $subject)
                                                <tr>
                                                    <td> <input type="text" class="subject-label" name="subjects[]" value="{{ $subject->name }}" readonly></td>
                                                    <td>
                                                        <input class="form-control" type="number" name="marks[]" value="" max="100" required>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>


                                    <span id="errormarks" class="text-danger"></span>



                                    <div class="col-md-6 offset-md-4">
                                        <button id="SaveChanges" type="submit" class="btn btn-primary">
                                            Add Marks
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="MarksUpdateModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelUpdateHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">

                                <form id="studentPerformanceUpdateForm" method="POST">
                                    <input type="hidden" name="studentid" id="studentupdateid">
                                    <div class="form-group row">
                                        <label for="name" class="col-form-label text-md-right">Name</label>
                                        <input type="text" id="studentname" name="studentname" class="form-control" readonly>

                                    </div>
                                    <div class="form-group row" id="subjectMarksContainer">
                                        <!-- Subject marks will be dynamically added here -->
                                    </div>






                                    <div class="col-md-6 offset-md-4">
                                        <button id="UpdateChanges" type="submit" class="btn btn-danger">
                                            Update Marks
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

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#marksbutton').click(function () {
                $('#studentPerformanceForm').trigger("reset");
                $('#SaveChanges').val("Add Marks");
                $('#studentid').val('');
                $('#errorstudent').text('');
                $('#errormarks').text('');
                $('#modelHeading').html("Register Marks");
                $('#MarksModel').modal('show');
            });


            var table = $('.performance-table').DataTable({
                processing: true,
                serverSide: true,
                ajax:"{{route('student.marks')}}",
                columns: [
                    {data: 'name', name:'Name'},
                    {data: 'subjects', render: function(subjects) {
                            var subjectList = '';
                            $.each(subjects, function(index,subject) {
                                subjectList += '<li>' + subject.name +':'  + subject.pivot.marks + '</li>';
                            });
                            return '<ul>' + subjectList + '</ul>';
                        }},
                    {data: 'action', name: 'Action', orderable: false, searchable: false},

                ]
            });


            const maxInput = document.querySelectorAll('input[name="marks[]"]');
            maxInput.forEach((input) => {
                input.addEventListener('input', () => {
                    if (input.value > 100) {
                        alert("cannot exceed 100");
                        input.value='';
                    }
                });
            });


            $('body').on('click','.deleteMarks',function(){
                var id= $(this).data("id");
                confirm("Are You sure want to delete this Record.This will Delete records including Subjects and Marks Also!");
                $.ajax({
                    type:'DELETE',
                    url: "{{ route('student.marks') }}"+'/'+id,
                    success: function(data){
                        table.draw();
                    },
                    error: function (data){
                        console.log('Error:', data);
                    }
                });
            });




            $('body').on('click','.editMarks',function(){
                var id= $(this).data("id");
                $.ajax({
                    type:'GET',
                    url: "{{ route('student.marks') }}"+"/"+id,
                    success: function(data){
                       $('#studentupdateid').val(data.id);
                       $('#studentname').val(data.name);
                       $('#modelUpdateHeading').html('Update Marks');
                        $('#').val(data.id);
                        const subjectMarksContainer = document.getElementById('subjectMarksContainer');
                        if (subjectMarksContainer.hasChildNodes()) {
                            // Delete all child elements
                            while (subjectMarksContainer.firstChild) {
                                subjectMarksContainer.removeChild(subjectMarksContainer.firstChild);
                            }
                        }
                        data.subjects.forEach(subject => {
                            const subjectInput = document.createElement('input');
                            subjectInput.type = 'text';
                            subjectInput.name = 'subjects[]';
                            subjectInput.value = subject.name;
                            subjectInput.readOnly = true;
                            subjectInput.className='subject-label';
                            subjectMarksContainer.appendChild(subjectInput);

                            const marksInput = document.createElement('input');
                            marksInput.type = 'number';
                            marksInput.name = 'marks[]';
                            marksInput.value = subject.pivot.marks;
                            subjectMarksContainer.appendChild(marksInput);
                        });
                        $('#MarksUpdateModel').modal("show");
                    },
                    error: function (data){
                        console.log('Error:', data);
                    }
                });
            });

            $('#UpdateChanges').click(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $('#studentPerformanceUpdateForm').serialize(),
                    url:"{{ route('students.performance.update') }}",
                    type: "PATCH",
                    dataType: 'json',
                    success: function (data) {
                        $('#studentPerformanceUpdateForm').trigger("reset");
                        $('#MarksUpdateModel').modal("hide");
                        table.draw();

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#SaveChanges').html('Save Changes');
                    }
                });
            });

            $('#SaveChanges').click(function (e) {
              e.preventDefault();
                $.ajax({
                    data: $('#studentPerformanceForm').serialize(),
                    url:"{{ route('student.addmarks') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#studentPerformanceForm').trigger("reset");
                        $('#MarksModel').modal("hide");
                        table.draw();
                        location.reload();

                    },
                    error: function (data) {
                        var errors=JSON.parse(data.responseText);
                        var newerrors=errors.errors;
                        for (var key in newerrors) {
                            if (newerrors.hasOwnProperty(key)) {
                                if(key=='studentid'){
                                    $('#errorstudent').text("Please Fill the student field")
                                }
                                else{
                                    $('#errormarks').text("Please fill all Marks Fields")
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
