@extends('layouts.admin-main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Folders</h1>
    </div>
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Folder</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form class="form-group" id="folderForm">
                        <label for="folderName">Folder Name</label>
                        <input type="text" class="form-control" name="name" id="folderName"
                               placeholder="Folder name">
                        <label for="folderDescription">Folder Description</label>
                        <input type="text" class="form-control" name="description" id="folderDescription"
                               placeholder="Folder name">
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
            <h6 class="m-0 font-weight-bold text-primary">Folder Items</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                $('#folderForm').submit(function (e) {
                    var postData = $('#folderForm').serialize();
                    /* start ajax submission process */
                    console.log(postData);
                    $.ajax({
                        url: '{{ url('/folder') }}',
                        type: "POST",
                        data: postData,
                        success: function (data, textStatus, jqXHR) {
                            $('#dataTable').DataTable().ajax.reload();
                            $('#folderForm').trigger("reset");
                            $.toast({
                                heading: 'Success',
                                text: 'Folder stored successfully',
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
                        "ajax": '{{ url('/folder') }}',
                        "columnDefs": [{
                            "targets": 0,
                            "render": function ( data, type, row, meta ) {
                                var itemID = row['uuid'];
                                return '<a href="/admin/folder/' + itemID + '/details">' + data + '</a>';
                            }
                        }],
                        "columns": [
                            {"data": "name"},
                            {"data": "description"},
                            {"data": "updated_at"}
                        ]
                    });
                });
            </script>

@stop
