<div class="pagetitle">
    <h1>{{ $title }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">{{ $title }}</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row supplier-body">
    <!-- Datatables -->
    <div class="col-lg-12 "> 
        <div class="from-group mb-2  d-flex justify-content-end">
            <button class="btn btn-primary creatData"  data-id="add">Add Data</button>
        </div> 
        <div class="card mb-4"> 
            <div class="table-responsive p-3">
                <table class="table table-striped" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 4px">#</th>
                            <th>.::.</th> 
                            <th>title</th> 
                            <th>Foto</th>
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
            ajax: "{{ route('supplier',['opt'=>'data'])}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'action', name: 'action', orderable: false, searchable: false },   
                { data: 'title', name: 'title' },
                { data: 'foto', name: 'foto' },
            ]
        });
    });
    $('.supplier-body').on('click','.creatData, .edit-data',function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let url = "{{route('supplier.modal',['opt'=> ':id'])}}";
        url = url.replace(":id", id);
        $.MyModal(url, {},{
                title:  (id =='add' ? 'Tambah' : 'Edit') + ' supplier',
                closable: false,
                buttons: [{
                    label: 'Close', 
                    action: function(dialogItself){
                        dialogItself.close();
                    }
                }, {
                    label: 'Save', 
                    cssClass: 'btn-primary',
                    action: function(dialogItself){
                        const $form = dialogItself.getModalBody().find('form');
                        let $footer = dialogItself.getModalFooter().find('.btn-primary');
                        $footer.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'); 
                        $form.ug("submit", function(r){
                            $footer.html('Save');
                            // check validation
                            $form.ug("validateForm",r.errors); 
                            if(r.status){
                                ug.alert(r.msg);
                                dialogItself.close();
                                table.draw();
                            }
                        },"json");
                    }
                }]
        }); 
    });

    $('.supplier-body').on('click','.delete-data',function(e){
        let id = $(this).data('id') 
        let url ="{{ route('supplier.delete',['opt'=>':id']) }}";
        url = url.replace(":id", id); 
        $.confirm('Yakin Hapus ?', function(result) {
            if(result) {
                ug.action('DELETE', url ,{}, function(r){
                    if(r.status){
                        ug.alert(r.msg)
                    }
                    table.draw();
                }, "json");
            }
        });
    });
    
</script>