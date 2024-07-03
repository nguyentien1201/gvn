<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
   <!-- DataTables Responsive CSS -->
   <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
  <style>
    .hero {
      background: url('https://via.placeholder.com/1500x800') no-repeat center center;
      background-size: cover;
      color: white;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .cta {
      background-color: #007bff;
      color: white;
      padding: 60px 0;
    }
    .footer {
      padding: 30px 0;
    }
    .carousel-item {
      height: 100vh;
      min-height: 300px;
      background: no-repeat center center scroll;
      background-size: cover;
    }
    .carousel-caption {
      background: rgba(0, 0, 0, 0.6);
      padding: 20px;
      border-radius: 10px;
    }
    .features {
      background: #f9f9f9;
    }
    .features .card {
      border: none;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .features .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .features .card-body {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .cta {
      background: linear-gradient(45deg, #007bff, #0056b3);
      color: white;
      padding: 60px 0;
    }
    .cta .btn {
      background: white;
      color: #007bff;
      border: none;
      transition: background-color 0.3s, color 0.3s;
    }
    .cta .btn:hover {
      background: #007bff;
      color: white;
    }
    .footer {
      padding: 30px 0;
      background: #f1f1f1;
    }
    .header {
  position: relative;
  width: 100%;
  z-index: 1000;
  transition: all 0.5s ease; /* Smooth transition for any changes */
}

.fixed-header {
  position: fixed;
  top: 0;
  background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent or any effect */
  box-shadow: 0 2px 5px rgba(0,0,0,0.2); /* Optional: adds shadow for better visibility */
}
  </style>

</head>
<body>

  <!-- Navigation Bar -->

@include('front.common.header')


  <!-- Features Section -->

  @include('front.common.home-content')
  <!-- Call to Action Section -->

  <section class="text-center mt-5">
  @include('front.common.footer')
  </section>
  <!-- Footer -->


  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
</body>
</html>
@yield('scripts')
    <script>


        // Chart js config
        var ctx = document.getElementById('myChartBeta').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['11/22', '11/25', '11/29', '03/23', '04/25', '06/28'],
                datasets: [{
                    fill: false,
                    label: 'Green Alpha 10.0.1',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        '#3ab54a',
                        '#3ab54a',
                        '#3ab54a',
                        '#3ab54a',
                        '#3ab54a',
                        '#3ab54a'
                    ],
                    borderColor: [
                        '#3ab54a'
                    ],
                    borderWidth: 2
                },
                {
                    fill: false,
                    label: 'NASDAQ',
                    data: [5, 14, -3, -5, 6, -3],
                    backgroundColor: [
                        '#7a7a7a',
                        '#7a7a7a',
                        '#7a7a7a',
                        '#7a7a7a',
                        '#7a7a7a',
                        '#7a7a7a'
                    ],
                    borderColor: [
                        '#7a7a7a'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: 'rgb(255, 99, 132)'
                        }
                    }
                }
            }
        });

        var ctx = document.getElementById('myChartAnpha').getContext('2d');
        var myChartAnpha = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['11/22', '11/25', '11/29', '03/23', '04/25', '06/28'],
                datasets: [{
                    fill: 'origin',
                    label: 'Green Alpha 10.0.1',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: '#4ac12c94',
                    borderColor: '#3ab54a',
                    borderWidth: 2
                },
                {
                    fill: 'origin',
                    label: 'NASDAQ',
                    data: [-12, -19, -3, -5, -2, -3],
                    backgroundColor: '#00000066',
                    borderColor: '#7a7a7a',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: 'rgb(255, 99, 132)'
                        }
                    }
                }
            }
        });

        $('#chartType').on('select2:select', function (e) {
            var typeChart = e.params.data.id;
            changeChartType(typeChart)
        });
        function changeChartType(typeChart) {
            switch (typeChart) {
                case 'bar':
                    myChart.config.type = 'bar';
                    myChart.data.datasets = [{
                        fill: false,
                        label: 'Green Alpha 10.0.1',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a'
                        ],
                        borderColor: [
                            '#3ab54a'
                        ],
                        borderWidth: 2
                    },
                    {
                        fill: false,
                        label: 'NASDAQ',
                        data: [-12, -19, -3, -5, -2, -3],
                        backgroundColor: [
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a'
                        ],
                        borderColor: [
                            '#7a7a7a'
                        ],
                        borderWidth: 2
                    }]
                    break;
                case 'area':
                    myChart.config.type = 'line';
                    myChart.data.datasets = [{
                        fill: true,
                        label: 'Green Alpha 10.0.1',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: '#4ac12c94',
                        borderColor: '#3ab54a',
                        borderWidth: 2
                    },
                    {
                        fill: true,
                        label: 'NASDAQ',
                        data: [-12, -19, -3, -5, -2, -3],
                        backgroundColor: '#00000066',
                        borderColor: '#7a7a7a',
                        borderWidth: 2
                    }]
                    break;
                default:
                    myChart.config.type = 'line';
                    myChart.data.datasets = [{
                        fill: false,
                        label: 'Green Alpha 10.0.1',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a'
                        ],
                        borderColor: [
                            '#3ab54a'
                        ],
                        borderWidth: 2
                    },
                    {
                        fill: false,
                        label: 'NASDAQ',
                        data: [-12, -19, -3, -5, -2, -3],
                        backgroundColor: [
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a'
                        ],
                        borderColor: [
                            '#7a7a7a'
                        ],
                        borderWidth: 2
                    }]
                    break;
            }
            myChart.update();
        }
    </script>
