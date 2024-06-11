@extends('index')
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3 ml-6">
                    {{-- <h5 class="card-title">History Analysis</h5> --}}

                    <div class="search-bar">
                        <form class="search-form d-flex align-items-center" method="POST" action="#">
                          <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                          <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                        </form>
                      </div><!-- End Search Bar -->

                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-3">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Calon presiden dan Wakil Presiden</th>
                                <th scope="col">Rentang Waktu</th>
                                <th scope="col">Hasil Upload</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>gambar capres</td>
                                <td>pra/pemilu/pasca</td>
                                <td>View Data</td>
                                <td>Ubah nama/Tambah data/Hapus</td>
                              </tr>
                              <tr>
                                <th scope="row">2</th>
                                <td>gambar capres</td>
                                <td>pra/pemilu/pasca</td>
                                <td>View Data</td>
                                <td>Ubah nama/Tambah data/Hapus</td>
                              </tr>
                            </tbody>
                         </table>

      </div><!-- End Right side columns -->

    </div>
  </section>

  @endsection
