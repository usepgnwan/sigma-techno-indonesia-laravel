<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  <meta name="base-route" content="{{ url('') }}">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Artikel</title> 
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
        <div class="hero-img hero-tentang bg-detail-artikel" >
            <div class="info d-flex align-items-center">
                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                      <h2 data-aos="fade-down">Artikel</h2>
                      <h3 class="text-white text-title-page">  </h3>
                      <!-- <a data-aos="fade-up" data-aos-delay="200" href="#get-started" class="btn-get-started">Get Started</a> -->
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </section>
      <main id="main">
        <section id="artikel">
           <div class="container">
               <div class="row">
                 <div class="col-md-12 text-end mb-5">
                   <div class="btn-group" role="group" aria-label="Basic outlined example">
                     <button class="btn btn-outline-secondary" style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">Kategori : </button>
                     <select  class="form-input btn btn-outline-secondary select-category" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;max-width: 100px;"> 
                        <option value="0">-ALl-</option>
                        @foreach ($category as $item) 
                        <option value="{{ $item->id }}"  @if(!is_null($id_category) && $id_category == $item['id']) selected @endif>{{ $item->description }}</option> 
                        @endforeach 
                     </select> 
                   </div>
                 </div>
                 
                    <div class="col-md-12">
                      <div class="row loading-content page-content">
                        
                      </div>
                    </div>
                   <div class="col-md-12 text-center">
                        <div class="loading-text d-none">
                          <span class="spinner-border spinner-border-lg" role="status" aria-hidden="true"></span>
                        </div>
                       <button class="btn btn-prev btn-load-more d-none" data-page="" data-status="">Load more</button>
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
 
 
     
      <script>
        $('.select-category').change(function(){
          let id = $(this).val();
          let url = "{{route('front.content.artikel')}}";
          url += '?category=' + id;
          url += '&status=' + true;
          $('.page-content').html('').addClass('loading-content')
          getdata(url)
        });

        $('.select-category').trigger('change');

        $('.btn-load-more').click(function(){
          let $this = $(this);
          let category = $('.select-category').val();
          let page = $this.data('page');
          let status = $this.data('status');
          let url = "{{route('front.content.artikel')}}";
          url += '?category=' + category;
          url += '&page=' + page;
          url += '&status=' + status;
          getdata(url, "click");
        });

        function getdata(url, type ="change"){
          if(type == "click"){
            $('.btn-load-more').addClass('d-none');
            $('.loading-text').removeClass('d-none');
          }
          ug.action('GET', url ,{}, function(r){
            $('.btn-load-more').removeClass('d-none');
            $('.loading-text').addClass('d-none');
            $('.btn-load-more').html('Lihat lebih Banyak');
            $('.page-content').removeClass('loading-content')
            if(type == "click"){
              $('.page-content').append(r.view);
            }else{
              $('.page-content').html(r.view);
            }
            
            if(r.data.data.length > 0){
               if(r.data.to == r.data.total){
                console.log('dd')
                $('.btn-load-more').data('status', 0);
                $('.btn-load-more').addClass('d-none');
               }else{
                $('.btn-load-more').data('status', 1);
                $('.btn-load-more').removeClass('d-none')
               }
            }else{
              $('.btn-load-more').addClass('d-none');
            }
            $('.btn-load-more').data('page', r.data.current_page + 1);
          }, "json");
        }
      </script>
</body>
</html>