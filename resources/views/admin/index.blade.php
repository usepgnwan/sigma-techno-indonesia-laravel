<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="url-route" content="{{ $url }}">
  <meta name="base-route" content="{{ url('') }}">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title></title> 
  <!-- Favicons -->
  <link  name='icon' rel="icon">
  {{-- <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  @include('admin.assets.css') 
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
      @include('admin.partials.header') 
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav sidebar-nav-account" id="sidebar-nav ">
        @include('admin.partials.navbar')
    </ul>
  </aside><!-- End Sidebar-->
  <main id="main" class="main content-page-first"> 
    <section class="section">
      <div class="row ml-2 mr-2 mt-5 d-flex">
        <div class="col-md-12 text-center justify-content-center ">
            <div class="spinner-border text-primary "> 
            </div>
        </div>
    </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright"> 
    </div> 
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  @include('admin.assets.js') 
</body>
</html>