<!-- Begin Page Content -->
<?php if ($kurikulum1 > 0) : ?>
    <div class="card-group">

        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 pb-2 mb-2">
            <div class="panel panel-primary">
                <div class="panel-heading bg-primary">
                    <h5>Filter Data</h5>
                </div>
                <div class="panel-body" style="padding: 10px;">
                    <form role="form" id="form-filter">
                        <div class="form-group">
                            <label for="">Kurikulum</label>
                            <select name="filterkr" id="filterkr" class="form-control">
                                <?php foreach ($kurikulum as $kr) : ?>
                                    <?php if ($kr->id == $selectkk) : ?>
                                        <option value="<?= $kr->id ?>" selected><?= $kr->namakurikulum ?></option>
                                    <?php else : ?>
                                        <option value="<?= $kr->id ?>"><?= $kr->namakurikulum ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Semester</label>
                            <select name="filtersmt" id="filtersmt" class="form-control">
                                <?php if ($pid['id_kaprodi'] != 6) : ?>
                                    <?php foreach ($semester as $s) : ?>
                                        <option value="<?= $s->id_semester ?>"><?= $s->nama_semester ?></option>
                                        <?php if ($s->id_semester == 6) : break;
                                        endif ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <?php foreach ($semester as $s) : ?>
                                        <option value="<?= $s->id_semester ?>"><?= $s->nama_semester ?></option>
                                    <?php endforeach; ?>

                                <?php endif ?>
                            </select>
                        </div>
                        <button type="button" id="btn-filter" class="btn btn-primary btn-out btn-mini">Filter</button>
                        <button type="button" id="btn-filter" class="btn btn-default btn-out btn-mini">Reset</button>
                    </form>


                </div>

            </div>
        </div>

        <div class="col-sm-10">

            <div class="card">
                <div class="card-header">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= validation_errors(); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?= $this->session->flashdata('message'); ?>
                    <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#NewImportModal">import</a>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#NewMatkulModal">Tambah Matakuliah</button>
                </div>

                <div class="card-body">
                    <div class="span" id="mkkr">

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="NewImportModal" tabindex="-1" role="dialog" aria-labelledby="NewImportModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="NewImportModalLabel">Import Mata Kuliah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open_multipart(base_url() . 'distribusi/import_excel/', ['id' => 'form-import']); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Kurikulum</label>
                            <select name="kkid" id="filterkr" class="form-control">
                                <?php foreach ($kurikulum as $kr) : ?>
                                    <option value="<?= $kr->id ?>"><?= $kr->namakurikulum ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="filtersmt" id="filtersmt" class="form-control">
                                <?php if ($pid['id_kaprodi'] != 6) : ?>
                                    <?php foreach ($semester as $s) : ?>
                                        <option value="<?= $s->id_semester ?>"><?= $s->nama_semester ?></option>
                                        <?php if ($s->id_semester == 6) : break;
                                        endif ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <?php foreach ($semester as $s) : ?>
                                        <option value="<?= $s->id_semester ?>"><?= $s->nama_semester ?></option>
                                    <?php endforeach; ?>

                                <?php endif ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="form-custom-file" name="fileExcel" id="fileExcel">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="NewMatkulModal" tabindex="-1" aria-labelledby="NewMatkulModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="NewMatkulModalLabel">Tambah Matakuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open(base_url() . 'distribusi/matakuliahBaru'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kkid">Kurikulum</label>
                        <select name="kkid" id="kkid" class="form-control">
                            <?php foreach ($kurikulum as $kr) : ?>
                                <option value="<?= $kr->id ?>"><?= $kr->namakurikulum ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="smtid">Semester</label>
                            <select name="smtid" id="smtid" class="form-control">
                                <?php if ($pid['id_kaprodi'] != 6) : ?>
                                    <?php foreach ($semester as $s) : ?>
                                        <option value="<?= $s->id_semester ?>"><?= $s->nama_semester ?></option>
                                        <?php if ($s->id_semester == 6) : break;
                                        endif ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <?php foreach ($semester as $s) : ?>
                                        <option value="<?= $s->id_semester ?>"><?= $s->nama_semester ?></option>
                                    <?php endforeach; ?>

                                <?php endif ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="jumlahmk"> Jumlah Mata Kuliah</label>
                            <input type="number" min="1" class="form-control" id="jumlahmk" name="jumlahmk" value="1">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('#filterkr').on('change', function() {
                var kur = $(this).val();
                var smt = $('#filtersmt').val();

                $('#mkkr').load('<?= base_url() ?>distribusi/mk_data?idkk=' + kur + '&idsmt=' + smt);
            });
            $('#filtersmt').on('change', function() {
                var kur = $('#filterkr').val();
                var smt = $(this).val();

                $('#mkkr').load('<?= base_url() ?>distribusi/mk_data?idkk=' + kur + '&idsmt=' + smt);
            });

            mkload();

        });

        function mkload() {
            var id = $('#filterkr').val();
            var smt = $('#filtersmt').val();

            $('#mkkr').load('<?= base_url() ?>distribusi/mk_data?idkk=' + id + '&idsmt=' + smt);
        }
    </script>

<?php else : ?>
    <div class="col-lg">

        <div class="card">
            <div class="card-header">
                <div class="card-body">

                    <div class="alert alert-danger" role="alert">
                        Anda belum memiliki Kurikulum dan Mata Kuliah!<br>Silahkan tambahkan Kurikulum dan Mata Kuliah di menu Kurikulum atau <a href="<?= base_url('distribusi/kurikulum') ?>"><b>klik untuk menambahkan.</b></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>