
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
  @yield('js')
</body>

</html>
