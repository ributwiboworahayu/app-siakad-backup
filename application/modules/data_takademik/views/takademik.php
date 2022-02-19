 <div class="row">


  <div class="col-xl-12">
    <div class="card">
      <div class="card-header">

        <hr>
        <button type="button" class="btn btn-out btn-primary btn-square btn-sm " data-toggle="modal" href='#modal-add'><i class="ion-plus-round"></i> New data</button>
        <!-- <a href="<?=base_url()?>data_prodi/setkaprodi" class="btn btn-out btn-info btn-square btn-sm " ><i class="ion-gear-b"></i> Setting Kaprodi</a> -->
        <button type="button" class="btn btn-out btn-danger btn-square btn-sm"><i class="ion-trash-a"></i> Bulk Hapus</button>
        <button type="button" class="btn btn-out btn-dark btn-square btn-sm"><i class="ion-refresh"></i> Refresh</button>
        <hr>
      </div>

      <div class="card-block">
        <div class="dt-responsive table-responsive">
          <table id="table" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Akademik</th>
                <th>Tahun Akademik</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Edit</th>
                <th><input type="checkbox" name="" value="" placeholder=""></th>
              </tr>
            </thead>
            <tbody>
              <tr>

                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td><button type="button" class="btn btn-out btn-warning btn-square btn-mini" data-toggle="modal" href='#modal-add'><i class="ion-edit"></i> Edit</button></td>
                <td><input type="checkbox" name="" value="" placeholder=""></td>
                <td><input type="checkbox" name="" value="" placeholder=""></td>
              </tr>

            </tbody>
            <tfoot>
              <tr>
               <th>No</th>
               <th>Kode Akademik</th>
               <th>Tahun Akademik</th>
               <th>Keterangan</th>
               <th>Status</th>
               <th>Edit</th>
               <th><input type="checkbox" name="" value="" placeholder=""></th>
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

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        // "lengthMenu": [100,500,1000,2000,5000,10000,50000,100000],
        "order": [], //Initial no order.
        // "scrollY":        "75vh",
        // "scrollX":        true,
        "scrollCollapse": false,
        "paging":         true,
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?=base_url()?>data_takademik/tables_takad",
            "type": "POST",
            "data": function ( data ) {
                // data.takad_id = $('#filter_t').val();
                // data.prodi_id = $('#filter_p').val();
                // data.semester_id = $('#filter_s').val();
                // data.kelas_id = $('#filter_k').val();
                // data.keyreg = $('#filter_kr').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
       // dom: 'Bfrtip',
       //  buttons: [
       //          {
       //          extend: 'pdfHtml5',
       //          messageTop: 'PDF created by PDFMake with Buttons for DataTables.',
       //          orientation: 'potrait',
       //          pageSize: 'LEGAL'
       //          },
       //          {
       //      extend: 'excelHtml5',
       //      autoFilter: true,
       //      sheetName: 'Exported data'
       //  }
       //  ]

    });
     $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });
 });
  takadLoad();
function takadLoad() {
    table.ajax.reload()
}

</script>