
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
        <div class="panel panel-primary">
          <div class="panel-heading bg-primary">
            <h5>Filter Data</h5>
        </div>
        <div class="panel-body" style="padding: 10px;">
            <form role="form" id="form-filter">

              <div class="form-group">
                <label for="">Tahun Akademik</label>
                <select name="filter_t" id="filter_t" class="form-control" >
                  <option value="">Pilih data</option>
                  <?php foreach ($takadall as $p) :?>
                    <option <?=$takadaktif->id_thnakad==$p->id_thnakad? 'selected':''?> value="<?=$p->id_thnakad?>"><?=$p->kode_takad?> <?=$ta->tipe?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="button" id="btn-filter" class="btn btn-primary btn-out btn-mini">Filter</button>
        <button type="button" id="btn-filter" class="btn btn-default btn-out btn-mini">Reset</button>
    </form>
</div>

</div>
</div>
<div class="col-sm-9">
    <!-- Animation card start -->
    <div class="card">
        <div class="card-header">
            <!-- <h5>Enjoy Animation</h5> -->

        </div>
        <div class="card-block">
           <div class="row">

            <div class="col-sm-12">
                <div class="table-responsive">
                    <div class="dt-responsive table-responsive">

                        <table id="table" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Akademik</th>
                                    <th>keterangan</th>
                                    <th>Data</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    
                                </tr>
                            </tbody>
                            <tfoot>
                               <tr>
                                <th>No</th>
                                <th>Tahun Akademik</th>
                                <th>keterangan</th>
                                <th>Data</th>
                            </tr>
                        </tfoot>
                    </table>

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

        "processing": true, 
        "serverSide": true, 
        "order": [], 

        "ajax": {
          "url":"<?=base_url()?>registrasi/tables_datareg",
          "type": "POST",
          "data": function ( data ) {
                data.takad_id = $('#filter_t').val();
            }
      },


      "columnDefs": [
      { 
          "targets": [ 0,3 ], 
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
 });
</script>