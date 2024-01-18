<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Login - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=The+Nautigal:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=The+Nautigal:wght@400;700&display=swap" rel="stylesheet">

   <!-- Vendor CSS Files -->
   <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet"> 
   <link href="{{ asset('assets/vendor/bootstrap-dialog/css/bootstrap-dialog.css') }}" rel="stylesheet">
</head>
<style>
  body{
    background-color: white !important;
  }
  .section-background{
    position: fixed;
    background:url('http://127.0.0.1:8000/uploads/image/sample.jpg');
    background-repeat: no-repeat;
     /* Full height */
    height: 100%;  
    width: 100%;
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover; 
  }
  .column-section-title{
    position: relative;
    width: 100%;
    height: 100%;
  }
  .conten-section-title{
    position: absolute; 
    width: 100%;
    height: 100%; 
    padding-top: 119px  ;
    flex-direction: column;
    justify-content: flex-end;
    align-items: center; 
  }
  .conten-section-title .title{ 
    text-shadow: 0px 4px 4px rgba(255, 255, 255, 0.25), 0px 4px 4px rgba(255, 255, 255, 0.25);
    font-family: "The Nautigal";
    font-size: 45px;
    font-style: normal;
    font-weight: 400;
    line-height: normal; 
    color: #ffffff;
  }
  .conten-section-title .description-title{ 
    color: #ffffff;
    text-align: center;
    font-family: "DM Serif Display";
    font-size: 64px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    letter-spacing: 17.92px;  
  }
  .conten-section-title .date-title {
    color: #ffffff;
    text-align: center;
    font-family: "DM Serif Display";
    font-size: 24px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    letter-spacing: 12px;  
  }
  #myVideo {
    position: fixed;
    right: 0;
    bottom: 0;
    min-width: 100%; 
    min-height: 100%;
    z-index: -999;
  }

 .section-background-vip {
  position: fixed;
  background: white;
  z-index: 999;
  height: 100%;  
  width: 100%;
 }
 .column-vip-section-title{
    position: relative;
    width: 100%;
    height: 100%;
  }
  .conten-vip-section-title{
    position: absolute; 
    width: 100%;
    height: 100%;  
    flex-direction: column;
    justify-content: flex-end;
    align-items: center; 
  }
  .conten-vip-footer{
    position: absolute; 
    bottom: 0px;
    width: 100%;
    border-top: 1px solid aliceblue; 
    padding: 15px;
    color: #ffffff; 
    text-align: center;
    font-family: "DM Serif Display";
    font-size: 36px;
    font-style: normal;
    font-weight: 400; 
    height: 84px; 
    line-height: normal; 
    background: #000; 
  }
 .section-background-vip .title{ 
    text-shadow: 0px 4px 4px rgba(255, 255, 255, 0.25), 0px 4px 4px rgba(255, 255, 255, 0.25);
    font-family: "The Nautigal";
    font-size: 45px;
    font-style: normal;
    font-weight: 400;
    line-height: normal; 
    color: #000000;
  }
  .section-background-vip .description-title{ 
    color:  #000000;
    text-align: center;
    font-family: "DM Serif Display";
    font-size: 44px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    letter-spacing: 17.92px;  
  }
  .section-background-vip .date-title {
    color:  #000000;
    text-align: center;
    font-family: "DM Serif Display";
    font-size: 24px;
    font-style: normal;
    font-weight: 400;
    line-height: normal; 
  }
</style>
<body> 
  <main> 
    <section class="section-background"> 
      <div class="column-section-title">
        <div class="conten-section-title">
          <!-- section video -->
          <video autoplay muted loop id="myVideo">
            <source src="assets/img//player.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
          </video>
          <div class=" min-vh-100 d-flex flex-column align-items-center justify-content-center  "> 
            <div class="row ">
              <div class="col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center">  
                <h3 class="d-lg-block title"><b>The Wedding Of</b></h3>
                <h3 class="description-title">DADAN & TETY</h3> 
                <h3 class="date-title">20 . 12 . 2023</h3> 
              </div> 
            </div>   
          </div>
        </div>
      </div>
    </section> 
    <!-- section vip tamu -->
    <section class="section-background-vip"> 
      <div class="column-vip-section-title">
        <div class="conten-vip-section-title"> 
          <div class=" min-vh-100 d-flex flex-column align-items-center justify-content-center  "> 
            <div class="row ">
              <div class="col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center">  
                <h3 class="d-lg-block title"><b>Selamat datang</b></h3>
                <h3 class="description-title">DADAN & TETY</h3> 
                <h3 class="date-title"> 
                  dari :
                </h3> 
                <h3 class="date-title pt-3"> 
                  <span class="pt-3"> PT CINTA ABADI</span> 
                </h3> 
              </div> 
            </div>   
          </div>
        </div> 
      </div>
      <div class="conten-vip-footer text-center">
        TAMU VIP
      </div>
    </section> 
  </main><!-- End #main --> 
  <!-- Vendor JS Files --> 
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 

  <!-- Template Main JS File -->
  <!-- <script src="assets/js/main.js"></script> -->

</body>

</html>