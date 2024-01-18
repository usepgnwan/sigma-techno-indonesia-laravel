<div class="row">
    <div class="col-12">
        <form action="{{route('asset.post')}}">
            @method('POST')
            <div class="mb-3">
                <label for="">Deskripsi</label>
                <input type="hidden" class="form-control" name="id" value={{ $data['id'] ?? "add"}} >
                <div class="pt-2">
                <input type="text" class="form-control" name="description" value='{{ $data['description'] ?? ""}}'>
                </div>
            </div> 
            <div class="mb-3"> 
                <div class="pt-2">
                    <label for="">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" value='{{ $data['jumlah'] ?? "0"}}' min="0">
                </div>
            </div> 
        </form>
    </div>
</div>
 