<div class="row">
  <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
    <div class="panel panel-primary">
      <div class="panel-heading bg-primary">
        <h5>Filter Data</h5>
      </div>
      <div class="panel-body" style="padding: 10px;">
        <form role="form" id="form-filter">
          <div class="form-group">
            <label for="">Program Studi</label>
            <select name="filter_p" id="filter_p" class="form-control" >
              <option value="">All Prodi</option>
              <?php foreach ($prodi as $p) :?>
                <option value="<?=$p->kode_prodi?>"><?=$p->nama_prodi?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="">Semester</label>
            <select name="filter_s" id="filter_s" class="form-control" >
              <option value="">All Semester</option>
              <?php foreach ($semester as $s) :?>
                <option value="<?=$s->id_semester?>"><?=$s->nama_semester?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <button type="button" id="btn-filter" class="btn btn-primary btn-out btn-mini">Filter</button>
          <button type="button" id="btn-filter" class="btn btn-default btn-out btn-mini">Reset</button>
        </form>


      </div>

    </div>
  </div>

  <div class="col-xl-10">
    <div class="card">
      <div class="card-header">

        <hr>
        <button type="button" class="btn btn-out btn-dark btn-square btn-sm" onclick="reload_ajax();"><i class="ion-refresh"></i> Refresh</button>
        <hr>
      </div>

      <div class="card-block">
        <div class="">
          <?=form_open('',array('id'=>'bulk'))?>
          <table id="table" class="table table-striped table-bordered dt-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>E-mail</th>
                <th>Prodi</th>
                <th>Semester</th>
                <th>Edit</th>

              </tr>
            </thead>
            <tbody>


            </tbody>
            
          </table>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
 var table;
 $(function() {
   ajaxcsrf();
   table = $('#table').DataTable({ 
    "processing": true, 
    "serverSide": true,
            // "pageLength": 50, 
            "scrollY":        false,
            "scrollCollapse": false,
            "paging":         true,
            "order": [], 

            "ajax": {
              "url": "<?=base_url()?>pengguna/tablesmahasiswa",
              "type": "POST",
              "data": function ( data ) {
                data.prodi_id = $('#filter_p').val();
                data.semester_id = $('#filter_s').val();
              }
            },
            pageLength: 25,
            lengthMenu: [25, 50, 75, 100, 200, 500],

            "columnDefs": [
            { 
              "targets": [ 0 ], 
              "orderable": false, 
            },
            ],


          });
      $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
      });

      $('#btn-reset').click(function(){ //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload();  //just reload table
      });

      $('tbody').on('click', '.btn-delete', function(event) {
        event.preventDefault();
        var email=$(this).attr('data-email');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.post('<?=base_url()?>pengguna/deleteakun', {email: email}, function(data, textStatus, xhr) {
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'success',
                showConfirmButton: false,
                text: data.msg,
                timer: 2000
              })
              table.ajax.reload();
            });
          }
        })
      });

      $('tbody').on('click', '.btn-create', function(event) {
        event.preventDefault();
        var email=$(this).attr('data-email');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Create!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.post('<?=base_url()?>pengguna/createakun', {email: email}, function(data, textStatus, xhr) {
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'success',
                showConfirmButton: false,
                text: data.msg,
                timer: 2000
              })
              table.ajax.reload();

            });
          }
        })
      });
    });
  </script>
