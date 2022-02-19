<?= form_open(base_url() . 'distribusi/tambahdistribusi/', ['id' => 'formkredit']); ?>

<input type="hidden" name="prodiid" id="prodiid" value="<?= $prodiid; ?>">
<input type="hidden" name="taid" id="taid" value="<?= $taid['id_thnakad']; ?>">
<br><br>
<?php $i = 1; ?>
<?php foreach ($mahasiswa as $mhs) : ?>
    <div class="col-lg mx-auto mt-2 mb-3">
        <h5 class="text-center mb-4">Kelas <?= $mhs['nama_kelas'] ?></h5>
        <div class="table-responsive">
            <table class="table table-condensed table-striped table-bordered" id="tabel-ds<?= $i; ?>" cellspacing="0" width="100%">
                <thead>
                    <tr class="">
                        <th scope="col">KODE</th>
                        <th scope="col">MATA KULIAH</th>
                        <th scope="col">TEORI</th>
                        <th scope="col">PRAKTEK</th>
                        <th scope="col">DOSEN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matkul as $mk) : ?>
                        <tr>
                            <td>
                                <?= $mk['kodematkul']; ?>
                            </td>
                            <td>
                                <?= $mk['matkul']; ?>
                            </td>
                            <td>
                                <?= $mk['teori']; ?>
                            </td>
                            <td>
                                <?= $mk['praktek']; ?>
                            </td>
                            <td>
                                <!-- <input type="checkbox" name="matakuliah[]" value="<?= $mhs['id_kelas'] ?>:<?= $mk['id'] ?>" aria-label="Radio button for following text input"> -->
                                <div class="form-inline">
                                    <div class="form-group">
                                        <?php
                                        $dstr = set_mkselect($mhs['id_kelas'], $mk['id'], 'r_distribusi', 1);
                                        $dstrlp = set_mkselect($mhs['id_kelas'], $mk['id'], 'r_distribusi_lp', 1);
                                        ?>
                                        <select class="form-control" id="dosenpk<?= $mhs['id_kelas'] . $mk['id'] ?>" name="dosenpk[]">
                                            <option disabled selected> -- Pilih Dosen -- </option>
                                            <?php foreach ($dosen as $dsn) : ?>
                                                <?php if ($dsn['id_dosen'] == $dstr->dosen_id && $mhs['id_kelas'] == $dstr->kelas_id) : ?>
                                                    <option value="<?= $mhs['id_kelas'] ?>:<?= $mk['id'] ?>:<?= $dsn['id_dosen']; ?>:<?= $prodiid; ?>" selected><?= $dsn['nama_dsn']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $mhs['id_kelas'] ?>:<?= $mk['id'] ?>:<?= $dsn['id_dosen']; ?>:<?= $prodiid; ?>"><?= $dsn['nama_dsn']; ?></option>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                            <option disabled> -- Lintas Prodi -- </option>
                                            <?php foreach ($prodi as $pr) : ?>
                                                <?php if ($pr->kode_prodi != $prodiid) : ?>
                                                    <?php if ($pr->kode_prodi == $dstrlp->prodi_lintas_id && $mhs['id_kelas'] == $dstrlp->kelas_id) : ?>
                                                        <option value="<?= $mhs['id_kelas'] ?>:<?= $mk['id'] ?>:0:<?= $pr->kode_prodi; ?>" selected>Lintas Prodi <?= $pr->nama_prodi; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $mhs['id_kelas'] ?>:<?= $mk['id'] ?>:lintaspr:<?= $pr->kode_prodi; ?>">Lintas Prodi <?= $pr->nama_prodi; ?></option>
                                                    <?php endif ?>
                                                <?php endif ?>
                                            <?php endforeach; ?>
                                            <option disabled> -- Dosen Luar Biasa -- </option>
                                            <?php foreach ($dosenlb as $dlb) : ?>
                                                <option value="<?= $mhs['id_kelas'] ?>:<?= $mk['id'] ?>:dlb:<?= $dlb->id; ?>"><?= $dlb->namadosen ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <a class="btn btn-outline-success btn-sm" id="tmbhdsn<?= $mhs['id_kelas'] . $mk['id'] ?>">tambah dosen kedua</a>
                                    <a class="btn btn-outline-danger btn-sm" id="krgdsn<?= $mhs['id_kelas'] . $mk['id'] ?>">hapus dosen kedua</a>
                                    <br><br>
                                    <?php
                                    $dstrdua = set_mkselect($mhs['id_kelas'], $mk['id'], 'r_distribusi', 2);
                                    ?>
                                    <select class="form-control" id="dosenpkd<?= $mhs['id_kelas'] . $mk['id'] ?>" name="dosenpkd">
                                        <option disabled selected> -- Pilih Dosen -- </option>
                                        <?php foreach ($dosen as $dsn) : ?>
                                            <?php if ($dsn['id_dosen'] == $dstrdua->dosen_id && $mhs['id_kelas'] == $dstrdua->kelas_id) : ?>
                                                <option value="<?= $mhs['id_kelas'] ?>:<?= $mk['id'] ?>:<?= $dsn['id_dosen']; ?>:<?= $prodiid; ?>" selected><?= $dsn['nama_dsn']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $mhs['id_kelas'] ?>:<?= $mk['id'] ?>:<?= $dsn['id_dosen']; ?>:<?= $prodiid; ?>"><?= $dsn['nama_dsn']; ?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <script>
                            $(document).ready(function() {

                                $('#krgdsn<?= $mhs['id_kelas'] . $mk['id'] ?>').hide();
                                $('#dosenpkd<?= $mhs['id_kelas'] . $mk['id'] ?>').hide();

                                $('#tmbhdsn<?= $mhs['id_kelas'] . $mk['id'] ?>').on('click', function() {
                                    $('#krgdsn<?= $mhs['id_kelas'] . $mk['id'] ?>').show();
                                    $('#tmbhdsn<?= $mhs['id_kelas'] . $mk['id'] ?>').hide();
                                    $('#dosenpkd<?= $mhs['id_kelas'] . $mk['id'] ?>').show();

                                });
                                $('#krgdsn<?= $mhs['id_kelas'] . $mk['id'] ?>').on('click', function() {
                                    $('#krgdsn<?= $mhs['id_kelas'] . $mk['id'] ?>').hide();
                                    $('#tmbhdsn<?= $mhs['id_kelas'] . $mk['id'] ?>').show();
                                    $('#dosenpkd<?= $mhs['id_kelas'] . $mk['id'] ?>').hide();

                                    var dsdua = $('#dosenpkd<?= $mhs['id_kelas'] . $mk['id'] ?>').val();
                                    if (dsdua != null) {
                                        $.ajax({
                                            type: 'GET',
                                            url: "<?= base_url('distribusi/hpsdatadua'); ?>",
                                            data: {
                                                id: dsdua
                                            },
                                            success: function() {

                                                console.log('success!');
                                            },
                                            error: function(response) {
                                                console.log(response.responseText);
                                            }
                                        });
                                    }
                                    // console.log(dsdua);
                                });

                                $('#dosenpk<?= $mhs['id_kelas'] . $mk['id'] ?>').on('change', function() {
                                    var kid = $(this).val();
                                    $.ajax({
                                        type: 'GET',
                                        url: "<?= base_url('distribusi/tmbhdata'); ?>",
                                        data: {
                                            id: kid,
                                            prodiid: <?= $prodiid; ?>,
                                            taid: <?= $taid['id_thnakad']; ?>
                                        },
                                        success: function() {
                                            console.log('Success! id:' + kid);
                                        },
                                        error: function(response) {
                                            console.log(response.responseText);
                                        }
                                    });
                                });

                                $('#dosenpkd<?= $mhs['id_kelas'] . $mk['id'] ?>').on('change', function() {
                                    var kid = $(this).val();
                                    $.ajax({
                                        type: 'GET',
                                        url: "<?= base_url('distribusi/tmbhdatadua'); ?>",
                                        data: {
                                            id: kid,
                                            prodiid: <?= $prodiid; ?>,
                                            taid: <?= $taid['id_thnakad']; ?>
                                        },
                                        success: function() {
                                            console.log('Success! id:' + kid);
                                        },
                                        error: function(response) {
                                            console.log(response.responseText);
                                        }
                                    });
                                });


                                var iddss = $('#dosenpkd<?= $mhs['id_kelas'] . $mk['id'] ?>').val();
                                if (iddss != null) {
                                    $('#krgdsn<?= $mhs['id_kelas'] . $mk['id'] ?>').show();
                                    $('#tmbhdsn<?= $mhs['id_kelas'] . $mk['id'] ?>').hide();
                                    $('#dosenpkd<?= $mhs['id_kelas'] . $mk['id'] ?>').show();
                                    console.log(iddss);
                                }

                            });
                        </script>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- <script>
            $(document).ready(function() {
                var table = $('#tabel-ds<?= $i; ?>').DataTable({
                    scrollY: "50%",
                    scrollX: true,
                    scrollCollapse: true

                });

            });
        </script> -->

    <?php $i++; ?>
<?php endforeach; ?>
<div class="form-group row col-lg-8 mx-auto pt-5">
    <div class="alert alert-warning" role="alert">
        Mohon periksa kembali data mata kulliah dan dosen sebelum anda melakukan submit!
        Data akan dikirimkan ke Ka. Baak setelah anda melakukan submit.
    </div>
    <button class="btn btn-warning btn-lg btn-block">submit</button>
</div>
<?= form_close(); ?>