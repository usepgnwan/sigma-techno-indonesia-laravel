<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/sigma.png" alt="">
        
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="/" class="{{  "/" == $active ? "active":"" }}">Beranda</a></li>
          <li><a href="{{route('tentang')}}" class="{{ "tentang" == $active ? "active":"" }}">Tentang</a></li>
          <li><a href="{{route('front.artikel')}}" class="{{ "artikel" == $active ? "active":"" }}">Artikel </a></li> 
          <li><a href="{{route('front.team')}}" class="{{ "team" == $active ? "active":"" }}">Team</a></li> 
          <li><a href="{{route('kontak')}}" class="header-contact ms-4 me-4 {{ "kontak" == $active ? "active":"" }}">Kontak</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->