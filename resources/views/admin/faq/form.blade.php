<div class="row">
    <div class="col-12">
        <form action="{{route('faq.post')}}" enctype="multipart/form-data">
            @method('POST')
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id" value={{ $data['id'] ?? "add"}} > 
                <div>
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title" value='{{ $data['title'] ?? ""}}' >
                </div>
                <div>
                    <label for="">Description</label>
                    <textarea   name="description"   class="form-control"cols="30" rows="10">{{ $data['description'] ?? ""}}</textarea> 
                </div>
            </div>
        </form>
    </div>
</div>
 