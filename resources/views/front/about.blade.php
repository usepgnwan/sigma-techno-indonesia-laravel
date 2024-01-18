<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  <meta name="base-route" content="{{ url('') }}">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tentang</title> 
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
                      <h2 data-aos="fade-down">Tentang</h2>
                      <h3 class="text-white text-title-page">  </h3>
                      <!-- <a data-aos="fade-up" data-aos-delay="200" href="#get-started" class="btn-get-started">Get Started</a> -->
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </section>
      <main id="main">
         <section id="about">
            <div class="container">
                <div class="row"> 
                    <div class="col-sm-12 col-md-6 col-lg-7 text-justify"> 
                        {!! $about->description !!}
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 offset-lg-1">
                      <div id="about-coursel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner"> 
                          @foreach ($team as $k=> $item) 
                            <div class="carousel-item @if($k==0) active @endif">
                                <img src="{{ $item->foto }}" class="d-block w-100" alt="...">
                                <h3 class="text-center">{{ $item->name }}</h3>
                            </div>
                          @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#about-coursel" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#about-coursel" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                    </div>
                    <div class="col-md-12 mt-5 text-center">
                      <h5 class="fw-bold">FAQ</h5>
                      <div class="accordion accordion-flush" id="accordionFlushExample">
                        @foreach ($faq as $item) 
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="{{$item->id}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-{{$item->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                              {{$item->title}}
                            </button>
                          </h2>
                          <div id="flush-{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="{{$item->id}}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body " style="text-align: left;"> 
                                {{$item->description}}
                            </div>
                          </div>
                        </div> 
                        @endforeach
                      </div>
                    </div>
                </div>
            </div>
         </section>
      </main>

      
      @include('front.partial.footer',["service"=>$service])
  <!-- End Footer -->
       {{-- <a href="#" class="whatsapp-floating d-flex align-items-center justify-content-center"><i class="bi bi-whatsapp"></i></a> --}}
        {{-- <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> --}}
        {{-- <div id="preloader"></div> --}}
 
 
     
</body>
</html>