<table class="table mb-0">
    <thead class="table-dark">
        <tr>
            <th scope="col" >#</th>
            <th scope="col" >Game</th>
            <th scope="col" >Bid Number</th>
            <th scope="col" >Bid Amount</th>
            <th scope="col" >Type</th>
            <th scope="col" >Winning Amount</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        @php  $i = ($winners->currentPage() - 1) * $winners->perPage() + 1; @endphp
        @foreach ($data as $item)
            <tr>
                <td >{{ $i }}</td>
                <td>{{ $item->game->name ?? ''}}</td>
                <td>{{ $item->bid->number ?? ''}}</td>
                <td>₹{{ $item->bid->amount ?? 0 }}</td>
                <td class="uppercase">{{ $item->bid->type ?? ''}}</td>
                <td><strong>₹{{ $item->amount ?? 0 }}</strong></td>
                <td>{{ $item->created_at ?? '' }}</td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
        
    </tbody>
</table>
@include('admin._pagination', ['data' => $winners])

<script>
    feather.replace();
</script>