<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login - Ranger</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

<!-- Favicons -->
<link  name="icon" rel="icon"> 

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet"> 
<link href="{{ asset('assets/vendor/bootstrap-dialog/css/bootstrap-dialog.css') }}" rel="stylesheet">
<!-- Template Main CSS File -->
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/" class="logo d-flex align-items-center w-auto">
                  <img src="" class="my-image">
                  <span class="d-none d-lg-block label-name"></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  </div>
                  <form action="{{ route('auth.login') }}">
                    @method('POST')
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Email/Username</label>
                      <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-12 d-none">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12 mt-4">
                      <button class="btn btn-primary w-100 login" type="submit">Login</button>
                    </div>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
 
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script> 
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 
<script src="{{ asset('assets/vendor/bootstrap-dialog/js/bootstrap-dialog.js')}}"></script>
<script src="{{ asset('assets/front/js/ug.js') }}"></script>

<script>
  $(function(){ 
    if(ug.getStore('account').length <= 0){
      getCompany();
    }else{
      let account = ug.getStore('account');
      $('.my-image').attr('src',account.image);
      $('.label-name').html(account.name); 
      $('link[name="icon"]').attr('href', account.image);
    } 
    function getCompany(){ 
      ug.action("GET","{{ route('profile.show')}}", {}, function(r){
            $('.my-image').attr('src',r.data.image);
            $('.label-name').html(r.data.name); 
            $('link[name="icon"]').attr('href', r.data.image);
            ug.addStore('account', r.data)
      }, "json");
    }
 
    $(".login").click(function(e){
        e.preventDefault();
        let $this = $(this); 
        $this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disabled', true);
        let data = {};
        let $form =  $this.closest('form');
        $form.ug("submit", function(r){ 
            $this.html('Login').attr('disabled', false);
            // check validation
            $form.ug("validateForm",r.errors); 
            if(r.status != undefined && r.status == true){
              ug.alert(r.message);
              window.location.href = "{{ route('account') }}";
            }
        }, "json");
    });
  });
</script>
</body>
</html>