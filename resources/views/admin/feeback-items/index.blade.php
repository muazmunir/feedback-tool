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
                            <li class="breadcrumb-item active">Feedback Items</li>
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
                        All Feedback Items
                    </div>
                </div>
                <div class="card-body">
                    <table id="feedback_items_datatable"
                        class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                               
                                <th>{{ __('#') }}</th>                                
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Vote') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                    </table>
                     
                </div>
            </div>
        </div>
        <!-- end page-content-wrapper-->
    </div>
    <!-- Container-fluid -->
</div>

@endsection
@push('scripts')
@include('includes.admin.js.datatable')
<script type="text/javascript">
    $(document).ready(function(){
    
        $("#feedback_items_datatable").DataTable({             
            processing: true,
            serverSide: true,
            ajax: "{{ route('feedback-items.dataTable') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'user.name', name: 'user' },
                { data: 'title', name: 'title' }, 
                { data: 'category', name: 'category' }, 
                { data: 'vote_count', name: 'vote_count' },
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
    function confirmDelete(feedbackItem) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this feedback!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/admin/feedback-items/${feedbackItem}`)
                    .then(response => {
                        if (response.status === 200) {
                            Swal.fire('Success', response.data.message, 'success').then(() => {
                                $('#feedback_items_datatable').DataTable().ajax.reload();
                            });
                        }
                    })
                    .catch(error => {
                        if (error.response.status === 403) {
                            Swal.fire('Error', 'An error occurred while deleting the blog.', 'error');
                             
                        }  
                    });
            }
        });
    }
</script>
 
@endpush