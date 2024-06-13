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
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th><b>#</b></th>
                                <th>Start Date</th>
                                <th>Text</th>
                                <th>Sentiment</th>
                                <th>Action</th>
                                <th>Add To TestData</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sentiments as $sentiment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sentiment->created_at }}</td>
                                    <td>{{ $sentiment->text }}</td>
                                    <td>{{ $sentiment->sentiment }}</td>
                                    <td>
                                        <form id="delete-form-{{ $sentiment->id }}"
                                            action="{{ url('/historyanalysisdel/delete', $sentiment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $sentiment->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        @php
                                            $existsInTestData = \App\Models\TestData::where('single_id', $sentiment->id)->exists();
                                        @endphp
                                        @if ($existsInTestData)
                                            <form action="{{ url('/deletefromtestdata', $sentiment->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Remove from TestData
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ url('/addtotestdata') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $sentiment->id }}">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Add to TestData
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
