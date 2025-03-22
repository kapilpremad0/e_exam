
@extends('admin.layouts.app')

@section('content')

 <!-- BEGIN: Content-->
<!-- BEGIN: Content-->
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            
            <div class="content-body">

                @include('admin.user.show.tab-bar')


                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">
                     <!-- Responsive tables start -->
                <div class="row" >
                    <div class="col-12">
                        <div class="card card-company-table">
                            <div class="card-header">
                                <div class="col-md-3">
                                    <label for="">Date From</label>
                                    <input type="date" class="form-control" id="date_from" value="{{ request()->input('date_from') }}">
                                </div>

                                <div class="col-md-3">
                                    <label for="">Date To</label>
                                    <input type="date" class="form-control" id="date_to" value="{{ request()->input('date_to') }}">
                                </div>


                                <div class="col-md-5">

                                </div>
                            </div>
                            <div class="table-responsive" id="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" >#</th>
                                            <th scope="col" >Game</th>
                                            <th scope="col" >Bid Number</th>
                                            <th scope="col" >Bid Amount</th>
                                            <th scope="col" >Type</th>
                                            <th>Created at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php  $i = ($bids->currentPage() - 1) * $bids->perPage() + 1; @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td >{{ $i }}</td>
                                                <td>{{ $item->game->name ?? ''}}</td>
                                                <td>{{ $item->number ?? ''}}</td>
                                                <td><strong>₹{{ $item->amount ?? 0 }}</strong></td>
                                                <td class="uppercase">{{ $item->type ?? ''}}</td>
                                                <td>{{ $item->created_at ?? '' }}</td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                                @include('admin._pagination', ['data' => $bids])
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
    $(document).ready(function () {
        $('#date_to ,#date_from').on('input', function () {
            fetch_data();
        });

        function fetch_data() {
            var date_from = $('#date_from').val();
            var date_to = $('#date_to').val();
            $.ajax({
                url: "?page=1",
                method: 'GET',
                data: {date_from: date_from , date_to:date_to},
                dataType: 'html',
                success: function (data) {
                    $('#table-responsive').html(data);
                }
            });
        }


    });

</script>

@endsection