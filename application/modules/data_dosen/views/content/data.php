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


                <button type="button" id="btn-filter" class="btn btn-primary btn-out btn-mini">Filter</button>
                <button type="button" id="btn-reset" class="btn btn-default btn-out btn-mini">Reset</button>
              </form>


            </div>

          </div>
        </div>

        <div class="col-xl-10">
          <div class="card">
            <div class="card-header">

              <hr>
              <button type="button" class="btn btn-out btn-primary btn-square btn-sm btn-add"><i class="ion-plus-round"></i> New data</button>
              <button type="button" class="btn btn-out btn-danger btn-square btn-sm" onclick="bulk_delete();"><i class="ion-trash-a"></i> Bulk Hapus</button>
              <button type="button" class="btn btn-out btn-dark btn-square btn-sm" onclick="reload_ajax();"><i class="ion-refresh"></i> Refresh</button>
              <hr>
            </div>

            <div class="card-block">
              <div class="dt-responsive table-responsive">
                <?=form_open('',array('id'=>'bulk'))?>
                <table id="table" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th><input type="checkbox" name="" value="" placeholder="" id="select_all"></th>
                      <th>NRP</th>
                      <th>NIDN</th>
                      <th>NAMA</th>
                      <th>E-mail</th>
                      <th>L/P</th>
                      <th>Prodi</th>
                      <th>Edit</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Tiger Nixon</td>
                      <td>System Architect</td>
                      <td>Edinburgh</td>
                      <td>61</td>
                      <td>2011/04/25</td>
                      <td>$320,800</td>
                      <td><button type="button" class="btn btn-out btn-warning btn-square btn-mini" data-toggle="modal" href='#modal-add'><i class="ion-edit"></i> Edit</button></td>
                      <td><input type="checkbox" name="" value="" placeholder=""></td>
                    </tr>

                  </tbody>
                  <tfoot>

                   <tr>
                    <th><input type="checkbox" name="" value="" placeholder="" id="select_all"></th>
                    <th>NRP</th>
                    <th>NIDN</th>
                    <th>NAMA</th>
                    <th>E-mail</th>
                    <th>L/P</th>
                    <th>Prodi</th>
                    <th>Edit</th>

                  </tr>
                </tfoot>
              </table>
              <?= form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h4 class="modal-title">Add New Dosen</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?= form_open(base_url().'data_dosen/save', array('id' =>"dsn" ,'class'=>"dsn" )); ?>
            <input type="hidden" name="id_dsn" id="id_dsn" value="">
            <input type="hidden" name="method" id="method" value="">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">NRP</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="nrp" name="nrp" placeholder="Enter NRP">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">NIDN</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="nidn" name="nidn" placeholder="Enter NIDN">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Dosen</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Nama">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">E-mail</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-labif ($action) {
        $this->output_json(['status' => true]);
      } else {
        $this->output_json(['status' => false]);
      }el">Jenis Kelamin</label>
              <div class="col-sm-10">
                <select name="jenis_k" id="jenis_k" class="form-control" >
                  <option value="">Pilih Gender</option>
                  <option value="L">Laki - Laki</option>
                  <option value="P">Perempuan</option>
                </select>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Program Studi</label>
              <div class="col-sm-10">
                <select name="prodi" id="prodi" class="form-control" >
                  <option value="">Pilih Program Studi</option>
                  <?php foreach ($prodi as $p) :?>
                    <option value="<?=$p->kode_prodi?>"><?=$p->nama_prodi?></option>
                  <?php endforeach; ?>
                </select>
                <span class="help-block"></span>
              </div>
            </div>

          <!-- <div class="form-group row">
            <label class="col-sm-2 col-form-label">Photo</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="EmailP" name="Email" placeholder="Enter email">
              <span class="messages popover-valid"></span>
            </div>
          </div> -->
          
        </div>
        <div class="modal-footer bg-info">
          <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
          <button class="btn btn-primary waves-effect waves-light " id="submit">Simpan</button>
        </div>
        <?= form_close(); ?>
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
            "scrollY":        "100vh",
            "scrollCollapse": true,
            "paging":         false,
            "order": [], 

            "ajax": {
              "url": "<?=base_url()?>data_dosen/tables",
              "type": "POST",
              "data": function ( data ) {
                data.prodi_id = $('#filter_p').val();
                data.semester_id = $('#filter_s').val();
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
        $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
      });
    $('#btn-reset').click(function(){ //button reset event click
      $('#form-filter')[0].reset();
        table.ajax.reload();  //just reload table

      });
    $('.btn-add').on('click',function(event) {
      event.preventDefault();
      $('#method').val('add');
      $('#modal-add').modal('show');
    });
    $('tbody').on('click', '.btn-edit', function(event) {
      event.preventDefault();
      const id=$(this).attr('data');
      $('#method').val('edit');
      $.ajax({
        url: '<?=base_url()?>data_dosen/getdsnid',
        type: 'GET',
        dataType: 'JSON',
        data: {id: id},
        success : function(result) {
          $('#modal-add').modal('show');
          $('#id_dsn').val(result.id_dosen);
          $('#nrp').val(result.nrp);
          $('#nidn').val(result.nidn);
          $('#email').val(result.email);
          $('#nama').val(result.nama_dsn);
          $('#jenis_k').val(result.jenis_k);
          $('#prodi').val(result.prodi_id);
        }
      })
    });
    $('form#dsn').on('submit', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();

      var btn = $('#submit');
      btn.attr('disabled', 'disabled').text('Wait...');

      $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        type: 'POST',
        success: function (data) {
          btn.removeAttr('disabled').text('Simpan');
          if (data.status) {
            $('#modal-add').modal('hide');
            $('#dsn')[0].reset();
            success('berhasil');
          } else {
            console.log(data.errors);
            $.each(data.errors, function (key, value) {
              $('[name="' + key + '"]').nextAll('.help-block').eq(0).text(value).addClass('form-txt-danger');
              $('[name="' + key + '"]').addClass('form-control-danger');
              if (value == '') {
                $('[name="' + key + '"]').nextAll('.help-block').eq(0).text('');
                $('[name="' + key + '"]').removeClass('has-error').addClass('form-control-success');
              }
            });
          }
        }
      });
    });
    $("#select_all").on("click", function() {
      if (this.checked) {
        $(".check").each(function() {
          this.checked = true;
        });
      } else {
        $(".check").each(function() {
          this.checked = false;
        });
      }
    });
    $("#table tbody").on("click", "tr .check", function() {
      var check = $("#table tbody tr .check").length;
      var checked = $("#table tbody tr .check:checked").length;
      if (check === checked) {
        $("#select_all").prop("checked", true);
      } else {
        $("#select_all").prop("checked", false);
      }
    });
    $("#bulk").on("submit", function(e) {
      if ($(this).attr("action") =="<?=base_url()?>data_dosen/delete") {
        e.preventDefault();
        e.stopImmediatePropagation();

        $.ajax({
          url: $(this).attr("action"),
          data: $(this).serialize(),
          type: "POST",
          success: function(respon) {
            if (respon.status) {
              Swal.fire({
                icon:"success",
                title: "Berhasil",
                text: respon.total + " data berhasil dihapus",
                type: "success"
              });
            } else {
              Swal.fire({
                icon:"error",
                title: "Gagal",
                text: "Tidak ada data yang dipilih",
                type: "error"
              });
            }
            
          },
          error: function() {
            Swal.fire({
              icon:"error",
              title: "Gagal",
              text: "Ada data yang sedang digunakan",
              type: "error"
            });
          }
        });
      }
    });
  });
       function bulk_delete() {
        if ($("#table tbody tr .check:checked").length == 0) {
          Swal.fire({
            icon:"error",
            title: "Gagal",
            text: "Tidak ada data yang dipilih",
            type: "error"
          });
        } else {
          $("#bulk").attr("action", "<?=base_url()?>data_dosen/delete");
          Swal.fire({
            icon:"warning",
            title: "Anda yakin?",
            text: "Data akan dihapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus!"
          }).then(result => {
            if (result.value) {
              $("#bulk").submit();
            }
          });
        }
      }
    </script>