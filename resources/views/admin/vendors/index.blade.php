
@extends('admin.layouts.app')

@section('content')

 <!-- BEGIN: Content-->
<!-- BEGIN: Content-->
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Vendor</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{  route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.vendors.index') }}">Vendors</a>
                                    </li>
                                    <li class="breadcrumb-item active">List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                @can('vendors create')
                    <div class="col-md-3" style="text-align: end">
                        <a href="{{ route('admin.vendors.create') }}" class=" btn btn-primary btn-gradient round  ">Create</a>
                    </div>
                @endcan
            </div>
            <div class="content-body">

                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="alert-body">
                                            {{$error}}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
            @endif


                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">
                     <!-- Responsive tables start -->
                <div class="row" >
                    <div class="col-12">
                        <div class="card card-company-table">
                            <div class="card-header">
                                <h4 class="card-title"></h4>
                                <div class="col-md-3" style="text-align: end">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search">
                                </div>
                            </div>
                            <div class="table-responsive" id="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" >#</th>
                                            <th scope="col" >Name</th>
                                            <th scope="col" >Email</th>
                                            <th>Mobile</th>
                                            <th>Type</th>
                                            <th>Created at</th>
                                            @can('vendors edit')
                                            <th>Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php  $i = ($vendors->currentPage() - 1) * $vendors->perPage() + 1; @endphp
                                        @foreach ($vendors as $item)
                                            <tr>
                                                <td >{{ $i }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        {{-- <div class="avatar rounded">
                                                            <div class="avatar-content" style="width: 50px;
                                                            height: 50px;">
                                                                <img src="{{ url('public/uploads/'.$item->image) }}" alt="Toolbar svg" width="100%" />
                                                            </div>
                                                        </div> --}}
                                                        <div>
                                                            <div class="fw-bolder"><a href="{{ route('admin.vendors.show',$item->id) }}">{{ $item->name ?? '' }}</a></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                

                                                {{-- <td >
                                                        <div class="form-check form-check-primary form-switch">
                                                            <input type="checkbox" name="status" onchange="changeStatus({{ $item->id }})" {{ ($item->status == 1) ? 'checked' : '' }} class="form-check-input" id="customSwitch3" />
                                                        </div>    
                                                </td> --}}

                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->mobile }}</td>
                                                <td>{{ $item->type }}</td>
                                                
                                                <td>{{ date('d-m-Y h:i a',strtotime($item->created_at)) }}</td>
                                                
                                                @can('vendors edit')
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            
                                                            <a class="dropdown-item" href="{{route('admin.vendors.show',$item->id)}}">
                                                                <i data-feather="edit-2" class="me-50"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            
                                                            {{-- <a class="dropdown-item" href="{{route('admin.vendors.show',$item->id)}}">
                                                                <i data-feather="eye" class="me-50"></i>
                                                                <span>View</span>
                                                            </a> --}}


                                                            {{-- <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#danger_ke{{ $item->id }}">
                                                                <i data-feather="trash" class="me-50"></i>
                                                                <span>Delete</span>
                                                            </a> --}}

                                                        </div>
                                                    </div>

                                                    <div class="modal fade modal-danger text-start" id="danger_ke{{ $item->id }}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel120">Delete</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete !
                                                                    </div>
                                                                    <form action="{{route('admin.vendors.destroy',$item->id)}}" method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-danger" @if ($item->is_default == 1) @disabled(true) @endif>Delete</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                @endcan
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                                @include('admin._pagination', ['data' => $vendors])
                            </div>
                            
                            {{-- <div class="table-responsive">
                                <table class="table mb-0">
                                    <!-- ... (your table structure) ... -->
                                </table>
                                {{ $vendors->links('admin._pagination') }}
                            </div> --}}
                        </div>
                    </div>
                </div>
                <!-- Responsive tables end -->
                </section>

                <!--/ Ajax Sourced Server-side -->
                
                

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <!-- END: Content-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#searchInput').on('input', function () {
            fetch_data($(this).val());
        });

        function fetch_data(query = '') {
            $.ajax({
                url: "",
                method: 'GET',
                data: {search: query},
                dataType: 'html',
                success: function (data) {
                    $('#table-responsive').html(data);
                }
            });
        }


    });


    function changeStatus(id){
        $.ajax({
            url: "",
            method: 'GET',
            data: {change_status: id},
            // dataType: 'html',
            success: function (data) {
                console.log(data);
                Toastify({
                    text: `${data}`,
                    className: "success",
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    }
                }).showToast();
            }
        });
    }

</script>

@endsection