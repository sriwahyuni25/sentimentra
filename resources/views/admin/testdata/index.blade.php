@extends('index')
@section('content')
    <div class="pagetitle">
        <h1>Data Master</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-sentimentra') }}">Home</a></li>
                <li class="breadcrumb-item">Data Master</li>
                <li class="breadcrumb-item active">Test Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

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
                    <h5 class="card-title">Test Data</h5>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="d-flex gap-3">
                        <div class="mb-3">
                            <a href="#" class="btn btn-primary btn-training">Training Data</a>
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('downloadTestData') }}" class="btn btn-primary">Download as CSV</a>
                        </div>
                        <div class="mb-3">
                            <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Import Data CSV</a>
                        </div>
                        <form action="{{ url('/admin/testdata/manydelete') }}" class="mb-3 delete d-none" method="post">
                            @csrf
                            <input type="hidden" name="id" id="multiId" value="">
                            <button class="btn btn-danger">Delete TestData</button>
                        </form>
                    </div>
                    <table class="table datatable1">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check d-inline">
                                        <input class="form-check-input" type="checkbox" value="" id="checkall">
                                    </div>
                                    No
                                </th>
                                <th>Text</th>
                                <th>Sentiment</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testData as $data)
                                <tr>
                                    <td>
                                        <div class="form-check d-inline">
                                            <input class="form-check-input checkall" type="checkbox"
                                                value="{{ $data->id }}">
                                        </div>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $data->text }}</td>
                                    <td>
                                        @if ($data->sentiment == 1)
                                            <span>Positif</span>
                                        @elseif ($data->sentiment == 0)
                                            <span>Negatif</span>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        <form action="{{ url('/deleteTestData', $data->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Remove
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data CSV</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('admin/testdata/import') }}" enctype="multipart/form-data" method="post">
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
    <script>
        $(document).ready(function() {
            const datatables = document.querySelectorAll(".datatable1")
            datatables.forEach(datatable => {
                new simpleDatatables.DataTable(datatable, {
                    perPageSelect: [5, 10, 15, ["All", -1]],
                    columns: [{
                            select: 0,
                            sortable: false
                        }, {
                            select: 2,
                            sortSequence: ["desc", "asc"]
                        },
                        {
                            select: 3,
                            sortSequence: ["desc"]
                        },
                        {
                            select: 4,
                            cellClass: "green",
                            headerClass: "red"
                        }
                    ]
                });
            })

            // Handling delete action
            $('.delete-btn').click(function() {
                var sentimentId = $(this).data('id');

                Swal.fire({
                    title: 'Apa Anda Yakin?',
                    text: "Anda tidak akan dapat mengembalikannya!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form-' + sentimentId).submit();
                    }
                });
            });

            let ids = []
            $("#checkall").on("click", function() {
                if ($(this).is(":checked")) {
                    $(".checkall").prop("checked", true)
                    for (let index = 0; index < $(".checkall").length; index++) {
                        const check = $(".checkall")[index];
                        ids.push(check.value)
                    }
                    $("#multiId").val(ids.join(", "))
                    $(".delete").removeClass("d-none").addClass("d-flex")
                } else {
                    $(".checkall").prop("checked", false)
                    $("#multiId").val("")
                    ids = []
                    $(".delete").addClass("d-none").removeClass("d-flex")
                }
            })

            $("body").on("click", ".checkall", function() {
                if ($(this).is(":checked")) {
                    ids.push($(this).val())
                    $(".delete").removeClass("d-none").addClass("d-flex")
                } else {
                    var index = ids.indexOf($(this).val());
                    if (index !== -1) {
                        ids.splice(index, 1);
                    }
                }
                if (ids.length < 1) {
                    $(".delete").addClass("d-none").removeClass("d-flex")
                }
                $("#multiId").val(ids.join(", "))
            })
        });
    </script>
@endsection
