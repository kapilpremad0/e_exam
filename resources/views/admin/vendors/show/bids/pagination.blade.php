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

<script>
    feather.replace();
</script>

