<!-- Begin Page Content -->

<div class="card col-lg-11 mx-auto">
    <div class="card-header">
        <a class="btn btn-warning btn-sm" href="<?= base_url('distribusi/lintasprodi') ?>">Menu Lintas Prodi</a>
        <a class="btn btn-primary btn-sm" href="<?= base_url('distribusi/dlb') ?>">Menu Dosen Luar Biasa</a>
    </div>
    <div class="card-body">
        <div class="text-center">
            <h5 class="text-uppercase"><strong> <?= $judul; ?></strong></h5><br><br>
        </div>
        <?= form_error('dosenpk[]', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>
        <!-- <?= form_error('matakuliah[]', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?> -->
        <?= $this->session->flashdata('message'); ?>
        <?php if ($kcek > 0) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Silahkan pilih kurikulum dan semester untuk memilih mata kuliah!
            </div>
            <div class="form-group row">
                <label for="selectkk" class="col-sm-2 col-form-label">Kurikulum</label>
                <div class="col-sm-5">
                    <select class="form-control" id="selectkk" name="selectkk">
                        <option disabled selected> -- Pilih Kurikulum --</option>
                        <?php foreach ($kurikulum as $kr) : ?>
                            <option value="<?= $kr['id']; ?>">Kurikulum <?= $kr['namakurikulum']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="selectsmt" class="col-sm-2 col-form-label">Semester</label>
                <div class="col-sm-5">
                    <select class="form-control" id="selectsmt" name="selectsmt">
                        <option disabled selected> -- Pilih Semester -- </option>
                        <?php if ($proid->kode_prodi != 14) : ?>
                            <?php foreach ($semester as $smt) : ?>
                                <option value="<?= $smt['id_semester']; ?>"><?= $smt['nama_semester']; ?></option>
                                <?php if ($smt['id_semester'] == 6 || $smt['id_semester'] == 5) : break;
                                endif; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <?php foreach ($semester as $smt) : ?>
                                <option value="<?= $smt['id_semester']; ?>"><?= $smt['nama_semester']; ?></option>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </select>
                </div>
            </div>
            <div id="dsst">

            </div>
            <br><br><br>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Anda belum memiliki Kurikulum dan Mata Kuliah!<br>Silahkan tambahkan Kurikulum dan Mata Kuliah di menu Kurikulum atau <a href="<?= base_url('distribusi/kurikulum') ?>"><b>klik untuk menambahkan.</b></a>
            </div>
        <?php endif ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        var kur;
        var smt;
        $('#selectkk').on('change', function() {
            const idkk = $(this).val();
            kur = idkk;

            $('#dsst').load('<?= base_url() ?>distribusi/form_dist?idkk=' + kur + '&idsmt=' + smt);
        });
        $('#selectsmt').on('change', function() {
            const idsmt = $(this).val();
            smt = idsmt;

            $('#dsst').load('<?= base_url() ?>distribusi/form_dist?idkk=' + kur + '&idsmt=' + smt);
        });
    });
</script>