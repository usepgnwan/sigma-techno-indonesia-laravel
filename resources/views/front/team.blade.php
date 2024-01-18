<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  <meta name="base-route" content="{{ url('') }}">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tim</title> 
  <!-- Favicons -->
  <link  name='icon' rel="icon" href="{{asset('assets/img/sigma.png')}}">
  {{-- <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  @include('front.assets.css') 
</head>
<body>
    @include('front.assets.js') 
    @include('front.partial.header') 
      <section id="hero" class="hero">  
        <div class="hero-img hero-tentang hero-page-about" >
            <div class="info d-flex align-items-center">
                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                      <h2 data-aos="fade-down">Team</h2>
                      <h3 class="text-white text-title-page">  </h3>
                      <!-- <a data-aos="fade-up" data-aos-delay="200" href="#get-started" class="btn-get-started">Get Started</a> -->
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </section>
      <main id="main">
         <section id="teams">
            <div class="container">
              <div class="row">
                @foreach ($team as $item)
                  <div class="col-md-4 col-sm-6">
                    <div class="card" style="border: none" >
                      <div class="  d-flex justify-content-center"> 
                        <img src="{{ $item->foto }}" class="card-img-top rounded-team-2" alt="..."  >
                      </div>
                      <div class="card-body text-center">
                        <h3> <b>{{$item->name}}</b> </h3> 
                        <p> {{$item->title}}</p>
                        </p> 
                      </div>
                    </div> 
                  </div>
                @endforeach
              </div>
            </div>
         </section>
      </main>

      
      @include('front.partial.footer',["service"=>$service])
  <!-- End Footer -->

        {{-- <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> --}}
        {{-- <div id="preloader"></div> --}}
 
 
     
</body>
</html>