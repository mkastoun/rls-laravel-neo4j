@extends('layouts.admin-main')

@section('content')
    <!-- Page Heading -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="m-0 font-weight-bold text-primary">Add Employee</h4>
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

    <!-- Content Row -->
@stop

@section('javascript_naive')
    <script>
        $('#employeeForm').submit(function (e) {
            var postData = $('#employeeForm').serialize();
            /* start ajax submission process */
            $.ajax({
                url: '{{ url('/employee/orphan') }}',
                type: "POST",
                data: postData,
                success: function (data, textStatus, jqXHR) {
                    // $('#dataTable').DataTable().ajax.reload();
                    $('#employeeForm').trigger("reset");
                    $.toast({
                        heading: 'Success',
                        text: 'Employee stored successfully',
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
        </script>
@stop
