<table class="table mb-0">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            {{-- <th>Category</th> --}}
            <th scope="col">status</th>
            <th>Trending</th>
            <th>Created at</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        @php  $i = ($exams->currentPage() - 1) * $exams->perPage() + 1; @endphp
        @foreach ($exams as $item)
            <tr>
                <td>{{ $i }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                            <div class="avatar-content" style="width: 50px;
                        height: 50px;">
                                <img src="{{ $item->image }}" alt="Toolbar svg" width="100%" />
                            </div>
                        </div>
                        <div>
                            <div class="fw-bolder"><a
                                    href="{{ route('admin.exams.show', $item->id) }}">{{ $item->name ?? '' }}</a>
                            </div>
                        </div>
                    </div>
                </td>

                {{-- <td>{{ $item->category->title ?? '' }}</td> --}}

                <td>
                    <div class="form-check form-check-primary form-switch">
                        <input type="checkbox" name="status" onchange="changeStatus({{ $item->id }})"
                            {{ $item->status == 1 ? 'checked' : '' }} class="form-check-input" id="customSwitch3" />
                    </div>
                </td>

                <td>
                    <div class="form-check form-check-primary form-switch">
                        <input type="checkbox" name="trending" onchange="changeTrending({{ $item->id }})"
                            {{ $item->trending == 1 ? 'checked' : '' }} class="form-check-input" id="customSwitch3" />
                    </div>
                </td>

                <td>{{ date('d-m-Y h:i a', strtotime($item->created_at)) }}</td>

                <td>
                    <div class="dropdown">
                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
                            data-bs-toggle="dropdown">
                            <i data-feather="more-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">

                            <a class="dropdown-item" href="{{ route('admin.exams.edit', $item->id) }}">
                                <i data-feather="edit-2" class="me-50"></i>
                                <span>Edit</span>
                            </a>

                            {{-- <a class="dropdown-item" href="{{route('admin.exams.show',$item->id)}}">
                            <i data-feather="eye" class="me-50"></i>
                            <span>View</span>
                        </a> --}}


                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#danger_ke{{ $item->id }}">
                                <i data-feather="trash" class="me-50"></i>
                                <span>Delete</span>
                            </a>

                        </div>
                    </div>

                    <div class="modal fade modal-danger text-start" id="danger_ke{{ $item->id }}" tabindex="-1"
                        aria-labelledby="myModalLabel120" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel120">Delete
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete !
                                </div>
                                <form action="{{ route('admin.exams.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>

            </tr>
            @php
                $i++;
            @endphp
        @endforeach

    </tbody>
</table>
@include('admin._pagination', ['data' => $exams])

<script>
    feather.replace();
</script>
