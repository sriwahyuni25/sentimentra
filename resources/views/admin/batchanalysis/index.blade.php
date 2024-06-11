@extends('index')
@section('content')
    <div class="pagetitle">
        <h1>Analysis</h1>
        <nav>
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> --}}
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-sentimentra')}}">Home</a></li>
                {{-- <a class="nav-link" href="{{ url('/historyanalysis') }}"> --}}
                <li class="breadcrumb-item">Analysis</li>
                <li class="breadcrumb-item active">Batch Analysis</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Batch Analysis</h5>

            <!-- General Form Elements -->
            <form action="{{ url('/batch-analysiscreate') }}"method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="formFile" class="col-sm-2 col-form-label">Choose file</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="formFile" name="file">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>

            @if (isset($response) && is_array($response))
        <h5>Sentiment Result</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Text</th>
                    <th>Sentiment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($response as $data)
                    <tr>
                        <td>{{ $data['text'] }}</td>
                        <td>{{ $data['sentiment'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        </div>
    </div>
@endsection
