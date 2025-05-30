<table class="table mb-0">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">User Name</th>
            <th>Level</th>
            <th>Exam</th>
            <th>Subject</th>
            <th>correct_answer</th>
            <th>total_question</th>
            <th>Created at</th>

        </tr>
    </thead>
    <tbody>
        @php  $i = ($levels->currentPage() - 1) * $levels->perPage() + 1; @endphp
        @foreach ($levels as $item)
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
                <td>{{ $item->correct_answer ?? '' }}</td>
                <td>{{ $item->total_question ?? '' }}</td>

                <td>{{ date('d-m-Y h:i a', strtotime($item->created_at)) }}</td>



            </tr>
            @php
                $i++;
            @endphp
        @endforeach

    </tbody>
</table>
@include('admin._pagination', ['data' => $levels])

<script>
    feather.replace();
</script>
