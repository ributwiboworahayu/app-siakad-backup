<?php if ($distdosen > 0 ) : ?>
    <div class="card-group">

        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 pb-2 mb-2">
            <div class="panel panel-primary">
                <div class="panel-heading bg-primary">
                    <h5>Filter Data</h5>
                </div>
                <div class="panel-body" style="padding: 10px;">
                    <form role="form" id="form-filter">
                        <div class="form-group">
                            <label for="ftthnakad">Tahun Akademik</label>
                            <select name="ftthnakad" id="ftthnakad" class="form-control">
                                <option selected value="<?= $ta->id_thnakad ?>"><?= $ta->thun_akademik ?></option>
                            </select>
                        </div>
                        <button type="button" id="btn-filter" class="btn btn-primary btn-out btn-mini">Filter</button>
                        <button type="button" id="btn-filter" class="btn btn-default btn-out btn-mini">Reset</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card col-lg-11 mx-auto" id="verif">
            <div class="card-header">
                <?= $this->session->flashdata('message'); ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#SKDosen">
                    <i class="far fa-file-pdf"></i>lihat SK
                </button>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h5 class="text-uppercase"><strong> <?= $judul; ?></strong></h5><br><br>
                </div>
                <br><br>
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
                        <?php $countmk = set_dosendist($distribusi->id_dosen) ?>
                        <tbody>
                            <?php
                            $tjamteori = 0;
                            $tjampraktek = 0;
                            ?>
                            <?php foreach ($countmk->result() as $cnt => $val) : ?>
                                <tr>
                                    <?php if ($cnt == 0) : ?>
                                        <td rowspan="<?= $countmk->num_rows() ?>" id="td-align">
                                            <?= $distribusi->nama_dsn; ?>
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

                            $totalt = set_totalsum($distribusi->id_dosen)
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
                                <td colspan="9"></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <br><br>
            </div>
        </div>
    </div>

    <!-- Modal SK -->
    <div class="modal fade" id="SKDosen" tabindex="-1" role="dialog" aria-labelledby="SKDosenTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="SKDosenTitle">SK Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <embed type="application/pdf" src="<?= base_url('distribusi/unduhsk/' . $distribusi->id_dosen) ?>" width="780" height="2000"></embed>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="card-group">

        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 pb-2 mb-2">
            <div class="panel panel-primary">
                <div class="panel-heading bg-primary">
                    <h5>Filter Data</h5>
                </div>
                <div class="panel-body" style="padding: 10px;">
                    <form role="form" id="form-filter">
                        <div class="form-group">
                            <label for="ftthnakad">Tahun Akademik</label>
                            <select name="ftthnakad" id="ftthnakad" class="form-control">
                                <option selected value="<?= $ta->id_thnakad ?>"><?= $ta->thun_akademik ?></option>
                            </select>
                        </div>
                        <button type="button" id="btn-filter" class="btn btn-primary btn-out btn-mini">Filter</button>
                        <button type="button" id="btn-filter" class="btn btn-default btn-out btn-mini">Reset</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card col-lg-11 mx-auto" id="verif">
            <div class="card-header">
                <?= $this->session->flashdata('message'); ?>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h5 class="text-uppercase"><strong>SK Dosen Mengajar Belum Diterbitkan!</strong></h5><br><br>
                </div>

            </div>
        </div>
    </div>
<?php endif ?>