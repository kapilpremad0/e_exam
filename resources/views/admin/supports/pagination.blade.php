<table class="table mb-0">
    <thead class="table-dark">
        <tr>
            <th scope="col" >#</th>
            <th scope="col" >Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Message</th>
            <th>Created at</th>
            
            
        </tr>
    </thead>
    <tbody>
        @php  $i = ($supports->currentPage() - 1) * $supports->perPage() + 1; @endphp
        @foreach ($supports as $item)
            <tr>
                <td >{{ $i }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        {{-- <div class="avatar rounded">
                            <div class="avatar-content" style="width: 50px;
                            height: 50px;">
                                <img src="{{ url('public/uploads/'.$item->image) }}" alt="Toolbar svg" width="100%" />
                            </div>
                        </div> --}}
                        <div>
                            <div class="fw-bolder">{{ $item->name ?? '' }}
                                
                            </div>
                        </div>
                    </div>
                </td>
                

                

                <td>{{ $item->email }}</td>
                <td>{{ $item->mobile }}</td>
                <td>{{ $item->message }}</td>
                
                <td>{{ date('d-m-Y h:i a',strtotime($item->created_at)) }}</td>
                
                @can('supports edit')
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                            <i data-feather="more-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            
                            <a class="dropdown-item" href="{{route('admin.supports.edit',$item->id)}}">
                                <i data-feather="edit-2" class="me-50"></i>
                                <span>Edit</span>
                            </a>
                            
                            {{-- <a class="dropdown-item" href="{{route('admin.supports.show',$item->id)}}">
                                <i data-feather="eye" class="me-50"></i>
                                <span>View</span>
                            </a> --}}


                            {{-- <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#danger_ke{{ $item->id }}">
                                <i data-feather="trash" class="me-50"></i>
                                <span>Delete</span>
                            </a> --}}

                        </div>
                    </div>

                    <div class="modal fade modal-danger text-start" id="danger_ke{{ $item->id }}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel120">Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete !
                                    </div>
                                    <form action="{{route('admin.supports.destroy',$item->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger" @if ($item->is_default == 1) @disabled(true) @endif>Delete</button>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </td>
                @endcan
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
        
    </tbody>
</table>
@include('admin._pagination', ['data' => $supports])

<script>
    feather.replace();
</script>