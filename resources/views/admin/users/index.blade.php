@section('style')
    @include('includes.admin.css.datatable')
@endsection

@extends('layouts.admin')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- Start page content-wrapper -->
        <div class="page-content-wrapper">
            <div class="card">
                <div class="card-header text-center bg-primary">
                    <div class="card-title m-0 text-white">
                        All Users
                    </div>
                </div>
                <div class="card-body">
                    <table id="feedback_items_datatable" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- end page-content-wrapper -->
    </div>
    <!-- Container-fluid -->
</div>
@endsection

@push('scripts')
    @include('includes.admin.js.datatable')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#feedback_items_datatable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.dataTable') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'user' },
                    { data: 'email', name: 'email' },
                    { data: 'type', name: 'type' },
                    { data: 'action', searchable: false, orderable: false }
                ],
                lengthMenu: [
                    [5, 10, 50],
                    [5, 10, 50],
                ],
                order: [[1, 'asc']],
            });
        });
    </script>

    <script type="text/javascript">
        function confirmDelete(user) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this user!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/admin/users/${user}`)
                        .then(response => {
                            if (response.status === 200) {
                                Swal.fire('Success', response.data.message, 'success').then(() => {
                                    $('#feedback_items_datatable').DataTable().ajax.reload();
                                });
                            }
                        })
                        .catch(error => {
                            if (error.response.status === 403) {
                                Swal.fire('Error', 'An error occurred while deleting the user.', 'error');
                            }
                        });
                }
            });
        }
    </script>
@endpush
