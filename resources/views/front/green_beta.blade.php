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
   <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
   <link rel="stylesheet" href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
  <style>
    body{
        font-size: 0.9rem !important;
    }
    #navbarNav .nav-link {
        font-size: 1.1rem;
        color: #000;
        font-weight: 600;
    }
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

  </style>

</head>
<body>

  <!-- Navigation Bar -->

@include('front.common.header')


  <!-- Features Section -->

  <section class="features text-left mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4"><span class="title-trading-first label-color">Green Beta Signal</span>

                </h2>
            <!-- Data and Chart Section -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Chart Section -->
                        <div class="col-md-12 text-center">
                            <img class="img-fluid" style="width:100%" src="{{asset('images/green-beta-2.png')}}" />
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
<section class="features text-left mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4"><span class="title-trading-first label-color">WinRatio</span>

                </h2>
            <!-- Data and Chart Section -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Chart Section -->
                        <div class="col-md-12 text-center">
                            <img class="img-fluid" style="width:100%" src="{{asset('images/green-beta-1.png')}}" />
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
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
