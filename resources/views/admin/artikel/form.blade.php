<div class="row">
    <div class="col-12">
        <div class="card"> 
            <div class="card-body">
                <h5 class="card-title"> <a class="btn text-primary back-home"><i class="bi bi-arrow-left"></i> </a>  {{ isset($data['id']) ?  "Edit" : "Add"}} Artikel</span></h5> 
                <form action="{{route('artikel.post')}}" enctype="multipart/form-data">
                    @method('POST')
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="id" value={{ $data['id'] ?? "add"}} >
                        <div>
                            <label for="">Judul</label>
                            <input type="text" class="form-control" name="title" value='{{ $data['title'] ?? ""}}' >
                        </div>
                        <div>
                            <label for="">Kategori</label>
                            <select name="categories_id" class="cst-select2">
                                <option value="" readonly>Pilih</option>
                                @foreach($kategori as $v)
                                    <option value="{{ $v['id'] }}" @if(@isset($data['categories_id']) && $v['id']  ==  $data['categories_id'] ) selected @endif> {{ $v['description'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="">Link Youtube <small class="text-warning">untuk video bisa dikosongkan</small></label>
                            <input type="text" class="form-control" name="youtube" value='{{ $data['youtube'] ?? ""}}' >
                        </div>
                        <div>
                            <label for="">Deskripsi Singkat <small class="text-warning">bisa dikosongkan</small></label> 
                            <textarea class="form-control" name="short_body">{{ $data['short_body'] ?? ""}}</textarea>
                        </div>
                        <div>
                            <label for="">Deskripsi <small class="text-warning">bisa dikosongkan</small></label> 
                            <textarea class=" tinymce-editor" name="body">{{ $data['body'] ?? ""}}</textarea>
                        </div>
                        <div>
                            <label for="">Cover <small class="text-warning">bisa dikosongkan</small></label>
                            @if(isset($data['foto']))
                            <div class="pt-3 mb-3">
                                <img src="{{ $data['foto'] }}" alt="Profile"  width="100" height="100">
                            </div>
                            @endif
                            <input type="file" class="form-control" name="foto">
                        </div>
                        <div>
                            <label for="">status</label> 
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" checked="">
                                <label class="form-check-label" for="status" name="status"></label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary form-articel">Save</button> &nbsp;
                        <button class="btn btn-light back-home">close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
<script>
     $(".form-articel").click(function(e){
        e.preventDefault();
        let $this = $(this); 
        $this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disabled', true);
        let data = {};
        const editorContent =tinymce.activeEditor.getContent({format: "html"});


        $("textarea[name='body']").val(editorContent);
        let $form =  $this.closest('form');  
        $form.ug("submit", function(result){
            let r = JSON.parse(result); 
            $this.html('Save').attr('disabled', false);
            // check validation
            $form.ug("validateForm",r.errors); 
            if(r.status){
                $('.back-home').trigger('click');
                table.draw();
                ug.alert(r.msg); 
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
                ug.alert('Form isian masih kosong!','Warning',BootstrapDialog.TYPE_WARNING)
            }
        })
    });
</script>