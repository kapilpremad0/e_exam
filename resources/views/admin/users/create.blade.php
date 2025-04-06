@extends('admin.layouts.app')

@section('content')
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


    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Customer</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('dashboard.customers.index') }}">Customers</a>
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

                                    @if (!empty($coupon->id))
                                        <form class="form" action="{{ route('dashboard.customers.update', $coupon->id) }}"
                                            method="POST" enctype="multipart/form-data" id="submitFrom">
                                            @method('put')
                                        @else
                                            <form class="form" action="{{ route('dashboard.customers.store') }}"
                                                method="POST" enctype="multipart/form-data" id="submitFrom">
                                    @endif

                                    {{ csrf_field() }}

                                    <div class="row">

                                        <div class="col-md-6 col-12 mb-1">
                                            <label class="form-label" for="image">Image</label>
                                            <input type="file" class="form-control dt-full-image" name="image"
                                                id="image" accept="image/*" placeholder="John Doe" />
                                            <span class="text-danger validation-class" id="image-submit_errors"></span>
                                        </div>


                                        <div class="col-md-6 col-12 mb-1">
                                            <label class="form-label" for="name">Name</label>
                                            <input type="text" class="form-control dt-full-name" id="name"
                                                name="name" placeholder="Name" />
                                            <span class="text-danger validation-class" id="name-submit_errors"></span>
                                        </div>

                                        <div class="col-md-6 col-12 mb-1">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" class="form-control dt-full-email" name="email"
                                                id="email" placeholder="Email" />
                                            <span class="text-danger validation-class" id="email-submit_errors"></span>
                                        </div>

                                        <div class="col-md-6 col-12 mb-1">
                                            <label class="form-label" for="mobile">Mobile</label>
                                            <input type="number" name="mobile" class="form-control dt-full-mobile"
                                                id="mobile" placeholder="Mobile" aria-label="Mobile" />
                                            <span class="text-danger validation-class" id="mobile-submit_errors"></span>
                                        </div>

                                        <div class="col-md-6 col-12 mb-1">
                                            <label class="form-label" for="father_name">Father Name</label>
                                            <input type="text" class="form-control dt-full-father_name"
                                                name="father_name" id="father_name" placeholder="Contact Person" />
                                            <span class="text-danger validation-class"
                                                id="father_name-submit_errors"></span>
                                        </div>

                                        <div class="col-md-6 col-12 mb-1">
                                            <label class="form-label" for="uid_number">Uid Number</label>
                                            <input type="text" class="form-control dt-full-uid_number" id="uid_number"
                                                name="uid_number" placeholder="Uid Number" />
                                            <span class="text-danger validation-class"
                                                id="uid_number-submit_errors"></span>
                                        </div>

                                        <div class="col-md-6 col-12 mb-1">
                                            <label class="form-label" for="address">Address</label>
                                            <input type="text" class="form-control dt-full-address" id="address"
                                                placeholder="Address" name="address" />
                                            <span class="text-danger validation-class" id="address-submit_errors"></span>
                                        </div>

                                        <div class="col-md-6 col-12 mb-1">
                                            <label class="form-label" for="pincode">Pincode</label>
                                            <input type="text" class="form-control dt-full-pincode" id="pincode"
                                                placeholder="Pincode" name="pincode" />
                                            <span class="text-danger validation-class" id="pincode-submit_errors"></span>
                                        </div>

                                        <div class="col-md-6 col-12 mb-1">
                                            <label class="form-label" for="shift">Shift</label>
                                            <input type="text" class="form-control dt-full-shift" id="shift"
                                                placeholder="Shift" name="shift" />
                                            <span class="text-danger validation-class" id="shift-submit_errors"></span>
                                        </div>

                                        <div class="col-md-6 col-12 mb-1">
                                            <label class="form-label" for="state">State</label>
                                            <select name="state_id" id="state_id" class="form-select select2"
                                                onchange="getCitiesByState()">
                                                <option value="">(Select State)</option>
                                                @foreach ($appStates as $item)
                                                    <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger validation-class" id="state_id-submit_errors"></span>
                                        </div>

                                        <div class="col-md-6 col-12 mb-1">
                                            <label class="form-label" for="city">city</label>
                                            <select name="city_id" id="city_id" class="form-select select2">
                                                <option value="">(Select city)</option>
                                            </select>
                                            <span class="text-danger validation-class" id="city_id-submit_errors"></span>
                                        </div>

                                        <div class="col-md-6 col-12 mb-1">
                                            <label class="form-label" for="city">Subscription Plan</label>
                                            <select name="subscription_id" id="subscription_id" class="form-select select2">
                                                <option value="">(Select Subscription Plan)</option>
                                                @foreach ($appPlans as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger validation-class" id="subscription_id-submit_errors"></span>
                                        </div>

                                        <input type="hidden" name="branch_id" value="{{ $appUser->branch_id ?? '' }}">



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
        function getCitiesByState() {
            var state_id = $('#state_id').val();
            $('#city_id').html('<option value="">(Loading...)</option>'); // Show loading text

            if (state_id) {
                $.ajax({
                    url: "{{ route('get.cities') }}", // Laravel route to fetch cities
                    type: "GET",
                    data: {
                        state_id: state_id
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#city_id').html('<option value="">(Select City)</option>'); // Reset dropdown

                        $.each(response.cities, function(key, value) {
                            $('#city_id').append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                    },
                    error: function() {
                        alert("Error fetching cities. Please try again.");
                    }
                });
            } else {
                $('#city_id').html('<option value="">(Select City)</option>'); // Reset if no exam selected
            }
        }



        $(document).ready(function() {
            $('#submitFrom').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission


                // let headingElements = 
                // document.getElementsByClassName('ql-editor');
                // let headingVal = headingElements[0].innerHTML;

                // $('#description_id').val(headingVal);


                var $form = $('#submitFrom');
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
        <script src="{{ asset('public/admin-assets/app-assets/vendors/js/vendors.min.js') }}"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
        <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
        <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
        <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
        <script src="{{ asset('public/admin-assets/app-assets/js/scripts/forms/form-quill-editor.js') }}"></script>
    @endpush
@endsection
