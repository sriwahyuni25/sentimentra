<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sentimentra</title>
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
                {{-- <!-- <img src="{{ asset('arsha/assets/img/logo.png') }}" alt=""> --> --}}
                <h1 class="sitename">SENTIMENTRA</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#beranda" class="active">Beranda</a></li>
                    <li><a href="#sentiment">Analysis Sentiment</a></li>
                    <li><a href="#statistik">Statistik</a></li>
                    <li><a href="#wordcloud">Wordcloud</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="#sentiment">Get Started</a>

        </div>
    </header>

    <main class="main">

        <!-- Beranda Section -->
        <section id="beranda" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center"
                        data-aos="zoom-out">
                        <h1>Selamat Datang di Sentimentra</h1>
                        <p>Dengan Sentimentra, Anda dapat menganalisis sentimen teks secara otomatis untuk mengetahui
                            apakah teks tersebut bersifat positif atau negatif</p>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 lp" data-aos="zoom-out" data-aos-delay="200">
                        <img src="{{ asset('arsha/assets/img/lp.png') }}" class="img-fluid animated" alt=""
                            style="width: 90%;">
                    </div>
                </div>
            </div>

        </section><!-- /Beranda Section -->

        <!-- Sentiment Section -->
        <section id="sentiment" class="sentiment section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Analysis Sentiment</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="container mt-3">
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ url('/guest/single-analysis') }}" class="contain" method="POST">
                        @csrf
                        <div class="row mb-2 mt-3 duplikasi" id="gandakan-0" data-id="0">
                            <div class="col-sm-11  mb-3">
                                <input type="text" name="texts[]" class="form-control" placeholder="Masukkan Text"
                                    value="{{ old('single') }}">
                            </div>
                            <div class="col-sm mb-3">
                                <a href="#" class="text-danger fs-3 delete-input">&times;</a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-warning col-sm-12 mb-2 btn-add">Add Text</button>
                                <button type="submit" class="btn btn-primary col-sm-12 mb-2">Process</button>
                                <button type="reset" class="btn btn-secondary col-sm-12">Reset</button>
                            </div>
                        </div>
                    </form>

                    @if (session('sentiment') && session('text'))
                        <div class="row mb-3 mt-3">
                            <div class="col-sm-12">
                                <div class="alert alert-info">
                                    <strong>Sentiment Analysis Result:</strong><br>
                                    The sentence "<strong>{{ session('text') }}</strong>" has a sentiment of
                                    "<strong>{{ session('sentiment') }}</strong>".
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('response') && is_array(session('response')))
                        <div class="alert alert-info">

                            <h5>Sentiment Result</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Text</th>
                                        <th>Sentiment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (session('response') as $data)
                                        <tr>
                                            <td>{{ $data['text'] }}</td>
                                            <td>{{ $data['sentiment'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </section>
        <!-- /About Section -->



        <!-- Statistik Section -->
        <section id="statistik" class="statistik section">

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

        <!-- wordcloud Section -->
        <section id="wordcloud" class="wordcloud section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2 style="margin-bottom: 1px;">Wordcloud</h2>
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
                        <h4>Terimakasih Telah Mengunjungi Sentimentra</h4>
                        <p>Kami berharap aplikasi ini dapat membantu Anda dalam menganalisis sentimen. Dukungan Anda
                            sangat berarti bagi kami.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-sentiment">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">Sentimentra</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Lohbener Lama No.08, Legok,</p>
                        <p>Kec. Lohbener, Kabupaten Indramayu, Jawa Barat 45252</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>(021) 123-4567</span></p>
                        <p><strong>Email:</strong> <span>support@sentimentra.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Halaman</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#beranda">Beranda</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#sentimet">Analysis Sentiment</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#statistik">Statistik</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#wordcloud">Wordcloud</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Ikuti Kami</h4>
                    <p>Tetap terhubung dengan kami melalui media sosial untuk mendapatkan update terbaru dan informasi
                        menarik lainnya:</p>
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
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Sentimentra</strong> <span>All Rights
                    Reserved</span>
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
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('fragment') === 'sentiment' || (isset($fragment) && $fragment === 'sentiment'))
                var element = document.getElementById('sentiment');
                if (element) {
                    element.scrollIntoView();
                }
            @endif
        });
        // {{-- chart pra sentimen --}}
        document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#praSentiment"), {
                series: [{
                        name: 'Positif',
                        data: [717, 1268, 1342, ]
                    },
                    {
                        name: 'Negatif',
                        data: [1077, 1473, 1341, ]
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
                        data: [953, 1460, 1316, ]
                    },
                    {
                        name: 'Negatif',
                        data: [1022, 1533, 1725, ]
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
                        data: [704, 1046, 1496, ]
                    },
                    {
                        name: 'Negatif',
                        data: [1197, 1468, 2960, ]
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
    <script>
        $(function() {
            var counter = $(".duplikasi:last").data("id");
            $("#gandakan-" + counter).find("a").hide();

            $(".btn-add").on("click", function(e) {
                e.preventDefault();
                var editElm;
                counter++;

                $(".duplikasi:last").clone(true)
                    .map(function() {
                        editElm = $(this)
                            .attr('id', 'gandakan-' + counter)
                            .attr('data-id', counter)
                    });


                if ($("#gandakan-" + (counter - 1)).length) {
                    $("#gandakan-" + (counter - 1)).after(editElm);
                } else {
                    $("#gandakan-0").after(editElm);
                }

                $("#gandakan-" + counter).find('input').val('');

                $('.duplikasi').find("a").show();
                $("#gandakan-" + counter).find("a").hide();
            })

            $(document).undelegate(".delete-input", "click").delegate(".delete-input", "click", function(e) {
                e.preventDefault()
                $(this).parents(".duplikasi").remove()
            })

            // $(".contain").on("submit", function(e) {
            //     e.preventDefault()

            //     for (let index = 0; index < $(this).find('input[name="texts[]"]').length; index++) {
            //         const input = $(this).find('input[name="texts[]"]')[index];

            //     }
            //     // $.ajax({
            //     //     url: "https://train-data.sentimentra.my.id/predicts",
            //     //     method: "post",
            //     //     data: $(this).serialize(),
            //     //     dataType: "json",
            //     //     contentType: "application/json",
            //     //     success: function(response) {
            //     //         console.log(response);
            //     //     },
            //     //     error: function(error) {
            //     //         console.log(error);
            //     //     }
            //     // })
            // })
        })
    </script>
</body>

</html>
