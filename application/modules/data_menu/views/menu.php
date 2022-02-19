<div class="row">
  <div class="col-sm-12" id="form-menu" style="display: none;">

   <div class="j-wrapper j-wrapper-640">
     <?= form_open(base_url().'data_menu/savemenu', array('id' =>"f-menu" ,'class'=>"j-pro" )); ?>

      <div class="j-content">
       <legend style="text-align: center;margin-bottom: 10px;">FORM MENU</legend>
       <div class="j-unit">
        <label class="j-label">Tipe Menu</label>
        <div class="j-input j-select">
          <label class="j-input j-select">
            <select name="tipe">
              <option value="">Pilih Tipe</option>
              <option value="0">Parent</option>
              <option value="1">Child</option>
              <option value="2">Sub Child</option>
            </select>
            <i></i>
          </label>
          </div>
        </div>
        <div class="j-unit">
          <label class="j-label">Parent Menu</label>
          <div class="j-input">
            <label class="j-input j-select">
            <select name="parent">
              <option value="">Pilih Tipe</option>
              <option value="0">Parent</option>
              <option value="1">Child</option>
              <option value="2">Sub Child</option>
            </select>
            <i></i>
          </label>
          </div>
        </div>
        <div class="j-unit">
          <label class="j-label">Sub Menu</label>
          <div class="j-input">
            <label class="j-input j-select">
            <select name="submenu">
              <option value="">Pilih Tipe</option>
              <option value="0">Parent</option>
              <option value="1">Child</option>
              <option value="2">Sub Child</option>
            </select>
            <i></i>
          </label>
          </div>
        </div>
        <div class="j-unit">
          <label class="j-label">Kode Menu</label>
          <div class="j-input">
            <input type="text" id="name" name="kode_menu">
          </div>
        </div>
        <div class="j-unit">
          <label class="j-label">Nama Menu</label>
          <div class="j-input">
            <input type="text" id="name" name="nama_menu">
          </div>
        </div>
        <div class="j-unit">
          <label class="j-label">Url</label>
          <div class="j-input">
            <input type="text" id="name" name="url" value="#">
          </div>
        </div>
        

      </div>
      <!-- end /.content -->
      <div class="j-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" id="cancel-form">Cancel</button>
      </div>
      <!-- end /.footer -->
        <?= form_close(); ?>
  </div>
</div>
<div class="col-xl-12" id="tbl-menu" style="display: block;">
  <!-- Editable table -->
  <div class="card">
    <div class="card-header">
      <button type="button" class="btn btn-primary btn-sm" id="add-menu"><i class="fas fa-plus"></i>Add Menu</button>
    </div>
    <div class="card-block">
      <div class="dt-responsive table-responsive">
        <table id="table" class="table table-striped table-bordered nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Tipe</th>
              <th>Parent</th>
              <th>Kode Menu</th>
              <th>Nama Menu</th>
              <th>Url</th>
              <th>main_sub</th>
              <th>Action</th>
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
              <td>$320,800</td>
              <td>$320,800</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Editable table -->
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
            "scrollCollapse": true,
            "paging":         true,
            "order": [], 

            "ajax": {
              "url": "<?=base_url()?>data_menu/tables",
              "type": "POST",
              "data": function ( data ) {

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
    $('#add-menu').on('click',function(event) {
      event.preventDefault();
      $('#form-menu').css('display', 'block');
      $('#tbl-menu').css('display', 'none');
    });
    $('#cancel-form').on('click',function(event) {
      event.preventDefault();
      $('#form-menu').css('display', 'none');
      $('#tbl-menu').css('display', 'block');
    });

    $('[name="tipe"]').change(function(event) {
      var value=$(this).val();
      if (value==0) {
        $('[name="parent"]').html('<option selected value="NULL">NULL</option>').attr('readonly',true);
        $('[name="url"]').val('#').attr('readonly', true);
        $('[name="submenu"]').html('<option selected value="0">Main Menu</option>').attr('readonly',true);
      }else if(value==1){
        $('[name="submenu"]').attr('disabled', false);
        GetParent();
      }else{
        $('[name="submenu"]').attr('disabled', false);
        GetParent();
      }

    });

    $('[name="parent"]').change(function(event) {
      /* Act on the event */
      var value=$(this).val();

      GetSubMenu(value);
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
            success(respon.msg);
            $('#form-menu').css('display', 'none');
            $('#tbl-menu').css('display', 'block');
            table.ajax.reload();
          }
        }
      })
      
      
    });

  });

  function GetParent() {
    var opsi='';
    opsi='<option value="">Pilih Paren Menu</option>';
    $.get('<?=base_url()?>data_menu/getallparentmenu', function(data) {
      $.each(data, function(index, val) {
         opsi +='<option value="'+val.parent+'">'+val.parent+'</option>';
      });
      $('[name="parent"]').html(opsi).attr('disabled',false);
    });
  }

  function GetSubMenu(id) {
    var tipe=$('[name="tipe"]').val();
    var val=id;

    var opsi='';
    $.post('<?=base_url()?>data_menu/getallsubmenu', {tipe: tipe,val:val}, function(data, textStatus, xhr) {
      $.each(data, function(index, val) {
        opsi +='<option value="'+val.id+'">'+val.nama_menu+'</option>';
      });
      $('[name="submenu"]').html(opsi).attr('disabled',false);
    });

    $('[name="kode_menu"]').val(id+'-');
    
  }
</script>