<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  <meta name="base-route" content="{{ url('') }}">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kontak</title> 
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
                      <h2 data-aos="fade-down">Kontak</h2>
                      <h3 class="text-white text-title-page">  </h3>
                      <!-- <a data-aos="fade-up" data-aos-delay="200" href="#get-started" class="btn-get-started">Get Started</a> -->
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </section>
      <main id="main"> 
 
        <!-- ======= Blog Details Section ======= -->
        <section id="blog" class="blog">
          <div class="container" > 
            <div class="col-md-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li> 
                <li class="breadcrumb-item active">Kontak</li>
              </ol>
            </div>
            <div class="row g-5">
              <div class="col-lg-6">
                <form action="{{route('kontak')}}" method="post" role="form" class="php-email-form"> 
                  <div class="form-group mt-3">
                    <input type="hidden" class="form-control p-2" name="id" id="id"   value="add">
                    <input type="text" class="form-control p-2" name="name" id="name" placeholder="Masukan Nama Anda" required>
                  </div>
                  <div class="form-group mt-3">
                    <input type="text" class="form-control p-2" name="phone" id="phone" placeholder="No Handphone" required>
                  </div>
                  <div class="form-group mt-3">
                    <input type="text" class="form-control p-2" name="email" id="email" placeholder="Email Adress" required>
                  </div>
                  <div class="form-group mt-3">
                    <textarea class="form-control" name="pesan" id="pesan" rows="5" placeholder="Pesan" required></textarea>
                  </div> 
                  <div class="text-center mt-4"><button class="btn btn-prev save-msg" type="submit">Send Message</button></div>
                </form>
      
              </div>
    
              <div class="col-lg-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.8969214461194!2d106.85047687478742!3d-6.5347006638825835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c15165c54ee1%3A0x4dfd7d2fd89dff53!2sPT%20SIGMA%20TECHNO%20INDONESIA!5e0!3m2!1sid!2sid!4v1703208521882!5m2!1sid!2sid" height="480" style="border:0; width: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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