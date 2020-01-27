@extends('layouts.admin-main')

@section('content')
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Team Access Level</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="teamAccessLevel">N/A</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-lock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Team Name</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="teamInfo">N/A</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-lock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="m-0 font-weight-bold text-primary">Add Employee To Team</h4>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form class="form-group" id="employeeForm">
                        <label for="employeeName">Employee Name</label>
                        <input type="text" class="form-control" name="name" id="employeeName"
                               placeholder="John Doe">
                        <label for="employeeEmail">Employee Email</label>
                        <input type="email" class="form-control" name="email" id="employeeEmail"
                               placeholder="example@example.com">
                        <br/>
                        <input type="submit" id="addButton" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Team Employee List</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Employee Email</th>
                        <th>Last Updated Date</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Employee Name</th>
                        <th>Employee Email</th>
                        <th>Last Updated Date</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Team Accessible Folders</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="folderDataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Folder Name</th>
                        <th>Folder Description</th>
                        <th>Last Updated Date</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Folder Name</th>
                        <th>Folder Description</th>
                        <th>Last Updated Date</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Team Accessible Items</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="itemDataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Item Description</th>
                        <th>Last Updated Date</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Item Name</th>
                        <th>Item Description</th>
                        <th>Last Updated Date</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

        <!-- Content Row -->
        @stop
        @section('javascript')
            {{--            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}
            <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

            <!-- Page level custom scripts -->
            {{--            <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>--}}
        @stop
        @section('javascript_naive')
            <script>
                $('#employeeForm').submit(function (e) {
                    var postData = $('#employeeForm').serialize();
                    /* start ajax submission process */
                    $.ajax({
                        url: '{{ route('addTeamEmployee', ['teamUuid' => Request::route('teamUuid')]) }}',
                        type: "POST",
                        data: postData,
                        success: function (data, textStatus, jqXHR) {
                            $('#dataTable').DataTable().ajax.reload();
                            $('#employeeForm').trigger("reset");
                            $.toast({
                                heading: 'Success',
                                text: 'Team stored successfully',
                                showHideTransition: 'slide',
                                icon: 'success'
                            })
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('Error occurred!');
                        }
                    });
                    e.preventDefault(); //STOP default action
                    /* ends ajax submission process */
                });
                $(document).ready(function () {
                    $.get("{{ route('teamAccess',  ['teamUuid' => Request::route('teamUuid')]) }}", function (data, status) {
                        $('#teamAccessLevel').html(data.data.name);
                    });
                    $.get("{{ url('team',  ['teamUuid' => Request::route('teamUuid')]) }}", function (data, status) {
                        $('#teamInfo').html(data.data.name);
                    });
                    $('#dataTable').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "paging": false,
                        "ajax": '{{ route('teamEmployees', ['teamUuid' => Request::route('teamUuid')]) }}',
                        "columnDefs": [{
                            "targets": 0,
                            "render": function ( data, type, row, meta ) {
                                var itemID = row['uuid'];
                                return '<a href="/admin/employee/' + itemID + '/details">' + data + '</a>';
                            }
                        }],
                        "columns": [
                            {"data": "name"},
                            {"data": "email"},
                            {"data": "updated_at"}
                        ]
                    });

                    $('#folderDataTable').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "paging": false,
                        "ajax": '{{ route('teamFolders', ['teamUuid' => Request::route('teamUuid')]) }}',
                        "columns": [
                            {"data": "name"},
                            {"data": "description"},
                            {"data": "updated_at"}
                        ]
                    });

                    $('#itemDataTable').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "paging": false,
                        "ajax": '{{ route('teamItems', ['teamUuid' => Request::route('teamUuid')]) }}',
                        "columns": [
                            {"data": "name"},
                            {"data": "description"},
                            {"data": "updated_at"}
                        ]
                    });
                });
            </script>

@stop
