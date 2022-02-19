<div class="row">
    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading bg-primary">
                <h5>Filter Data</h5>
            </div>
            <div class="panel-body" style="padding: 10px;">
                <form role="form" id="form-filter">

                    <div class="form-group">
                        <label for="">Program Studi</label>
                        <select name="filter_p" id="filter_p" class="form-control">
                            <option value="">All Prodi</option>
                            <?php foreach ($prodi as $p) : ?>
                                <option value="<?= $p->kode_prodi ?>"><?= $p->nama_prodi ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Semester</label>
                        <select name="filter_s" id="filter_s" class="form-control">
                            <option value="">All Semester</option>
                            <?php foreach ($semester as $s) : ?>
                                <option value="<?= $s->id_semester ?>"><?= $s->nama_semester ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Kelas</label>
                        <select name="filter_k" id="filter_k" class="form-control">
                            <option value="">All Kelas</option>
                            <?php foreach ($kelas as $k) : ?>
                                <option value="<?= $k->id_kelas ?>"><?= $k->nama_kelas ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="button" id="btn-filter" class="btn btn-primary btn-out btn-mini">Filter</button>
                    <button type="button" id="btn-filter" class="btn btn-default btn-out btn-mini">Reset</button>
                </form>
                <input type="hidden" name="filter_kr" id="filter_kr" value="<?= $keyreg ?>" placeholder="">
                <input type="hidden" name="filter_t" id="filter_t" value="<?= $takad ?>" placeholder="">

            </div>

        </div>
    </div>
    <div class="col-sm-10">
        <!-- Animation card start -->
        <div class="card">
            <div class="card-header">
                <!-- <h5>Enjoy Animation</h5> -->
                <?php if ($this->session->userdata('id_jabatan') == 8) : ?>
                    <a href="<?= base_url() ?>registrasi/datareg" class="btn btn-grd-warning btn-mini"> <i class="ti-arrow-left"></i> Kembali</a>
                <?php endif ?>
                <?php if ($this->session->userdata('id_jabatan') == 10) : ?>
                    <a href="<?= base_url() ?>registrasi/datapendaftar" class="btn btn-grd-warning btn-mini"> <i class="ti-arrow-left"></i> Kembali</a>
                <?php endif ?>
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
                                            <th>Nim</th>
                                            <th>Nama</th>
                                            <th>Prodi</th>
                                            <th>Semester</th>
                                            <?php if ($keyreg != '') : ?>
                                                <th>Tgl Terdaftar</th>
                                            <?php endif ?>

                                            <th>status</th>
                                            <!-- <th>Act</th> -->

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <th>2019001</th>
                                            <td>Mahdiawan nurkholifah</td>
                                            <td>TIF</td>
                                            <td>1 <i class="ion-arrow-right-c"></i> 2</td>
                                            <td>20 sep 2020</td>
                                            <!-- <td><span class="badge badge-info">Proses</span><span class="badge badge-warning">Tunda</span><span class="badge badge-success">Ok</span></td> -->

                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nim</th>
                                            <th>Nama</th>
                                            <th>Prodi</th>
                                            <th>Semester</th>
                                            <?php if ($keyreg != '') : ?>
                                                <th>Tgl Terdaftar</th>
                                            <?php endif ?>
                                            <th>status</th>
                                            <!-- <th>Act</th> -->
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
<div class="modal fade" id="view-status" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Validator</th>
                                <th>Status</th>
                                <th>Tgl Validasi</th>
                                <th>Pesan</th>
                            </tr>
                        </thead>
                        <tbody id="tb-data">

                        </tbody>
                    </table>
                    <button type="button" class="btn btn-secondary waves-effect btn-block" data-dismiss="modal">Close</button>
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
            "scrollY": "75vh",
            // "scrollX":        true,
            "scrollCollapse": false,
            "paging": false,
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url() ?>registrasi/tables_vreg",
                "type": "POST",
                "data": function(data) {
                    data.takad_id = $('#filter_t').val();
                    data.prodi_id = $('#filter_p').val();
                    data.semester_id = $('#filter_s').val();
                    data.kelas_id = $('#filter_k').val();
                    data.keyreg = $('#filter_kr').val();
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    messageTop: 'PDF created by PDFMake with Buttons for DataTables.',
                    orientation: 'potrait',
                    pageSize: 'LEGAL'
                },
                {
                    extend: 'excelHtml5',
                    autoFilter: true,
                    sheetName: 'Exported data'
                }
            ]

        });
        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(); //just reload table
        });

        $('tbody').on('click', '.btn-cek-validasi', function(event) {
            event.preventDefault();
            var id = $(this).attr('data-id');
            var table = '';
            $.post('<?= base_url() ?>registrasi/getallcekingvalidasi', {
                id: id
            }, function(data, textStatus, xhr) {
                $.each(data, function(index, val) {
                    table += '<tr>' +
                        '<td>' + val.validator + '</td>' +
                        '<td>' + val.status + '</td>' +
                        '<td>' + val.pesan + '</td>' +
                        '<td>' + val.tgl_valid + '</td>' +
                        '</tr>';
                });
                $('#view-status').modal('show');
                $('#tb-data').html(table);
            });
        });
    });
    takadLoad();

    function takadLoad() {
        table.ajax.reload()
    }
</script>