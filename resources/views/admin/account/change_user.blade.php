<div class="row">
  <div class="col-md-12">
    <form action="{{route('change.user')}}"  class="unsubmit" enctype="multipart/form-data">
      @method('POST')
      <div class="d-flex flex-column align-items-center">
          <img width="150" height="150" src="{{ auth()->user()->foto }}" alt="Profile" class="rounded-circle img-image">
      </div>
      <div class="mb-3">
          <div class="pt-2">
            <input type="file" class="form-control" name="foto">
          </div> 
      </div> 
      <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Name</label>
          <input type="text" class="form-control" name="nama" value="{{ auth()->user()->name}}">
      </div>
  </form>
  </div>
</div>