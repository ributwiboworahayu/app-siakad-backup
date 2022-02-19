<style type="text/css" media="screen">
  .container {
    color: #333;
    margin: 0 auto;
    text-align: center;
  }

  h1 {
    font-weight: normal;
    letter-spacing: .125rem;
    text-transform: uppercase;
  }

  .timer {
    display: inline-block;
    font-size: 1.5em;
    list-style-type: none;
    padding: 1em;
    text-transform: uppercase;
  }

  .timer span {
    display: block;
    font-size: 4.5rem;
    font-weight: bold;
    color:red;
  }

  .message {
    font-size: 4rem;
  }

  #content {
    display: none;
    padding: 1rem;
  }

  .emoji {
    padding: 0 .25rem;
  }

  @media all and (max-width: 768px) {
    h1 {
      font-size: 1.5rem;
    }

    .timer {
      font-size: 1.125rem;
      padding: .75rem;
    }

    .timer span {
      font-size: 3.375rem;
    }
  } 
</style>
<!-- <div class="card">
  <div class="card-header">
    <h5>All Side</h5>

  </div>
  <div class="card-block box-list"> -->
    <div class="row" id="display-before"  <?=$ui['dis_before']?>>
      <div class="col-lg-12">
        <div class="p-20 z-depth-0 waves-effect">
          <div class="container">
            <h1 id="headline">Waktu Pendaftaran Akan di Mulai</h1>
            <div id="countdown">
              <ul>
                <li class="timer"><span id="days">55</span>days</li>
                <li class="timer"><span id="hours">10</span>Hours</li>
                <li class="timer"><span id="minutes">24</span>Minutes</li>
                <li class="timer"><span id="seconds">00</span>Seconds</li>
              </ul>
            </div><br>
            <h1 id="headline">Silahkan tunggu</h1>
          </div>
        </div>
      </div>

    </div>
    <div class="row" id="display-before"  <?=$ui['dis_portal']?>>
      <div class="col-lg-12">
        <div class="p-20 z-depth-0 waves-effect">
          <div class="container">
            <h1 id="headline">PORTAL PENDAFTARAN REGISTRASI TELAH DI TUTUP</h1>
            <div id="countdown">
              <div id="msg-selesai" class="timer" <?=$ui['msg_selesai']?>><span style="font-size: 4rem">!! PORTAL HAS CLOSED !!</span></div>
            </div>
            <br>
            <h1 id="headline">Silahkan tunggu PORTAL REGISTRASI SEMESTER SELANJUTNYA</h1>
          </div>
        </div>
      </div>
      
    </div>
    <br>
    <div class="row" id="display-after" <?=$ui['dis_after']?> >
      <div class="col-sm-6">
        <div class="p-20 z-depth-0 waves-effect">
          <?= form_open(base_url().'registrasi/savependaftaran',['id'=>'form-reg']); ?>

            <div class="row form-group">
              <div class="col-lg-4">
                <label for="">Nama Mahaiswa</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="" placeholder="Input field" value="<?=$dt_mahasiswa->nama?>" readonly >
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-4">
                <label for="">NIM Mahaiswa</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="" placeholder="Input field" value="<?=$dt_mahasiswa->nim?>" readonly>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-4">
                <label for="">Program Studi</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="" placeholder="Input field" value="<?=getDetailProdi($dt_mahasiswa->prodi_id)?>" readonly>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-4">
                <label for="">Semester</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="" placeholder="Input field" value="<?=getDetailSemester($dt_mahasiswa->semester_id)?>" readonly>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-4">
                <label for="">Tahun Akademik</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="" placeholder="Input field" value="<?=getDetailAKD($thun_akademik->id_thnakad)?>" readonly>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-4">
                <label for="">IPK</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="" placeholder="Input field" value="-" readonly>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-4">
                <label for="">Status</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="" placeholder="Input field" value="-" readonly>
              </div>
            </div>
            <input type="hidden" name="mhs_id" value="<?=$dt_mahasiswa->id_mhs?>" placeholder="">
            <input type="hidden" name="setting_id" value="<?=$ru_setting->id_setting?>" placeholder="">
            <input type="hidden" name="takad_id" value="<?=$thun_akademik->id_thnakad?>" placeholder="">
            <input type="hidden" name="semester_sebelum" value="<?=$dt_mahasiswa->semester_id?>" placeholder="">
            <input type="hidden" name="semester_pengajuan" value="<?=$dt_mahasiswa->semester_id+1?>" placeholder="">
            

            <?=$ui['dis_btn']?>
            <button type="button" class="btn btn-primary btn-cek-vld" hidden>Cek Registrasi</button>
            
          <?= form_close(); ?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="p-20 z-depth-0 waves-effect">
          <div class="container">
            <h1 id="headline">Waktu Pendaftaran Akan Berakhir Dalam</h1>
            <div id="msg-selesai" class="timer" <?=$ui['msg_selesai']?>><span style="font-size: 4rem">PENDAFTARAN BERAKHIR</span></div>
            <div id="countdown-1" <?=$ui['counttimer']?>>
              <ul>
                <li class="timer"><span id="days-a"></span>days</li>
                <li class="timer"><span id="hours-a"></span>Hours</li>
                <li class="timer"><span id="minutes-a"></span>Minutes</li>
                <li class="timer"><span id="seconds-a"></span>Seconds</li>
              </ul>
            </div><br>
            <h1 id="headline">Silahkan Lakukan Pendaftaran</h1>
          </div>
        </div>
      </div>
    </div>
    <hr style="margin-bottom:8rem;margin-top: 8rem;">
    <div class="row" id="display-validasi" <?=$ui['dis_validasi']?>>
      <?php foreach ($dt_validasi as $vld): 
        ?>

        <div class="col-md-2 col-lg-4" style="margin-bottom: 10px;">
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
              <?php if ($vld->status==1): ?>
                <button class="btn btn-success btn-sm btn-round">Selesai</button>
              <?php endif ?>
              <?php if ($vld->status==2): ?>
                <button class="btn btn-warning btn-sm btn-round">Tunda</button>
                <p> Notes : <?=$vld->pesan?></p>
              <?php endif ?>
              
            </div>
          </div>
        </div>
      <?php endforeach ?>
      
    </div>
<!--   </div>
</div> -->
<script>
  $(document).ready(function() {
    portal();
  $('.btn-cek-vld').on('click',function(event) {
    event.preventDefault();
    $('html, body').animate({ scrollTop: $('#display-validasi').offset().top }, 'slow');
  });

   $('#form-reg').submit(function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    const form=$(this).serialize();
    $.ajax({
      url: '<?=base_url()?>registrasi/savependaftaran',
      type: 'POST',
      dataType: 'JSON',
      data: form,
      success : function(res) {
        if (res.status) {
          Swal.fire({
          icon: 'success',
          title: 'Sukses',
          text: 'Pendaftaran Berhasil Di Lakukan',
        }).then((result) => {
        if (result.value) {
          location.reload();

        }
      });
      }else{
        Swal.fire({
          icon: 'warning',
          title: 'Galat',
          text: 'Anda Telah Telah Melakukan Pendaftaran',
        }).then((result) => {
        if (result.value) {
          location.reload();

        }
      });
        
      }
      }
    })
    });
  });
// Set the date we're counting down to

function portal() {

var countDownDate = new Date("<?=$tgl_mulai?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("days").innerHTML = days;
  document.getElementById("hours").innerHTML = hours;
  document.getElementById("minutes").innerHTML = minutes;
  document.getElementById("seconds").innerHTML = seconds;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    mulaiReg();
    // document.getElementById("demo").innerHTML = "EXPIRED";

  }
}, 1000);
}
function mulaiReg() {
  // body...

// Set the date we're counting down to
var countDownDate = new Date("<?=$tgl_batas?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("days-a").innerHTML = days;
  document.getElementById("hours-a").innerHTML = hours;
  document.getElementById("minutes-a").innerHTML = minutes;
  document.getElementById("seconds-a").innerHTML = seconds;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    // $('#msg-selesai').html('<div class="timer"><span id="headline">PENDAFTARAN BERAKHIR</span></div>');
    // document.getElementById("countdown-1").style.display="none";
  }
}, 1000);
} 
</script>