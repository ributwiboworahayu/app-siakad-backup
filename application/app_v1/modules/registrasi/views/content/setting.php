<style type="text/css" media="screen">
  .st-1 > input[type="radio"] {
    display: none;
  }
  .st-1 > input[type="radio"] + *::before {
    content: "";
    display: inline-block;
    vertical-align: bottom;
    width: 1rem;
    height: 1rem;
    margin-right: 0.3rem;
    border-radius: 50%;
    border-style: solid;
    border-width: 0.1rem;
    border-color: gray;
  }
  .st-1 > input[type="radio"]:checked + * {
    color: green;
  }
  .st-1 > input[type="radio"]:checked + *::before {
    background: radial-gradient(teal 0%, teal 40%, transparent 50%, transparent);
    border-color: green;
  }
  .st-1 > input[type="radio"] + * {
    display: inline-block;
    padding: 0.5rem 1rem;
  }

  .st-2 > input[type="radio"] {
    display: none;
  }
  .st-2 > input[type="radio"] + *::before {
    content: "";
    display: inline-block;
    vertical-align: bottom;
    width: 1rem;
    height: 1rem;
    margin-right: 0.3rem;
    border-radius: 50%;
    border-style: solid;
    border-width: 0.1rem;
    border-color: gray;
  }
  .st-2 > input[type="radio"]:checked + * {
    color: red;
  }
  .st-2 > input[type="radio"]:checked + *::before {
    background: radial-gradient(teal 0%, teal 40%, transparent 50%, transparent);
    border-color: red;
  }
  .st-2 > input[type="radio"] + * {
    display: inline-block;
    padding: 0.5rem 1rem;
  }

</style>
<div class="row form-ru" style="display: none;">
 <div class="col-sm-12">
  <!-- Animation card start -->
  <div class="card">
    <div class="card-block">
     <div class="row">

      <div class="col-sm-12">
        <?= form_open('', array('id'=>"form_reg")); ?>
        <!-- <form method="POST" id="form_reg" action="<?=base_url()?>registrasi/saveSetting"> -->
          <legend>Form Pengaturan Registrasi</legend>
          <input type="hidden" name="id_" value="0">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tahun Akademik</label>
            <div class="col-sm-10">
             <select name="thn" class="form-control" required="">
              <option value="">Select One Value Only</option>
              <?php foreach ($alltakad as $tkd): ?>
                <?php $st = ($tkd->status == '1') ? "green" : "red"; ?>
                <option value="<?=$tkd->id_thnakad?>" style="color: <?=$st?>"><?=$tkd->ta_tipe?> - <?=$tkd->thun_akademik?></option>
              <?php endforeach ?>
            </select>
            <small>Catatan : Warna Hijau Menandakan <b style="color: green">Aktif</b>, Warna Merah Menandakan <b style="color: red">Tidak Aktif</b></small>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Tgl Portal di buka</label>
          <div class="col-sm-5">
            <input type="date" class="form-control" name="tgl_open" required="">
          </div>
          <div class="col-sm-5">
            <input type="time" class="form-control" name="time_open" required="">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Tgl Batas Mendaftar</label>
          <div class="col-sm-5">
            <input type="date" class="form-control" name="tgl_batas" required="">
            <small style="color: red">Info : Ini untuk batas Waktu MHS Mendaftar & Waktu Petugas untuk Mulai validasi</small>
          </div>
          <div class="col-sm-5">
            <input type="time" class="form-control" name="time_batas">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Tgl Portal di tutup</label>
          <div class="col-sm-5">
            <input type="date" class="form-control" name="tgl_close" required="">
          </div>
          <div class="col-sm-5">
            <input type="time" class="form-control" name="time_close" required="">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">status</label>
          <div class="col-sm-10">
            <select name="status" class="form-control" required="">
              <option value="">Select One Value Only</option>
              <option value="1">Opened</option>
              <option value="0">Closed</option>
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-primary save-rug">Simpan</button>
        <button type="button" class="btn btn-default" onclick="cancel();">Batal</button>




        <!-- </form> -->
        <?= form_close(); ?>
      </div>
    </div>
  </div>
  <!-- Animation card end -->
</div>

</div>
</div>
<div class="row">


  <div class="col-xl-12">
    <div class="card">
      <div class="card-header">

        <hr>
        <button type="button" class="btn btn-out btn-primary btn-square btn-sm btn-add" ><i class="ion-plus-round"></i> New data</button>
        <!-- <button type="button" class="btn btn-out btn-danger btn-square btn-sm" onclick="bulk_delete();"><i class="ion-trash-a"></i> Bulk Hapus</button> -->
        <button type="button" class="btn btn-out btn-dark btn-square btn-sm" onclick="reload_ajax();"><i class="ion-refresh"></i> Refresh</button>
        <hr>
      </div>

      <div class="card-block">
        <div class="dt-responsive table-responsive">
          <table id="table" class="table table-striped table-bordered ">
            <thead>
              <tr>
                <th>No</th>
                <th>Tahun Akademik</th>
                <th>Date Open</th>
                <th>Date Batas</th>
                <th>Date Close</th>
                <th>Statis</th>
                <th>act</th>

              </tr>
            </thead>
            <tbody id="dta">


            </tbody>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Tahun Akademik</th>
                <th>Date Open</th>
                <th>Date Batas</th>
                <th>Date Close</th>
                <th>Statis</th>
                <th>act</th>
              </tr>
            </tfoot>
          </table>

        </div>
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
    "order": [], 

    "ajax": {
      "url":"<?=base_url()?>registrasi/tables_setting",
      "type": "POST"
    },


    "columnDefs": [
    { 
      "targets": [ 0,6 ], 
      "orderable": false, 
    },
    ],

  });

   $('.btn-add').on('click',function(event) {
     event.preventDefault();
     $('.form-ru').css('display', 'block');
   });

   $('tbody').on('click', '.btn-edit', function(event) {
     event.preventDefault();
     const id=$(this).attr('data');
     $.ajax({
      url: '<?=base_url()?>registrasi/getSetting',
      type: 'GET',
      dataType: 'JSON',
      data: {id:id},
      success : function(res) {
        $('.form-ru').css('display', 'block');
        $('[name=thn]').val(res.thn_akd);
        $('[name=id_]').val(res.id_setting);
        $('[name=tgl_open]').val(res.tgl_mulai.substring(0,10));
        $('[name=time_open]').val(res.tgl_mulai.substring(11,16));
        $('[name=tgl_batas]').val(res.tgl_bts_reg.substring(0,10));
        $('[name=time_batas]').val(res.tgl_bts_reg.substring(11,16));
        $('[name=tgl_close]').val(res.tgl_selesai.substring(0,10));
        $('[name=time_close]').val(res.tgl_selesai.substring(11,16));
        $('[name=status]').val(res.status);
      }
    })

   });

   // $('tbody').on('click', '.btn-open', function(event) {
   //   event.preventDefault();
   //   const nilai=$(this).val();

   // });



   $('#form_reg').submit(function(e) {
    /* Act on the event */

    e.preventDefault();
    e.stopImmediatePropagation();
    const form = $('#form_reg').serialize();
    $.ajax({
      url: '<?=base_url()?>registrasi/saveSetting',
      type: 'POST',
      dataType: 'JSON',
      data: form,
      success : function(res) {
       Swal.fire('Sukses', res.pesan, 'success')
       .then((result) => {
        if (result.value) {
          table.ajax.reload();
          $('.form-ru').css('display', 'none');
          $('#form_reg')[0].reset();
        }
      });
     }
   })

  });
 });

  function cancel() {
    $('.form-ru').css('display', 'none');
    $('#form_reg')[0].reset();
  }

  function portal(id,nilai) {
    $.ajax({
      url: '<?=base_url()?>registrasi/setStatusChange',
      type: 'POST',
      dataType: 'JSON',
      data: {id:id,nilai:nilai},
      success : function(res) {
        if (res.status) {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: res.pesan
          })
          table.ajax.reload();
        }else{
          Swal.fire({
            icon: 'error',
            title: 'Warning',
            text: res.pesan
          })
          table.ajax.reload();
        }

      }
    })
    
  }

</script>