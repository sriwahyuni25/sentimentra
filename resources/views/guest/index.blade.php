<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Starter Template · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/starter-template/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="{{ asset('/bootstrap/assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>


</head>

<body>




    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="arrow-right-circle" viewBox="0 0 16 16">
            <path
                d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
        </symbol>
        <symbol id="bootstrap" viewBox="0 0 118 94">
            <title>Bootstrap</title>
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z">
            </path>
        </symbol>
    </svg>

    <div class="col-lg-8 mx-auto p-4 py-md-5">
        <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
            <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
                <h3 class="text-body-emphasis">SENTIMENTRA</h3>
            </a>
        </header>

        <main>
            <h3 class="text-body-emphasis">Analysis Sentiment</h3>
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
                        <form action="{{ url('/textanalysis') }}" method="POST">
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
                        <form action="{{ url('/batch-analysiscreate') }}" method="POST"
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
            <hr class="col-3 col-md-12 mb-5">
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

            <hr class="col-3 col-md-12 mb-3">
            <h3 class="text-body-emphasis mb-3">Wordcloud</h3>
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

        </main>
        <footer class="pt-5 my-5 text-body-secondary border-top">
            Created by the Bootstrap team &middot; &copy; 2024
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="asset{{ '/boorstrap/assets/dist/js/bootstrap.bundle.min.js' }}"></script>
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
