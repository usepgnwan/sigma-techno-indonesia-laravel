(function($) {
     
    window.title = document.querySelector("title");
    let accountStore = ug.getStore('account');
    window.webname = accountStore.name ?? window.title.text
    var $ajaxMenuRequest = undefined;
    var pushstate = undefined; 
    let parent = $(".sidebar-nav-account").find("a.spa-link");
    // console.log(parent)
    // let a = $('.alink-click'); 
    // $.each(a,function(i,val){
    //     let v =$(val);
    //     v.removeClass('active');
    //     if(v.attr("href") == thisPath){
    //         if(v.closest("li.nav-item").find("a.multi-link") != undefined) {
    //         v.closest("li.nav-item").find("a.multi-link").removeClass("collapsed").attr("aria-expanded", true)
    //         v.closest("li.nav-item").find("ul.nav-content ").addClass("show")
    //         }
    //         v.addClass('router-link-exact-active');
    //     }
    // });
    let popurl =''
    if(ug.url_route !== ''){
        parent.each(function(i,$target){ 
            let Thisurl = $($target).attr('href');
            let pregurl =  Thisurl.replace(/#/g,"");
            if(ug.url_route == pregurl){
                popurl = Thisurl;
            }
        });
    }
    parent.click(function(e){
        e.preventDefault();
        if( $ajaxMenuRequest ){
            $ajaxMenuRequest.abort();
        }

        let $this = $(this);
        let href = $this.attr("href"); 
        let $url = popurl  != '' ? popurl : href;
        let $targetID = "main.content-page-first";
        let $target = $($targetID);

        let $loader = `<div class="row ml-2 mr-2 mt-5 d-flex">
                            <div class="col-md-12 text-center justify-content-center ">
                                <div class="spinner-border text-primary "> 
                                </div>
                            </div>
                        </div>`;
        $target.html($loader);

        let $urla = $url.replace(/#/g,"");
            // $urla = String($urla).includes('.html') ? String($urla).replace('.html','') : $urla;
        
        let $post = {};

        $ajaxMenuRequest = $.get($urla,$post, function (html) {
            $target.html('');
            $target.html(html);
        }).fail(function(e) { 
            // console.log(e);
            toastr["error"](`Something wrong! ${ e.statusText }`);
            let $error = `<div class="row ml-2 mr-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                        <!-- PAGE-CONTENT OPEN -->
                            <div class="page">
                                <div class="page-content error-page">
                                    <div class="container text-center">
                                        <div class="error-template">
                                            <h1 class="display-1  mb-2">${ e.status }<span class="text-muted fs-20">error</span></h1>
                                            <h5 class="error-details">
                                                Something wrong! ${ e.statusText }
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- PAGE-CONTENT OPEN CLOSED -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>`; 
            $target.html($error);
        });
        // console.log($urla + ' -- ' + window.location)
        if($urla!=window.location){
            var $pushStateID = $this.attr("pushState");
            if($pushStateID =="" || $pushStateID == undefined){
                var $time = new Date().getTime();
                $pushStateID = "a_" + $time;
                $this.attr("pushState",$pushStateID);
            }
            popurl = '';
            window.history.pushState({ path:$url,ytarget: $targetID,ypost:$post ,yevent:'click' ,ypushState:  $pushStateID  },'',$url); 
        }
        // console.log( parent);
        parent.removeClass("collapse").addClass("collapsed");
        parent.closest("li.nav-item").find("a.multi-link").removeClass("collapse").addClass("collapsed").attr("aria-expanded", false)
        parent.closest("li.nav-item").find("ul.nav-content ").removeClass("show");
        parent.removeClass("active");
        // $this.addClass("active");
        $.each(parent,function(i,val){
            let v =$(val);
            // console.log(v.closest("li.nav-item").find("a.multi-link"));
            // v.closest("li.nav-item").find("a.multi-link").addClass("collapsed").attr("aria-expanded", false);
            if(v.attr("href") == $url){
                if(v.closest("li.nav-item").find("a.multi-link").length > 0) {
                    v.closest("li.nav-item").find("a.multi-link").removeClass("collapsed").addClass("collapse").attr("aria-expanded", true)
                    v.closest("li.nav-item").find("ul.nav-content ").addClass("show")
                    
                    v.addClass('active');
                }else{
                    v.removeClass('collapsed').addClass('collapse');
                }
            }
        });
         $('html, body').animate({
             scrollTop:0 //$target.offset().top
         }, 500);
        window.title.text = $this.text().trim() + " | " + window.webname;
        return false;
    });

   let  check = String(window.location.href).includes('#') ? `${ ROOTSITE }/account/#${( String(window.location.href).split("#")[1] || "" )}` : window.location.href;
 
   var selectedMenu = $(`a.spa-link[href="${check}"]`).first();  
    if( selectedMenu.length ){
        selectedMenu.click();
    }else{
        parent.first().click(); 
    }

    $(window).on('popstate', function(event) { 
        let prev_location = window.location;
        $(`a.spa-link[href="${ prev_location }"]`).first().click();  
    });
    
    $('.copyright').html( "&copy; " + (accountStore.name ?? ''));
    $('.my-image').attr('src',accountStore.logo ?? '');
    $('.label-name').html(accountStore.name ?? ''); 
    $('link[name="icon"]').attr('href', accountStore.image ?? '') 
    $('link[name="icon"]').attr('href', accountStore.logo)
})(jQuery);