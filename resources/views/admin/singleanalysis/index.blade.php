@extends('index')
@section('content')
    <div class="pagetitle">
        <h1>Analysis</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-sentimentra') }}">Home</a></li>
                <li class="breadcrumb-item">Analysis</li>
                <li class="breadcrumb-item active">Single Analysis</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Single Analysis</h5>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- General Form Elements -->
            <form action="{{ url('/textanalysis') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Text</label>
                    <div class="col-sm-10">
                        <input type="text" name="single" class="form-control" value="{{ old('single') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Process</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>

                @if (isset($sentiment))
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <label for="inputText" class="col-form-label">Kalimat "{{ $text }}" mengarah ke kalimat
                                {{ $sentiment }}</label>
                        </div>
                    </div>
                @elseif (isset($error))
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <div class="text-danger">{{ $error }}</div>
                        </div>
                    </div>
                @endif
            </form><!-- End General Form Elements -->
        </div>
    </div>
@endsection
