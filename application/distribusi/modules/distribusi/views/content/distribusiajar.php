<!-- Begin Page Content -->
<style>
    #td-align {
        vertical-align: middle;
    }
</style>
<div class="card-group">

    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 pb-2 mb-2">
        <div class="panel panel-primary">
            <div class="panel-heading bg-primary">
                <h5>Filter Data</h5>
            </div>
            <div class="panel-body" style="padding: 10px;">
                <form role="form" id="form-filter">
                    <div class="form-group">
                        <label for="">Tahun Akademik</label>
                        <select name="ftthnakad" id="ftthnakad" class="form-control">
                            <option selected disabled><?= $ta['thun_akademik'] ?></option>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Dosen</label>
                        <select name="ftdosen" id="ftdosen" class="form-control">
                            <option value="undefined"> -- All Dosen -- </option>
                            <?php foreach ($dosen as $ds) : ?>
                                <option value="<?= $ds->id_dosen ?>"><?= $ds->nama_dsn ?></option>
                            <?php endforeach; ?>
                            <option value="lintaspr"> -- Lintas Prodi -- </option>
                            <option value="luarbiasa"> -- Dosen Luar Biasa -- </option>
                        </select>
                    </div> -->
                    <button type="button" id="btn-filter" class="btn btn-primary btn-out btn-mini">Filter</button>
                    <button type="button" id="btn-filter" class="btn btn-default btn-out btn-mini">Reset</button>
                </form>


            </div>

        </div>
    </div>

    <div class="card col-lg-11 mx-auto">
        <div class="card-header">
            <?php if ($vstatus->status_baak == 2 || $vstatus->status_wadir == 2 || $vstatus->status_direktur == 2) : ?>
                <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#PesanTolakVerifModal">Catatan Penolakan</a>
            <?php endif ?>
            <a class="btn btn-warning btn-sm" href="<?= base_url('distribusi/lintasprodi') ?>">Menu Lintas Prodi</a>

        </div>
        <div class="card-body">
            <div class="text-center">
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= validation_errors(); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?= $this->session->flashdata('message'); ?>
                <h5 class="text-uppercase"><strong> <?= $judul; ?></strong></h5><br><br>
            </div>
            <br><br>
            <div class="pb-5 mb-4">
                <?php if ($vstatus != null) : ?>
                    Status Distribusi :
                    <?php if ($vstatus->status_submit != 0) : ?>
                        <i class="fas fa-sync"></i> on process
                        <br>
                    <?php elseif ($vstatus->status_baak == 1 && $vstatus->status_wadir == 1 && $vstatus->status_direktur == 1) : ?>
                        <i class="fas fa-check-circle"></i> Distribusi telah selesai!
                        <br>
                    <?php endif ?>
                    <span>
                        <?php if ($vstatus->status_baak == 1) : ?>
                            <i class="fas fa-check-circle"></i> Diverifikasi oleh Ka. BAAK
                            <br>
                        <?php elseif ($vstatus->status_baak == 2) : ?>
                            <i class="fas fa-times-circle"></i> Ditolak oleh Ka. BAAK
                            <br>
                        <?php endif ?>
                    </span>
                    <span>
                        <?php if ($vstatus->status_wadir == 1) : ?>
                            <i class="fas fa-check-circle"></i> Diverifikasi oleh Wadir 1
                            <br>
                        <?php elseif ($vstatus->status_wadir == 2) : ?>
                            <i class="fas fa-times-circle"></i> Ditolak oleh Wadir 1
                            <br>
                        <?php endif ?>
                    </span>
                    <span>
                        <?php if ($vstatus->status_direktur == 1) : ?>
                            <i class="fas fa-check-circle"></i> Divalidasi oleh Direktur
                            <br>
                        <?php elseif ($vstatus->status_direktur == 2) : ?>
                            <i class="fas fa-times-circle"></i> Ditolak oleh Direktur
                            <br>
                        <?php endif ?>
                    </span>
                <?php else : ?>
                    <span>Status Distribusi : Belum Ada Data!</span>
                <?php endif ?>
            </div>
            <h5 class="mb-4 text-center">Dosen Lokal</h5>
            <div class="table-responsive">
                <table id="t_dist" class="table table-condensed table-bordered">


                </table>
            </div>
            <br><br>
            <h5 class="mb-4 text-center">Dosen Lintas Prodi dan Dosen Luar Biasa </h5>
            <div class="table-responsive">
                <table class="table table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2" class="align-middle">NAMA DOSEN</th>
                            <th scope="col" rowspan="2" class="align-middle">MATA KULIAH</th>
                            <th scope="col" rowspan="2" class="align-middle">SEMESTER</th>
                            <th scope="col" colspan="2" class="text-center">SKS</th>
                            <th scope="col" colspan="2" class="text-center">JAM</th>
                            <!-- <th scope="col" rowspan="2" class="text-center align-middle">TOTAL JAM</th> -->
                        </tr>
                        <tr>
                            <th scope="col" class="text-center">TEORI</th>
                            <th scope="col" class="text-center">PRAKTEK</th>
                            <th scope="col" class="text-center">TEORI</th>
                            <th scope="col" class="text-center">PRAKTEK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dslp->result() as $dsp) : ?>

                            <tr>
                                <td><?= $dsp->nama_dsn; ?></td>
                                <td><?= $dsp->matkul . ' ' . $dsp->nama_kelas ?></td>
                                <td><?= $dsp->semester_id ?></td>
                                <td><?= $dsp->teori ?></td>
                                <td><?= $dsp->praktek ?></td>
                                <td class="text-center"><?= $jamteori = $dsp->teori * 15 ?></td>
                                <td class="text-center"><?= $jampraktek = $dsp->praktek * 30 ?></td>
                                <!-- <td class="text-center"><?= $jampraktek + $jamteori ?></td> -->
                            </tr>
                        <?php endforeach ?>

                        <?php foreach ($dslb->result() as $dsb) : ?>
                            <tr>
                                <td><?= $dsb->namadosen ?></td>
                                <td><?= $dsb->matkul . ' ' . $dsb->nama_kelas ?></td>
                                <td><?= $dsb->semester_id ?></td>
                                <td><?= $dsb->teori ?></td>
                                <td><?= $dsb->praktek ?></td>
                                <td class="text-center"><?= $jamteori = $dsp->teori * 15 ?></td>
                                <td class="text-center"><?= $jampraktek = $dsp->praktek * 30 ?></td>
                                <!-- <td class="text-center"><?= $jampraktek + $jamteori ?></td> -->
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <br>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="PesanTolakVerifModal" tabindex="-1" role="dialog" aria-labelledby="PesanTolakVerifModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PesanTolakVerifModalLabel">Catatan Penolakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Data distribusi beban ajar ditolak oleh <?= $alasan->ditolak_oleh ?> dengan alasan:
                <br><?= $alasan->keterangan ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <a href="<?= base_url('distribusi/tambahdistribusi') ?>" class="btn btn-success">Perbaiki</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        mkload();

        $('#ftdosen').on('change', function() {
            var dsid = $(this).val();
            $('#t_dist').load('<?= base_url() ?>distribusi/t_dist?dsid=' + dsid);
        });

    });

    function mkload() {
        var dsid = $('#ftdosen').val();
        $('#t_dist').load('<?= base_url() ?>distribusi/t_dist?dsid=' + dsid);
        console.log(dsid);
    }
</script>