@extends('layouts.admin-main')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Access Name</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="accessName">N/A</div>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Access Level</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="accessLevel">N/A</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grant access to employee</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form class="form-group" id="accessEmployeeForm">
                        <label for="employeeWithNoAccessSelect">Employees</label>
                        <select id="employeeWithNoAccessSelect" class="form-control" name="employee">
                            <option value="" selected disabled>select an Employee</option>
                        </select>
                        {{ csrf_field() }}
                        <br/>
                        <input type="submit" id="addButton" class="btn btn-primary"/>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grant access to team</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form class="form-group" id="accessTeamForm">
                        <label for="teamWithNoAccessSelect">Teams</label>
                        <select id="teamWithNoAccessSelect" class="form-control" name="employee">
                            <option value="" selected disabled>select a team</option>
                        </select>
                        {{ csrf_field() }}
                        <br/>
                        <input type="submit" id="addButton" class="btn btn-primary"/>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grant access to folder</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <!-- Card Body -->
                <div class="card-body">
                    <form class="form-group" id="accessFolderForm">
                        <label for="folderWithNoAccessSelect">Folder</label>
                        <select id="folderWithNoAccessSelect" class="form-control" name="employee">
                            <option value="" selected disabled>select a folder</option>
                        </select>
                        {{ csrf_field() }}
                        <br/>
                        <input type="submit" id="addButton" class="btn btn-primary"/>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grant access to Item</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <!-- Card Body -->
                <div class="card-body">
                    <form class="form-group" id="accessItemForm">
                        <label for="itemWithNoAccessSelect">Items</label>
                        <select id="itemWithNoAccessSelect" class="form-control" name="employee">
                            <option value="" selected disabled>select an item</option>
                        </select>
                        {{ csrf_field() }}
                        <br/>
                        <input type="submit" id="addButton" class="btn btn-primary"/>
                    </form>
                </div>
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
                $('#accessEmployeeForm').submit(function (e) {
                    var employeeUuid = $('#employeeWithNoAccessSelect').val();
                    var accessUuid = '{{ Request::route('accessUuid')}}';
                    var url = '/access/' + accessUuid + '/employee/'+ employeeUuid;
                    /* start ajax submission process */
                    $.ajax({
                        url: url,
                        type: "POST",
                        success: function (data, textStatus, jqXHR) {
                            $('#employeeWithNoAccessSelect')
                                .find('option')
                                .remove()
                                .end();
                            employeeWithoutAccess();
                            $.toast({
                                heading: 'Success',
                                text: 'Access grant to employee successfully',
                                showHideTransition: 'slide',
                                icon: 'success'
                            })
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('Error occurred!');
                        }
                    });
                    e.preventDefault(); //STOP default action
                    /* ends ajax submission process employeeWithNoAccess */
                });

                $('#accessTeamForm').submit(function (e) {
                    var teamUuid = $('#teamWithNoAccessSelect').val();
                    var accessUuid = '{{ Request::route('accessUuid')}}';
                    console.log(teamUuid);
                    console.log(accessUuid);
                    var url = '/access/' + accessUuid + '/team/'+ teamUuid;
                    /* start ajax submission process */
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: '{{ csrf_token() }}',
                        success: function (data, textStatus, jqXHR) {
                            $('#teamWithNoAccessSelect')
                                .find('option')
                                .remove()
                                .end();
                            teamWithoutAccess();
                            $.toast({
                                heading: 'Success',
                                text: 'Access grant to team successfully',
                                showHideTransition: 'slide',
                                icon: 'success'
                            })
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('Error occurred!');
                        }
                    });
                    e.preventDefault(); //STOP default action
                    /* ends ajax submission process employeeWithNoAccess */
                });

                $('#accessFolderForm').submit(function (e) {
                    var folderUuid = $('#folderWithNoAccessSelect').val();
                    var accessUuid = '{{ Request::route('accessUuid')}}';
                    console.log(folderUuid);
                    console.log(accessUuid);
                    var url = '/access/' + accessUuid + '/folder/'+ folderUuid;
                    /* start ajax submission process */
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: '{{ csrf_token() }}',
                        success: function (data, textStatus, jqXHR) {
                            $('#folderWithNoAccessSelect')
                                .find('option')
                                .remove()
                                .end();
                            folderWithoutAccess();
                            $.toast({
                                heading: 'Success',
                                text: 'Access grant to folder successfully',
                                showHideTransition: 'slide',
                                icon: 'success'
                            })
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('Error occurred!');
                        }
                    });
                    e.preventDefault(); //STOP default action
                    /* ends ajax submission process employeeWithNoAccess */
                });

                $('#accessItemForm').submit(function (e) {
                    var itemUuid = $('#itemWithNoAccessSelect').val();
                    var accessUuid = '{{ Request::route('accessUuid')}}';
                    console.log(itemUuid);
                    console.log(accessUuid);
                    var url = '/access/' + accessUuid + '/item/'+ itemUuid;
                    /* start ajax submission process */
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: '{{ csrf_token() }}',
                        success: function (data, textStatus, jqXHR) {
                            $('#itemWithNoAccessSelect')
                                .find('option')
                                .remove()
                                .end();
                            itemWithoutAccess();
                            $.toast({
                                heading: 'Success',
                                text: 'Access grant to item successfully',
                                showHideTransition: 'slide',
                                icon: 'success'
                            })
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('Error occurred!');
                        }
                    });
                    e.preventDefault(); //STOP default action
                    /* ends ajax submission process employeeWithNoAccess */
                });
                $(document).ready(function () {
                    $.get("{{ url('/access-level',  ['accessUuid' => Request::route('accessUuid')]) }}", function (data, status) {
                        $('#accessName').html(data.data.name);
                        $('#accessLevel').html(data.data.level);
                    });
                    employeeWithoutAccess();
                    teamWithoutAccess();
                    folderWithoutAccess();
                    itemWithoutAccess();
                });

                function employeeWithoutAccess()
                {
                    $.get("{{ route('employeeWithNoAccess',  ['accessUuid' => Request::route('accessUuid')]) }}", function (data, status) {
                        $.each(data.data, function( index, value ) {
                            $('#employeeWithNoAccessSelect').append('<option value="' + value.uuid + '">' + value.name + '</option>');
                        });
                    });
                }

                function teamWithoutAccess()
                {
                    $.get("{{ route('teamWithNoAccess',  ['accessUuid' => Request::route('accessUuid')]) }}", function (data, status) {
                        $.each(data.data, function( index, value ) {
                            $('#teamWithNoAccessSelect').append('<option value="' + value.uuid + '">' + value.name + '</option>');
                        });
                    });
                }

                function folderWithoutAccess()
                {
                    $.get("{{ route('folderWithNoAccessSelect',  ['accessUuid' => Request::route('accessUuid')]) }}", function (data, status) {
                        $.each(data.data, function( index, value ) {
                            $('#folderWithNoAccessSelect').append('<option value="' + value.uuid + '">' + value.name + '</option>');
                        });
                    });
                }
                function itemWithoutAccess()
                {
                    $.get("{{ route('itemWithNoAccessSelect',  ['accessUuid' => Request::route('accessUuid')]) }}", function (data, status) {
                        $.each(data.data, function( index, value ) {
                            $('#itemWithNoAccessSelect').append('<option value="' + value.uuid + '">' + value.name + '</option>');
                        });
                    });
                }


            </script>

@stop
