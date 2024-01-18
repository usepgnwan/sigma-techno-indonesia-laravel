<li class="nav-item">
  <a class="nav-link spa-link" href="{{ url('') }}/account/dashboard">
    <i class="bi bi-grid"></i>
    <span>Dashboard</span>
  </a>
</li>
<li class="nav-item ">
  <a class="nav-link multi-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
    <li>
      <a class="spa-link" href="{{ url('') }}/account/category">
        <i class="bi bi-circle"></i><span>Kategori</span>
      </a>
    </li> 
    <li>
      <a class="spa-link" href="{{ url('') }}/account/team">
        <i class="bi bi-circle"></i><span>Team</span>
      </a>
    </li> 
    <li>
      <a class="spa-link" href="{{ route('faq') }}">
        <i class="bi bi-circle"></i><span>Faq</span>
      </a>
    </li> 
    <li>
      <a class="spa-link" href="{{ route('supplier') }}">
        <i class="bi bi-circle"></i><span>Supplier</span>
      </a>
    </li> 
    <li>
      <a class="spa-link" href="{{ route('project') }}">
        <i class="bi bi-circle"></i><span>Project</span>
      </a>
    </li> 
    <li>
      <a class="spa-link" href="{{ route('service') }}">
        <i class="bi bi-circle"></i><span>Service</span>
      </a>
    </li> 
    <li>
      <a class="spa-link" href="{{ route('slider') }}">
        <i class="bi bi-circle"></i><span>Slide Content</span>
      </a>
    </li> 
    <li>
      <a class="spa-link" href="{{ route('artikel')}}">
        <i class="bi bi-circle"></i><span>Artikel</span>
      </a>
    </li> 
    <li>
      <a class="spa-link" href="{{ route('message')}}">
        <i class="bi bi-circle"></i><span>Pesan</span>
      </a>
    </li> 
  </ul>
</li>
<li class="nav-item">
  <a class="nav-link spa-link" href="{{ url('') }}/account/profile">
    <i class="bi bi-person"></i>
    <span>Profile</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link spa-link" href="{{ route('resume') }}">
    <i class="bi bi-person"></i>
    <span>Resume</span>
  </a>
</li>
<!-- End Dashboard Nav -->
 