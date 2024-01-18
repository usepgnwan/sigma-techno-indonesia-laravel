var ug = {}; 
;(function(ug) {
    ug.csrftoken = $('meta[name="csrf-token"]').attr('content')
    ug.url_route = $('meta[name="url-route"]').attr('content')
    ug.base_route = $('meta[name="base-route"]').attr('content')
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
    // ECHART FUNCTION
    ug.echarts = function(selector, options){
        echarts.init($(selector)[0]).setOption(options);
    };

    ug.apexchart = function(selector, options){
        new ApexCharts($(selector)[0],options).render();
    };
    ug.alert = function(msg, title='', type=''){ 
        BootstrapDialog.show({
            title : title.length > 0 ? title : 'Information',
            message: msg,
            type: type.length > 0 ?  type :  BootstrapDialog.TYPE_PRIMARY,
        });
    };
    ug.tes = function(msg){ 
        console.log(msg)
    };
    ug.post = function(url, data = {}, func=false,$dataType, $opt, $type){
        if( typeof data != 'object'){
            ug.alert('error data')
            return data;
        } 
        var $option = {
            headers: {
                'X-CSRF-Token': ug.csrftoken 
            },
            url: url,
            type: ( $type == undefined  || $type == 'undefined' ? "POST" : $type ),
            data: data,
            cache: false,
            dataType: ( $dataType == undefined || $dataType == 'undefined' ? "text" : $dataType ),
            };
            $.extend(true,$option, $opt || {} );
        var request = $.ajax( $option );
            request.done(function( resp ) {
                if(func == undefined){
                    ug.alert(resp);
                }else{ 
                    if(typeof func == 'function'){
                        func(resp);
                        return;
                    }
                    console.log(func);  
                    return resp;
                } 
            });
            request.fail(function( jqXHR, textStatus ) {
                if( jqXHR.status == 0 ) return false;
                if(  typeof $option["errorCallback"] == 'function' ){
                    $option["errorCallback"](jqXHR.responseText);
                }else{
                    $msg = JSON.stringify(jqXHR); 
                    ug.alert("ERROR CODE : " + jqXHR.status + ":::" + jqXHR.statusText);
                    if( $dataType == 'json') {
                        let obj = JSON.parse(jqXHR.responseText);
                        func(obj);
                        return;
                    }
                    func('error');
                }
            }); 
    };
    ug.serializeObject = function(idForm){
        var $form = $(idForm);
        var result = {};
        if( $form.attr("enctype") ==  "multipart/form-data" ) {
            result = new FormData( $form[0] );  
            return result;
        }
        var extend = function (i, element) {
            var value = element.value;
            var node = result[element.name];
            if ('undefined' !== typeof node && node !== null) {
                if ($.isArray(node)) {
                    node.push(value);
                } else {
                    result[element.name] = [node, value];
                }
            } else {
                result[element.name] = value;
            }
        };
        
        $.each($form.serializeArray(), extend); 
        return result;
    };
    ug.action =  function(type,url, data = {}, func,$dataType, $opt){ 
        ug.post(url, data = {}, func,$dataType, $opt, type);
    }

    // add local storage 
    ug.checkStore = function(){
        return typeof(Storage) !== "undefined";
    }
    ug.addStore = function(cache_key,data){
        if (ug.checkStore()) {
            // let historyData = null;
            // if (localStorage.getItem(cache_key) === null) {
            //     historyData = [];
            // } else {
            //     historyData = JSON.parse(localStorage.getItem(cache_key));
            // }
    
            // historyData.unshift(data); // tambahkan komen
            // if (historyData.length > 6) {
            //     historyData.pop(); //batasi
            // }
    
            localStorage.setItem(cache_key, JSON.stringify(data));
        }
    }
    ug.getStore = function(CACHE_KEY) {
        if (ug.checkStore()) {
            return JSON.parse(localStorage.getItem(CACHE_KEY)) || [];
        } else {
            return [];
        }
    } 
    ug.deleteStore =  function (CACHE_KEY) {
        const hapus = confirm('yakin hapus komenya?');
        if (hapus) { 
            localStorage.removeItem(CACHE_KEY);
            alert('berhasil dihapus !');
        }
    }
    ug.encrypt64 = function (key){
        return btoa(key);
    }
    ug.decrypt64 = function (key){
        return atob(key);
    }
    ug.validate  =function($form, data){
        $.each($form,function(i,v){
            let $value = $(v);
            let name = $value.attr('name');
            if((data[name] != undefined && $value.attr('type') != 'hidden' )){
                $value.addClass('is-invalid');
                let invalid = $value.closest('div').find('.invalid-feedback');
                if(invalid.length <= 0){
                    $value.after(`  
                                <div class="invalid-feedback">
                                    ${ data[name][0] }
                                </div>`);
                }else{
                    invalid.html(` ${ data[name][0] }`);
                }
            }else{
                if( $value.attr('type') != 'hidden' ){
                    if($value.hasClass('cst-select2')){
                        $value.removeClass('is-invalid');
                        $value.closest('div').find('.invalid-feedback').remove();
                    }else{
                        $value.removeClass('is-invalid').next().remove();
                    }
                }
            }
        });
    }
})( ug || {});


(function ($) {
	"use strict";
    $.fn.extend({
        confirm : function(options, arg1,arg2,arg3,arg4,arg5) { 
            this.each(function() {
                 new $.confirm(this, options, arg1,arg2,arg3,arg4,arg5 );
            });
            return this;
        },
        MyModal : function($url, $data, $opt){
            new $.MyModal(this, $url, $data, $opt);
            return this;
        },
        ug: function(options, arg, arg1, arg2,arg3, arg4 ){
            if (options && typeof(options) == 'object') {
                options = $.extend( {}, ug.defaults, options );
            }
            this.each(function() {
                new ug.external(this,options, arg, arg1, arg2,arg3, arg4 );
            });
            return this;
        }
    });
    
    $.confirm = function( ctl='', options, arg1,arg2,arg3,arg4,arg5) {
        BootstrapDialog.confirm({
            title: 'WARNING!!',
            message: ctl, 
            type: BootstrapDialog.TYPE_DANGER,
            btnOKLabel: arg1 ?? 'Delete',
            btnOKClass: 'btn-danger',
            callback :  options
        });
    };
    $.MyModal = function( url, datapost, $opt) {
        if( datapost == undefined ) datapost = {};
	    var $option = {
					message: function(dialogRef){
						var $div =   $(`<div class="row ml-2 mr-2 mt-5 d-flex">
                                            <div class="col-md-12 text-center justify-content-center ">
                                                <div class="spinner-border text-primary "> 
                                                </div>
                                            </div>
                                        </div>`);
						return $div;
					},
					onshown: function(dialogRef){
						var $button = dialogRef.getModalHeader().find(".bootstrap-dialog-close-button");
                        $button.css({ 'display' : 'inline-block' }); 
						// $button.on('click', { dialogRef: dialogRef }, function(event){
						// 	event.data.dialogRef.close();
						// });

                        var $container = dialogRef.getModalBody().find("> .bootstrap-dialog-body > .bootstrap-dialog-message");

                        ug.post(url,datapost,function(resp){
                            $container.html(resp);
                        },"text",{}, "GET");
					},
					closable: true,
					hideHeader: false,
					hideFooter: false,
				};
	$.extend(true,$option, $opt || {} );
	
	var dialog = new BootstrapDialog( $option );
		
        dialog.realize();
          //dialog.getModalBody().css('padding', 1);
		var $modal = dialog.getModalDialog();
		if( $option.width != undefined )  	$modal.css({ 'width' : $option.width });
		if( $option.height != undefined )   $modal.css({ 'height' : $option.height });
		if( $option.hideHeader )  dialog.getModalHeader().hide();
        if( $option.hideFooter )  dialog.getModalFooter().hide();
        dialog.open();
		return dialog;
    };
    
    ug.external =  function( elem, opt, opt1,opt2,opt3,opt4) { 
        let thisMethod = {
            submit : function(form, nameindex, func,datataype,dataTambahan={}){
                let $form  = $(form);
                if($form.attr("enctype") ==  "multipart/form-data" ) {
                    dataTambahan = {
                        processData : false,
                        contentType : false
                    };
                }

                if( typeof $form.attr('action') == 'undefined'){ 
                    ug.alert('Error action not found!');
                    return;
                }
                let url = $form.attr('action'); 
                let $post = ug.serializeObject(elem);
                let resp =  ug.post(url,$post,function(resp){
                    return func(resp)
                },datataype,dataTambahan);
                // return func(resp);
            },
            validateForm : function(form, nameindex, data){ 
                let $form = $(form).find('.form-control');
                let $formSelect = $(form).find('.form-select'); 
                let $formSelect2 = $(form).find('.cst-select2');

                if($form.length > 0){
                    ug.validate( $form , data) 
                }
                if($formSelect.length > 0){
                    ug.validate( $formSelect , data) 
                }
                if($formSelect2.length > 0){
                    ug.validate( $formSelect2 , data) 
                }
               
            }
        };
 
		if (thisMethod[opt]) {
            return  thisMethod[opt].call("",elem, opt, opt1, opt2,opt3,opt4);
        } else {
            console.log("Tidak menemukan method "+elem);
        }
    }
})(jQuery);

$('body').on("DOMNodeInserted", function(event) {
    var $eTarget = $(event.target); 

     
        /**
         * Initiate tooltips
         */
        // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        // var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        //     return new bootstrap.Tooltip(tooltipTriggerEl)
        // })
        if($eTarget.find('[data-bs-toggle="tooltip"]').length >= 1){
           let tooltip = $eTarget.find('[data-bs-toggle="tooltip"]');
           $.each(tooltip,function(i,v){
                return new bootstrap.Tooltip(v)
           });
        }
 
        
        // simple datatable instance
        // if( $eTarget.find('table').hasClass("datatable")){
        //     let datatables = $eTarget.find('table.datatable');
        //     // console.log(datatables);
        //     $.each(datatables, function(i,v){
        //         new simpleDatatables.DataTable( v );
        //     }); 
        // }
        // datatable
        if( $eTarget.find('table').hasClass("ug-table")){
            let ugtable = $eTarget.find('table.ug-table');
            // console.log(datatables);
            $.each(ugtable, function(i,v){
                $(v).DataTable();
                // new simpleDatatables.DataTable( v );
            });
        }
      
        // disabled enter
        
        $eTarget.find('div.row').find('form').each(function(i,$target){
            if(!$($target).hasClass('submit')){
                $($target).on("keydown",function(event){ return event.key != "Enter"  });
            }
        });
     
        if( $eTarget.find('div.row').find("select.cst-select2")){  
            let select2 = $eTarget.find('div.row').find("select.cst-select2") 
            if(select2){
                select2.each(function(i,$target){ 
                    let name = "." + $target.className.trim();
                  
                    $(name).select2({width:"100%", dropdownParent: $(this).parent(),  theme: 'bootstrap-5',    placeholder: {
                        id: '-1', // the value of the option
                        text: 'Select an option'
                      }});
                }); 
                // theme:"bootstrap"

            } 
        } 
        // $eTarget.find("form").each(function(i,$target){
        //     $($target).on("keydown",function(event){ return event.key != "Enter"  });
        // }); 


        /**
         * Initiate TinyMCE Editor
         */
        const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;
        // images_upload_handler
        tinymce.init({
            selector: 'textarea.tinymce-editor', 
            plugins: 'uploadimage image table preview media emoticons',
            toolbar: 'uploadimage | undo redo | image | table | preview| media | foto | outdent indent | numlist bullist | emoticons',
            images_upload_url : ug.base_route + "/account/upload/tinymce",
            paste_data_images: false, // Disable pasting of images 
            inline: false,
            relative_urls : true,
            document_base_url: ROOTSITE,
            convert_urls: false,
            emoticons_append: {
              custom_mind_explode: {
                keywords: ['brain', 'mind', 'explode', 'blown'],
                char: '🤯'
              }
            },
            images_upload_credentials: true, 
        });

        tinymce.init({
            selector: '.inline-tinymce-editor',
            inline: true, 
            fromTextrea: true,
            menubar: false, 
            plugins: [
              'lists',
              'powerpaste',
              'autolink'
            ],
         toolbar: 'undo redo | bold italic underline',
        });

        $('.back-home').click(function(){
            let body = $(this).closest('body');
            body.find('div.page-content').html('').addClass('d-none');
            body.find('div.body-content').removeClass('d-none');
        });

        
        /**
         * Initiate glightbox
         */
        const glightbox = GLightbox({
            selector: '.glightbox'
        });

});