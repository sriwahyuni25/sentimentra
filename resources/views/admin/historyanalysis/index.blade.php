@extends('index')
@section('content')
    <div class="pagetitle">
        <h1>History Analysis</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-sentimentra') }}">Home</a></li>
                <li class="breadcrumb-item active">History Analysis</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">History Analysis</h5>
                    <table class="table datatable">
                        <thead>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <tr>
                                <th>
                                    <b>#</b>
                                </th>
                                {{-- <th>Choose Data</th> --}}
                                <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                                <th>Text</th>
                                <th>Sentiment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sentiments as $sentiment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- <td> <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                                        <label class="form-check-label" for="gridCheck1">
                                        </label>
                                      </div>
                                    </td> --}}
                                    <td>{{ $sentiment->created_at }}</td>
                                    <td>{{ $sentiment->text }}</td>
                                    <td>{{ $sentiment->sentiment }}</td>
                                    <td>
                                        <form id="delete-form-{{ $sentiment->id }}"
                                            action="{{ url('/historyanalysisdel/delete', $sentiment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            {{-- <input type="checkbox" class=""> --}}
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $sentiment->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
@endsection
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
