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
                            <h2 class="content-header-title float-start mb-0">Level</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.exams.index') }}">Exams</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.exams.index') }}">{{ $subject->exam->name ?? '' }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.exams.show', $subject->exam_id) }}">{{ $subject->name ?? '' }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Levels
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3" style="text-align: end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createQuestion">Create
                        Subject</button>

                    <div class="modal fade modal-danger text-start" id="createQuestion" tabindex="-1"
                        aria-labelledby="myModalLabel120" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel120">Create
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.levels.store') }}" method="POST" id="form_submit">
                                    @csrf

                                    <div class="modal-body">
                                        <div class="row">

                                            <div class="col-md-8 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Name <span
                                                            class="error"></span></label>
                                                    <input type="text" id="first-name-column" name="name"
                                                        class="form-control" placeholder="Name"
                                                        value="{{ $level->name ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="name-submit_errors"></span>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <div class="d-flex flex-column">
                                                        <label class="form-check-label mb-50" for="customSwitch3">Trending</label>
                                                        <div class="form-check form-check-primary form-switch">
                                                            <input type="checkbox" name="trending" 
                                                                @if (!empty($level))
                                                                    {{ (isset($level->trending) && $level->trending == 1) ? 'checked' : '' }}
                                                                @else
                                                                    checked
                                                                @endif
                                                            class="form-check-input" id="customSwitch3" value="1"  />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <div class="d-flex flex-column">
                                                        <label class="form-check-label mb-50"
                                                            for="customSwitch3">Status</label>
                                                        <div class="form-check form-check-primary form-switch">
                                                            <input type="checkbox" name="status"
                                                                @if (!empty($level)) {{ isset($level->status) && $level->status == 1 ? 'checked' : '' }}
                                                                @else
                                                                    checked @endif
                                                                class="form-check-input" id="customSwitch3"
                                                                value="1" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="subject_id" value="{{ $subject->id ?? '' }}"
                                                id="">
                                            <input type="hidden" name="exam_id" value="{{ $subject->exam_id ?? '' }}"
                                                id="">

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="question-column">Total Question <span
                                                            class="error"></span></label>
                                                    <input type="number" id="question-column" name="quaction"
                                                        class="form-control" placeholder="Quaction"
                                                        value="{{ $level->quaction ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="quaction-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="question-column">Total Time (In Minutes)
                                                        <span class="error"></span></label>
                                                    <input type="number" id="question-column" name="time"
                                                        class="form-control" placeholder="Total Time "
                                                        value="{{ $level->time ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="time-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="question-column">Entry Amount<span
                                                            class="error"></span></label>
                                                    <input type="number" id="question-column" name="amount"
                                                        class="form-control" placeholder="Entry amount "
                                                        value="{{ $level->amount ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="amount-submit_errors"></span>
                                                </div>
                                            </div>



                                        </div>
                                    </div>



                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </form>
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
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
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
                                        <input type="text" id="searchInput" class="form-control"
                                            placeholder="Search">
                                    </div>
                                </div>
                                <div class="table-responsive" id="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th>Exam</th>
                                                <th>Subject</th>
                                                <th>Amount</th>
                                                <th>Quaction</th>
                                                <th>Time</th>
                                                <th scope="col">status</th>
                                                <th>Created at</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i = 1; @endphp
                                            @foreach ($levels as $item)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            {{-- <div class="avatar rounded">
                                                                <div class="avatar-content"
                                                                    style="width: 50px;
                                                            height: 50px;">
                                                                    <img src="{{ $item->image }}" alt="Toolbar svg"
                                                                        width="100%" />
                                                                </div>
                                                            </div> --}}
                                                            <div>
                                                                <div class="fw-bolder"><a
                                                                        href="{{ route('admin.exams.levels', $item->id) }}">{{ $item->name ?? '' }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>{{ $item->exam->name ?? '' }}</td>
                                                    <td>{{ $item->subject->name ?? '' }}</td>

                                                    <td>{{ $item->amount ?? '' }}</td>
                                                    <td>{{ $item->quaction ?? '' }}</td>
                                                    <td>{{ $item->time ?? '' }}</td>

                                                    <td>
                                                        <div class="form-check form-check-primary form-switch">
                                                            <input type="checkbox" name="status"
                                                                onchange="changeStatus({{ $item->id }})"
                                                                {{ $item->status == 1 ? 'checked' : '' }}
                                                                class="form-check-input" id="customSwitch3" />
                                                        </div>
                                                    </td>



                                                    {{-- <td>
                                                        <div class="form-check form-check-primary form-switch">
                                                            <input type="checkbox" name="trending"
                                                                onchange="changeTrending({{ $item->id }})"
                                                                {{ $item->trending == 1 ? 'checked' : '' }}
                                                                class="form-check-input" id="customSwitch3" />
                                                        </div>
                                                    </td> --}}

                                                    <td>{{ date('d-m-Y h:i a', strtotime($item->created_at)) }}</td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                                data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">

                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.levels.edit', $item->id) }}">
                                                                    <i data-feather="edit-2" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a>

                                                                {{-- <a class="dropdown-item" href="{{route('admin.levels.show',$item->id)}}">
                                                                <i data-feather="eye" class="me-50"></i>
                                                                <span>View</span>
                                                            </a> --}}


                                                                <a class="dropdown-item" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#danger_ke{{ $item->id }}">
                                                                    <i data-feather="trash" class="me-50"></i>
                                                                    <span>Delete</span>
                                                                </a>

                                                            </div>
                                                        </div>

                                                        <div class="modal fade modal-danger text-start"
                                                            id="danger_ke{{ $item->id }}" tabindex="-1"
                                                            aria-labelledby="myModalLabel120" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">

                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel120">
                                                                            Delete
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete !
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('admin.levels.destroy', $item->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Delete</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach

                                        </tbody>
                                    </table>
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


            $('#form_submit').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission



                var $form = $('#form_submit');
                var url = $form.attr('action');
                var formData = new FormData($form[0]);


                $('.validation-class').html('');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // $('#loader').fadeIn(); // Show the loader with a fade effect
                        $('.spinner-loader').css('display', 'block');
                    },
                    success: function(res) {

                        window.location.href = res;
                    },
                    error: function(res) {

                        // $('#loader').fadeOut(); // Hide the loader with a fade effect
                        if (res.status == 400 || res.status == 422) {
                            if (res.responseJSON && res.responseJSON.errors) {
                                var error = res.responseJSON.errors
                                $.each(error, function(key, value) {
                                    $("#" + key + "-submit_errors").text(value[0]);
                                });
                            }
                        }
                    }
                });
            });
        });
    </script>



    {{-- <script>
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
    </script> --}}

@endsection
