<div class="pagetitle">
    <h1>{{ $title }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">{{ $title }}</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row team-body">
    <!-- Datatables -->
    <div class="col-lg-12 "> 
        <div class="from-group mb-2  d-flex justify-content-end">
            <button class="btn btn-primary creatData d-none"  data-id="add">Add Data</button>
        </div> 
        <div class="card mb-4"> 
            <div class="table-responsive p-3">
                <table class="table table-striped" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 4px">#</th> 
                            <th>name</th>
                            <th>phone</th>
                            <th>email</th>
                            <th>message</th>
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
            ajax: "{{ route('message',['opt'=>'data'])}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' }, 
                { data: 'name', name: 'name' },
                { data: 'phone', name: 'phone' },
                { data: 'email', name: 'email' },
                { data: 'pesan', name: 'pesan' },
            ]
        });
    });
 
</script>