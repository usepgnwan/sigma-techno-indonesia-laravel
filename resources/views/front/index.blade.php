<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  <meta name="base-route" content="{{ url('') }}">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home</title> 
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
        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000"> 
            @foreach ($slider as $item)
                <div class="carousel-item @if($item->status) active @endif" style="background-image: url({{ $item->foto }})">
                    <div class="info d-flex align-items-center">
                        <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-12 text-center">
                            <h2 data-aos="fade-down">{{ $item->title }}</h2>
                            <p> {{ $item->description }}  </p>
                            @if( $item->id_articel > 0) 
                                <a href="{{ route('front.artikel.detail', ['slug'=> $item->artikel->slug ])}}" class="btn-get-started">Get Started</a>
                            @endif
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon  " aria-hidden="true"></span>
            </a> 
            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon  " aria-hidden="true"></span>
            </a>
    
        </div>
      </section>
      <main id="main">
        <section id="supplyer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="fw-bold">Supplyer Saat Ini</h1> 
                        <p class="mt-4">Kami sudah bekerjasama dengan beberapa perusahaan</p>
                    </div>
                </div>
                <div class="d-flex row justify-content-center mt-5">
                   <div class="col-10">
                        <div class="container"> 
                            <div class="clients-slider swiper">
                                <div class="swiper-wrapper align-items-center" >
                                    @foreach ($suply as $item)   
                                        <div class="swiper-slide"> <div class="col-3"><img width="100" src="{{ $item->foto }}" alt="" data-bs-toggle="tooltip" data-bs-placement="top" ></div></div>
                                    @endforeach 
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </section>
        <section id="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-5 mb-4">
                        <div class="card-img"  style="background:url('{{$account->artikel->foto}}');"> 
                            @if($account->artikel->youtube)
                                <div class="button-play">
                                    <a href="{{ $account->artikel->youtube }}" class="glightbox">
                                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle opacity="0.5" cx="35" cy="35" r="35" fill="white"/>
                                            <circle cx="35" cy="35" r="25" fill="white"/>
                                            <path d="M42.5 32.4019C44.5 33.5566 44.5 36.4434 42.5 37.5981L33.5 42.7942C31.5 43.9489 29 42.5056 29 40.1962L29 29.8038C29 27.4944 31.5 26.0511 33.5 27.2058L42.5 32.4019Z" fill="#1F7CFF"/>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div> 
                    <div class="col-md-6 col-lg-6 offset-md-1 d-flex align-items-center "> 
                        <div class="col-12">
                            <h1 class="fw-bold">{{ $account->artikel->title }}</h1> 
                            <p>{{ $account->artikel->short_body }}</p>
                            <a href="{{ route('front.artikel.detail', ['slug'=>$account->artikel->slug])}}" class="text-success" style="color: #89C68E !important;font-size: 1.2em;">Selengkapnya  <i class="bi bi-arrow-right"></i></a>
                        </div>  
                    </div>
                </div>
            </div>
        </section> 
        <section id="services">
            <div class="container">
                <div class="row mb-4"> 
                    <div class="col-md-12 text-center">
                        <h1 class="fw-bold">Jasa Kami</h1> 
                        <p  class="mt-4">PT Sigma Techno Indonesia selalu memberikan pelayanan dan kualitas terbaik</p>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mt-5"> 
                    <div class="col-md-12 col-lg-8">
                        <div class="row row   d-flex justify-content-center">
                            @foreach ($service as $item)
                            <div class="col-md-8  align-items-center">
                                @if(@isset($item->artikel->slug)) <a href="{{ route('front.artikel.detail', ['slug'=>$item->artikel->slug])}}"> @endif
                                    <div class="col text-center">
                                        <div  class="fill-rounded @if($item->status)  rounded-active @endif d-flex align-items-center mb-5">
                                            <div style="width: 100%;" class="icon-on-fill-rounded">
                                                <i class=" {{$item->icon}}"  ></i>
                                            </div>    
                                        </div>
                                        <h5 class="fw-bold mt-3">
                                            {{$item->title}}
                                        </h5>
                                        <p>
                                            {{$item->description}}
                                        </p>
                                    </div>
                                @if(@isset($item->artikel->slug)) </a> @endif
                            </div>
                                
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
          <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container"> 
                <div class="row mb-4"> 
                    <div class="col-md-12 text-center">
                        <h1 class="fw-bold">Pintasan Project</h1> 
                        <p  class="mt-4">Project yang telah PT Sigma Techno Indonesia kerjakan saat ini</p>
                    </div>
                </div>
                <div class="row d-none">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-app">App</li>
                            <li data-filter=".filter-card">Card</li>
                            <li data-filter=".filter-web">Web</li>
                        </ul>
                    </div>
                </div> 
                <div class="row portfolio-container" data-aos-delay="200">
                    @foreach ($project as $item) 
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <div class="portfolio-wrap">
                                <img src="{{ $item->image }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                <h4>{{$item->title}}</h4>
                                <p>{{\Str::limit($item->description,300)}}</p>
                                <div class="portfolio-links">
                                    <a href="{{ $item->image }}" data-gallery="portfolioGallery" class="portfolio-lightbox"  ><i class="bi bi-plus"></i></a>
                                    @if( $item->id_articel > 0) 
                                        <a href="{{ route('front.artikel.detail', ['slug'=> $item->artikel->slug ])}}"title="Lihat selengkapnya"><i class="bi bi-link"></i></a>
                                    @endif 
                                </div>
                                </div>
                            </div>
                        </div> 
                    @endforeach
                </div> 
            </div>
        </section><!-- End Portfolio Section -->
        <section id="teams">
            <div class="container">
                <div class="row"> 
                    <div class="col-md-12 text-center">
                        <h1 class="fw-bold">TIM KAMI</h1> 
                        <p class="mt-4">Tim PT Sigma Techno Indonesia adalah pondasi dari keberhasilan perusahaan ini.</p>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="row d-flex">
                            <div class="col">
                                <a href="javascrip:void(0)" class="swiper-next">
                                    <svg width="42" height="43" viewBox="0 0 42 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.206036 20.8448C0.02889 24.9675 1.07825 29.0502 3.22142 32.5765C5.36458 36.1028 8.5053 38.9145 12.2464 40.6558C15.9875 42.3972 20.161 42.9901 24.239 42.3595C28.3171 41.7289 32.1166 39.9032 35.157 37.1133C38.1975 34.3234 40.3423 30.6945 41.3204 26.6855C42.2984 22.6766 42.0657 18.4677 40.6517 14.591C39.2377 10.7143 36.7058 7.344 33.3763 4.90625C30.0468 2.46851 26.0692 1.07281 21.9465 0.895663C16.4197 0.664347 11.0269 2.6348 6.95117 6.37472C2.87543 10.1146 0.449647 15.3186 0.206036 20.8448ZM22.9462 11.9921C23.1315 12.194 23.2752 12.4303 23.3691 12.6877C23.463 12.9451 23.5053 13.2184 23.4935 13.4922C23.4818 13.7659 23.4162 14.0346 23.3005 14.283C23.1849 14.5314 23.0214 14.7545 22.8195 14.9397L17.8345 19.5139L29.4783 20.0143C30.0312 20.038 30.5519 20.2804 30.9261 20.6881C31.3002 21.0958 31.497 21.6355 31.4733 22.1883C31.4495 22.7411 31.2071 23.2619 30.7994 23.636C30.3917 24.0101 29.852 24.207 29.2992 24.1832L17.6554 23.6829L22.2296 28.668C22.5978 29.0766 22.7897 29.6141 22.7636 30.1635C22.7375 30.7129 22.4955 31.2297 22.0903 31.6016C21.685 31.9735 21.1493 32.1702 20.5997 32.1491C20.0501 32.128 19.531 31.8907 19.1555 31.4888L11.1765 22.7933C10.8039 22.3846 10.6081 21.8452 10.6318 21.2927C10.6556 20.7402 10.8969 20.2196 11.3032 19.8444L19.9987 11.8655C20.2005 11.6802 20.4369 11.5365 20.6942 11.4426C20.9516 11.3487 21.225 11.3064 21.4987 11.3182C21.7724 11.3299 22.0411 11.3955 22.2895 11.5112C22.5378 11.6268 22.761 11.7902 22.9462 11.9921Z" fill="#89C68E"/>
                                        </svg> 
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascrip:void(0)" class="swiper-prev">
                                    <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M42 21C42 16.8466 40.7684 12.7865 38.4609 9.33303C36.1534 5.8796 32.8736 3.18798 29.0364 1.59854C25.1991 0.00909896 20.9767 -0.406771 16.9031 0.403519C12.8295 1.21381 9.08767 3.21386 6.15077 6.15077C3.21386 9.08767 1.21381 12.8295 0.403519 16.9031C-0.406771 20.9767 0.00909896 25.1991 1.59854 29.0364C3.18798 32.8736 5.8796 36.1534 9.33303 38.4609C12.7865 40.7684 16.8466 42 21 42C26.5677 41.9938 31.9055 39.7793 35.8424 35.8424C39.7793 31.9055 41.9938 26.5677 42 21ZM19.5153 30.8847C19.3203 30.6898 19.1655 30.4583 19.06 30.2035C18.9544 29.9488 18.9001 29.6757 18.9001 29.3999C18.9001 29.1242 18.9544 28.8511 19.06 28.5964C19.1655 28.3416 19.3203 28.1101 19.5153 27.9152L24.3305 23.1H12.6C12.0431 23.1 11.5089 22.8788 11.1151 22.4849C10.7213 22.0911 10.5 21.557 10.5 21C10.5 20.4431 10.7213 19.9089 11.1151 19.5151C11.5089 19.1213 12.0431 18.9 12.6 18.9H24.3305L19.5153 14.0847C19.1274 13.6897 18.9112 13.1575 18.9137 12.6039C18.9162 12.0504 19.1372 11.5201 19.5287 11.1287C19.9201 10.7372 20.4504 10.5162 21.0039 10.5137C21.5575 10.5112 22.0897 10.7274 22.4847 11.1153L30.8841 19.5147C31.2764 19.9095 31.4966 20.4435 31.4966 21.0001C31.4966 21.5567 31.2764 22.0907 30.8841 22.4855L22.4847 30.8847C22.2898 31.0797 22.0583 31.2344 21.8036 31.34C21.5488 31.4456 21.2758 31.4999 21 31.4999C20.7243 31.4999 20.4512 31.4456 20.1965 31.34C19.9417 31.2344 19.7102 31.0797 19.5153 30.8847Z" fill="#89C68E"/>
                                    </svg> 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex row justify-content-center mt-4">
                    <div class="col-12">
                         <div class="container-fluid"> 
                             <div class="team-slider swiper">
                                <div class="swiper-wrapper align-items-center" > 
                                        @foreach ($team as $item)
                                        <div class="swiper-slide"> 
                                            <div class="rounded-team" style="background-image: url({{ $item->foto }});background-size: cover;background-repeat: no-repeat;">
                                            {{-- <img src="{{ $item->foto }}" alt="" class="rounded"> --}}
                                            </div>
                                            <div class="text-center">
                                                <h5 class="fw-bold mt-3">{{ $item->name }}</h5>
                                                <p>{{ $item->title }}</p>
                                            </div>
                                        </div> 
                                    @endforeach 
                                </div>
                            </div>
                 </div>
            </div>
        </section>  
        <section id="maps">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-md-12">
                        <h1 class="fw-bold text-white"> Lokasi Kami Saat Ini </h1>
                    </div>
                    <div class="col-md-12">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.8969214461194!2d106.85047687478742!3d-6.5347006638825835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c15165c54ee1%3A0x4dfd7d2fd89dff53!2sPT%20SIGMA%20TECHNO%20INDONESIA!5e0!3m2!1sid!2sid!4v1703208521882!5m2!1sid!2sid" height="480" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-md-12">
                        <a href="https://maps.app.goo.gl/5vRG62EAdMQobpmo6" class="btn btn-location" target="_blank">
                            <svg width="18" height="23" viewBox="0 0 18 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.59148 0C3.83753 0 0 3.83753 0 8.59148C0 14.3191 8.59148 22.9106 8.59148 22.9106C8.59148 22.9106 17.183 14.3191 17.183 8.59148C17.183 3.83753 13.3454 0 8.59148 0ZM8.59148 2.86383C11.7703 2.86383 14.3191 5.44127 14.3191 8.59148C14.3191 11.7703 11.7703 14.3191 8.59148 14.3191C5.44127 14.3191 2.86383 11.7703 2.86383 8.59148C2.86383 5.44127 5.44127 2.86383 8.59148 2.86383Z" fill="white"/>
                                </svg> &nbsp;
                            Arahkan Ke Lokasi
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section id="articel">
            <div class="container">
                <div class="row"> 
                    <div class="col-md-12 text-center">
                        <h1 class="fw-bold">Artikel</h1> 
                        <p class="mt-4">Kenali lebih jauh  dengan mempelajari artikel & kegiatan kami</p>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="row"> 
                            @foreach ($artikel as $item) 
                                <div class="col-lg-4 col-md-6 col-sm-12 pt-5 mb-3">
                                    <div class="card-img img-resize-col" style="background:url('{{$item->foto}}');">
                                        {{-- <img class="img-resize-col-after" src="" alt=""> --}}
                                        @if(!is_null($item->youtube))
                                                <div class="button-play">
                                                    <a href="{{ $item->youtube }}" class="glightbox">
                                                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <circle opacity="0.5" cx="35" cy="35" r="35" fill="white"/>
                                                            <circle cx="35" cy="35" r="25" fill="white"/>
                                                            <path d="M42.5 32.4019C44.5 33.5566 44.5 36.4434 42.5 37.5981L33.5 42.7942C31.5 43.9489 29 42.5056 29 40.1962L29 29.8038C29 27.4944 31.5 26.0511 33.5 27.2058L42.5 32.4019Z" fill="#1F7CFF"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                        @endif
                                        {{-- <div class="title" >
                                            <h4 class="text-white">{{ $item->title }}</h4>
                                            <p class="text-white">{{ \Str::limit(strip_tags($item->body),40) }}</p>
                                        </div> --}}
                                    </div>
                                    <div class="card-body pt-5 px-3">
                                        <h4>{{ $item->title }}</h4>
                                        <p style="text-align: justify;min-height:50px">{{ \Str::limit(strip_tags($item->body),80) }}</p>
                                        <a href="{{ route('front.artikel.detail', ['slug'=>$item->slug])}}" class="text-success" style="color: #89C68E !important;font-size: 1.2em;">Selengkapnya  <i class="bi bi-arrow-right"></i></a> 
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-5">
                        <a href="{{route('front.artikel')}}" class="text-success">Lihat lebih Banyak ...</a>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-5 mb-4">
                        <div class="card-img-contact"> 
                            <div class="floating-img-contact" style="background: url('{{ $account->cover_about }}')"></div>
                        </div>
                    </div> 
                    <div class="col-md-6 col-lg-6 offset-md-1 d-flex align-items-center "> 
                        <form action="{{route('kontak')}}" method="post"> 
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <input type="hidden" class="form-control p-2" name="id" id="id"   value="add">
                                    <input type="text" class="form-control p-2" name="name" id="name" placeholder="Masukan Nama Anda" required>
                                  </div>
                                  <div class="col-md-12 mt-3">
                                    <input type="text" class="form-control p-2" name="phone" id="phone" placeholder="No Handphone" required>
                                  </div>
                                  <div class="col-md-12 mt-3">
                                    <input type="text" class="form-control p-2" name="email" id="email" placeholder="Email Adress" required>
                                  </div>
                                  <div class="col-md-12 mt-3">
                                    <textarea class="form-control" name="pesan" id="pesan" rows="5" placeholder="Pesan" required></textarea>
                                  </div> 
                                  <div class="text-center mt-4"><button class="btn btn-prev save-msg" type="submit">Send Message</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section> 
        <section id="contats-colaboration">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="row  card-colaboration">
                            <div class="col-md-8 d-flex  align-items-center justify-content-center">
                                <h4 class="text-white fw-bold title">
                                    Tertarik Kerjasama Bersama Kami ?
                                </h4>
                            </div>
                            <div class="col-md-4 d-flex  align-items-center justify-content-center">
                                <a class="contact p-2 text-center whatsapp-contact">Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </main>

    @include('front.partial.footer',["service"=>$service])
  <!-- End Footer --> 

        {{-- <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> --}}
    
 
  <script>
    
    new Swiper('.clients-slider', {
        speed: 400,
        loop: true,
        autoplay: {
        delay: 5000,
        disableOnInteraction: false
        },
        slidesPerView: 'auto',
        // pagination: {
        //   el: '.swiper-pagination',
        //   type: 'bullets',
        //   clickable: true
        // },
        breakpoints: {
                360:{
                slidesPerView: 2,
                spaceBetween: 30,
                },
                640: {
                    slidesPerView:2, 
                },
                768: {
                    slidesPerView: 5,
                    spaceBetween: 4,
                },
                1024: {
                    slidesPerView: 7,
                    spaceBetween: 30,
                },
            }
    });
    
    new Swiper('.team-slider', {
        speed: 600,
        loop: true,
        autoplay: {
        delay: 5000,
        disableOnInteraction: false
        },
        slidesPerView: 'auto',
        pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
        },
        navigation: {
        nextEl: '.swiper-next',
        prevEl: '.swiper-prev',
        },
        breakpoints: {
            360:{
                slidesPerView: 2
            },
            640: {
                slidesPerView:2, 
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 4,
            },
            1024: {
                slidesPerView: 6,
                spaceBetween: 30,
            },
        }
    });
  </script> 
  <script>
    $(document).ready(function(){
      $('.save-msg').click(function(e){
        e.preventDefault();
        let $this = $(this); 
          // $this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disabled', true);
          let data = {};
          let $form =  $this.closest('form');
          $form.ug("submit", function(result){
              let r = JSON.parse(result); 
              $this.html('Send Message').attr('disabled', false);
              // check validation
              $form.ug("validateForm",r.errors); 
              if(r.status){
                ug.alert(r.msg);
                $form[0].reset();
              }
          })
      });
    })
  </script>
</body>
</html>