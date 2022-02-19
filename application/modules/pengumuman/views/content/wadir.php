 <div class="row">
                    

                    <div class="col-xl-12">
                      <div class="card">
                        <div class="card-header">

                          <hr>
                          <button type="button" class="btn btn-out btn-primary btn-square btn-sm " data-toggle="modal" href='#modal-add'><i class="ion-plus-round"></i> New data</button>
                          <button type="button" class="btn btn-out btn-danger btn-square btn-sm"><i class="ion-trash-a"></i> Bulk Hapus</button>
                          <button type="button" class="btn btn-out btn-dark btn-square btn-sm"><i class="ion-refresh"></i> Refresh</button>
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
                                  <th>Act</th>
                                
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  
                                  <td>Edinburgh</td>
                                  <td>Edinburgh</td>
                                  <td>Edinburgh</td>

                                  <td>2011/04/25</td>
                                  <td>$320,800</td>
                                  <td><button type="button" class="btn btn-out btn-warning btn-square btn-mini" data-toggle="modal" href='#modal-add'><i class="ion-edit"></i> Edit</button></td>
                                
                                </tr>

                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>No</th>
                                  <th>Tahun Akademik</th>
                                  <th>No Surat</th>
                                  <th>Kab.Baak</th>
                                  <th>Wadir</th>
                                  <th>Act</th>
                               
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
  <div class="modal fade" id="modal-id">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
          <?= form_open(base_url().'pengumuman/saveReview', array('id' =>"form-rvw",'class'=>"rvw-form")); ?>
          <input type="hidden" name="id_p" id="id_p" value="">
          <input type="hidden" name="r_id" id="r_id" value="2">
          <input type="hidden" name="r_field" id="r_field" value="wadir">
          <div class="form-group">
            <label for="">Isi Review</label>
            <textarea name="isi_r" class="form-control"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button  class="btn btn-primary" id="submit">Save And Send</button>
      </div>
      <?= form_close(); ?>
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
      "processing": false, 
      "serverSide": true,
            // "pageLength": 50, 
            // "scrollY":        "100vh",
            // "scrollCollapse": true,
            // "paging":         false,
            "order": [], 

            "ajax": {
              "url": "<?=base_url()?>pengumuman/tables_wadir",
              "type": "POST",
              "data": function ( data ) {
                // data.send_kabak = $('#filter_kabak').val();
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
   $('tbody').on('click','.btn-rvw',function(event) {
      event.preventDefault();
       const id=$(this).attr('data');
        $('#id_p').val(id);
      $('#modal-id').modal('show');
    });
    $('tbody').on('click','.btn-vld',function(event) {
      event.preventDefault();
      const id=$(this).attr('data');
      const val=1;
      Swal.fire({
        title: 'Are you sure?',
        text: "Untuk validasi Akhir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {

          $.ajax({
            url: '<?=base_url()?>pengumuman/val_wadir',
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
     setInterval(function(){
        load()
        }, 2000);
       });
  load();
  function load() {
    table.ajax.reload();
  }
</script>