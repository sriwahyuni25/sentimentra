@extends('index')
@section('content')
    <div class="pagetitle">
        <h1>Data Master</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-sentimentra') }}">Home</a></li>
                <li class="breadcrumb-item">Data Master</li>
                <li class="breadcrumb-item active">Train Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Train Data</h5>
                        <div class="d-flex gap-3">
                            <div class="mb-3">
                                <a href="#" class="btn btn-primary btn-training">Training Data</a>
                            </div>
                            <div class="mb-3">
                                <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Import Data CSV</a>
                            </div>
                        </div>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Text</th>
                                    <th>Sentiment</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trainData as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->text }}</td>
                                        <td>
                                            @if ($data->sentiment == 1)
                                                <span>Positif</span>
                                            @elseif ($data->sentiment == 0)
                                                <span>Negatif</span>
                                            @endif
                                        </td>
                                        {{-- <td>
                                <form action="{{ route('admin.testdata.index', $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data CSV</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('admin/traindata/import') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="file" class="form-control" accept=".csv" name="file" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $(".btn-training").on("click", function() {
                Swal.fire({
                    title: "Harap Tunggu!",
                    html: "Butuh beberapa waktu untuk melakukan training data.",
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        $.ajax({
                            url: "https://train-data.sentimentra.my.id/retrain",
                            type: "POST",
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Selamat...',
                                    text: response.message
                                });
                            },
                            error: function(error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!'
                                });
                            }
                        })
                    },
                    willClose: () => {

                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log("I was closed by the timer");
                    }
                });
            })
        })
    </script>
@endsection
