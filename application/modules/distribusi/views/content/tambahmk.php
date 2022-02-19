<!-- Begin Page Content -->

<div class="card col-lg-9 mx-auto">
    <div class="card-header">
        <!-- <?= form_error('kodematkul[]', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?> -->
        <!-- <?= form_error('matkul[]', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?> -->
        <!-- <?= form_error('kel[]', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?> -->
        <?= $this->session->flashdata('message'); ?>
    </div>
    <div class="card-body">
        <?= form_open(base_url('distribusi/matakuliahbaru')) ?>
        <input type="hidden" name="idkur" id="idkur" value="<?= $idkur ?>">
        <input type="hidden" name="smtid" id="smtid" value="<?= $smtid ?>">
        <?php for ($i = 1; $i <= $jumlahmk; $i++) : ?>
            <div class="form-row align-items-center">
                <div class="form-group col-2">
                    <label for="kodematkul">Kode</label>
                    <input type="text" class="form-control" id="kodematkul" name="kodematkul[]">
                </div>
                <div class="form-group col-6">
                    <label for="matkul">Mata Kuliah</label>
                    <input type="text" class="form-control" id="matkul" name="matkul[]">
                </div>
                <div class="form-group col-2">
                    <label for="kel">Kelompok</label>
                    <select id="kel" name="kel[]" class="form-control">
                        <option selected disabled> -- Pilih -- </option>
                        <?php foreach ($kel as $kl) : ?>
                            <option value="<?= $kl->kel ?>"><?= $kl->keterangan ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-1">
                    <label for="teori">Teori</label>
                    <input type="number" min="0" value="0" class="form-control" id="teori" name="teori[]">
                </div>
                <div class="form-group col-1">
                    <label for="praktek">Praktek</label>
                    <input type="number" min="0" value="0" class="form-control" id="praktek" name="praktek[]">
                </div>
            </div>
        <?php endfor ?>
        <div class="form-group row float-right">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i>Simpan</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>