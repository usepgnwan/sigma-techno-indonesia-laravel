  
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-content position-relative">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <h3 class="title-name"></h3>
              <p class="body-description">
              </p><br><br> <br>
              <div class="social-links d-flex mt-3">
                <a href="#" class="d-flex align-items-center justify-content-center li-ig"><i class="bi bi-twitter"></i></a>
                <a href="#" class="d-flex align-items-center justify-content-center li-twitter"><i class="bi bi-facebook"></i></a>
                <a href="#" class="d-flex align-items-center justify-content-center li-fb"><i class="bi bi-instagram"></i></a>
                <a href="#" class="d-flex align-items-center justify-content-center li-linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div><!-- End footer info column-->

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Jasa Kami</h4>
            <ul>
              @foreach($service as $item)
              <li>
                @if(@isset($item->artikel->slug)) <a href="{{ route('front.artikel.detail', ['slug'=>$item->artikel->slug])}}"> @endif
                {{$item->description}}
                @if(@isset($item->artikel->slug)) </a> @endif
                </li> 
              @endforeach
            </ul>
          </div><!-- End footer links column-->

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Project Kami</h4>
            <ul>
              <li><a href="#">Project</a></li>
              <li><a href="{{route('front.team')}}">Tim</a></li>
              <li><a href="#">Service</a></li> 
            </ul>
          </div><!-- End footer links column-->

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Alamat Kami</h4>
            <p class="text-white account-address"> 
                
            </p>
          </div><!-- End footer links column-->

          <div class="col-lg-2 col-md-3 footer-links">
           
            <ul>
                <li>
                    <a href="#"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.44 12.9999C19.22 12.9999 18.99 12.9299 18.77 12.8799C18.3245 12.7817 17.8866 12.6514 17.46 12.4899C16.9961 12.3211 16.4861 12.3299 16.0283 12.5145C15.5704 12.6991 15.1971 13.0465 14.98 13.4899L14.76 13.9399C13.786 13.398 12.891 12.7251 12.1 11.9399C11.3147 11.1489 10.6418 10.2539 10.1 9.27987L10.52 8.99987C10.9633 8.78278 11.3108 8.4094 11.4954 7.95156C11.68 7.49372 11.6888 6.98378 11.52 6.51987C11.3612 6.09229 11.2309 5.65467 11.13 5.20987C11.08 4.98987 11.04 4.75987 11.01 4.52987C10.8885 3.82549 10.5196 3.18761 9.9696 2.73111C9.4196 2.2746 8.72467 2.02948 8.00998 2.03987H5.00998C4.57901 2.03582 4.15223 2.12468 3.75869 2.3004C3.36515 2.47612 3.01409 2.73456 2.72941 3.05815C2.44473 3.38174 2.23311 3.76286 2.10897 4.17558C1.98482 4.5883 1.95106 5.02293 2.00998 5.44987C2.54272 9.63925 4.45601 13.5317 7.44763 16.5125C10.4393 19.4933 14.3387 21.3924 18.53 21.9099H18.91C19.6474 21.9109 20.3594 21.6404 20.91 21.1499C21.2263 20.8669 21.4791 20.52 21.6514 20.1322C21.8238 19.7443 21.9119 19.3243 21.91 18.8999V15.8999C21.8977 15.2053 21.6448 14.5364 21.1943 14.0075C20.7439 13.4786 20.1238 13.1225 19.44 12.9999ZM19.94 18.9999C19.9398 19.1419 19.9094 19.2822 19.8508 19.4115C19.7921 19.5408 19.7066 19.6562 19.6 19.7499C19.4886 19.8469 19.358 19.9193 19.2167 19.9624C19.0754 20.0054 18.9266 20.0182 18.78 19.9999C15.0349 19.5197 11.5562 17.8064 8.89269 15.1302C6.22917 12.454 4.53239 8.96721 4.06998 5.21987C4.05406 5.07339 4.06801 4.9252 4.11098 4.78426C4.15395 4.64332 4.22505 4.51256 4.31998 4.39987C4.41369 4.2932 4.52904 4.20771 4.65836 4.14909C4.78767 4.09046 4.92799 4.06005 5.06998 4.05987H8.06998C8.30253 4.05469 8.5296 4.13075 8.71212 4.27494C8.89464 4.41913 9.02119 4.62244 9.06998 4.84987C9.10998 5.1232 9.15998 5.3932 9.21998 5.65987C9.3355 6.18701 9.48924 6.70505 9.67998 7.20987L8.27998 7.85987C8.16028 7.91479 8.0526 7.99281 7.96314 8.08946C7.87367 8.18611 7.80418 8.29948 7.75865 8.42306C7.71312 8.54664 7.69245 8.678 7.69783 8.80959C7.7032 8.94118 7.73452 9.07041 7.78998 9.18987C9.22918 12.2726 11.7072 14.7507 14.79 16.1899C15.0334 16.2899 15.3065 16.2899 15.55 16.1899C15.6747 16.1453 15.7893 16.0763 15.8871 15.9871C15.985 15.8978 16.0641 15.79 16.12 15.6699L16.74 14.2699C17.2569 14.4547 17.7846 14.6084 18.32 14.7299C18.5866 14.7899 18.8566 14.8399 19.13 14.8799C19.3574 14.9287 19.5607 15.0552 19.7049 15.2377C19.8491 15.4202 19.9252 15.6473 19.92 15.8799L19.94 18.9999Z" fill="white"/>
                    </svg>
                    <span class="account-phone"></span>
                    </a>
                </li> 
            </ul>
          </div><!-- End footer links column-->

        </div>
      </div>
    </div> 
  </footer>
  <a  class="whatsapp-floating d-flex align-items-center justify-content-center whatsapp-contact"><i class="bi bi-whatsapp"></i></a>
  <div id="preloader"></div>
  <script>
    $(document).ready(function(){
        // if(ug.getStore('account').length <= 0){
        //     getCompany();
        // }else{
        //     let account = ug.getStore('account'); 
        //     view(account)
        // } 
        getCompany();
        function getCompany(){ 
            ug.action("GET","{{ route('profile.show')}}", {}, function(r){ 
                // ug.addStore('account', r.data)
                view(r.data)
            }, "json");
        } 

        function view(data){ 
            
            $('.title-name').html(data.name)
            $('.artikel-logo').attr('src', data.logo)
            $('.artikel-name').html(data.name)
            $('.text-title-page').html(data.name)
            $('.body-description').html(data.description)
            $('.account-phone').html(data.phone)
            $('.account-address').html(data.address)
            $('a.logo').find('img').attr('src', data.logo)
            $('.bg-detail-artikel').css('background-image',  'url("'+data.cover_artikel+'")' )
            let ig = data.ig ? '' : 'd-none';
            let twitter = data.twitter ? '' : 'd-none';
            let fb = data.fb ? '' : 'd-none';
            let linkedin = data.linkedin ? '' : 'd-none';
            $('.li-ig').addClass(ig).attr('href', data.ig)
            $('.li-twitter').addClass(twitter).attr('href', data.twitter)
            $('.li-fb').addClass(fb).attr('href', data.fb)
            $('.li-linkedin').addClass(linkedin).attr('href', data.linkedin)
            $('.whatsapp-contact').attr('data-phone', data.phone)
          window.title = document.querySelector("title");
          window.title.text = window.title.text+ " | " + data.name ;
          $('link[name="icon"]').attr('href', data.logo)
          $('.hero-page-about').css('background-image',  'url("'+data.cover_about+'")' )
        }

        $('body').on('click','.whatsapp-contact',function(){
          let wa = $(this).data('phone')
           var walink = 'https://wa.me/?';
               walink = 'https://web.whatsapp.com/send',
              phone = wa,
              text = '%2AHallo PT SIGMA TECHNO INDONESIA%2A';
              /* Smartphone Support */
              if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                  var walink = 'whatsapp://send';
              }
              var checkout_whatsapp = walink + '?phone=62'+ phone + '&text=' + text;
              /* Whatsapp Window Open */
              window.open(checkout_whatsapp, '_blank');
        })
    })
  </script>