 <div class="row">


  <div class="col-xl-12">
    <div class="card">
      <div class="card-header">

        <hr>

        <a href="<?=base_url()?>pengumuman/add"  class="btn btn-out btn-primary btn-square btn-sm "><i class="ion-plus-round"></i> New data</a>
        <!-- <button type="button" class="btn btn-out btn-danger btn-square btn-sm"><i class="ion-trash-a"></i> Bulk Hapus</button> -->
        <button type="button" class="btn btn-out btn-dark btn-square btn-sm" onclick="load();"><i class="ion-refresh"></i> Refresh</button>
        <hr>
      </div>

      <div class="card-block">
        <div class="dt-responsive table-responsive">
          <table id="table" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Tahun Akademik</th>
                <th>No Surat</th>
                
                <th>Kab.Baak</th>
                <th>Wadir</th>
                <th>Sending</th>
                <th>Act</th>
                <th><input type="checkbox" name="" value="" placeholder=""></th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Tahun Akademik</th>
                <th>No Surat</th>

                <th>Kab.Baak</th>
                <th>Wadir</th>
                <th>Sending</th>
                <th>Act</th>
                <th><input type="checkbox" name="" value="" placeholder=""></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-view" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title txt-head"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="txt-isi"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var table;
  $(document).ready(function() {
    ajaxcsrf();
    table = $('#table').DataTable({ 
      "processing": true, 
      "serverSide": true,
            // "pageLength": 50, 
            // "scrollY":        "100vh",
            // "scrollCollapse": true,
            // "paging":         false,
            "order": [], 

            "ajax": {
              "url": "<?=base_url()?>pengumuman/tables_operator",
              "type": "POST",
              "data": function ( data ) {
                // data.send_kabak = $('#filter_kabak').val();
                // data.prodi_id = $('#filter_p').val();
                // data.semester_id = $('#filter_s').val();
              }
            },
            // pageLength: 25,
            // lengthMenu: [25, 50, 75, 100, 200, 500],

            "columnDefs": [
            { 
              "targets": [ 0 ], 
              "orderable": false, 
            },
            ],


          });
    $('tbody').on('click', '.btn-edit', function(event) {
      event.preventDefault();
      const id=$(this).attr('data');
      window.location.href="<?=base_url()?>pengumuman/edit/"+id
    });
    $('tbody').on('click', '.btn-cncl', function(event) {
      event.preventDefault();
      const id=$(this).attr('data');
     Swal.fire({
        title: 'Are you sure?',
        text: "Membatakan Pengiriman",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Cancel it'
      }).then((result) => {
        if (result.isConfirmed) {

          $.ajax({
            url: '<?=base_url()?>pengumuman/cancel_send',
            type: 'POST',
            dataType: 'json',
            data: {id:id},
            success : function(res) {
              if (res.status) {
                Swal.fire(
                'Success!',
                'Pengumuman Di tarik Kembali, kabak Tidak Dapat Melihat Pengumuman Ini',
                'success'
                )
                table.ajax.reload();
              }
            }
          })
          
          
          
        }
      })    
    });

    $('tbody').on('click', '.v-label', function(event) {
      event.preventDefault();
      const id=$(this).attr('data');
      $.ajax({
        url: '<?=base_url()?>pengumuman/getReview',
        type: 'GET',
        dataType: 'json',
        data: {id:id},
        success : function(res) {
          if (res.reviewer_id=='1') {
            $('.txt-head').text('Review Kabak');
          }else{
            $('.txt-head').text('Review WADIR');
          }
           $('#txt-isi').text(res.review);
          $('#modal-view').modal('show');
        }
      })
      
      
      
    });
     $('tbody').on('click','.btn-snp',function(event) {
      event.preventDefault();
      const id=$(this).attr('data');
      const val=1;
      Swal.fire({
        title: 'Are you sure?',
        text: "Mengirim Ke wadir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Send it'
      }).then((result) => {
        if (result.isConfirmed) {

          $.ajax({
            url: '<?=base_url()?>pengumuman/val_operator',
            type: 'POST',
            dataType: 'json',
            data: {id:id,val:val},
            success : function(res) {
              if (res.status) {
                Swal.fire(
                'Success!',
                'Your file has been send to wadir and validasi.',
                'success'
                )
                table.ajax.reload();
              }
            }
          })
          
          
          
        }
      })
    });
  });
  load();
  function load() {
    table.ajax.reload();
  }
</script>