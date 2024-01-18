<div class="pagetitle">
    <h1>{{ $title }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">{{ $title }}</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row">
    <!-- Datatables -->
    <div class="col-lg-12 "> 
        <div class="from-group mb-2 d-none">
            <button class="btn btn-primary creatData"  >Add Data</button>
        </div> 
        <div class="card mb-4"> 
            <div class="table-responsive p-3">
                <table class="table align-items-center table-striped" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th> 
                            <th>Role</th> 
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead> 
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</div>
<div class="row page-content d-none"> 
</div>

<script>
    $(document).ready(function () {
        table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user',['opt'=>'data'])}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'username', name: 'username' },
                { data: 'email', name: 'email' },
                { data: 'my_role', name: 'role' },
                // { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
    $('.creatData').click(function(e){
        e.preventDefault();
        $(this).closest('.row').addClass('d-none');
        $('.page-content').removeClass('d-none').addClass('loading-content');
        ug.action('GET', "{{ route('user',['opt'=>'data']) }}",{}, function(r){
            $('.page-content').removeClass('loading-content')
            console.log($('.page-content'))
        }, "json");
    });
</script>