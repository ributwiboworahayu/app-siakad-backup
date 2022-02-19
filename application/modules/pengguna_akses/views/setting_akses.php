<div class="row">
  <div class="col-sm-3">
    <div class="card">
      <div class="card-header">
        <a href="<?=base_url()?>pengguna_akses" class="btn btn-sm btn-warning">Kembali</a>
      </div>
      <div class="card-block">
        <form>
          <div class="form-group">
            <label>Level user</label>
            <input type="text" value="<?=$level->level?>" class="form-control" disabled>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-xl-9" id="tbl-menu" style="display: block;">
    <!-- Editable table -->
    <div class="card">
      <div class="card-header">
      </div>
      <div class="card-block">
        <div class="dt-responsive table-responsive">
          <?= form_open(base_url().'pengguna_akses/saveakses', array('id' =>"f-menu" ,'class'=>"" )); ?>
          <input type="hidden" name="level" id="level_id" value="<?=$level->id_level?>">
          <table id="table" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>Main Menu</th>
                <th>Child Menu</th>
                <!-- <th>Sub Child Menu</th> -->
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
              </tr>


            </tbody>
          </table>
          <button  class="btn btn-sm btn-primary">Simpan</button>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
    <!-- Editable table -->
  </div>
</div>

<script type="text/javascript">
  function check(id) {
    $("#main"+id).prop("checked", true);

  }
  var table;
  $(function() {

    ajaxcsrf();
    table = $('#table').DataTable({ 
      "processing": true, 
      "serverSide": true,
            // "pageLength": 50, 
            "scrollY":        false,
            "scrollCollapse": true,
            "paging":         true,
            "order": [], 

            "ajax": {
              "url": "<?=base_url()?>pengguna_akses/tablesmenuakses",
              "type": "POST",
              "data": function ( data ) {
                data.level_id = $('#level_id').val();
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
    $('form#f-menu').on('submit', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();

      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        dataType: 'JSON',
        data: $(this).serialize(),
        success:function(respon) {
          if (respon.status) {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'success',
              showConfirmButton: false,
              text: respon.msg,
              timer: 2000
            })
            table.ajax.reload();
          }  

        }
      })
      
      
    });
  });
</script>
