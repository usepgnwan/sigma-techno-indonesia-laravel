<div class="row">
    <div class="col-12">
        <form action="{{route('team.post')}}" enctype="multipart/form-data">
            @method('POST')
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id" value={{ $data['id'] ?? "add"}} >
                <div>
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value='{{ $data['name'] ?? ""}}' >
                </div>
                <div>
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title" value='{{ $data['title'] ?? ""}}' >
                </div>
                <div>
                    <label for="">Foto</label>
                    @if(isset($data['foto']))
                    <div class="pt-3 mb-3">
                        <img src="{{ $data['foto'] }}" alt="Profile"  width="100" height="100">
                    </div>
                    @endif
                    <input type="file" class="form-control" name="image">
                </div>
            </div>
        </form>
    </div>
</div>
 