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
                    <div class="d-none gap-3 buttons">
                        <form action="{{ url('/multitotestdata') }}" class="mb-3" method="post">
                            @csrf
                            <input type="hidden" name="id" id="multiId1" value="">
                            <button class="btn btn-sm btn-primary">Add Multi to TrainData</button>
                        </form>
                        <form action="{{ url('/deletemultifromtestdata') }}" class="mb-3" method="post">
                            @csrf
                            <input type="hidden" name="id" id="multiId2" value="">
                            <button class="btn btn-sm btn-danger">Delete Multi from TrainData</button>
                        </form>
                    </div>
                    <table class="table datatable1">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check d-inline">
                                        <input class="form-check-input" type="checkbox" value="" id="checkall">
                                    </div>
                                    <b>#</b>
                                </th>
                                <th>Start Date</th>
                                <th>Text</th>
                                <th>Sentiment</th>
                                <th>Action</th>
                                <th>Add To TrainData</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sentiments as $sentiment)
                                <tr>
                                    <td>
                                        <div class="form-check d-inline">
                                            <input class="form-check-input checkall" type="checkbox"
                                                value="{{ $sentiment->id }}">
                                        </div>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $sentiment->created_at }}</td>
                                    <td>{{ $sentiment->text }}</td>
                                    <td>{{ $sentiment->sentiment }}</td>
                                    <td>
                                        @if ($sentiment->status == 'false')
                                            <form id="delete-form-{{ $sentiment->id }}"
                                                action="{{ url('/historyanalysisdel/delete', $sentiment->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                    data-id="{{ $sentiment->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                                <a href="{{ url('/historyanalysisdel/falsestatus', $sentiment->id) }}"><span
                                                        class="badge bg-danger">False</span></a>
                                            </form>
                                        @elseif ($sentiment->status == 'true')
                                            <form id="delete-form-{{ $sentiment->id }}"
                                                action="{{ url('/historyanalysisdel/delete', $sentiment->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                    data-id="{{ $sentiment->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                                <a href="{{ url('/historyanalysisdel/truestatus', $sentiment->id) }}"><span
                                                        class="badge bg-success">True</span></a>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $sentiment->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <a href="{{ url('/historyanalysisdel/falsestatus', $sentiment->id) }}"><span
                                                    class="badge bg-danger">False</span></a>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $existsInTestData = \App\Models\TrainData::where(
                                                'single_id',
                                                $sentiment->id,
                                            )->exists();
                                        @endphp
                                        @if ($existsInTestData)
                                            <form id="remove-form-{{ $sentiment->id }}"
                                                action="{{ url('/deletefromtestdata', $sentiment->id) }}" method="POST">
                                                @csrf
                                                <button id="remove-btn-{{ $sentiment->id }}" type="submit"
                                                    class="btn btn-danger btn-sm remove-btn"
                                                    data-id="{{ $sentiment->id }}">
                                                    Remove from TestData
                                                </button>
                                            </form>
                                        @else
                                            <form id="add-form-{{ $sentiment->id }}" action="{{ url('/addtotestdata') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $sentiment->id }}">
                                                <button type="submit" class="btn btn-primary btn-sm add-btn"
                                                    data-id="{{ $sentiment->id }}">
                                                    Add to TrainData
                                                </button>
                                            </form>
                                        @endif
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

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                    $("#multiId1").val(ids.join(", "))
                    $("#multiId2").val(ids.join(", "))
                    $(".buttons").removeClass("d-none").addClass("d-flex")
                } else {
                    $(".checkall").prop("checked", false)
                    $("#multiId1").val("")
                    $("#multiId2").val("")
                    ids = []
                    $(".buttons").addClass("d-none").removeClass("d-flex")
                }
            })

            $("body").on("click", ".checkall", function() {
                if ($(this).is(":checked")) {
                    ids.push($(this).val())
                    $(".buttons").removeClass("d-none").addClass("d-flex")
                } else {
                    var index = ids.indexOf($(this).val());
                    if (index !== -1) {
                        ids.splice(index, 1);
                    }
                }
                if (ids.length < 1) {
                    $(".buttons").addClass("d-none").removeClass("d-flex")
                }
                $("#multiId1").val(ids.join(", "))
                $("#multiId2").val(ids.join(", "))
            })

            // Handling remove from TestData action
            // $('.remove-btn').click(function() {
            //     var sendId = $(this).data('id');

            //     Swal.fire({
            //         title: 'Apa Anda Yakin?',
            //         text: "Data Akan Terhapus dari TestData!",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#d33',
            //         cancelButtonColor: '#3085d6',
            //         confirmButtonText: 'Ya, Hapus!'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             $('#remove-form-' + sendId).submit();
            //         }
            //     });
            // });

            // // Handling add to TestData action
            // $('.add-btn').click(function() {
            //     var sentimentId = $(this).data('id');

            //     Swal.fire({
            //         title: 'Tambahkan ke TestData',
            //         text: "Apakah Anda yakin ingin menambahkan ini ke TestData?",
            //         icon: 'info',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Ya, Tambahkan!'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             $('#add-form-' + sentimentId).submit();
            //         }
            //     });
            // });
        });
    </script>
@endsection
