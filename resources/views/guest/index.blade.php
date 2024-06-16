<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Arsha Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('arsha/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('arsha/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('arsha/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('arsha/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('arsha/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('arsha/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('arsha/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('arsha/assets/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Jun 14 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="{{ asset('arsha/assets/img/logo.png') }}" alt=""> -->
                <h1 class="sitename">SENTIMENTRA</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Analysis Sentiment</a></li>
                    <li><a href="#services">Statistik</a></li>
                    <li><a href="#portfolio">Wordcloud</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="#about">Get Started</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center"
                        data-aos="zoom-out">
                        <h1>Selamat Datang di Sentimentra</h1>
                        <p>Dengan Sentimentra, Anda dapat menganalisis sentimen teks secara otomatis untuk mengetahui
                            apakah teks tersebut bersifat positif atau negatif</p>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
                        <img src="{{ asset('arsha/assets/img/hero-img.png') }}" class="img-fluid animated"
                            alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Analysis Sentiment</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="container mt-3">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="single-tab" data-toggle="tab" href="#single" role="tab"
                                aria-controls="single" aria-selected="true">Single</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="batch-tab" data-toggle="tab" href="#batch" role="tab"
                                aria-controls="batch" aria-selected="false">Batch</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="single" role="tabpanel"
                            aria-labelledby="single-tab">

                            <!-- General Form Elements -->
                            <form action="{{ url('/guest/single-analysis') }}" method="POST">
                                @csrf
                                <div class="row mb-2 mt-3">
                                    <div class="col-sm-12">
                                        <input type="text" name="single" class="form-control"
                                            placeholder="Masukkan Text" value="{{ old('single') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary col-sm-12 mb-2">Process</button>
                                        <button type="reset" class="btn btn-secondary col-sm-12">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="batch" role="tabpanel" aria-labelledby="batch-tab">
                            <!-- General Form Elements -->
                            <form action="{{ url('/guest/batch-analysis') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-2 mt-3">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="file" id="formFile" name="file">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary col-sm-12">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    @if (isset($sentiment))
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <label for="inputText" class="col-form-label">Kalimat
                                    "{{ $text }}" mengarah ke kalimat
                                    {{ $sentiment }}</label>
                            </div>
                        </div>
                    @endif
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

        </section><!-- /About Section -->

        <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Statistik</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Pra Sentiment</h5>

                                    <!-- Column Chart -->
                                    <div id="praSentiment"></div>
                                    <!-- End Column Chart -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Pemilu Sentiment</h5>

                                    <!-- Column Chart -->
                                    <div id="pemiluSentiment"></div>
                                    <!-- End Column Chart -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Pasca Sentiment</h5>

                                    <!-- Column Chart -->
                                    <div id="pascaSentiment"></div>
                                    <!-- End Column Chart -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Services Section -->

        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Wordcloud</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <ul class="nav nav-tabs" id="sentimenTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab"
                            aria-controls="all" aria-selected="true">All Sentimen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="positive-tab" data-toggle="tab" href="#positif" role="tab"
                            aria-controls="positif" aria-selected="false">Positif Sentimen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="negative-tab" data-toggle="tab" href="#negative" role="tab"
                            aria-controls="negative" aria-selected="false">Negative Sentimen</a>
                    </li>
                </ul>
                <div class="tab-content" id="sentimenTabContent">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                        <img class="mt-2" src="{{ asset('wordcloud/word-cloud-all.png') }}"
                            style="width: 100%; max-width: 1000px; height: auto;" alt="">
                    </div>
                    <div class="tab-pane fade" id="positif" role="tabpanel" aria-labelledby="positive-tab">
                        <img class="mt-2" src="{{ asset('wordcloud/word-cloud-pos.png') }}"
                            style="width: 100%; max-width: 1000px; height: auto;" alt="">
                    </div>
                    <div class="tab-pane fade" id="negative" role="tabpanel" aria-labelledby="negative-tab">
                        <img class="mt-2" src="{{ asset('wordcloud/word-cloud-neg.png') }}"
                            style="width: 100%; max-width: 1000px; height: auto;" alt="">
                    </div>
                </div>

            </div>

        </section><!-- /Portfolio Section -->

    </main>

    <footer id="footer" class="footer">

        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h4>Join Our Newsletter</h4>
                        <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                        <form action="forms/newsletter.php" method="post" class="php-email-form">
                            <div class="newsletter-form"><input type="email" name="email"><input type="submit"
                                    value="Subscribe"></div>
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">Arsha</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Arsha</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('arsha/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('arsha/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('arsha/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('arsha/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('arsha/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('arsha/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('arsha/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('arsha/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('arsha/assets/js/main.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @include('template.component.style_js')
    <script>
        // {{-- chart pra sentimen --}}
        document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#praSentiment"), {
                series: [{
                        name: 'Positif',
                        data: [14, 80, 43, ]
                    },
                    {
                        name: 'Negatif',
                        data: [56, 55, 76, ]
                    }
                ],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Paslon 01', 'Paslon 02', 'Paslon 03'],
                },
                yaxis: {
                    title: {
                        text: 'Sentiment'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "s " + val + " sentiment"
                        }
                    }
                }
            }).render();
        });

        // {{-- chart pemilu sentimen --}}
        document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#pemiluSentiment"), {
                series: [{
                        name: 'Positif',
                        data: [14, 80, 43, ]
                    },
                    {
                        name: 'Negatif',
                        data: [56, 55, 76, ]
                    }
                ],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Paslon 01', 'Paslon 02', 'Paslon 03'],
                },
                yaxis: {
                    title: {
                        text: 'Sentiment'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "s " + val + " sentiment"
                        }
                    }
                }
            }).render();
        });

        // {{-- chart pemilu sentimen --}}
        document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#pascaSentiment"), {
                series: [{
                        name: 'Positif',
                        data: [14, 80, 43, ]
                    },
                    {
                        name: 'Negatif',
                        data: [56, 55, 76, ]
                    }
                ],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Paslon 01', 'Paslon 02', 'Paslon 03'],
                },
                yaxis: {
                    title: {
                        text: 'Sentiment'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "s " + val + " sentiment"
                        }
                    }
                }
            }).render();
        });
    </script>

</body>

</html>
