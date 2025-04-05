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
                            <h2 class="content-header-title float-start mb-0">Question</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.exams.index') }}">Exams</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.exams.index') }}">{{ $level->exam->name ?? '' }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.exams.show', $level->exam_id) }}">{{ $level->subject->name ?? '' }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                        href="{{ route('admin.exams.subjects', $level->subject) }}">{{ $level->name ?? '' }}</a>
                                </li>
                                    <li class="breadcrumb-item active">Questions
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="content-body">

                {{-- @include('admin.vendors.show.tab-bar') --}}


                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">
                    <!-- Responsive tables start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-company-table">
                                <div class="card-header">
                                    <h2></h2>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#createQuestion">Create Question</button>

                                    <div class="modal fade modal-danger text-start" id="createQuestion" tabindex="-1"
                                        aria-labelledby="myModalLabel120" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel120">Create Question
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.questions.store') }}" method="POST" id="form_submit">
                                                    @csrf

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            
                                                            <input type="hidden" name="level_id" value="{{ $level->id }}">

                                                            <div class="col-md-12 col-12">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="first-name-column">Name <span
                                                                            class="error"></span></label>
                                                                    <input type="text" id="first-name-column" name="name"
                                                                        class="form-control" placeholder="Name"
                                                                        value="{{ $level->name ?? '' }}" />
                                                                    <span class="text-danger validation-class" id="name-submit_errors"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="option_a">option_a <span
                                                                            class="error"></span></label>
                                                                    <input type="text" id="option_a-column" name="option_a"
                                                                        class="form-control" placeholder="option_a"
                                                                        value="{{ $level->option_a ?? '' }}" />
                                                                    <span class="text-danger validation-class" id="option_a-submit_errors"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="option_b">Option B <span
                                                                            class="error"></span></label>
                                                                    <input type="text" id="option_b-column" name="option_b"
                                                                        class="form-control" placeholder="Option B"
                                                                        value="{{ $level->option_b ?? '' }}" />
                                                                    <span class="text-danger validation-class" id="option_b-submit_errors"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="option_c">Option C <span
                                                                            class="error"></span></label>
                                                                    <input type="text" id="option_c-column" name="option_c"
                                                                        class="form-control" placeholder="Option C"
                                                                        value="{{ $level->option_c ?? '' }}" />
                                                                    <span class="text-danger validation-class" id="option_c-submit_errors"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="option_d">Option D <span
                                                                            class="error"></span></label>
                                                                    <input type="text" id="option_d-column" name="option_d"
                                                                        class="form-control" placeholder="Option D"
                                                                        value="{{ $level->option_d ?? '' }}" />
                                                                    <span class="text-danger validation-class" id="option_d-submit_errors"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="correct_answer">Correct Answer <span
                                                                            class="error"></span></label>
                                                                            <select name="correct_answer" id="correct_answer" class="form-select">
                                                                                <option value="">(Select Option)</option>
                                                                            @php
                                                                                $otions = ['a','b','c','d'];
                                                                                
                                                                            @endphp
                                                                            @foreach ($otions as $item)
                                                                                <option value="{{ $item }}">{{ $item }}</option>
                                                                            @endforeach
                                                                            </select>
                                                                    {{-- <input type="text" id="correct_answer-column" name="correct_answer"
                                                                        class="form-control" placeholder="Correct Answer"
                                                                        value="{{ $level->correct_answer ?? '' }}" /> --}}
                                                                    <span class="text-danger validation-class" id="correct_answer-submit_errors"></span>
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
                                <div class="table-responsive" id="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Option A</th>
                                                <th scope="col">Bption B</th>
                                                <th scope="col">Option C</th>
                                                <th scope="col">Option C</th>
                                                <th scope="col">Correct Answer</th>
                                                <th>Created at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @php  $i = ($transactions->currentPage() - 1) * $transactions->perPage() + 1; @endphp --}}
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($questions as $item)
                                            <tr>
                                                <td >{{ $i }}</td>
                                                <td>{{ $item->name ?? ''}}</td>
                                                <td>{{ $item->option_a ?? ''}}</td>
                                                <td>{{ $item->option_b ?? ''}}</td>
                                                <td>{{ $item->option_c ?? ''}}</td>
                                                <td>{{ $item->option_d ?? ''}}</td>
                                                <td>{{ $item->correct_answer ?? ''}}</td>
                                                <td>{{ $item->created_at ?? '' }}</td>
                                                <td>
                                                    <a class="" href="#" data-bs-toggle="modal" data-bs-target="#danger_ke{{ $item->id }}">
                                                        <i data-feather="trash" class="me-50"></i>
                                                    </a>

                                                    <div class="modal fade modal-danger text-start"
                                                            id="danger_ke{{ $item->id }}" tabindex="-1"
                                                            aria-labelledby="myModalLabel120" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">

                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel120">Delete
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete !
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('admin.questions.destroy', $item->id) }}"
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
                                    {{-- @include('admin._pagination', ['data' => $transactions]) --}}
                                </div>

                                {{-- <div class="table-responsive">
                                <table class="table mb-0">
                                    <!-- ... (your table structure) ... -->
                                </table>
                                {{ $transactions->links('admin._pagination') }}
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
            $('#date_from ,#date_to').on('input', function() {
                fetch_data();
            });

            function fetch_data() {
                var date_from = $('#date_from').val();
                var date_to = $('#date_to').val();
                $.ajax({
                    url: "?page=1",
                    method: 'GET',
                    data: {
                        date_from: date_from,
                        date_to: date_to
                    },
                    dataType: 'html',
                    success: function(data) {
                        $('#table-responsive').html(data);
                    }
                });
            }


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
                        $('.spinner-loader').css('display', 'block');
                    },
                    success: function(res) {
                        location.reload();
                    },
                    error: function(res) {
                        if (res.status == 422 || res.status == 401) {
                            if (res.responseJSON && res.responseJSON.errors) {
                                var error = res.responseJSON.errors
                                $.each(error, function(key, value) {
                                    $("#" + key + "-submit_errors").text(value);
                                });
                            }
                        }

                    }
                });
            });


        });
    </script>
@endsection
