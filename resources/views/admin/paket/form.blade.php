<div class="row">
    <div class="col-12">
        <form action="{{route('paket.post')}}">
            @method('POST')
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id" value={{ $data['id'] ?? "add"}} >
                <div class="pt-2">
                    <label for="">Deskripsi</label>
                <input type="text" class="form-control" name="description" value='{{ $data['description'] ?? ""}}' >
                </div>
            </div>    
            <div class="mb-3"> 
                <label for="">Harga</label>
                <input type="text" class="form-control" name="harga" value='{{ $data['harga'] ?? ""}}' > 
            </div>    
            <div class="mb-3">
                <div class="pt-2">
                    <label for="">Kategori Asset</label>
                    <select name="kategori" class="cst-select2" data-placeholder="Choose anything" multiple>
                        @foreach ($categories as $item)
                            <option value="{{ $item['id'] }}"  
                                @if(isset($data['category']) && count($data['category']->toArray())>0) 
                                    @if(in_array($item['id'], $data['category']->pluck('id')->toArray())) 
                                        selected
                                    @endif
                                @endif>
                                {{ $item['description'] }}  ({{( $item['asset']->description ?? '' )}}  Jumlah {{ $item['jumlah'] }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div> 
        </form>
    </div>
</div>
 