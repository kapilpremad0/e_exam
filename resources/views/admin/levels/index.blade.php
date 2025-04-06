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
                            <h2 class="content-header-title float-start mb-0">Submit Result</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.submit_results.index') }}">Submit Results</a>
                                    </li>
                                    <li class="breadcrumb-item active">List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>


              

            </div>
            <div class="content-body">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                {{ $error }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif


                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">
                    <!-- Responsive tables start -->
                    <div class="row">
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
                                                <th scope="col">#</th>
                                                <th scope="col">User Name</th>
                                                <th>Level</th>
                                                <th>Exam</th>
                                                <th>Subject</th>
                                                <th>correct_answer</th>
                                                <th>total_question</th>
                                                <th>Created at</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i = ($levels->currentPage() - 1) * $levels->perPage() + 1; @endphp
                                            @foreach ($levels as $item)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                           
                                                            <div>
                                                                <div class="fw-bolder">{{ $item->user->name ?? '' }}</div>
                                                                <div class="fw-small">{{ $item->user->email ?? '' }}</div>
                                                                <div class="fw-small">{{ $item->user->mobile ?? '' }}</div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>{{ $item->level->name ?? '' }}</td>
                                                    <td>{{ $item->level->exam->name ?? '' }}</td>

                                                    <td>{{ $item->level->subject->name ?? '' }}</td>
                                                    <td>{{ $item->correct_answer ?? '' }}</td>
                                                    <td>{{ $item->total_question ?? '' }}</td>

                                                    <td>{{ date('d-m-Y h:i a', strtotime($item->created_at)) }}</td>

                                                    

                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach

                                        </tbody>
                                    </table>
                                    @include('admin._pagination', ['data' => $levels])
                                </div>

                                {{-- <div class="table-responsive">
                                <table class="table mb-0">
                                    <!-- ... (your table structure) ... -->
                                </table>
                                {{ $levels->links('admin._pagination') }}
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
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                fetch_data($(this).val());
            });

            function fetch_data(query = '') {
                $.ajax({
                    url: "",
                    method: 'GET',
                    data: {
                        search: query
                    },
                    dataType: 'html',
                    success: function(data) {
                        $('#table-responsive').html(data);
                    }
                });
            }


        });


        function changeStatus(id) {
            $.ajax({
                url: "",
                method: 'GET',
                data: {
                    change_status: id
                },
                // dataType: 'html',
                success: function(data) {
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

        function changeTrending(id) {
            $.ajax({
                url: "",
                method: 'GET',
                data: {
                    change_trending: id
                },
                // dataType: 'html',
                success: function(data) {
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
