<table class="table mb-0">
    <thead class="table-dark">
        <tr>
            <th scope="col" >#</th>
            <th scope="col" >Customer</th>
            <th>State</th>
            <th>City</th>
            <th>Address</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        @php  $i = ($customers->currentPage() - 1) * $customers->perPage() + 1; @endphp
        @foreach ($customers as $item)
            <tr>
                <td >{{ $i }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                            <div class="avatar-content">
                                <img src="{{ $item->image }}" width="50" height="50"
                                    alt="Toolbar svg" />
                            </div>
                        </div>
                        <div>
                            <div class="fw-bolder">{{ $item->name }}
                                    </div>
                            <div class="font-small-2 text-muted">{{ $item->email }}
                            </div>
                            <div class="font-small-2 text-muted">{{ $item->mobile }}
                            </div>
                        </div>
                    </div>
                </td>

                <td>{{ $item->state->name ?? "" }}</td>
                <td>{{ $item->city->name ?? "" }}</td>
                <td><strong>{{ $item->address ?? "" }}</strong></td>
                
                <td>{{ $item->created_at }}</td>
               
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
        
    </tbody>
</table>
@include('admin._pagination', ['data' => $customers])

<script>
    feather.replace();
</script>