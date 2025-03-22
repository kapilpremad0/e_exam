@extends('admin.layouts.app')

@section('content')


@push('css_links')
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/vendors/css/editors/quill/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/css/plugins/forms/form-quill-editor.css')}}">

    <style>
        .price-details .price-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }
    </style>
@endpush


    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">

                @include('admin.vendors.show.tab-bar')



                <!-- current plan -->
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Current plan</h4>

                        @if (empty($active_plan))

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewAddressModal">
                                Purchase Plan
                            </button>

                        @endif

                    </div>
                    @if (!empty($active_plan))
                        <div class="card-body my-2 py-25">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2 pb-50">
                                        <h5>Your Current Plan is <strong>{{ $active_plan->plan->name ?? '' }}</strong></h5> 
                                        {{-- <p>{!! $active_plan->plan->description ?? '' !!}</p> --}}
                                    </div>

                                    <div class="mb-2 pb-50">
                                        <h5>Started on {{ date('d M, Y', strtotime($active_plan->start_time)) }}</h5>
                                        {{-- <span>We will send you a notification upon Subscription expiration</span> --}}
                                    </div>

                                    <div class="mb-2 pb-50">
                                        <h5>The duration is {{ $durations[$active_plan->duration] ?? '' }}</h5>
                                        {{-- <span>We will send you a notification upon Subscription expiration</span> --}}
                                    </div>


                                    {{-- <div class="mb-1">
                                        <h5>$199 Per Month <span class="badge badge-light-primary ms-50">Popular</span></h5>
                                        <span>Standard plan for small to medium businesses</span>
                                    </div> --}}
                                </div>
                                <div class="col-md-6">

                                    
                                    <div class="mb-2 pb-50">
                                        <h5>Active until Dec {{ date('d M, Y',strtotime($active_plan->expire_time)) }}</h5>
                                        <span>We will send you a notification upon Subscription expiration</span>
                                    </div>

                                    {{-- <div class="alert alert-warning mb-2" role="alert">
                                        <h6 class="alert-heading">We need your attention!</h6>
                                        <div class="alert-body fw-normal">your plan requires update</div>
                                    </div> --}}

                                    <div class="plan-statistics pt-1">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="fw-bolder">Days</h5>
                                            <h5 class="fw-bolder">{{ $active_plan->details['used_days'] ?? '' }} of {{ $active_plan->details['total_days'] ?? '' }} Days</h5>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar " style="width: <?= $active_plan->details['percentage_used'] ?? 0 ?>%;" role="progressbar" aria-valuenow="{{ $active_plan->details['percentage_used'] ?? '0' }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-50">{{ $active_plan->details['remaining_days'] ?? '' }} days remaining until your plan requires update</p>
                                    </div>


                                </div>
                                {{-- <div class="col-12"> --}}
                                    {{-- <button class="btn btn-primary me-1 mt-1" data-bs-toggle="modal" data-bs-target="#pricingModal">
                                        Upgrade Plan
                                    </button> --}}
                                    {{-- <button class="btn btn-outline-danger cancel-subscription mt-1">Cancel Subscription</button> --}}
                                {{-- </div> --}}
                            </div>
                        </div>    
                    @endif
                    
                </div>
                <!-- / current plan -->



                @if (!empty($expired_plans->toArray()))
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Expired Plan</h4>
                        </div>
                        <div class="card-body">

                            {{-- <p class="card-text">
                                An API key is a simple encrypted string that identifies an application without any principal. They are useful
                                for accessing public data anonymously, and are used to associate API requests with your project for quota and
                                billing.
                            </p> --}}

                            <div class="row gy-2">

                                @foreach ($expired_plans as $item)

                                    <div class="col-12">
                                        <div class="bg-light-secondary position-relative rounded p-2 row" >

                                             

                                            <div class="col-md-6">
                                                <div class="">
                                                    <div class="d-flex align-items-center flex-wrap">
                                                        <h3 class="mb-1 me-1">{{ $item->plan->name ?? 'N/A' }}</h3>
                                                        {{-- <span class="badge badge-light-primary mb-1">₹ {{ $item->amount }}</span> --}}
                                                    </div>
                                                    
                                                    <div>
                                                        <h5>₹{{ $item->amount ?? '' }}</h5>
                                                        {{-- <p>{!! $item->plan->description !!}</p> --}}
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                            {{-- <h6 class="d-flex align-items-center fw-bolder">
                                                <span class="me-50">{{ $item->id }}</span>
                                                <span><i data-feather="copy" class="font-medium-4 cursor-pointer"></i></span>
                                            </h6> --}}
                                            
                                            <div class="col-md-6">
                                                {{-- <p><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($item->start_time)->format('d M Y, H:i') }}</p> --}}
                                                <p><strong>Expire Time:</strong> {{ \Carbon\Carbon::parse($item->expire_time)->format('d M Y, H:i') }}</p>
                                                <p><strong>Duration:</strong> {{ $durations[$active_plan->duration] ?? '' }}</p>
                                                <span>Created on {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i T') }}</span>
                                            </div>
                                            
                                        </div>
                                    </div>   

                                    
                                @endforeach


                                

                                

                            </div>
                        </div>
                    </div>
                @endif



                

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <div class="modal fade" id="addNewAddressModal" tabindex="-1" aria-labelledby="addNewAddressTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-4 mx-50">
                    <h1 class="address-title text-center mb-1" id="addNewAddressTitle">Subscription Plan</h1>
                    <p class="address-subtitle text-center mb-2 pb-75">Choose the best plan for vendor.</p>

                    <form id="submitFrom" class="row gy-1 gx-2" action="{{ route('admin.subscriptions.store') }}">
                        @csrf
                        <div class="col-12">
                            <div class="row custom-options-checkable">
                                <input type="hidden" value="{{ $user->id }}" name="user_id">

                                @foreach ($plans as $item)


                                    <div class="col-md-6 mb-md-1 mb-2">
                                        <input class="custom-option-item-check" id="plan{{ $item->id }}" type="radio" name="plan_id" value="{{ $item->id }}" onchange="getValues()" data-amount="{{ $item->amount }}"   />
                                        <label for="plan{{ $item->id }}" class="custom-option-item px-2 py-1">
                                            <span class="d-flex align-items-center mb-50">
                                                {{-- <i data-feather="home" class="font-medium-4 me-50"></i> --}}
                                                <span class="custom-option-item-title h4 fw-bolder mb-0">{{ $item->name }} - {{ $item->type }}</span>
                                            </span>
                                            <span class="d-flex align-items-center mb-50">
                                                <i data-feather="calendar" class="font-medium-4 me-50"></i>
                                                <span class="custom-option-item-title h6 fw-bolder mb-0">{{ $item->duration }}</span>
                                            </span>
                                            <span class="d-flex align-items-center mb-50">
                                                <i  class="font-medium-4 me-50">₹</i>
                                                <span class="custom-option-item-title h6 fw-bolder mb-0">{{ $item->amount }}</span>
                                            </span>
                                            <span class="d-block">{!! $item->description !!}</span>
                                        </label>
                                    </div>    
                                @endforeach
                                <span class="text-danger validation-class" id="plan_id-submit_errors"></span>

                            </div>
                        </div>


                        {{-- <div class="col-12 col-md-6">
                            <label class="form-label" for="discount">Discount Amount</label>
                            <input type="number" id="discount_amount" name="discount_amount" class="form-control" placeholder="Discount Amount"  />
                            <span class="text-danger validation-class" id="discount_amount-submit_errors"></span>
                        </div> --}}

                        <div class="col-12 col-md-6">
                            <label class="form-label" for="payment_type">Payment Type</label>
                            <select name="payment_type" id="payment_type" class="form-select">
                                <option value="">(Select Payment)</option>
                                <option value="online">Online</option>
                                <option value="cash">Cash</option>
                            </select>
                            <span class="text-danger validation-class" id="payment_type-submit_errors"></span>
                        </div>


                        <div class="col-12 col-md-6">
                            <label class="form-label" for="transaction_id">Transaction Id</label>
                            <input type="text" id="transaction_id" name="transaction_id" class="form-control" placeholder="Transaction Id"  />
                            <span class="text-danger validation-class" id="transaction_id-submit_errors"></span>
                        </div>

                        <div class="col-12 col-md-12">
                            <label class="form-label" for="transaction_id">Coupon Code</label>
                            <div class="coupons input-group input-group-merge">
                                <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Coupon Code" aria-label="Coupons" aria-describedby="input-coupons" />
                                <a href="#" class="btn btn-dark input-group-text text-primary ps-1" onclick="applyCopon()">Apply</a>
                            </div>
                            <span class="text-danger validation-class" id="coupon_code-submit_errors"></span>
                        </div>

                        <div class="checkout-options">
                            <div class="">
                                <div class="body">
                                    {{-- <label class="section-label form-label mb-1">Options</label>
                                    <div class="coupons input-group input-group-merge">
                                        <input type="text" class="form-control" placeholder="Coupons" aria-label="Coupons" aria-describedby="input-coupons" />
                                        <span class="input-group-text text-primary ps-1" id="input-coupons">Apply</span>
                                    </div> --}}
                                    <hr />
                                    <div class="price-details">
                                        <h6 class="price-title">Price Details</h6>
                                        <ul class="list-unstyled">
                                            <li class="price-detail">
                                                <div class="detail-title">Total MRP</div>
                                                <div class="detail-amt" id="span_plan_amount">₹ 0</div>
                                            </li>
                                            <li class="price-detail">
                                                <div class="detail-title">Bag Discount</div>
                                                <div class="detail-amt discount-amt text-success">₹ 0</div>
                                            </li>
                                        </ul>
                                        <hr />
                                        <ul class="list-unstyled">
                                            <li class="price-detail">
                                                <div class="detail-title detail-total">Total</div>
                                                <div class="detail-amt fw-bolder" id="span_total_amount">₹ 0</div>
                                            </li>
                                        </ul>
                                        {{-- <button type="button" class="btn btn-primary w-100 btn-next place-order">Place Order</button> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- Checkout Place Order Right ends -->
                        </div>

                        <div class="col-12 text-center">
                            
                            <button type="submit" class="btn btn-primary me-1 mt-2">Submit</button>

                            <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                                Discard
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    


@push('scripts')


<script>
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
                    $('#form-loader').show();
                    // $('#form-loader').hide();
                    $('.spinner-loader').css('display', 'block');
                },
                success: function(res) {
                    // $('#loader').fadeOut(); // Hide the loader with a fade effect
                    $('#form-loader').hide();

                    location.reload();
                },
                error: function(res) {
                    // $('#loader').fadeOut(); // Hide the loader with a fade effect
                    $('#form-loader').hide();

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

<script>
    function getValues() {
        // Get the selected radio button
        var selectedPlan = document.querySelector('input[name="plan_id"]:checked');

        if (selectedPlan) {
            // Retrieve the amount from the data-amount attribute
            var active_plan_amount = selectedPlan.getAttribute('data-amount');

            // Display the selected plan amount (or use it as needed)
            // alert("Selected Plan Amount: ₹" + active_plan_amount);

            document.getElementById('span_plan_amount').textContent = `₹ ${active_plan_amount}`;
            
            document.getElementById('span_total_amount').textContent = `₹ ${active_plan_amount}`;

        } else {
            document.getElementById('span_plan_amount').textContent = `₹ 0`;
        }
    }




    function applyCopon(){
        var coupon_code = $('#coupon_code').val();
        var selectedPlan = document.querySelector('input[name="plan_id"]:checked').value;
        

        $.ajax({
                url: "{{ route('admin.coupons.apply') }}",
                type: 'GET',
                data: {
                    coupon_code:coupon_code,
                    plan_id:selectedPlan
                },
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#form-loader').show();
                    // $('#form-loader').hide();
                    $('.spinner-loader').css('display', 'block');
                },
                success: function(res) {
                    
                    // $('#loader').fadeOut(); // Hide the loader with a fade effect
                    $('#form-loader').hide();

                    // location.reload();
                },
                error: function(res) {
                    // $('#loader').fadeOut(); // Hide the loader with a fade effect
                    $('#form-loader').hide();

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

    }
</script>



    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/katex.min.js')}}"></script>
    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/highlight.min.js')}}"></script>
    <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/quill.min.js')}}"></script>
    <script src="{{ asset('public/admin-assets/app-assets/js/scripts/forms/form-quill-editor.js')}}"></script>    

@endpush

@endsection
