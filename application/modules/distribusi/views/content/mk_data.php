<div id="htbl">
    <h3 class="text-center"><?= $judul; ?></h3><br>

    <?php if ($pid['id_kaprodi'] != 6) : ?>

        <?php $x = 1; ?>
        <?php foreach ($semester as $smt) : ?>
            <?php
            $mkuliah = set_mkuliah($kkd, $smt['id_semester'])->result_array();
            $mkuliah1 = set_mkuliah($kkd, $smt['id_semester'])->row_array();
            ?>
            <br><br>
            <h5><?= $smt['nama_semester'] ?></h5>
            <br><br>
            <div class="table-responsive">
                <table class="table table-condensed table-bordered" id="tabel-mkr<?= $x; ?>" cellspacing="0" width="75%">
                    <thead>
                        <tr class="">
                            <th scope="col">#</th>
                            <th scope="col">KODE</th>
                            <th scope="col">MATA KULIAH</th>
                            <th scope="col">KEL</th>
                            <th scope="col">SKS</th>
                            <th scope="col">TEORI</th>
                            <th scope="col">PRAKTEK</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $skstotal = 0;
                        $teoritotal = 0;
                        $praktektotal = 0;
                        ?>
                        <?php if ($mkuliah1 > 0) : ?>

                            <?php foreach ($mkuliah as $mk) : ?>
                                <tr>
                                    <td scope="row"><?= $i; ?></td>
                                    <td>
                                        <?= $mk['kodematkul']; ?>
                                    </td>
                                    <td>
                                        <?= $mk['matkul']; ?>
                                    </td>
                                    <td>
                                        <?= $mk['kel']; ?>
                                    </td>
                                    <td>
                                        <?= $mk['sks']; ?>
                                    </td>
                                    <td>
                                        <?= $mk['teori']; ?>
                                    </td>
                                    <td>
                                        <?= $mk['praktek']; ?>
                                    </td>
                                    <td>
                                        <button class="fas fa-edit" data-toggle="modal" data-target="#EditMatkulModal<?= $mk['id']; ?>"></button>
                                        <button type="button" class="deletemk<?= $mk['id'] ?>" id="<?= $mk['id']; ?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php
                                $skstotal += $mk['sks'];
                                $teoritotal += $mk['teori'];
                                $praktektotal += $mk['praktek'];
                                ?>
                            <?php $i++;
                            endforeach; ?>
                            <tr>
                                <td colspan="3" class="text-center">
                                    Total
                                </td>
                                <td></td>
                                <td><?= $skstotal; ?></td>
                                <td><?= $teoritotal; ?></td>
                                <td><?= $praktektotal; ?></td>
                            </tr>
                        <?php else : ?>
                            <tr>
                                <td colspan='10' class='text-center pt-4 pb-4'>
                                    <strong>Belum Ada Data Matakuliah.</strong>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <script>
                    $(document).ready(function() {
                        var table = $('#tabel-mkr<?= $x; ?>').DataTable({
                            scrollY: "300px",
                            scrollX: true,
                            scrollCollapse: true

                        });
                    });
                </script>
            </div>
            <?php if ($x == 6) : break;
            endif; ?>
            <?php $x++; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <?php $x = 1; ?>
        <?php foreach ($semester as $smt) : ?>
            <?php
            $mkuliah = set_mkuliah($kkd, $smt['id_semester'])->result_array();
            $mkuliah1 = set_mkuliah($kkd, $smt['id_semester'])->row_array();
            ?>
            <br><br>
            <h5><?= $smt['nama_semester'] ?></h5>
            <br><br>
            <div class="table-responsive">
                <table class="table table-condensed table-bordered" id="tabel-mkr<?= $x; ?>" cellspacing="0" width="75%">
                    <thead>
                        <tr class="">
                            <th scope="col">#</th>
                            <th scope="col">KODE</th>
                            <th scope="col">MATA KULIAH</th>
                            <th scope="col">KEL</th>
                            <th scope="col">SKS</th>
                            <th scope="col">TEORI</th>
                            <th scope="col">PRAKTEK</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $skstotal = 0;
                        $teoritotal = 0;
                        $praktektotal = 0;
                        ?>
                        <?php if ($mkuliah1 > 0) : ?>

                            <?php foreach ($mkuliah as $mk) : ?>
                                <tr>
                                    <td scope="row"><?= $i; ?></td>
                                    <td>
                                        <?= $mk['kodematkul']; ?>
                                    </td>
                                    <td>
                                        <?= $mk['matkul']; ?>
                                    </td>
                                    <td>
                                        <?= $mk['kel']; ?>
                                    </td>
                                    <td>
                                        <?= $mk['sks']; ?>
                                    </td>
                                    <td>
                                        <?= $mk['teori']; ?>
                                    </td>
                                    <td>
                                        <?= $mk['praktek']; ?>
                                    </td>
                                    <td>
                                        <button class="fas fa-edit" data-toggle="modal" data-target="#EditMatkulModal<?= $mk['id']; ?>"></button>
                                        <button type="button" class="deletemk<?= $mk['id'] ?>" id="<?= $mk['id']; ?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php
                                $skstotal += $mk['sks'];
                                $teoritotal += $mk['teori'];
                                $praktektotal += $mk['praktek'];
                                ?>
                            <?php $i++;
                            endforeach; ?>
                            <tr>
                                <td colspan="3" class="text-center">
                                    Total
                                </td>
                                <td></td>
                                <td><?= $skstotal; ?></td>
                                <td><?= $teoritotal; ?></td>
                                <td><?= $praktektotal; ?></td>
                            </tr>
                        <?php else : ?>
                            <tr>
                                <td colspan='10' class='text-center pt-4 pb-4'>
                                    <strong>Belum Ada Data Matakuliah.</strong>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <script>
                    $(document).ready(function() {
                        var table = $('#tabel-mkr<?= $x; ?>').DataTable({
                            scrollY: "300px",
                            scrollX: true,
                            scrollCollapse: true

                        });
                    });
                </script>
            </div>

            <?php $x++; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


<!-- Modal Edit -->
<?php foreach ($mkuliah as $mk) : ?>
    <div class="modal fade" id="EditMatkulModal<?= $mk['id']; ?>" tabindex="-1" aria-labelledby="EditMatkulModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditMatkulModalLabel">Edit Matakuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <form action="<?= base_url('distribusi/matakuliahBaru/') . $kkd; ?>" method="post"> -->
                <?= form_open(base_url() . 'distribusi/matakuliahEdit/' . $kkd, ['id' => 'form-mkedit']); ?>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kodematkul">Kode Matakuliah</label>
                            <input type="hidden" name="id" id="id" value="<?= $mk['id'] ?>">
                            <input type="hidden" name="idkk" id="idkk" value="<?= $kkd ?>">
                            <input type="hidden" name="idsemester" id="idsemester" value="<?= $smt['id_semester'] ?>">
                            <input type="hidden" name="keterangansmt" id="keterangansmt" value="<?= $smt['keterangan'] ?>">
                            <input type="text" class="form-control" id="kodematkul" name="kodematkul" value="<?= $mk['kodematkul'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="matkul">Nama Matakuliah</label>
                            <input type="text" class="form-control" id="matkul" name="matkul" value="<?= $mk['matkul'] ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kel">Kel</label>
                            <select class="form-control" id="kel" name="kel">
                                <?php foreach ($kel as $kl) : ?>
                                    <?php if ($kl['kel'] == $mk['kel']) : ?>
                                        <option value="<?= $kl['kel']; ?>" selected><?= $kl['kel']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $kl['kel']; ?>"><?= $kl['kel']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <!-- <input type="text" class="form-control" id="kel" name="kel"> -->
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sks">SKS</label>
                            <input type="number" min="0" class="form-control" id="sks" name="sks" value="<?= $mk['sks']; ?>">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="teori">Teori</label>
                            <input type="number" min="0" class="form-control" id="teori" name="teori" value="<?= $mk['teori']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="praktek">Praktek</label>
                            <input type="number" min="0" class="form-control" id="praktek" name="praktek" value="<?= $mk['praktek']; ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                <?= form_close(); ?>
                <!-- </form> -->
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    $(document).ready(function() {
        <?php foreach ($mkuliah as $mk) : ?>
            $('.deletemk<?= $mk['id'] ?>').on('click', function() {

                var kr = $('#filterkr').val();
                var smt = $('#filtersmt').val();
                var idmk = $(this).attr('id');
                $.ajax({
                    type: 'GET',
                    url: "<?= base_url('distribusi/hapusMkuliah') ?>",
                    data: {
                        id: idmk
                    },
                    success: function() {
                        $('#htbl').load('<?= base_url() ?>distribusi/mk_data?idkk=' + kr + '&idsmt=' + smt);
                    },
                    error: function(response) {
                        console.log(response.responseText);
                    }
                });
            });
        <?php endforeach ?>
    });
</script>