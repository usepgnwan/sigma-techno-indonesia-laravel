<div class="row">
    <div class="col-12">
        <form action="{{route('project.post')}}" enctype="multipart/form-data">
            @method('POST')
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id" value={{ $data['id'] ?? "add"}} > 
                <div>
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title" value='{{ $data['title'] ?? ""}}' >
                </div>
                <div>
                    <label for="">Description</label>
                    <textarea   name="description"   class="form-control"cols="20" rows="5">{{ $data['description'] ?? ""}}</textarea> 
                </div>
                <div>
                    <label for="">Foto</label>
                    @if(isset($data['image']))
                    <div class="pt-3 mb-3">
                        <img src="{{ $data['image'] }}" alt="image"  width="100" height="100">
                    </div>
                    @endif
                    <input type="file" class="form-control" name="image">
                </div>
                <div>
                    <label for="">Kategori</label>
                    <select name="categories_id" class="cst-select2">
                        <option value="0" readonly>Pilih</option>
                        @foreach($kategori as $v)
                            <option value="{{ $v['id'] }}" @if(@isset($data['id_articel']) && $v['id']  ==  $data['id_articel'] ) selected @endif> {{ $v['description'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">Content/Artikel</label>
                    <select name="artikel" class="cst-select2">
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>
 

<script>
 $('[name="icon"]').click(function(){
    let url = "{{ route('list.icon') }}"
    $.MyModal(url, {},{
        size: BootstrapDialog.SIZE_WIDE,
        title: "Pilih Icon",
        closable: false,
        buttons: [{
            label: 'Close',
            cssClass: 'btn-secondary close-btn',
            action: function(dialogItself){
                dialogItself.close();
            }
        }]
    });  
 })
 $("select[name='categories_id']").change(function(){
    let kategori_id = $(this).val(); 
    let id = $("input[name='id']").val();
    let url ="{{ route('artikel.sort',['kategori_id'=>':kategori_id','id'=>':id']) }}";
        url = url.replace(":kategori_id", kategori_id); 
        url = url.replace(":id", id);
    ug.action('GET', url ,{}, function(res){
        $("[name='artikel']").html(''); 
        let $opt = '';
        let r = JSON.parse(res);
        let idslide = $('[name="id"]').val()
        $.each(r.data, function(i,v){
        let select = idslide == v.id ? 'selected' : '';
        $opt += `<option value='${ v.id }' ${ select }>${ v.title }</option>`;
        });

        $("[name='artikel']").html($opt);
    }), "json";
 });  
 $("select[name='categories_id']").trigger('change');
</script>