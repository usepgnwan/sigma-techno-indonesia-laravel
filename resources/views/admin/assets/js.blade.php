
  <!-- Vendor JS Files -->
  <script>
    let ROOTSITE = "{{ url('')}}"
  </script>
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script> 
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script> --}}
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.min.js')   }}"></script>
  {{-- <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script> --}}
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script> --}}
  <script src="{{ asset('assets/vendor/datatables/table/datatables.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/bootstrap-dialog/js/bootstrap-dialog.js')}}"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  {{-- <script src="https://cdn.jsdelivr.net/gh/GedMarc/bootstrap4-dialog/dist/js/bootstrap-dialog.js"></script> --}}
  <!-- Template Main JS File -->
  <script src="{{ asset('assets/vendor/toastr/toastr.js')}}"></script>
  <script src="{{ asset('assets/front/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/ug.js') }}"></script>
  <script src="{{ asset('assets/js/spa.js') }}"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
  <script> 
    $(document).ready(function(){
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
    });
    $('.sign-out').click(function(e){
      e.preventDefault();
      ug.action('POST', "{{ route('logout') }}",{}, function(res){
        let r = JSON.parse(res);
        if(r.status){ 
          window.location.href = "{{ route('login') }}";
        }
      });
    });
    // ug.action("GET","{{ route('profile.show')}}", {}, function(r){
    //     $('.my-image').attr('src',r.data.image);
    //     $('.label-name').html(r.data.name); 
    //     $('link[name="icon"]').attr('href', r.data.image)
    // }, "json");
    $('.my-profile').click(function(e){
      e.preventDefault();
      $.MyModal("{{route('user.modal')}}", {},{
            title: 'Change Profile',
            closable: false,
            buttons: [{
                label: 'Close', 
                action: function(dialogItself){
                    dialogItself.close();
                }
            }, {
                label: 'Save', 
                cssClass: 'btn-primary',
                action: function(dialogItself){
                    const $form = dialogItself.getModalBody().find('form'); 
                    let $footer = dialogItself.getModalFooter().find('.btn-primary');
                    $footer.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'); 
                    $form.ug("submit", function(r){
                      $footer.html('Save');
                        // check validation
                        $form.ug("validateForm",r.data); 
                        if(r.status){
                            ug.alert(r.msg);
                            dialogItself.close();
                        }
                    },"json");
                }
            }]
      });
    }); 
</script>

<script>
  ug.action('GET', "{{route('limit.message')}}" ,{}, function(res){
      $("[name='artikel']").html('') 
      let r = JSON.parse(res);
      $('.notif-count').html(r.count)
      $('.badge-count-limit').html(r.count)
      let $opt = '';
      $.each(r.limit, function(i,v){  
      $opt += `
            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>${ v.name }</h4> 
              </div>
            </li>`;
      });
      $('.notif-all-list').html($opt);
  }), "json";
</script>