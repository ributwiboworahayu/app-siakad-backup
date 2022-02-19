<?php if ($vstatus != null) : ?>
    <?php if ($vstatus->status_submit != 0) : ?>

        <div class="card-header">
            <?= $this->session->flashdata('message'); ?>

            <?php if ($vstatus->status_wadir == 1 && $vstatus->status_direktur == 0) : ?>
                <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#TolakVerifikasiModal">Tolak</a>
                <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ValidasiModal">Validasi</a>
            <?php endif ?>
        </div>
        <div class="card-body">
            <div class="text-center">
                <?= $this->session->flashdata('message'); ?>
                <h5 class="text-uppercase"><strong> <?= $judul; ?></strong></h5><br><br>
            </div>
            <br><br>
            <div class="pb-5 mb-4">
                <?php if ($vstatus != null) : ?>
                    Status Distribusi :
                    <?php if ($vstatus->status_baak == 0 || $vstatus->status_wadir == 0 || $vstatus->status_direktur == 0) : ?>
                        <i class="fas fa-sync"></i> on process
                        <br>
                    <?php elseif ($vstatus->status_baak == 1 || $vstatus->status_wadir == 1 || $vstatus->status_direktur == 1) : ?>
                        <i class="fas fa-check-circle"></i> Distribusi telah selesai!
                        <br>
                    <?php endif ?>
                    <span>
                        <?php if ($vstatus->status_baak == 1) : ?>
                            <i class="fas fa-check-circle"></i> Diverifikasi oleh Ka. BAAK
                            <br>
                        <?php elseif ($vstatus->status_baak == 2) : ?>
                            <i class="fas fa-check-circle"></i> Dikembalikan ke Ka. Prodi
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
            <h5 class="mb-4 text-center">Dosen Internal</h5>
            <div class="table-responsive">
                <table id="t_dist" class="table table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2" class="align-middle">NAMA DOSEN</th>
                            <th scope="col" rowspan="2" class="align-middle">MATA KULIAH</th>
                            <th scope="col" rowspan="2" class="align-middle">SEMESTER</th>
                            <th scope="col" colspan="2" class="text-center">SKS</th>
                            <th scope="col" colspan="2" class="text-center">JAM</th>
                        </tr>
                        <tr>
                            <th scope="col" class="text-center">TEORI</th>
                            <th scope="col" class="text-center">PRAKTEK</th>
                            <th scope="col" class="text-center">TEORI</th>
                            <th scope="col" class="text-center">PRAKTEK</th>
                        </tr>
                    </thead>
                    <?php if ($data1->num_rows() > 0) : ?>
                        <?php foreach ($data1->result() as $dt1) : ?>
                            <?php
                            $countmk = set_tvalid($dt1->dosen_id)
                            ?>
                            <tbody>
                                <?php
                                $tjamteori = 0;
                                $tjampraktek = 0;
                                ?>
                                <?php foreach ($countmk->result() as $cnt => $val) : ?>
                                    <tr>
                                        <?php if ($cnt == 0) : ?>
                                            <td rowspan="<?= $countmk->num_rows() ?>" id="td-align">
                                                <?= $dt1->nama_dsn; ?>
                                            </td>
                                        <?php endif ?>
                                        <td><?= $val->matkul . ' ' . $val->nama_kelas ?></td>
                                        <td class="text-center"><?= $val->semester_id ?></td>
                                        <td class="text-center"><?= $val->teori ?></td>
                                        <td class="text-center"><?= $val->praktek ?></td>
                                        <td class="text-center"><?= $jamteori = $val->teori * 15 ?></td>
                                        <td class="text-center"><?= $jampraktek = $val->praktek * 30 ?></td>

                                    </tr>
                                    <?php
                                    $tjamteori += $jamteori;
                                    $tjampraktek += $jampraktek;
                                    ?>
                                <?php endforeach ?>
                                <?php

                                $totalt = set_sumtvalid($dt1->dosen_id)
                                ?>
                                <tr>
                                    <td colspan="3" class="">Total</td>
                                    <td class="text-center"><?= $totalt->t ?></td>
                                    <td class="text-center"><?= $totalt->p ?></td>
                                    <td class="text-center"><?= $tjamteori ?></td>
                                    <td class="text-center"><?= $tjampraktek ?></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="">Total Jam</td>
                                    <td colspan="2" class="text-center"><?= $tjamteori + $tjampraktek ?></td>
                                </tr>
                            </tbody>
                            <tbody class="bg-light">
                                <tr>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#SKDosen<?= $dt1->dosen_id ?>">
                                            <i class="far fa-file-pdf"></i>lihat SK
                                        </a>
                                    </td>
                                    <td colspan="8"></td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tbody>
                            <tr>
                                <td colspan="9" class="text-center"><br>Belum ada data disini!<br><br></td>
                            </tr>
                        </tbody>
                    <?php endif ?>
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
                                <td class="text-center"><?= $jamteori = $dsb->teori * 15 ?></td>
                                <td class="text-center"><?= $jampraktek = $dsb->praktek * 30 ?></td>
                                <!-- <td class="text-center"><?= $jampraktek + $jamteori ?></td> -->
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <br>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="TolakVerifikasiModal" tabindex="-1" aria-labelledby="TolakVerifikasiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TolakVerifikasiModalLabel">Tolak Distribusi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open(base_url() . 'distribusi/tolakvalidasi'); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" id="taid" name="taid" value="<?= $ta ?>">
                            <input type="hidden" id="prodiid" name="prodiid" value="<?= $prodiid ?>">
                            <label for="tolakvalidasi">Alasan Penolakan</label>
                            <textarea class="form-control" id="tolakvalidasi" name="tolakvalidasi" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Kirim</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>

        <!-- Modal Validasi -->
        <div class="modal fade" id="ValidasiModal" tabindex="-1" aria-labelledby="ValidasiModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ValidasiModalLabel">Validasi Distribusi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Kirim Distribusi Beban Ajar ke masing-masing Dosen pengampu?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <a href="<?= base_url('distribusi/divalidasi/' . $prodiid) ?>" class="btn btn-warning">Kirim</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal SK -->
        <?php foreach ($data1->result() as $dt1) : ?>
            <div class="modal fade" id="SKDosen<?= $dt1->dosen_id ?>" tabindex="-1" role="dialog" aria-labelledby="SKDosenTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="SKDosenTitle">SK <?= $dt1->nama_dsn ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <embed type="application/pdf" src="<?= base_url('distribusi/unduhsk/' . $dt1->dosen_id) ?>" width="780" height="2000"></embed>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    <?php else : ?>
        <div class="card-header">
        </div>
        <div class="card-body">
            <div class="alert alert-danger" role="alert">
                Kaprodi belum melakukan submit distribusi!
            </div>
        </div>
    <?php endif ?>
<?php else : ?>
    <div class="card-header">
    </div>
    <div class="card-body">
        <div class="alert alert-danger" role="alert">
            Kaprodi belum melakukan submit distribusi!
        </div>
    </div>
<?php endif ?>