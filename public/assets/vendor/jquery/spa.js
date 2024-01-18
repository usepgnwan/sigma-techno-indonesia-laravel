(function($) {
     
    window.title = document.querySelector("title");
    window.webname = window.title.text;
    console.log(window);
    var $ajaxMenuRequest = undefined;
    var pushstate = undefined;
    const KEY_COLOR_MODE = "assignment-color-mode";
    let parent = $("#accordionSidebar").find("a.spa-link");
    parent.click(function(e){
        e.preventDefault();

        if( $ajaxMenuRequest ){
            $ajaxMenuRequest.abort();
        }

        let $this = $(this);
        
        let $url = $this.attr("href");
        let $targetID = "section.content-page-first";
        let $target = $($targetID);

        let $loader = `<div class="row ml-2 mr-2">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body loader-container">
                                    </div>
                                </div>
                            </div>
                        </div>`;
        $target.html($loader);


        let $urla =  $url.replace(/#/g,"");
            // $urla = String($urla).includes('.html') ? String($urla).replace('.html','') : $urla;
        // console.log($urla);
        let $post = {};

        $ajaxMenuRequest = $.get($urla,$post, function (html) {
            $target.html(html);
        }).fail(function(e) { 
            console.log(e);
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

        if($urla!=window.location){
            // console.log($urla + ' -- ' + window.location)
            var $pushStateID = $this.attr("pushState");
            if($pushStateID =="" || $pushStateID == undefined){
                var $time = new Date().getTime();
                $pushStateID = "a_" + $time;
                $this.attr("pushState",$pushStateID);
            }
            window.history.pushState({ path:$url,ytarget: $targetID,ypost:$post ,yevent:'click' ,ypushState:  $pushStateID  },'',$url); 
        }
        parent.removeClass("active");
        $this.addClass("active");
         $('html, body').animate({
             scrollTop:0 //$target.offset().top
         }, 500);
        window.title.text = $this.text().trim() + " | " + window.webname;
        return false;
    });

   let  check = String(window.location.href).includes('#') ? `${ ROOTSITE }/dashboard/#${( String(window.location.href).split("#")[1] || "" )}` : window.location.href; 
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
})(jQuery);