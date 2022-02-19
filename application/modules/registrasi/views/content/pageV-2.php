<style type="text/css">
  .popover__content {
    opacity: 0;
    visibility: hidden;
    position: absolute;
    right: 290px;
    transform: translate(0, 10px);
    background-color: #bfbfbf;
    padding: 1.5rem;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
    width: auto;
    margin-top: 30px;
  }

  .popover__content:before {
    position: absolute;
    z-index: -1;
    content: "";
    right: calc(50% - 10px);
    top: -8px;
    right: 120px;
    border-style: solid;
    border-width: 0 10px 10px 10px;
    border-color: transparent transparent #bfbfbf transparent;
    transition-duration: 0.3s;
    transition-property: transform;
  }

  .popover__wrapper:hover .popover__content {
    z-index: 10;
    opacity: 1;
    visibility: visible;
    transform: translate(0, -20px);
    transition: all 0.5s cubic-bezier(0.75, -0.02, 0.2, 0.97);
  }

  .popover__message {
    text-align: center;
  }
</style>
<div class="row">
  <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
    <div class="panel panel-primary">
      <div class="panel-heading bg-primary">
        <h5>Filter Data</h5>
      </div>
      <div class="panel-body" style="padding: 10px;">
        <form role="form" id="form-filter">
          <div class="form-group">
            <label for="">Tahun Ajaran</label>
            <select name="filter_t" id="filter_t" class="form-control">
              <option value="">All T.A</option>
              <?php foreach ($alltakad as $tk) : ?>
                <option <?= ($aktifta == $tk->id_thnakad) ? 'selected' : '' ?> value="<?= $tk->id_thnakad ?>"><?= $tk->ta_tipe ?> <?= $tk->thun_akademik ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">Kelas</label>
            <select name="filter_k" id="filter_k" class="form-control">
              <option value="">All Kelas</option>
              <?php foreach ($allkelas as $kl) : ?>
                <option value="<?= $kl->id_kelas ?>"><?= $kl->nama_kelas ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="">Semester</label>
            <select name="filter_s" id="filter_s" class="form-control">
              <option value="">All Semester</option>
              <?php foreach ($semester as $s) : ?>
                <option value="<?= $s->id_semester ?>"><?= $s->nama_semester ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <button type="button" id="btn-filter" class="btn btn-primary btn-out btn-mini">Filter</button>
          <button type="button" id="btn-filter" class="btn btn-default btn-out btn-mini">Reset</button>
        </form>
        <input type="hidden" name="filter_p" id="filter_p" value="<?= $aktifprodi ?>" placeholder="">

      </div>

    </div>
  </div>
  <div class="col-sm-10">
    <!-- Animation card start -->
    <div class="card">
      <div class="card-header">
        <!-- <h5>Enjoy Animation</h5> -->
        <button class="btn btn-warning btn-sm" onclick="bulk_validasi();">Batch Validasi</button>
        <button class="btn btn-dark btn-sm" onclick="load();">Refresh</button>
      </div>
      <div class="card-block">
        <div class="row">

          <div class="col-sm-12">
            <div class="table-responsive">
              <div class="dt-responsive table-responsive">
                <?= form_open('', array('id' => 'bulk')) ?>
                <table id="table" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="select_all" name="" value="" placeholder=""></th>
                      <th>Nim</th>
                      <th>Nama</th>
                      <th>Prodi</th>
                      <th>Semester</th>
                      <th>Tgl Terdaftar</th>
                      <th>Status Validator</th>
                      <th>status</th>
                      <th>Act</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <!-- <th scope="row">1</th> -->
                      <th>2019001</th>
                      <td>Mahdiawan nurkholifah</td>
                      <td>TIF</td>
                      <td>1 <i class="ion-arrow-right-c"></i> 2</td>
                      <td>20 sep 2020</td>
                      <td><span class="badge badge-info">Proses</span><span class="badge badge-warning">Tunda</span><span class="badge badge-success">Ok</span></td>
                      <td><button type="button" class="btn btn-grd-primary btn-mini">Aksi</button></td>

                    </tr>
                  </tbody>
                  <!-- <tfoot>
                               <tr>
                                <th><input type="checkbox" name="" value="" placeholder=""></th>
                                <th>Nim</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Semester</th>
                                <th>Tgl Terdaftar</th>
                                <th>Status Validator</th>
                                <th>status</th>
                                <th>Act</th>
                            </tr>
                        </tfoot> -->
                </table>
                <?= form_close() ?>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- Animation card end -->
    </div>

  </div>
</div>
<script type="text/javascript">
  var table;
  $(document).ready(function() {
    ajaxcsrf();
    table = $('#table').DataTable({
      "scrollY": "70vh",
      "scrollCollapse": true,
      "paging": false,
      "processing": false, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?= base_url() ?>registrasi/tables_v1",
        "type": "POST",
        "data": function(data) {
          data.prodi_id = $('#filter_p').val();
          data.semester_id = $('#filter_s').val();
          data.takad_id = $('#filter_t').val();
          data.kelas_id = $('#filter_k').val();
        }
      },

      //Set column definition initialisation properties.
      "columnDefs": [{
        "targets": [0], //first column / numbering column
        "orderable": false, //set not orderable
      }, ],

    });
    $('#btn-filter').click(function() { //button filter event click
      table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function() { //button reset event click
      $('#form-filter')[0].reset();
      table.ajax.reload(); //just reload table
    });
    $('tbody').on('click', '.valid', function(event) {
      event.preventDefault();
      const id = $(this).attr('data-idtr');
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Validasi!' + id
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '<?= base_url() ?>registrasi/validasiRegistasi',
            type: 'POST',
            dataType: 'JSON',
            data: {
              id: id
            },
            success: function(response) {
              Swal.fire(
                'Validasi',
                response.status,
                'success'
              )
              table.ajax.reload(null, false);
            }
          })


        }
      })
    });
    // setInterval(function(){ table.ajax.reload() }, 3000);

    $(".select_all").on("click", function() {
      if (this.checked) {
        $(".check").each(function() {
          // 
          var atr = $(this).attr('data-ds');
          if (atr == '') {
            this.checked = true;
          } else {
            this.checked = false;
          }
          $(".select_all").prop("checked", true);
        });
      } else {
        $(".check").each(function() {
          this.checked = false;
          $(".select_all").prop("checked", false);
        });
      }
    });

    $("#table tbody").on("click", "tr .check", function() {
      var check = $("#table tbody tr .check").length;
      var checked = $("#table tbody tr .check:checked").length;
      if (check === checked) {
        $(".select_all").prop("checked", true);
      } else {
        $(".select_all").prop("checked", false);
      }
    });
  });
  load();

  function load() {
    table.ajax.reload();
  }

  function bulk_validasi() {
    if ($("#table tbody tr .check:checked").length == 0) {
      Swal.fire({
        title: "Gagal",
        text: "Tidak ada data yang dipilih",
        type: "error"
      });
    } else {
      Swal.fire({
        title: "Anda yakin?",
        text: "Data akan divalidasi!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Validasi!"
      }).then(result => {
        if (result.value) {
          $.ajax({
            url: '<?= base_url() ?>registrasi/batchvalidasiKaprodi',
            type: 'POST',
            dataType: 'json',
            data: $('#bulk').serialize(),
            success: function(respon) {
              console.log(respon);
              //    if (respon.status) {
              //     Swal.fire({
              //       position: 'top',
              //       icon: 'success',
              //       title: 'Your work has been saved',
              //       showConfirmButton: false,
              //       timer: 1500
              //   })
              // } else {
              //     Swal.fire({
              //       title: "Gagal",
              //       text: "Tidak ada data yang dipilih",
              //       type: "error"
              //   });
              // }
              load();
            }
          })
        }
      });
    }
  }
</script>