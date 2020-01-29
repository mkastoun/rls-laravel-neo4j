@extends('layouts.admin-main')

@section('content')
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Folder Access Level</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="folderAccessLevel">N/A</div>
                        </div>
                        <div class="col-auto inner-div">
                            <button class="btn btn-danger" id="revokeAccess">Revoke Access</button>
                            <input type="hidden" value="" id="folderAccessUuid" />
                        </div>
                        &nbsp;&nbsp;
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Folder Name</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="folderName">N/A</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-info fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Folder Description</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="folderDescription">N/A</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-audio-description fa-2x text-gray-300"></i>
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
                    <h4 class="m-0 font-weight-bold text-primary">Add Item To Folder</h4>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form class="form-group" id="itemForm">
                        <label for="itemName">Item Name</label>
                        <input type="text" class="form-control" name="name" id="itemName"
                               placeholder="Item name">
                        <label for="itemDescription">Item description</label>
                        <input type="text" class="form-control" name="description" id="itemDescription"
                               placeholder="Item description">
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
            <h4 class="m-0 font-weight-bold text-primary">Folder Items</h4>
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
                $('#itemForm').submit(function (e) {
                    var postData = $('#itemForm').serialize();
                    /* start ajax submission process */
                    $.ajax({
                        url: '{{ route('itemStore', ['folderUuid' => Request::route('folderUuid')]) }}',
                        type: "POST",
                        data: postData,
                        success: function (data, textStatus, jqXHR) {
                            $('#itemDataTable').DataTable().ajax.reload();
                            $('#itemForm').trigger("reset");
                            $.toast({
                                heading: 'Success',
                                text: 'Item stored successfully',
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
                    $.get("{{ route('folderAccess',  ['folderUuid' => Request::route('folderUuid')]) }}", function (data, status) {
                        $('#folderAccessLevel').html(data.data.name);
                        if(typeof(data.data.uuid) != "undefined" && data.data.uuid !== null) {
                            $('#folderAccessUuid').val(data.data.uuid);
                            $('#revokeAccess').css('display', 'block');
                        } else {
                            $('#revokeAccess').css('display', 'none');
                        }
                    });
                    $.get("{{ url('folder',  ['folderUuid' => Request::route('folderUuid')]) }}", function (data, status) {
                        $('#folderName').html(data.data.name);
                        $('#folderDescription').html(data.data.description);
                    });

                    $('#itemDataTable').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "paging": false,
                        "ajax": '{{ route('folderItems', ['folderUuid' => Request::route('folderUuid')]) }}',
                        "columnDefs": [{
                            "targets": 0,
                            "render": function ( data, type, row, meta ) {
                                var itemID = row['uuid'];
                                console.log(row);
                                return '<a href="/admin/folder/' + '{{ Request::route('folderUuid') }}' + '/item/'+ itemID +'">' + data + '</a>';
                            }
                        }],
                        "columns": [
                            {"data": "name"},
                            {"data": "description"},
                            {"data": "updated_at"}
                        ]
                    });
                    $('#revokeAccess').click( function (e) {
                        var accessUuid = $('#folderAccessUuid').val();
                        var folderUuid = '{{ Request::route('folderUuid') }}';
                        var url = '/access/' + accessUuid + '/folder/' + folderUuid;
                        /* start ajax submission process */
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                "_method": 'DELETE',
                                "_token": '{{csrf_token()}}',
                            },
                            success: function (data, textStatus, jqXHR) {
                                $('#itemDataTable').DataTable().ajax.reload();
                                $('#revokeAccess').css('display','none');
                                $.toast({
                                    heading: 'Failure',
                                    text: 'Employee access revoked',
                                    showHideTransition: 'slide',
                                    icon: 'failure'
                                })
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                alert('Error occurred!');
                            }
                        });
                        e.preventDefault(); //STOP default action
                        /* ends ajax submission process */
                    });
                });
            </script>

@stop
