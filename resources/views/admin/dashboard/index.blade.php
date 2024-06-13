@extends('index')
@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-sentimentra') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    {{-- <!-- Paslon 1 Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Pra</a></li>
                  <li><a class="dropdown-item" href="#">Pemilu</a></li>
                  <li><a class="dropdown-item" href="#">Pasca</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Paslon <span>| 01</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <h6>Anies</h6>
                    <span class="text-success small pt-1 fw-bold">Muhaimin</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Paslon 1 Card -->

           <!-- Paslon 2 Card -->
           <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Pra</a></li>
                  <li><a class="dropdown-item" href="#">Pemilu</a></li>
                  <li><a class="dropdown-item" href="#">Pasca</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Paslon <span>| 02</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <h6>Prabowo</h6>
                    <span class="text-success small pt-1 fw-bold">Gibran</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Paslon 2 Card -->

           <!-- Paslon 3 Card -->
           <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Pra</a></li>
                  <li><a class="dropdown-item" href="#">Pemilu</a></li>
                  <li><a class="dropdown-item" href="#">Pasca</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Paslon <span>| 03</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <h6>Ganjar</h6>
                    <span class="text-success small pt-1 fw-bold">Mahfud</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Paslon 3 Card --> --}}

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
    </section>
@endsection

@section('js')
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
@endsection

{{-- chart pemilu sentimen --}}
@section('js')
    <script>
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
                        columnWidth: '55%',
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
@endsection

{{-- chart pasca sentimen
   @section('js')
   <script>
     document.addEventListener("DOMContentLoaded", () => {
       new ApexCharts(document.querySelector("#pascaSentiment"), {
         series: [{
           name: 'Positif',
           data: [14, 80, 43, ]
         },
         {
           name: 'Negatif',
           data: [56, 55, 76, ]
         }],
         chart: {
           type: 'bar',
           height: 350
         },
         plotOptions: {
           bar: {
             horizontal: false,
             columnWidth: '55%',
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
   @endsection --}}
