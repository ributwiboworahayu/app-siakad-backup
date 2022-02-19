<div class="row">

<div class="col-xl-12" id="tbl-menu" style="display: block;">
  <!-- Editable table -->
  <div class="card">
    <div class="card-header">
      <!-- <button type="button" class="btn btn-primary btn-sm" id="add-menu"><i class="fas fa-plus"></i>Add Menu</button> -->
    </div>
    <div class="card-block">
      <div class="dt-responsive table-responsive">
        <table id="table" class="table table-striped table-bordered nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Level</th>
              <th>Akses Menu</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Tiger Nixon</td>
              <td>System Architect</td>
              <td>Edinburgh</td>
              <td>61</td>
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
              "url": "<?=base_url()?>pengguna_akses/tables",
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
  });
</script>