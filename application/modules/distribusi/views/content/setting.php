<!-- Begin Page Content -->

<div class="card col-lg-10 mx-auto">
    <div class="card-header">
        <?= form_error('prodi', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>
        <?= $this->session->flashdata('message'); ?>
        <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#NewDosenLbModal">Tambah Portal</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Prodi</th>
                        <th scope="col">Tahun Akademik</th>
                        <th scope="col">Status Distribusi</th>
                        <th scope="col">Status Portal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php if ($dstport->num_rows() > 0) : ?>
                        <?php foreach ($dstport->result() as $dsp) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td>
                                    <?= $dsp->nama_prodi; ?>
                                </td>
                                <td>
                                    <?= $dsp->thun_akademik; ?>
                                </td>
                                <td>
                                    <?php if ($dsp->status_submit == 1 && $dsp->status_baak == 0) : ?>
                                        Kaprodi telah melakukan Submit
                                    <?php elseif ($dsp->status_baak != 0) : ?>
                                        Data distribusi sedang diproses
                                    <?php else : ?>
                                        Kaprodi belum melakukan Submit
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if ($dsp->status_portal == 1) : ?>
                                        Portal Dibuka
                                    <?php else : ?>
                                        Portal Ditutup
                                    <?php endif ?>
                                </td>
                                <td>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" id="chnge<?= $dsp->id ?>" type="checkbox" <?= check_status($dsp->id, $dsp->status_portal); ?> data-id="<?= $dsp->id ?>" data-status=" <?= $dsp->status_portal ?>">
                                        <label>Portal</label>
                                    </div>
                                    <br>
                                    <?php if ($dsp->status_baak == 0) : ?>
                                        <div class="form-check pl-4">
                                            <input class="form-check-input" id="chnge<?= $dsp->id . $dsp->status_submit ?>" type="checkbox" <?= check_submit($dsp->id, $dsp->status_submit); ?> data-id="<?= $dsp->id ?>" data-status=" <?= $dsp->status_submit ?>">
                                            <label>Submit Kaprodi</label>
                                        </div>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <script>
                                $(document).ready(function() {
                                    $('#chnge<?= $dsp->id ?>').on('click', function() {
                                        const id = $(this).data('id');
                                        const status = $(this).data('status');

                                        $.ajax({
                                            url: "<?= base_url('distribusi/changeportal'); ?>",
                                            type: 'get',
                                            data: {
                                                id: id,
                                                statusportal: status
                                            },
                                            success: function() {
                                                // console.log(id + status);
                                                document.location.href = "<?= base_url('distribusi/setting'); ?>";
                                            }
                                        });
                                    });
                                    $('#chnge<?= $dsp->id . $dsp->status_submit ?>').on('click', function() {
                                        const id = $(this).data('id');
                                        const status = $(this).data('status');

                                        $.ajax({
                                            url: "<?= base_url('distribusi/changesubmit'); ?>",
                                            type: 'get',
                                            data: {
                                                id: id,
                                                statussubmit: status,
                                                kodeprodi: <?= $dsp->kode_prodi ?>
                                            },
                                            success: function() {
                                                // console.log(id + status);
                                                document.location.href = "<?= base_url('distribusi/setting'); ?>";
                                            }
                                        });
                                    });
                                });
                            </script>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan='4' class='text-center pt-4 pb-4'>
                                <strong>Belum Ada Portal.</strong>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="NewDosenLbModal" tabindex="-1" aria-labelledby="NewDosenLbModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewDosenLbModalLabel">Tambah Portal Distribusi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open(base_url() . 'distribusi/setting'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="prodi">Prodi</label>
                    <select class="form-control" id="prodi" name="prodi">
                        <option disabled selected> -- Pilih Prodi -- </option>
                        <?php foreach ($prodi as $pr) : ?>
                            <option value="<?= $pr->kode_prodi ?>"><?= $pr->nama_prodi ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group pb-2">
                    <label for="takadid">Tahun Akademik</label>
                    <select class="form-control" id="takadid" name="takadid">
                        <option disabled selected> -- Pilih Tahun Akademik -- </option>
                        <?php foreach ($ta as $tk) : ?>
                            <option value="<?= $tk->id_thnakad ?>"><?= $tk->thun_akademik ?> <?= $tk->ta_tipe ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-check pl-4">
                        <input class="form-check-input" type="hidden" value="0" name="status" id="status" checked>
                        <input class="form-check-input" type="checkbox" value="1" name="status" id="status" checked>
                        <label class="form-check-label" for="status">
                            Active?
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-danger btn-sm">Tambah</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>