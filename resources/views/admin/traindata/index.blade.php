@extends('index')
@section('content')
    <div class="pagetitle">
        <h1>Data Master</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-sentimentra')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Master</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
    <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Train Data</h5>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Text</th>
                    <th>Sentiment</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($trainData as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->text }}</td>
                            <td>
                                @if($data->sentiment == 1)
                                <span>Positif</span>
                                @elseif ($data->sentiment == 0)
                                <span>Negatif</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.testdata.index', $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
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
    </section>
    @endsection
