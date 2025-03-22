@extends('admin.layouts.app')

@push('css_links')
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/admin-assets/app-assets/vendors/css/editors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/admin-assets/app-assets/css/plugins/forms/form-quill-editor.css') }}">

    <style>
        .error {
            color: #a93c3d !important;
            font-weight: 500;
        }

        .varient_div {
            padding: 1%;
            border: solid 1px;
            margin-left: initial;
        }
    </style>
@endpush


@section('content')
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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.levels.index') }}">Levels</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title">Create</h4> --}}
                                </div>
                                <div class="card-body">

                                    @if (!empty($level->id))
                                        <form class="form" action="{{ route('admin.levels.update', $level->id) }}"
                                            method="POST" enctype="multipart/form-data" id="submitFrom">
                                            @method('put')
                                        @else
                                            <form class="form" action="{{ route('admin.levels.store') }}" method="POST"
                                                enctype="multipart/form-data" id="submitFrom">
                                    @endif

                                    {{ csrf_field() }}

                                    <div class="row">

                                        <div class="col-md-8 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">Name <span
                                                        class="error"></span></label>
                                                <input type="text" id="first-name-column" name="name"
                                                    class="form-control" placeholder="Name"
                                                    value="{{ $level->name ?? '' }}" />
                                                <span class="text-danger validation-class" id="name-submit_errors"></span>
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
                                                    <label class="form-check-label mb-50" for="customSwitch3">Status</label>
                                                    <div class="form-check form-check-primary form-switch">
                                                        <input type="checkbox" name="status"
                                                            @if (!empty($level)) {{ isset($level->status) && $level->status == 1 ? 'checked' : '' }}
                                                            @else
                                                                checked @endif
                                                            class="form-check-input" id="customSwitch3" value="1" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Exam Dropdown -->
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="exam_id">Exam <span
                                                        class="error"></span></label>
                                                <select name="exam_id" id="exam_id" class="form-select select2" onchange="changeExam()">
                                                    <option value="">(Select Exam)</option>
                                                    @foreach ($exams as $key => $val)
                                                        <option value="{{ $val->id }}"
                                                            {{ isset($level->exam_id) && $level->exam_id == $val->id ? 'selected' : '' }}>
                                                            {{ $val->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger validation-class"
                                                    id="exam_id-submit_errors"></span>
                                            </div>
                                        </div>

                                        <!-- Subject Dropdown -->
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="subject_id">Subject <span
                                                        class="error"></span></label>
                                                <select name="subject_id" id="subject_id" class="form-select select2">
                                                    <option value="">(Select Subject)</option>
                                                    @if (!empty($subjects))
                                                        @foreach ($subjects as $key => $val)
                                                            <option value="{{ $val->id }}"
                                                                {{ isset($level->subject_id) && $level->subject_id == $val->id ? 'selected' : '' }}>
                                                                {{ $val->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span class="text-danger validation-class"
                                                    id="subject_id-submit_errors"></span>
                                            </div>
                                        </div>



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
                                                <span class="text-danger validation-class" id="time-submit_errors"></span>
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





                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <div class="d-flex flex-column">
                                                    <label class="form-check-label mb-50"
                                                        for="customSwitch3">Description</label>

                                                    <div id="full-wrapper">
                                                        <div id="full-container">
                                                            <div class="editor" id="description_nontent">
                                                                {!! $level->description ?? '' !!}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" id="description_id" name="description">

                                                    <span class="text-danger validation-class"
                                                        id="description-submit_errors"></span>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Floating Label Form section end -->




            </div>
        </div>
    </div>
    <!-- END: Content-->





    <script>

            function changeExam(){
                var examId = $('#exam_id').val();
                $('#subject_id').html('<option value="">(Loading...)</option>'); // Show loading text

                if (examId) {
                    $.ajax({
                        url: "{{ route('get.subjects') }}", // Laravel route to fetch subjects
                        type: "GET",
                        data: { exam_id: examId },
                        dataType: "json",
                        success: function (response) {
                            $('#subject_id').html('<option value="">(Select Subject)</option>'); // Reset dropdown

                            $.each(response.subjects, function (key, value) {
                                $('#subject_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        },
                        error: function () {
                            alert("Error fetching subjects. Please try again.");
                        }
                    });
                } else {
                    $('#subject_id').html('<option value="">(Select Subject)</option>'); // Reset if no exam selected
                }
            }


        $(document).ready(function() {


           


           


            $('#submitFrom').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission


                let headingElements =
                    document.getElementsByClassName('ql-editor');
                let headingVal = headingElements[0].innerHTML;

                $('#description_id').val(headingVal);


                var $form = $('#submitFrom');
                var url = $form.attr('action');
                var formData = new FormData($form[0]);


                var submitButtonId = $(e.originalEvent.submitter).attr(
                'id'); // Get the id of the clicked submit button
                console.log("Submit Button ID: ",
                submitButtonId); // Log the id of the submit button (for debugging)
                // Disable the submit button before sending the request
                $('#' + submitButtonId).prop('disabled', true);


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

                        $('#' + submitButtonId).prop('disabled', false);
                        // $('#loader').fadeOut(); // Hide the loader with a fade effect


                        // location.reload();

                        window.location.href = res;
                    },
                    error: function(res) {

                        $('#' + submitButtonId).prop('disabled', false);
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


{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}


@endsection


@push('scripts')
    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
    <script src="{{ asset('public/admin-assets/app-assets/js/scripts/forms/form-quill-editor.js') }}"></script>
@endpush
