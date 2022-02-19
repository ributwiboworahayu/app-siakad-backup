<div class="row" id="display-validasi">
  <div class="col-sm-12">
    <a href="<?=base_url()?>registrasi/histori" class="btn btn-warning"> <i class="feather icon-arrow-left"></i> Kembali</a>
    <hr>
  </div>

      <?php foreach ($dt_validasi as $vld): 
        ?>

        <div class="col-md-2 col-lg-4" style="margin-bottom: 10px; ">
          <div class="p-20 z-depth-0 waves-effect">
            <div class="card-block text-center">
              <?php if ($vld->status==0): ?>
                <i class="feather icon-refresh-cw text-c-lite-green d-block f-40"></i>
              <?php endif ?>
              <?php if ($vld->status==2): ?>
                <i class="feather icon-check-square text-c-lite-green d-block f-40"></i>
              <?php endif ?>
              <?php if ($vld->status==1): ?>
                <i class="feather icon-alert-triangle text-c-lite-green d-block f-40"></i>
              <?php endif ?>
              <h4 class="m-t-20"><span class="text-c-lite-green"><?=$vld->validator?></span></h4>
              <p></p>
              <?php if ($vld->status==0): ?>
                <button class="btn btn-info btn-sm btn-round">Proses</button>
              <?php endif ?>
              <?php if ($vld->status==2): ?>
                <button class="btn btn-success btn-sm btn-round">Selesai</button>
              <?php endif ?>
              <?php if ($vld->status==1): ?>
                <button class="btn btn-warning btn-sm btn-round">Tunda</button>
              <?php endif ?>
              
            </div>
          </div>
        </div>
      <?php endforeach ?>
      
    </div>