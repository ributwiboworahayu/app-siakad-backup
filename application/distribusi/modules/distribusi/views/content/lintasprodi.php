<div class="card col-lg-11 mx-auto">
    <div class="card-header">
    </div>
    <div class="card-body">
        <div class="text-center">
            <h5 class="text-uppercase"><strong> <?= $judul; ?></strong></h5><br><br>
        </div>
        <?= form_error('pildosen[]', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>
        <?= $this->session->flashdata('message'); ?>

        <?= form_open(base_url() . 'distribusi/lintasprodi/'); ?>
        <div class="pb-3">
            <h5>Permintaan Dosen Lintas Prodi</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-condensed table-bordered">
                <thead>
                    <th>Prodi</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Pilih Dosen</th>
                </thead>
                <tbody>
                    <?php if ($lpd->num_rows() > 0) : ?>

                        <?php foreach ($lpd->result() as $lp) : ?>
                            <tr>
                                <td><?= $lp->nama_prodi ?></td>
                                <td><?= $lp->matkul ?></td>
                                <td><?= $lp->sks ?></td>
                                <td>
                                    <?php
                                    $dosen = $this->db->get_where('m_dosen', ['prodi_id' => $prodiid])->result();
                                    ?>
                                    <select class="form-control" name="pildosen[]" id="pildosen">
                                        <option disabled selected> -- Pilih Dosen -- </option>
                                        <?php foreach ($dosen as $ds) : ?>
                                            <?php if ($ds->id_dosen == $lp->dosen_lintas_id) : ?>
                                                <option value="<?= $lp->prodi_id ?>:<?= $lp->matkul_id ?>:<?= $ds->id_dosen ?>" selected><?= $ds->nama_dsn ?></option>
                                            <?php else : ?>
                                                <option value="<?= $lp->prodi_id ?>:<?= $lp->matkul_id ?>:<?= $ds->id_dosen ?>"><?= $ds->nama_dsn ?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="pb-5 mr-4">
            <button class="btn float-right btn-warning">Edit</button>
        </div>
    <?php else : ?>
        <tr>
            <td colspan="4" class="text-center">Belum ada Data!</td>
        </tr>
        </tbody>
        </table>
    </div>
<?php endif ?>
<?php form_close(); ?>

<div class="pb-3 pt-3">
    <h5>Dosen Lintas Prodi</h5>
</div>
<div class="table-responsive">
    <table class="table table-condensed table-bordered">
        <thead>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Prodi Lintas</th>
            <th>Dosen Lintas</th>
        </thead>
        <tbody>
            <?php if ($lpl->num_rows() > 0) : ?>
                <?php foreach ($lpl->result() as $lk) : ?>
                    <tr>
                        <td><?= $lk->matkul ?></td>
                        <td><?= $lk->sks ?></td>
                        <td><?= $lk->nama_prodi ?></td>
                        <td>
                            <?php $dosenid = $this->db->get_where('m_dosen', ['id_dosen' => $lk->dosen_lintas_id])->row(); ?>
                            <?php if ($lk->dosen_lintas_id != 0) : ?>
                                <?= $dosenid->nama_dsn ?>
                            <?php else : ?>
                                Belum disetujui oleh Kaprodi <?= $lk->singkatan ?>.
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php else : ?>
    <tr>
        <td colspan="4" class="text-center">Belum ada Data!</td>
    </tr>
<?php endif ?>
</div>
</div>