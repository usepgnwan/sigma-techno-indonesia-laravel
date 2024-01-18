<!DOCTYPE html>
<html>
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"> 
<head>
    <title>{{ $title }}</title>
</head>

<body>
    <main>
        <div class="container"> 
          <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>404</h1>
            <h2>{{ $error }}</h2> 
            <a class="btn" href="/">Back to home</a> 
          </section> 
        </div>
      </main><!-- End #main --> 
</body> 
</html>
