<div class="pagetitle">
    <h1>{{ $title }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">{{ $title }}</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
<section class="section profile">
    <div class="row">
      <div class="col-xl-4"> 
        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{ $data['logo'] }}" alt="Profile" class="img-logo">
            <h2 class="profile-name text-center">{{ $data['name'] }}</h2> 
            <div class="social-links mt-2">
              <a href="{{ $data['twitter'] }}" class="href-twitter"><i class="bi bi-twitter"></i></a>
              <a href="{{ $data['fb'] }}" class="href-fb"><i class="bi bi-facebook"></i></a>
              <a href="{{ $data['ig'] }}" class="href-ig"><i class="bi bi-instagram"></i></a>
              <a href="{{ $data['linkedin'] }}" class="href-linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

              <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="false" role="tab" tabindex="-1">Overview</button>
              </li>

              <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="true" role="tab">Edit Profile</button>
              </li>

              <li class="nav-item " role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-about" aria-selected="false" role="tab" tabindex="-1">About</button>
              </li>

              <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" aria-selected="false" role="tab" tabindex="-1">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade profile-overview" id="profile-overview" role="tabpanel">
                <h5 class="card-title">Description</h5>
                <p class="small fst-italic label-description">{{ $data['description'] }}</p>

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Company</div>
                  <div class="col-lg-9 col-md-8 label-name">{{ $data['name'] }}</div>
                </div> 

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8 label-address">{{ $data['address'] }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8 label-phone">{{ $data['phone'] }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8 label-email">{{ $data['email'] }}</div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3 active show" id="profile-edit" role="tabpanel">

                <!-- Profile Edit Form -->
                <form enctype="multipart/form-data" action="{{ route('profile.post')}}" class="submit">
                  @method('POST')
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="{{ $data['logo'] }}" alt="Profile" class="img-image1 glightbox">
                      <div class="pt-2">
                        <input type="file" class="form-control" name="image">
                      </div>
                    </div>
                  </div> 
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Cover Tentang</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="{{ $data['cover_about'] }}" alt="Profile" class="img-image2 glightbox">
                      <div class="pt-2">
                        <input type="file" class="form-control" name="cover_about">
                      </div>
                    </div>
                  </div> 
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Cover Artikel</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="{{ $data['cover_artikel'] }}" alt="Profile" class="img-image3 glightbox">
                      <div class="pt-2">
                        <input type="file" class="form-control" name="cover_artikel">
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="name" value="{{ $data['name'] }}">
                    </div>
                  </div> 
                  <div class="row mb-3">
                    <label for="description" class="col-md-4 col-lg-3 col-form-label">About</label>
                    <div class="col-md-8 col-lg-9">
                        <textarea name="description" class="form-control" id="description" style="height: 100px">{{ $data['description'] }}</textarea>
                    </div>
                  </div>   
                  <div class="row mb-3">
                    <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                        <textarea name="alamat" class="form-control" id="alamat" style="height: 100px">{{ $data['address'] }}</textarea>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="email" value="{{ $data['email'] }}" required>
                    
                    </div>
                  </div>
                   
                  <div class="row mb-3">
                    <label for="wa" class="col-md-4 col-lg-3 col-form-label">No Telp / Wa</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="number" class="form-control" id="phone" value="{{ $data['phone'] }}" required>
                    </div>
                  </div> 
                  <div class="row mb-3">
                    <label for="wa" class="col-md-4 col-lg-3 col-form-label">Instagram</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="ig" type="text" class="form-control" id="ig" value="{{ $data['ig'] }}" required>
                    </div>
                  </div> 
                  <div class="row mb-3">
                    <label for="wa" class="col-md-4 col-lg-3 col-form-label">Twitter</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="twitter" type="text" class="form-control" id="twitter" value="{{ $data['twitter'] }}" required>
                    </div>
                  </div> 
                  <div class="row mb-3">
                    <label for="wa" class="col-md-4 col-lg-3 col-form-label">Facebook</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="fb" type="text" class="form-control" id="fb" value="{{ $data['fb'] }}" required>
                    </div>
                  </div> 
                  <div class="row mb-3">
                    <label for="wa" class="col-md-4 col-lg-3 col-form-label">Linkedin</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="linkedin" type="text" class="form-control" id="linkedin" value="{{ $data['linkedin'] }}" required>
                    </div>
                  </div> 
                  <div class="row mb-3">
                    <label for="wa" class="col-md-4 col-lg-3 col-form-label">Content Depan</label>
                    <div class="col-md-8 col-lg-9">
                      <select name="content" id="" class="cst-select2">
                        <option value="">Pilih</option>
                        @foreach($artikel as $v)
                            <option value="{{ $v['id'] }}" @if(@isset($data['artikel_id']) && $v['id']  ==  $data['artikel_id'] ) selected @endif> {{ $v['title'] }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div> 
                  <hr>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary form-profile">Save</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>
 

              <div class="tab-pane fade pt-3 " id="profile-about" role="tabpanel">
                <form enctype="multipart/form-data" action="{{ route('about.post')}}" class="submit">
                  @method('POST')
                  <div class="row mb-3">
                    <label for="wa" class="col-md-4 col-lg-3 col-form-label">Content</label>
                    <div class="col-md-12 col-lg-12">
                      <textarea class="tinymce-editor" name="content">{{ $tentang['description'] ?? ""}}</textarea>
                    </div>
                  </div>  
                  <hr>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary form-about">Save</button>
                  </div>
                </form><!-- End Profile Edit Form -->
           
              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                <!-- Change Password Form -->
                <form action="{{ route('change.password') }}" class="submit">
                  @method('POST')
                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="old_password" type="password" class="form-control" id="old_password">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="new_password" type="password" class="form-control" id="new_password">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="repeat_password" type="password" class="form-control" id="repeat_password">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary change-password">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

  <script>
    $(".form-profile").click(function(e){
        e.preventDefault();
        let $this = $(this); 
        $this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disabled', true);
        let data = {};
        let $form =  $this.closest('form');
        $form.ug("submit", function(result){
            let r = JSON.parse(result); 
            $this.html('Save').attr('disabled', false);
            // check validation
            $form.ug("validateForm",r.errors); 
            if(r.status){
                ug.alert(r.msg);
                ug.addStore('account', r.data)
                $.each(r.data, function(i,v){
                  if($('.label-' + i).length){ 
                    $('.label-' + i).html(v);
                  }
                  if($('.img-' + i).length){ 
                    $('.img-' + i).attr('src', v);
                    $('.img-' + i +'1').attr('src', v);
                  }
                  if($('.profile-' + i).length){ 
                    $('.profile-' + i).html(v);
                  }
                  if($('.href-' + i).length){ 
                    $('.href-' + i).attr('href',v);
                  }
    
                });
            }else{
              ug.alert('masih ada yang kosong !','Warning', BootstrapDialog.TYPE_WARNING);
            }
        })
    });
    $(".form-about").click(function(e){
        e.preventDefault();
        let $this = $(this); 
        $this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disabled', true);
        let data = {};
        const editorContent = tinymce.activeEditor.getContent({format: "html"});
        $("textarea[name='content']").val(editorContent);
        let $form =  $this.closest('form');
        $form.ug("submit", function(result){
            let r = JSON.parse(result); 
            $this.html('Save').attr('disabled', false);
            // check validation
            $form.ug("validateForm",r.errors); 
            if(r.status){
                ug.alert(r.msg); 
            }else{
              ug.alert('masih ada yang kosong !','Warning', BootstrapDialog.TYPE_WARNING);
            }
        })
    });

    $('.change-password').click(function(e){
      e.preventDefault();
      let $this = $(this); 
        // $this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disabled', true);
        let data = {};
        let $form =  $this.closest('form');
        $form.ug("submit", function(result){
            let r = JSON.parse(result); 
            $this.html('Change Password').attr('disabled', false);
            // check validation
            $form.ug("validateForm",r.errors); 
            if(r.status){
              ug.alert(r.msg);
              $form[0].reset();
            }
        })
    });
   
  </script>