var ug = {};
// (function($) {

//     $.fn.extend({
//         myfunc : function(options) {
//             options = $.extend( {}, $.MyFunc.defaults, options );

//             this.each(function() {
//                 new $.MyFunc(this,options);
//             });
//             return this;
//         }
//     });

//     // ctl is the element, options is the set of defaults + user options
//     $.MyFunc = function( ctl, options ) {
//          ...your function.
//     };

//     // option defaults
//     $.MyFunc.defaults = {
//         ...hash of default settings...
//     };

// })(jQuery);


(function ($) {
	// "use strict";
	// var $yhsAjaxRequst = {};
	// if ($.browser == undefined) !function(a,b){"use strict";var c,d;if(a.uaMatch=function(a){a=a.toLowerCase();var b=/(opr)[\/]([\w.]+)/.exec(a)||/(chrome)[ \/]([\w.]+)/.exec(a)||/(version)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec(a)||/(webkit)[ \/]([\w.]+)/.exec(a)||/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(a)||/(msie) ([\w.]+)/.exec(a)||a.indexOf("trident")>=0&&/(rv)(?::| )([\w.]+)/.exec(a)||a.indexOf("compatible")<0&&/(mozilla)(?:.*? rv:([\w.]+)|)/.exec(a)||[],c=/(ipad)/.exec(a)||/(iphone)/.exec(a)||/(android)/.exec(a)||/(windows phone)/.exec(a)||/(win)/.exec(a)||/(mac)/.exec(a)||/(linux)/.exec(a)||[];return{browser:b[3]||b[1]||"",version:b[2]||"0",platform:c[0]||""}},c=a.uaMatch(b.navigator.userAgent),d={},c.browser&&(d[c.browser]=!0,d.version=c.version,d.versionNumber=parseInt(c.version)),c.platform&&(d[c.platform]=!0),(d.chrome||d.opr||d.safari)&&(d.webkit=!0),d.rv){var e="msie";c.browser=e,d[e]=!0}if(d.opr){var f="opera";c.browser=f,d[f]=!0}if(d.safari&&d.android){var g="android";c.browser=g,d[g]=!0}d.name=c.browser,d.platform=c.platform,a.browser=d}(jQuery,window);
	// if( typeof $.curCSS != "function" ) $.curCSS =  $.css;

    $.fn.extend({
        myfunc : function(options, arg1,arg2,arg3,arg4,arg5) {
            // if (options && typeof(options) == 'object') {
            //     options = $.extend( {}, MyFunc.defaults, options );
            // }
            options = $.extend( {}, $.MyFunc.defaults, options );
            this.each(function() {
                 new $.MyFunc(this, options, arg1,arg2,arg3,arg4,arg5 );
            });
            return this;
        }
    });
    $.MyFunc = function( ctl, options, arg1,arg2,arg3,arg4,arg5) {
       alert(ctl)
   };
})(jQuery);

;(function(ug) {
    ug.require	=  function ( $js ,$callback,$basePath){
                    var $n = 0;
                    for( var u=0;u < $js.length;u++ ){
                        
                        var script = document.createElement("script")
                        script.type = "text/javascript";
    
                        if (script.readyState){  //IE
                            script.onreadystatechange = function(){
                                if (script.readyState == "loaded" ||
                                        script.readyState == "complete"){
                                    script.onreadystatechange = null;
                                    $n++;
                                 if(typeof $callback == "function" && $n == $js.length  ) $callback();
                                }
                            };
                        } else {  //Others
                            script.onload = function(){
                                $n++;
                                if(typeof $callback == "function" && $n == $js.length ) $callback();
                            };
                        }
                        
                        if( $js[u].indexOf("http") == 0 || $js[u].indexOf("//")  == 0 ){
                            script.src =  $js[u] ;
                        }else{		
                            if ( typeof $basePath == "undefined" ){
                                script.src = "file/vendor/jquery/ug." + $js[u] + ".js";
                            }else{
                                script.src = $basePath  + $js[u] ;
                            }
                        }
                        
                        document.getElementsByTagName("head")[0].appendChild(script);
                    }
                };	
            })( ug || {});


// document.addEventListener("DOMNodeInserted", function(event) {
//     var $eTarget = $(event.target);
//     // console.log($eTarget)
//     if( $eTarget.hasClass("cst-select2")){
// 		$($eTarget).select2();
//         $eTarget.find("select#cst-select2.cst-select2").each(function(i,$target){
//             console.log($target);
//             $($target).select2();
//         });
// 	}
   
// });


// $(document).ready(function(){
     
     
//     function loaded(selector, callback) {
//         //trigger after page load.
//         jQuery(function () {
//             callback(jQuery(selector));
//         });
//         var parentSelector = "* > " + selector;
//         //trigger after page update eg ajax event or jquery insert.
//         jQuery(document).on('DOMNodeInsertedIntoDocument', parentSelector, function (e) {
//             callback(jQuery(this).find(selector));
//         });
//     }

//     loaded('.cst-select2', function(e){
//         $.each(e,function(i,v){ 
//             let n = "." + v.className;
//             $(v).data('live-search',true);
//             $(v).selectpicker();
//             $(v).selectpicker("refresh")
//         });  
//     });
   
// });

$('.content-page-first').on("DOMNodeInserted", function(event) {
        var $eTarget = $(event.target); 
        
        if( $eTarget.hasClass("content-page-first")){
            // $($eTarget).select2(); 
            // $($eTarget).select2({
            //     width: "100%"
            // });
            let html = $($eTarget).html(); 
            // find select2
            let select2 = $(html).find('select.cst-select2');
            if(select2){
                select2.each(function(i,$target){ 
                    let name = "." + $target.className;
                    $(name).select2({width:"100%"});
                }); 
                // theme:"bootstrap"

            }
            
            // find nestable menu
                var updateOutput = function () { 
                    let data = $('#nestable').nestable('serialize'); 
                    // console.log(data);
                    $('#output').val(JSON.stringify($('#nestable').nestable('serialize')));
                }; 

                $('#nestable').nestable().on('change', updateOutput);
            
                updateOutput();
            
                $("#add-item").submit(function (e) {
                    e.preventDefault();
                    id = Date.now();
                    var label = $("#add-item > [name='name']").val();
                    var url = $("#add-item > [name='url']").val();
                    if ((url == "") || (label == "")) return;
                    var item =
                        '<li class="dd-item dd3-item" data-id="' + id + '" data-label="' + label + '" data-url="' + url + '">' +
                        '<div class="dd-handle dd3-handle" > Drag</div>' +
                        '<div class="dd3-content"><span>' + label + '</span>' +
                        '<div class="item-edit">Edit</div>' +
                        '</div>' +
                        '<div class="item-settings d-none">' +
                        '<p><label for="">Navigation Label<br><input type="text" name="navigation_label" value="' + label + '"></label></p>' +
                        '<p><label for="">Navigation Url<br><input type="text" name="navigation_url" value="' + url + '"></label></p>' +
                        '<p><a class="item-delete" href="javascript:;">Remove</a> |' +
                        '<a class="item-close" href="javascript:;">Close</a></p>' +
                        '</div>' +
                        '</li>';
            
                    $("#nestable > .dd-list").append(item);
                    $("#nestable").find('.dd-empty').remove();
                    $("#add-item > [name='name']").val('');
                    $("#add-item > [name='url']").val('');
                    updateOutput();
                });
            
                $("body").delegate(".item-delete", "click", function (e) {
                    $(this).closest(".dd-item").remove();
                    updateOutput();
                });
            
                $("body").delegate(".is_access, .is_create, .is_edit, .is_delete", "click", function (e) { 
                    let nameClass = this.className; 
                    let item = $(this).prop("checked") ? 1 : 0;  
                    $(this).closest('.dd-item').data(nameClass,item); 
                });
            
                // $("body").delegate(".dd3-content>.item-edit, .item-close", "click", function (e) {
                //     alert('hhahahaha');
                //     var item_setting = $(this).closest(".dd-item").find(".item-settings");
                //     if (item_setting.hasClass("d-none")) {
                //         item_setting.removeClass("d-none");
                //     } else {
                //         item_setting.addClass("d-none");
                //     }
                // });
            
                $("body").delegate("input[name='navigation_label']", "change paste keyup", function (e) {
                    $(this).closest(".dd-item").data("label", $(this).val());
                    $(this).closest(".dd-item").find(".dd3-content span").text($(this).val());
                });
            
                $("body").delegate("input[name='navigation_url']", "change paste keyup", function (e) {
                    $(this).closest(".dd-item").data("url", $(this).val());
                });  
        } 
});