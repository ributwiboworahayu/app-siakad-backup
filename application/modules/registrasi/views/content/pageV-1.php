<style type="text/css">
    .popover__content {
        opacity: 0;
        visibility: hidden;
        position: absolute;
        right: 90px;
        transform: translate(0, 10px);
        background-color: #bfbfbf;
        padding: 1.5rem;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        width: auto;
        margin-top: 30px;
    }

    .popover__content:before {
        position: absolute;
        z-index: -1;
        content: "";
        right: calc(50% - 10px);
        top: -8px;
        right: 90px;
        border-style: solid;
        border-width: 0 10px 10px 10px;
        border-color: transparent transparent #bfbfbf transparent;
        transition-duration: 0.3s;
        transition-property: transform;
    }

    .popover__wrapper:hover .popover__content {
        z-index: 10;
        opacity: 1;
        visibility: visible;
        transform: translate(0, -20px);
        transition: all 0.5s cubic-bezier(0.75, -0.02, 0.2, 0.97);
    }

    .popover__message {
        text-align: center;
    }
</style>
<div class="row">
    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading bg-primary">
                <h5>Filter Data</h5>
            </div>
            <div class="panel-body" style="padding: 10px;">
                <form role="form" id="form-filter">
                    <div class="form-group">
                        <label for="">Tahun Ajaran</label>
                        <select name="filter_t" id="filter_t" class="form-control">
                            <option value="">All T.A</option>
                            <?php foreach ($alltakad as $tk) : ?>
                                <option <?= ($aktifta == $tk->id_thnakad) ? 'selected' : '' ?> value="<?= $tk->id_thnakad ?>"><?= $tk->ta_tipe ?> <?= $tk->thun_akademik ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Program Studi</label>
                        <select name="filter_p" id="filter_p" class="form-control">
                            <option value="">All Prodi</option>
                            <?php foreach ($prodi as $p) : ?>
                                <option <?= ($p->kode_prodi === $aktifprodi) ? 'selected' : '' ?> value="<?= $p->kode_prodi ?>"><?= $p->nama_prodi ?></option>
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

                    <button type="button" id="btn-filter" class="btn btn-primary btn-out btn-mini">Filter</button>
                    <button type="button" id="btn-filter" class="btn btn-default btn-out btn-mini">Reset</button>
                </form>


            </div>

        </div>
    </div>
    <div class="col-sm-10">
        <!-- Animation card start -->
        <div class="card">
            <div class="card-header">
                <!-- <h5>Enjoy Animation</h5> -->
                <button type="button" class="btn btn-grd-primary btn-mini" onclick="bulk_validasi();"> <i class="ion-ios-keypad"></i> Batch Validasi</button>


            </div>
            <div class="card-block">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <div class="dt-responsive table-responsive">
                                <?= form_open(base_url() . 'registrasi/batchvalidasi', array('id' => 'bulk')) ?>
                                <table id="table" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th><input class="select_all" type="checkbox" name="" value="" placeholder=""></th>
                                            <th>Nim</th>
                                            <th>Nama</th>
                                            <th>Prodi</th>
                                            <th>Semester</th>
                                            <th>Tgl Terdaftar</th>
                                            <th>status</th>
                                            <th>Act</th>

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
                                            <td><span class="badge badge-info">Proses</span><span class="badge badge-warning">Tunda</span><span class="badge badge-success">Ok</span></td>
                                            <td><button type="button" class="btn btn-grd-primary btn-mini">Aksi</button></td>

                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><input class="select_all" type="checkbox" name="" value="" placeholder=""></th>
                                            <th>Nim</th>
                                            <th>Nama</th>
                                            <th>Prodi</th>
                                            <th>Semester</th>
                                            <th>Tgl Terdaftar</th>
                                            <th>status</th>
                                            <th>Act</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <?= form_close() ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Animation card end -->
        </div>

    </div>
</div>

<!-- <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#small-Modal">Small</button> -->
<div class="modal fade" id="small-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h4 class="modal-title">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body">
                <h5 class="text-center mb-4">select Your Action</h5>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="radio" name="test" id="test1" value="" placeholder="">
                        <i class="ion-checkmark-circled aktif" style="font-size: 120px;cursor: pointer;" onclick="pilih(1)"></i>
                    </div>
                    <div class="col-sm-6">
                        <input type="radio" name="test" id="test2" value="" placeholder="">
                        <i class="ion-close-circled tunda" style="font-size: 120px;cursor: pointer;" onclick="pilih(2)"></i>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    var table;
    $(document).ready(function() {
        ajaxcsrf();
        table = $('#table').DataTable({
            "scrollY": "70vh",
            "scrollCollapse": true,
            "paging": false,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url() ?>registrasi/tables_v1",
                "type": "POST",
                "data": function(data) {
                    data.prodi_id = $('#filter_p').val();
                    data.semester_id = $('#filter_s').val();
                    data.takad_id = $('#filter_t').val();
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });
        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(); //just reload table
        });
        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(); //just reload table
        });
        $('.aktif').on('click', function(event) {
            event.preventDefault();
            $(this).css('color', 'green');
            $('.tunda').css('color', 'black');
            $('#test1').attr('checked', true);
            $('#test2').attr('checked', false);
        });

        $('.tunda').on('click', function(event) {
            event.preventDefault();
            $(this).css('color', 'green');
            $('.aktif').css('color', 'black');
            $('#test2').attr('checked', true);
            $('#test1').attr('checked', false);
        });

        $('tbody').on('click', '.valid', function(event) {
            event.preventDefault();
            const id = $(this).attr('data-idtr');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Validasi!' + id
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>registrasi/validasiRegistasi',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            Swal.fire(
                                'Validasi',
                                response.status,
                                'success'
                            )
                            table.ajax.reload(null, false);
                        }
                    })


                }
            })
        });
        $('tbody').on('click', '.tunda', function(event) {
            event.preventDefault();
            const id = $(this).attr('data-idtr');
            Swal.fire({
                title: 'Pesan Kenapa Di Tunda',
                input: 'textarea',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Kirim',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    return login;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>registrasi/validasiRegistasi/' + result.value,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            Swal.fire(
                                'Validasi',
                                response.status,
                                'success'
                            )
                            load();
                        }
                    })

                }
            })
        });

        $(".select_all").on("click", function() {
            if (this.checked) {
                $(".check").each(function() {
                    this.checked = true;
                    $(".select_all").prop("checked", true);
                });
            } else {
                $(".check").each(function() {
                    this.checked = false;
                    $(".select_all").prop("checked", false);
                });
            }
        });

        $("#table tbody").on("click", "tr .check", function() {
            var check = $("#table tbody tr .check").length;
            var checked = $("#table tbody tr .check:checked").length;
            if (check === checked) {
                $(".select_all").prop("checked", true);
            } else {
                $(".select_all").prop("checked", false);
            }
        });

        $("#bulk").on("submit", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            $.ajax({
                url: $(this).attr("action"),
                data: $(this).serialize(),
                type: "POST",
                success: function(respon) {
                    if (respon.status) {
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        Swal.fire({
                            title: "Gagal",
                            text: "Tidak ada data yang dipilih",
                            type: "error"
                        });
                    }
                    load();
                },
                error: function() {
                    Swal.fire({
                        title: "Gagal",
                        text: "Ada data yang sedang digunakan",
                        type: "error"
                    });
                }
            });
        });
    });
    load();

    function load() {
        table.ajax.reload();
    }

    function valid() {
        alert();
    }

    function bulk_validasi() {
        if ($("#table tbody tr .check:checked").length == 0) {
            Swal.fire({
                title: "Gagal",
                text: "Tidak ada data yang dipilih",
                type: "error"
            });
        } else {
            Swal.fire({
                title: "Anda yakin?",
                text: "Data akan divalidasi!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Validasi!"
            }).then(result => {
                if (result.value) {
                    $("#bulk").submit();
                }
            });
        }
    }
</script>