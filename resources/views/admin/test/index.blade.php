@extends('index')
@section('content')
<form action="{{ url('/admin/test') }}" method="POST">
    @csrf
    <div class="row mb-3">
      <label for="inputText" class="col-sm-2 col-form-label">nyobain</label>
      <div class="col-sm-10">
        <input name="nama" type="text" class="form-control">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">simpan</button>
</form>
@endsection
