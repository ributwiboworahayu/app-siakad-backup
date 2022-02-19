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
.container {
  background: #232931;
  width: 498px;
  height: auto;
  margin: 0 auto;
  position: relative;
  /*margin-top: 10%;*/
  box-shadow: 2px 5px 20px rgba(119, 119, 119, 0.5);
}

.rightbox {
  padding: 0em 34rem 0em 0em;
  height: 100%;
}

.rb-container {
  font-family: "PT Sans", sans-serif;
  width: 50%;
  margin: auto;
  display: block;
  position: relative;
}

.rb-container ul.rb {
  margin: 2.5em 0;
  padding: 0;
  display: inline-block;
}

.rb-container ul.rb li {
  list-style: none;
  margin: auto;
  margin-left: 2em;
  min-height: 50px;
  border-left: 1px dashed #fff;
  padding: 0 0 50px 30px;
  position: relative;
}

.rb-container ul.rb li:last-child {
  border-left: 0;
}

.rb-container ul.rb li::before {
  position: absolute;
  left: -18px;
  top: -5px;
  content: " ";
  border: 8px solid rgba(255, 255, 255, 1);
  border-radius: 500%;
  background: #50d890;
  height: 20px;
  width: 20px;
  transition: all 500ms ease-in-out;
}

.rb-container ul.rb li:hover::before {
  border-color: #232931;
  transition: all 1000ms ease-in-out;
}

ul.rb li .timestamp {
  color: #50d890;
  position: relative;
  width: 220px;
  font-size: 12px;
}

.item-title {
  color: #fff;
}

.container-3 {
  width: 5em;
  vertical-align: right;
  white-space: nowrap;
  position: absolute;
}

.showme{
  display: none;
}

.showhim:hover .showme{
  display: block;
}


</style>
<div class="row form-ru" style="display: none;">
 <div class="col-sm-12">
  <div class="">
    <div class="card-block">
     <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="panel panel-primary z-depth-0">
          <div class="panel-heading bg-primary f-18">
            Form Setting Portal Registrasi
          </div>
          <div class="panel-body p-2">
            <?= form_open(base_url().'registrasi/savesetting', array('id'=>"form_reg")); ?>
            <input type="hidden" name="method" value="0">
            <div class="form-group">
              <label for="">Tahun Akademik</label>
              <input type="text" id="thn_akd" value="<?=$takad->kode_takad?> : <?=$takad->ta_tipe?>" class="form-control" readonly>
              <input type="hidden" name="id_takad" value="<?=$takad->id_thnakad?>">
            </div>
            <div class="form-group">
              <label for="">Semester</label>
              <select class="form-control" name="semester">
                <option>Pilih Semester</option>
               
                
              </select>
          </div>
          <div class="form-group">
              <label for="">Status portal</label>
              <div>
               <div class="radio radiofill radio-inline">
                <label>
                  <input type="radio" name="status" value="1">
                  Open
                </label>
              </div>
              <div class="radio radiofill radio-inline">
                <label>
                  <input type="radio" name="status" value="0">
                  Close
                </label>
              </div>
            </div>

          </div>
          <div class="form-group">
              <label for="">Keterangan</label>
              <textarea name="keterangan" class="form-control"></textarea>
            </div>
          <div class="form-group">
            <label for="">Date Open Portal And Mulai Registrasi</label>
            <div class="row">
              <div class="col-sm-5">
                <input type="date" class="form-control" id="date-start-port" name="date_start" placeholder="Input field">
              </div>
              <div class="col-sm-4">
                <input type="time" class="form-control" id="time-start-port" name="time_start" placeholder="Input field">
              </div>
              <div class="col-sm-3">
                <button type="button" class="btn btn-sm btn-warning" onclick="SetUp();">Set Up</button>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Date Batas Registrasi MHS</label>
            <div class="row">
              <div class="col-sm-9">
                <input type="date" class="form-control" id="date-end-reg-mhs" name="date_end_reg" placeholder="Input field" readonly="">
              </div>
              <div class="col-sm-3">
                <input type="time" class="form-control" id="time-end-reg-mhs" name="time_end_reg" placeholder="Input field" readonly="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Date Validasi Validator</label>
            <div class="row">
              <div class="col-sm-9">
                <input type="date" class="form-control" id="date-validasi-validator" placeholder="Input field" readonly="">
              </div>
              <div class="col-sm-3">
                <input type="time" class="form-control" id="time-validasi-validator" placeholder="Input field" readonly="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Date end validasi validator</label>
            <div class="row">
              <div class="col-sm-9">
                <input type="date" class="form-control" id="date-end-validasi-validator" placeholder="Input field" readonly="">
              </div>
              <div class="col-sm-3">
                <input type="time" class="form-control" id="time-end-validasi-validator" placeholder="Input field" readonly="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Date validasi Kaprodi</label>
            <div class="row">
              <div class="col-sm-9">
                <input type="date" class="form-control" id="date-validasi-kaprodi" placeholder="Input field" readonly="">
              </div>
              <div class="col-sm-3">
                <input type="time" class="form-control" id="time-validasi-kaprodi" placeholder="Input field" readonly="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Date end validasi kaprodi</label>
            <div class="row">
              <div class="col-sm-9">
                <input type="date" class="form-control" id="date-end-validasi-kaprodi" placeholder="Input field" readonly="">
              </div>
              <div class="col-sm-3">
                <input type="time" class="form-control" id="time-end-validasi-kaprodi" placeholder="Input field" readonly="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Date re:validasi validator</label>
            <div class="row">
              <div class="col-sm-9">
                <input type="date" class="form-control" id="date-revalidasi-validator" placeholder="Input field" readonly="">
              </div>
              <div class="col-sm-3">
                <input type="time" class="form-control" id="time-revalidasi-validator" placeholder="Input field" readonly="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Date end re:validasi validator</label>
            <div class="row">
              <div class="col-sm-9">
                <input type="date" class="form-control" id="date-end-revalidasi-validator" placeholder="Input field" readonly="">
              </div>
              <div class="col-sm-3">
                <input type="time" class="form-control" id="time-end-revalidasi-validator" placeholder="Input field" readonly="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Date re:validasi Kaprodi</label>
            <div class="row">
              <div class="col-sm-9">
                <input type="date" class="form-control" id="date-revalidasi-kaprodi" placeholder="Input field" readonly="">
              </div>
              <div class="col-sm-3">
                <input type="time" class="form-control" id="time-revalidasi-kaprodi" placeholder="Input field" readonly="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Date end re:validasi Kaprodi</label>
            <div class="row">
              <div class="col-sm-9">
                <input type="date" class="form-control" id="date-end-revalidasi-kaprodi" placeholder="Input field" readonly="">
              </div>
              <div class="col-sm-3">
                <input type="time" class="form-control" id="time-end-revalidasi-kaprodi" placeholder="Input field" readonly="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Date close portal</label>
            <div class="row">
              <div class="col-sm-9">
                <input type="date" class="form-control" id="date-close-portal" name="date_close" placeholder="Input field" readonly="">
              </div>
              <div class="col-sm-3">
                <input type="time" class="form-control" id="time-close-portal" name="time_close" placeholder="Input field" readonly="">
              </div>
            </div>
          </div>

        </div>
        <div class="panel-footer text-primary">
          <button type="submit" class="btn btn-primary save-rug">Simpan</button>
          <button type="button" class="btn btn-default" onclick="cancel();">Batal</button>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Animation card end -->
</div>

</div>
</div>
<div class="row tb-data">
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
                <th>Date Portal</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>act</th>
              </tr>
            </thead>
            <tbody id="dta">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="modal fade" id="md-timeline" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content z-depth-0">
      <div class="container">
        <div class="rightbox">
          <div class="rb-container">
            <ul class="rb" style="width:420px">
            </ul>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
<script type="text/javascript">
  var table;
  $(document).ready(function() {
   ajaxcsrf(); 
   // testing new script
  //  $('#setup').on('click', function(event) {
  //    event.preventDefault();
  //    var chooseDate=new Date($('#start_reg').val());
  //    chooseDate.setDate(chooseDate.getUTCDate()+7);
  //    var futureDate=chooseDate.getFullYear()+'-'+('0'+(chooseDate.getMonth()+1)).slice(-2)+'-'+('0'+(chooseDate.getDate())).slice(-2);
  //    $('[name=tgl_end_reg]').val(futureDate);
  //    $('[name=time_end_reg]').val('16:00');
  //   // alert(futureDate);
  // });
   
   $('#dta').on('click', '.cektimeline', function(event) {
    event.preventDefault();
    var id=$(this).attr('data-id');

    $.get('<?=base_url()?>registrasi/jsontimeline?id='+id, function(data) {
     var timeline='';
     $.each(data, function(index, val) {
       timeline +='<li class="rb-item" ng-repeat="itembx">'+
       '<div class="timestamp">'+val.tanggal+
       '<br>'+val.jam+
       '</div>'+
       '<div class="item-title">'+val.aktivitas+'</div>'+
       '</li>';
       // console.log(val);
     });

     $('#md-timeline').modal('show');
     $('.rb').html(timeline);
   });
  // 
  console.log(id);
});

   // 

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
      "targets": [ 0,4 ], 
      "orderable": false, 
    },
    ],

  });

   $('.btn-add').on('click',function(event) {
     event.preventDefault();
     $('.form-ru').css('display', 'block');
     $('.tb-data').css('display', 'none');
     getSemester();
   });

   $('tbody').on('click', '.btn-edit', function(event) {
     event.preventDefault();
     const id=$(this).attr('data');
     $.get('<?=base_url()?>registrasi/getSetting?id='+id, function(data) {
      $('[name="method"]').val(data.id_setting);
      $('[name="id_takad"]').val(data.id_akademik);
      $('#thn_akd').val(data.thn_akd);
       $('#semester').val(data.semester);
       $('#date-start-port').val(data.date_start);
       $('#time-start-port').val(data.time_start);
       $('[name="keterangan"]').val(data.keterangan);
       $('input[name="status"][value="'+data.status+'"]').prop('checked',true);
       $('.form-ru').css('display', 'block');
       $('.tb-data').css('display', 'none');
       SetUp();
       getSemester(data.semester);
       console.log(data);
     });

   });

   $('tbody').on('click', '.btn-hapus-sett', function(event) {
     event.preventDefault();
     var id=$(this).attr('data-id');
     $.post('<?=base_url()?>registrasi/deletesettingregistrasi', {id: id}, function(data, textStatus, xhr) {
        if (data.respon=='200') {
          Swal.fire('Sukses', 'Setting Reg Berhasil Dihapus', 'success');
          table.ajax.reload();
        }
     });
   });


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
       Swal.fire('Sukses', res.message, 'success')
       .then((result) => {
        if (result.value) {
          $('#form_reg')[0].reset();
          table.ajax.reload();
          $('.form-ru').css('display', 'none');
          $('.tb-data').css('display', 'block');
          
        }
      });
     }
   })

  });
});

  function cancel() {
    $('.form-ru').css('display', 'none');
    $('.tb-data').css('display', 'block');
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

  function SetUp() {
   var date=$('#date-start-port').val();
   $.post('<?=base_url()?>registrasi/formtimeline', {date_start: date}, function(data, textStatus, xhr) {
    $.each(data, function(index, val) {
      $('#'+val.id_date).val(val.tanggal);
      $('#'+val.id_time).val(val.jam);
    });
  });
     // console.log(date);
   }

   function getSemester(id=null) {
     var id_takad=$('[name="id_takad"]').val();
     var opsi='';
     $.get('<?=base_url()?>registrasi/getSemester?id='+id_takad, function(data) {
       $.each(data, function(index, val) {
        var selected=(id==val.id_semester)? 'selected':'';
          opsi +='<option '+selected+' value="'+val.id_semester+'">'+val.nama_semester+'</option>';

       });
       $('[name="semester"]').html(opsi);
       
     });
     console.log(id);
   }

 </script>