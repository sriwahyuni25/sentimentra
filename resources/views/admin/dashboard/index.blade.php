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

                    <!-- Test Data Card -->
  <div class="col-xxl-6 col-md-6">
    <div class="card info-card testdata-card">
      <div class="card-body">
        <h5 class="card-title">Test Data</h5>
        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="ri-database-2-line"></i>
          </div>
          <div class="ps-3">
            <h6>{{ $testDataCount }}</h6> <!-- Menampilkan jumlah test data -->
          </div>
        </div>
      </div>
    </div>
</div><!-- End Test Data Card -->

<!-- Train Data Card -->
<div class="col-xxl-6 col-md-6">
    <div class="card info-card traindata-card">
      <div class="card-body">
        <h5 class="card-title">Train Data</h5>
        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="ri-database-2-fill"></i>
          </div>
          <div class="ps-3">
            <h6>{{ $trainDataCount }}</h6> <!-- Menampilkan jumlah train data -->
          </div>
        </div>
      </div>
    </div>
</div><!-- End Train Data Card -->

<!-- Customers Card -->
{{-- <div class="col-xxl-4 col-xl-12">
    <div class="card info-card customers-card">
        <div class="card-body">
            <h5 class="card-title">Visitors</h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                    <h6>{{ $visitorCount }}</h6>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Customers Card --> --}}



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
