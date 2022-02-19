
<div class="row">
   <div class="col-sm-12">
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
      "type": "POST"
    },


    "columnDefs": [
    { 
      "targets": [ 0,3 ], 
      "orderable": false, 
    },
    ],

  });
  });
</script>