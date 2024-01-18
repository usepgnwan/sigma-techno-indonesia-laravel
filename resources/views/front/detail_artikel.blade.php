<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  <meta name="base-route" content="{{ url('') }}">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Detail Artikel</title> 
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
      <main id="main"> 
        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs d-flex align-items-center bg-detail-artikel" style="background-image: url('assets/img/breadcrumbs-bg.jpg');">
          <div class="container position-relative d-flex flex-column align-items-center" > 
            <h2>Details Artikel </h2> 
          </div>
        </div><!-- End Breadcrumbs --> 
        <!-- ======= Blog Details Section ======= -->
        <section id="blog" class="blog">
          <div class="container" > 
            <div class="col-md-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('front.artikel')}}">Artikel</a></li>
                <li class="breadcrumb-item active">Detail</li>
              </ol>
            </div>
            <div class="row g-5">
              <div class="col-lg-8">
    
                <article class="blog-details">
    
                  <div class="post-img">
                    @if(!is_null($check->foto))
                    <img src="{{$check->foto ?? ""}}" alt="" class="img-fluid">
                    @endif
                  </div>
    
                  <h2 class="title">{{$check->title}}</h2>
    
                  <div class="meta-top">
                    <ul> 
                      <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2020-01-01"> {{ \Carbon\Carbon::parse($check->created_at)->diffForHumans() }} </time></a></li> 
                    </ul>
                  </div><!-- End meta top -->
    
                  <div class="content" style="overflow: auto">
                     {!! $check->body !!}
                  </div><!-- End post content -->
    
                  <div class="meta-bottom">
                    <i class="bi bi-folder"></i>
                    <ul class="cats">
                      <li><a href="#">{{$check->category->description}}</a></li>
                    </ul>
    
                    {{-- <i class="bi bi-tags"></i>
                    <ul class="tags">
                      <li><a href="#">Creative</a></li>
                      <li><a href="#">Tips</a></li>
                      <li><a href="#">Marketing</a></li>
                    </ul> --}}
                  </div><!-- End meta bottom -->
    
                </article><!-- End blog post --> 
    
              </div>
    
              <div class="col-lg-4">
                <div class="post-author text-center mb-3">
                   
                    <img  class="artikel-logo" src="" alt="">
              
                    <h4 class="artikel-name"></h4>
                    <div class="social-links d-none">
                      <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                      <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                      <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                    </div>
                    
                </div>
                <!-- End post author -->
                <div class="sidebar"> 
                  <div class="sidebar-item categories">
                    <h3 class="sidebar-title">Kategori</h3>
                    <ul class="mt-3">
                      @foreach ($category as $item)
                      <li><a href="{{route('front.artikel')}}?category={{$item['id']}}">{{$item->description}} </a></li> 
                      @endforeach
                    </ul>
                  </div><!-- End sidebar categories-->
    
                  <div class="sidebar-item recent-posts">
                    <h3 class="sidebar-title">Artikel Berkaitan</h3> 
                    <div class="mt-3"> 

                     @foreach ($random as $item)
                      <div class="post-item mt-3">
                        <img src="{{$item->foto}}" alt="no image" width="150" height="80">
                        <div>
                          <h4><a href="{{ route('front.artikel.detail', ['slug'=> $item->slug ])}}">{{$item->title}}</a></h4>
                          <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</time>
                        </div>
                      </div><!-- End recent post item-->
    
                     @endforeach
                    </div>
    
                  </div><!-- End sidebar recent posts--> 
                </div><!-- End Blog Sidebar -->
    
              </div>
            </div>
    
          </div>
        </section><!-- End Blog Details Section -->
    
      </main><!-- End #main -->

      

      
      @include('front.partial.footer',["service"=>$service])
  <!-- End Footer -->
        {{-- <a href="#" class="whatsapp-floating d-flex align-items-center justify-content-center"><i class="bi bi-whatsapp"></i></a> --}}
              
        {{-- <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> --}}
        {{-- <div id="preloader"></div> --}}
 
 
     
</body>
</html>