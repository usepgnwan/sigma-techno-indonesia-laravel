<div class="row">
    <div class="col-12">
        <form action="{{route('slider.post')}}" enctype="multipart/form-data">
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
                    <label for="">Cover</label>
                    @if(isset($data['foto']))
                    <div class="pt-3 mb-3">
                        <img src="{{ $data['foto'] }}" alt="Profile"  width="100" height="100">
                    </div>
                    @endif
                    <input type="file" class="form-control" name="image">
                </div>
                <div>
                    <label for="">Kategori</label>
                    <select name="categories_id" class="cst-select2">
                        <option value="0" readonly>Pilih</option>
                        @foreach($kategori as $v)
                            <option value="{{ $v['id'] }}" @if(@isset($data['id_articel']) && $v['id']  ==  $data['id_articel'] ) selected @endif>{{ $v['id'] }} {{ $v['description'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">Content/Artikel</label>
                    <select name="artikel" class="cst-select2">
                    </select>
                </div>
                
                <div>
                    <label for="">Status</label> 
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" @if(@isset($data['status'])  && $data['status']) checked @endif>
                        <label class="form-check-label" for="status" name="status" @if(@isset($data['status']) && $data['status']) checked @endif></label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
 

<script>
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