@extends('layouts.admin-main')

@section('content')
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Item Access Level
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="itemAccessLevel">N/A</div>
                        </div>
                        <div class="col-auto inner-div">
                            <button class="btn btn-danger" id="revokeAccess">Revoke Access</button>
                            <input type="hidden" value="" id="itemAccessUuid"/>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Item Name</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="itemName">N/A</div>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Item Description
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="itemDescription">N/A</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-audio-description fa-2x text-gray-300"></i>
                        </div>
                    </div>
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

    <!-- Page level custom scripts -->
    {{--            <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>--}}
@stop
@section('javascript_naive')
    <script>
        $(document).ready(function () {
            $.get("{{ route('itemAccess',  ['folderUuid' => Request::route('folderUuid'), 'itemUuid' => Request::route('itemUuid')]) }}", function (data, status) {
                $('#itemAccessLevel').html(data.data.name);
                if (typeof (data.data.uuid) != "undefined" && data.data.uuid !== null) {
                    $('#itemAccessUuid').val(data.data.uuid);
                    $('#revokeAccess').css('display', 'block');
                } else {
                    $('#revokeAccess').css('display', 'none');
                }
            });
            $.get("{{ route('itemDetails',  ['folderUuid' => Request::route('folderUuid'), 'itemUuid' => Request::route('itemUuid')]) }}", function (data, status) {
                $('#itemName').html(data.data.name);
                $('#itemDescription').html(data.data.description);
            });

            $('#revokeAccess').click(function (e) {
                var accessUuid = $('#itemAccessUuid').val();
                var itemUuid = '{{ Request::route('itemUuid') }}';
                var url = '/access/' + accessUuid + '/item/' + itemUuid + ';
                /* start ajax submission process */
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        "_method": 'DELETE',
                        "_token": '{{csrf_token()}}',
                    },
                    success: function (data, textStatus, jqXHR) {
                        $('#revokeAccess').css('display', 'none');
                        $.toast({
                            heading: 'Failure',
                            text: 'item access revoked',
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
