
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sentimentra</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  @include('template.component.style_css')
  <style>
    .image-container {
        display: none;
    }
</style>
</head>

<body>

  <!-- ======= Header ======= -->
 @include('template.header')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
 @include('template.sidebar')
  <!-- End Sidebar-->

  <main id="main" class="main">

    @yield('content')


  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
 @include('template.footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @include('template.component.style_js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  @if (session('success'))
        <script type="text/javascript">
            Swal.fire({
                title: "Berhasil",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif
    @if (session('error'))
        <script type="text/javascript">
            Swal.fire({
                title: "Gagal",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif

  @yield('js')
</body>

</html>
