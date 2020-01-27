@extends('layouts.admin-main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Access Level</h1>
    </div>
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Create Access</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form class="form-group" id="accessForm">
                        <label for="accessName">Access Name</label>
                        <input type="text" class="form-control" name="name" id="accessName"
                               placeholder="Access Name">
                        <label for="accessLevel">Access Level</label>
                        <input type="number" class="form-control" name="level" id="accessLevel"
                               placeholder="Access Level">
                        {{ csrf_field() }}
                        <br/>
                        <input type="submit" id="addButton" class="btn btn-primary"/>
                    </form>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Access List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Access Name</th>
                        <th>Access Level</th>
                        <th>Last Updated Date</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Access Name</th>
                        <th>Access Level</th>
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
        @stop
        @section('javascript_naive')
            <script>
                $('#accessForm').submit(function (e) {
                    var postData = $('#accessForm').serialize();
                    /* start ajax submission process */
                    $.ajax({
                        url: '{{ url('/access-level') }}',
                        type: "POST",
                        data: postData,
                        success: function (data, textStatus, jqXHR) {
                            $('#dataTable').DataTable().ajax.reload();
                            $('#accessForm').trigger("reset");
                            $.toast({
                                heading: 'Success',
                                text: 'Access stored successfully',
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
                    $('#dataTable').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "paging": false,
                        "dataSrc": "data",
                        "ajax": '{{ url('/access-level') }}',
                        "columnDefs": [{
                            "targets": 0,
                            "render": function ( data, type, row, meta ) {
                                var itemID = row['uuid'];
                                return '<a href="access/' + itemID + '/details">' + data + '</a>';
                            }
                        }],
                        "columns": [
                            {"data": "name"},
                            {"data": "level"},
                            {"data": "updated_at"}
                        ]
                    });
                });
            </script>

@stop
