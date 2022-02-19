var table;
var url='http://localhost/app-new-main/';
$(document).ready(function() {

	 table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "http://localhost/app-new-main/data_mhs/datatable"
            "type": "POST",
            "data": function ( data ) {
                data.prodi_id = $('#filter_p').val();
                data.semester_id = $('#filter_s').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
        

    });

    // $('#btn-filter').click(function(){ //button filter event click
    //     table.ajax.reload();  //just reload table
    // });
    // $('#btn-reset').click(function(){ //button reset event click
    //     $('#form-filter')[0].reset();
    //     table.ajax.reload();  //just reload table
    // });	
});