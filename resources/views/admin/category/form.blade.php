<div class="row">
    <div class="col-12">
        <form action="{{route('category.post')}}">
            @method('POST')
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id" value={{ $data['id'] ?? "add"}} >
                <div>
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="description" value='{{ $data['description'] ?? ""}}' >
                </div>
            </div>
        </form>
    </div>
</div>
 