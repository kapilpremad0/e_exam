<table class="table mb-0">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">User Name</th>
            <th>Level</th>
            <th>Exam</th>
            <th>Subject</th>
            <th>Order ID</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Payment Status</th>
            <th>Created at</th>

        </tr>
    </thead>
    <tbody>
        @php  $i = ($transactions->currentPage() - 1) * $transactions->perPage() + 1; @endphp
        @foreach ($transactions as $item)
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

                <td>{{ $item->order_id ?? '' }}</td>
                <td>{{ $item->amount ?? '' }}</td>
                <td>{{ $item->status ?? '' }}</td>
                <td>{{ $item->payment_status ?? '' }}</td>

                <td>{{ date('d-m-Y h:i a', strtotime($item->created_at)) }}</td>

                

            </tr>
            @php
                $i++;
            @endphp
        @endforeach

    </tbody>
</table>
@include('admin._pagination', ['data' => $transactions])


<script>
    feather.replace();
</script>