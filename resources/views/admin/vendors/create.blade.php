@extends('admin.layouts.app')

@section('content')

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.vendors.index') }}">Vendors</a>
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

                {{-- @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="alert-body">
                                            {{$error}}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
            @endif --}}

                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title">Create</h4> --}}
                                </div>
                                <div class="card-body">

                                    @if (!empty($user->id))
                                        <form class="form" action="{{ route('admin.vendors.update', $user->id) }}"
                                            method="POST" enctype="multipart/form-data" id="submitFrom">
                                            @method('put')
                                        @else
                                            <form class="form" action="{{ route('admin.vendors.store') }}" method="POST"
                                                enctype="multipart/form-data" id="submitFrom">
                                    @endif

                                    {{ csrf_field() }}



                                    <div class="row">

                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">Name <span
                                                        class="error"></span></label>
                                                <input type="text" id="first-name-column" name="name"
                                                    class="form-control" placeholder="Name"
                                                    value="{{ $user->name ?? '' }}" />
                                                <span class="text-danger validation-class" id="name-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <div class="d-flex flex-column">
                                                    <label class="form-check-label mb-50" for="customSwitch3">Status</label>
                                                    <div class="form-check form-check-primary form-switch">
                                                        <input type="checkbox" name="status" 
                                                            @if (!empty($user))
                                                                {{ (isset($user->status) && $user->status == 1) ? 'checked' : '' }}
                                                            @else
                                                                checked
                                                            @endif
                                                        class="form-check-input" id="customSwitch3" value="1"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        

                                        {{-- <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">Image <span
                                                        class="error"></span></label>
                                                @if (!empty($user->image))
                                                    <div>
                                                        <img src="{{ url('public/uploads/' . $user->image) }}" alt=""
                                                            width="200" height="200">
                                                    </div>
                                                @endif
                                                <input type="file" id="first-name-column" name="image"
                                                    class="form-control" value="" accept="image/*" />
                                                <span class="text-danger validation-class" id="image-submit_errors"></span>
                                            </div>
                                        </div> --}}


                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="email-column">Email <span
                                                        class="error"></span></label>

                                                <input type="email" id="email-column" name="email"
                                                    class="form-control" placeholder="Email"
                                                    value="{{ $user->email ?? '' }}" />
                                                <span class="text-danger validation-class" id="email-submit_errors"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="mobile-column">Mobile <span
                                                        class="error"></span></label>

                                                <input type="number" id="mobile-column" name="mobile"
                                                    class="form-control" placeholder="Mobile"
                                                    value="{{ $user->mobile ?? '' }}" />
                                                <span class="text-danger validation-class" id="mobile-submit_errors"></span>
                                            </div>
                                        </div>
                                        

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="type-column">Type <span
                                                        class="error"></span></label>
                                                <select name="type" id="type" class="form-select select2" >
                                                    <option value="">(Select Type)</option>
                                                    @foreach ($types as $key => $val)
                                                        <option value="{{ $key }}"
                                                            {{ (isset($user->type) && $user->type == $key) ? 'selected' : '' }}
                                                        
                                                        >{{ $val }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger validation-class" id="type-submit_errors"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="password-column">Password <span
                                                        class="error"></span></label>

                                                <input type="text" id="password-column" name="password"
                                                    class="form-control" placeholder="Password"
                                                    value="{{ $user->password ?? '' }}" />

                                                <span class="text-danger validation-class" id="password-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="plan-column">Plan <span
                                                        class="error"></span></label>
                                                <select name="plan" id="plan" class="form-select select2" >
                                                    <option value="">(Select Plan)</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ (isset($user->plan) && $user->plan == $key) ? 'selected' : '' }}
                                                        >{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger validation-class" id="duration-submit_errors"></span>
                                            </div>
                                        </div> --}}


                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <div class="d-flex flex-column">
                                                    <label class="form-check-label mb-50"
                                                        for="customSwitch3">Description</label>

                                                        <div id="full-wrapper">
                                                            <div id="full-container">
                                                                <div class="editor"  id="description_nontent">
                                                                    {!!  $user->description ?? ''  !!}
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


                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const checkboxes = document.querySelectorAll('.toggle-status');

                        checkboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', function() {
                                const rowId = this.getAttribute('data-row');
                                const openInput = document.getElementById(`open-time-${rowId}`);
                                const closeInput = document.getElementById(`close-time-${rowId}`);

                                if (this.checked) {
                                    openInput.disabled = false;
                                    closeInput.disabled = false;
                                } else {
                                    openInput.disabled = true;
                                    closeInput.disabled = true;
                                }
                            });
                        });
                    });
                </script>

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







@push('scripts')


    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/katex.min.js')}}"></script>
    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/highlight.min.js')}}"></script>
    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/quill.min.js')}}"></script>
    <script src="{{ asset('public/admin-assets/app-assets/js/scripts/forms/form-quill-editor.js')}}"></script>    

@endpush


@endsection
