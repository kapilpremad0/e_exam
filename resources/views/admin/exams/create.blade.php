@extends('admin.layouts.app')

@push('css_links')
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/vendors/css/editors/quill/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/css/plugins/forms/form-quill-editor.css')}}">

    <style>
        .error{
            color:#a93c3d !important;
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
                            <h2 class="content-header-title float-start mb-0">Exam</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.exams.index') }}">Exams</a>
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

                                    @if (!empty($exam->id))
                                        <form class="form" action="{{ route('admin.exams.update', $exam->id) }}"
                                            method="POST" enctype="multipart/form-data" id="submitFrom">
                                            @method('put')
                                        @else
                                            <form class="form" action="{{ route('admin.exams.store') }}" method="POST"
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
                                                    value="{{ $exam->name ?? '' }}" />
                                                <span class="text-danger validation-class" id="name-submit_errors"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <div class="d-flex flex-column">
                                                    <label class="form-check-label mb-50" for="customSwitch3">Trending</label>
                                                    <div class="form-check form-check-primary form-switch">
                                                        <input type="checkbox" name="trending" 
                                                            @if (!empty($exam))
                                                                {{ (isset($exam->trending) && $exam->trending == 1) ? 'checked' : '' }}
                                                            @else
                                                                checked
                                                            @endif
                                                        class="form-check-input" id="customSwitch3" value="1"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <div class="d-flex flex-column">
                                                    <label class="form-check-label mb-50" for="customSwitch3">Status</label>
                                                    <div class="form-check form-check-primary form-switch">
                                                        <input type="checkbox" name="status" 
                                                            @if (!empty($exam))
                                                                {{ (isset($exam->status) && $exam->status == 1) ? 'checked' : '' }}
                                                            @else
                                                                checked
                                                            @endif
                                                        class="form-check-input" id="customSwitch3" value="1"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">Image <span
                                                        class="error"></span></label>
                                                @if (!empty($exam->image))
                                                    <div>
                                                        <img src="{{ $exam->image }}" alt=""
                                                            width="200" height="200">
                                                    </div>
                                                @endif
                                                <input type="file" id="first-name-column" name="image"
                                                    class="form-control" value="" accept="image/*" />
                                                <span class="text-danger validation-class" id="image-submit_errors"></span>
                                            </div>
                                        </div>
                                        

                                        

                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <div class="d-flex flex-column">
                                                    <label class="form-check-label mb-50"
                                                        for="customSwitch3">Description</label>

                                                        <div id="full-wrapper">
                                                            <div id="full-container">
                                                                <div class="editor"  id="description_nontent">
                                                                    {!!  $exam->description ?? ''  !!}
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


                var submitButtonId = $(e.originalEvent.submitter).attr('id'); // Get the id of the clicked submit button
                console.log("Submit Button ID: ", submitButtonId); // Log the id of the submit button (for debugging)
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










@endsection


@push('scripts')


    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/katex.min.js')}}"></script>
    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/highlight.min.js')}}"></script>
    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/quill.min.js')}}"></script>
    <script src="{{ asset('public/admin-assets/app-assets/js/scripts/forms/form-quill-editor.js')}}"></script>    

@endpush