@extends('layouts.admin-main')

@section('content')
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employee Name</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="employeeName">N/A</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employee Email</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="employeeEmail">N/A</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-mail-bulk fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employee Access
                                Level
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="employeeAccess">N/A</div>
                        </div>
                        <div class="col-auto inner-div">
                            <button class="btn btn-danger" id="revokeAccess">Revoke Access</button>
                            <input type="hidden" value="" id="employeeAccessUuid" />
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Team
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="employeeTeam">N/A</div>
                        </div>
                        <div class="col-auto inner-div">
                            <button class="btn btn-danger" id="removeFromTeam">Remove From Team</button>
                            <input type="hidden" value="" id="employeeTeamUuid" />
                        </div>
                        &nbsp;&nbsp;
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Employee Accessible Folders</h4>
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
            <h4 class="m-0 font-weight-bold text-primary">Employee Accessible Items</h4>
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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Employee Team Accessible Items ( items accessible by
                employee's team)</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="teamItemDataTable" width="100%" cellspacing="0">
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Employee Team Accessible Folders ( folders accessible by
                employee's team)</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="teamFolderDataTable" width="100%" cellspacing="0">
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
        $(document).ready(function () {
            $.get("{{ route('employeeShow',  ['employeeUuid' => Request::route('employeeUuid')]) }}",
                function (data, status) {
                console.log(data);
                    $('#employeeName').html(data.data.name);
                    $('#employeeEmail').html(data.data.email);
                });
            $.get("{{ route('employeeTeam',  ['employeeUuid' => Request::route('employeeUuid')]) }}",
                function (data, status) {
                    $('#employeeTeam').html(data.data.name);
                    if(typeof(data.data.uuid) != "undefined" && data.data.uuid !== null) {
                        $('#employeeTeamUuid').val(data.data.uuid);
                        $('#removeFromTeam').css('display', 'block');
                    } else {
                        $('#removeFromTeam').css('display', 'none');
                    }
                });
            $.get("{{ route('employeeAccess',  ['employeeUuid' => Request::route('employeeUuid')]) }}",
                function (data, status) {
                    $('#employeeAccess').html(data.data.name);
                    if(typeof(data.data.uuid) != "undefined" && data.data.uuid !== null) {
                        $('#employeeAccessUuid').val(data.data.uuid);
                        $('#revokeAccess').css('display', 'block');
                    } else {
                        $('#revokeAccess').css('display', 'none');
                    }
                });
            $('#folderDataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "paging": false,
                "ajax": '{{ route('employeeFolders', ['employeeUuid' => Request::route('employeeUuid')]) }}',
                "columnDefs": [{
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        var folderId = row['uuid'];
                        return '<a href="/admin/folder/' + folderId + '/details">' + data + '</a>';
                    }
                }],
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
                "ajax": '{{ route('employeeItems', ['employeeUuid' => Request::route('employeeUuid')]) }}',
                "columns": [
                    {"data": "name"},
                    {"data": "description"},
                    {"data": "updated_at"}
                ]
            });

            $('#teamItemDataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "paging": false,
                "ajax": '{{ route('employeeTeamItems', ['employeeUuid' => Request::route('employeeUuid')]) }}',
                "columns": [
                    {"data": "name"},
                    {"data": "description"},
                    {"data": "updated_at"}
                ]
            });
        });
        $('#teamFolderDataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "paging": false,
            "ajax": '{{ route('employeeFolderItems', ['employeeUuid' => Request::route('employeeUuid')]) }}',
            "columnDefs": [{
                "targets": 0,
                "render": function (data, type, row, meta) {
                    var folderId = row['uuid'];
                    return '<a href="/admin/folder/' + folderId + '/details">' + data + '</a>';
                }
            }],
            "columns": [
                {"data": "name"},
                {"data": "description"},
                {"data": "updated_at"}
            ]
        });

        $('#removeFromTeam').click( function (e) {
            var teamUuid = $('#employeeTeamUuid').val();
            var employeeUuid = '{{ Request::route('employeeUuid') }}';
            var url = '/team/' + teamUuid + '/employee/' + employeeUuid;
            /* start ajax submission process */
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    "_method": 'DELETE',
                    "_token": '{{csrf_token()}}',
                },
                success: function (data, textStatus, jqXHR) {
                    $('#teamFolderDataTable').DataTable().ajax.reload();
                    $('#teamItemDataTable').DataTable().ajax.reload();
                    $('#itemDataTable').DataTable().ajax.reload();
                    $('#folderDataTable').DataTable().ajax.reload();
                    $('#removeFromTeam').css('display', 'none');
                    $.toast({
                        heading: 'Failure',
                        text: 'Employee removed from team',
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

        $('#revokeAccess').click( function (e) {
            var accessUuid = $('#employeeAccessUuid').val();
            var employeeUuid = '{{ Request::route('employeeUuid') }}';
            var url = '/access/' + accessUuid + '/employee/' + employeeUuid;
            /* start ajax submission process */
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    "_method": 'DELETE',
                    "_token": '{{csrf_token()}}',
                },
                success: function (data, textStatus, jqXHR) {
                    $('#teamFolderDataTable').DataTable().ajax.reload();
                    $('#teamItemDataTable').DataTable().ajax.reload();
                    $('#itemDataTable').DataTable().ajax.reload();
                    $('#folderDataTable').DataTable().ajax.reload();
                    $('#revokeAccess').css('display', 'none');
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
    </script>

@stop
