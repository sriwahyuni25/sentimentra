@extends('index')
@section('content')
    <div class="pagetitle">
        <h1>Word Cloud</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-sentimentra')}}">Home</a></li>
                <li class="breadcrumb-item active">Word Cloud</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <div class="card">
        <div class="card-body">
            <form action="{{ url('/wordcloudaction') }}" method="POST">
                @csrf
                <div class="row mb-3 mt-5">
                    <table>
                        <tr>
                            <td>
                                <div class="col-sm-12 mr-2">
                                    <select id="sentimentSelect" name='option' class="form-select" aria-label="Default select example">
                                        <option value="all" @if(session('selectedSentiment') == 'all') selected @endif>All Sentiment</option>
                                        <option value="neg" @if(session('selectedSentiment') == 'neg') selected @endif>Negative</option>
                                        <option value="pos" @if(session('selectedSentiment') == 'pos') selected @endif>Positive</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <button id="processButton" type="submit" class="btn btn-primary">Process</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    @if (isset($image))
                    <img id="sentimentImage" src="{{ asset($image) }}" style="width: 100%; max-width: 800px; height: auto;" alt="">
                @endif

                </div>
            </form>
        </div>
    </div>

    @endsection
