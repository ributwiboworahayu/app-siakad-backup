<!-- Begin Page Content -->

<div class="card col-lg-9 mx-auto">
    <div class="card-header">
        <?= form_error('namadosenlb', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>
        <?= form_error('nohp', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>
        <?= $this->session->flashdata('message'); ?>
        <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#NewDosenLbModal">Tambah Dosen LB</a>
    </div>
    <div class="card-body">
        <div class="text-center">
            <h5 class="text-uppercase"><strong>Dosen Luar Biasa</strong></h5><br><br>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tabel-lb" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Dosen</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php if ($dslb->num_rows() > 0) : ?>
                        <?php foreach ($dslb->result() as $lb) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td>
                                    <?= $lb->namadosen; ?>
                                </td>
                                <td>
                                    <?= $lb->nohp; ?>
                                </td>
                                <td>
                                    <a class="fas fa-edit" href="" data-toggle="modal" data-target="#EditDosenLbModal<?= $lb->id; ?>">Edit</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan='4' class='text-center pt-4 pb-4'>
                                <strong>Belum Ada Data Dosen.</strong>
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
                <h5 class="modal-title" id="NewDosenLbModalLabel">Tambah Dosen Luar Biasa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open(base_url() . 'distribusi/dlb'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="namadosenlb">Nama</label>
                    <input type="text" class="form-control" id="namadosenlb" name="namadosenlb">
                </div>
                <div class="form-group">
                    <label for="nohp">No. Hp</label>
                    <input type="number" class="form-control" id="nohp" name="nohp">
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

<!-- Modal -->
<?php foreach ($dslb->result() as $lb) : ?>
    <div class="modal fade" id="EditDosenLbModal<?= $lb->id; ?>" tabindex="-1" aria-labelledby="EditDosenLbModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditDosenLbModalLabel">Edit Dosen LB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open(base_url() . 'distribusi/dlbEdit/'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namadosenlb">Nama</label>
                        <input type="hidden" name="id" id="id" value="<?= $lb->id ?>">
                        <input type="text" class="form-control" id="namadosenlb" name="namadosenlb" value="<?= $lb->namadosen ?>">
                    </div>
                    <div class="form-group">
                        <label for="nohp">No. Hp</label>
                        <input type="text" class="form-control" id="nohp" name="nohp" value="<?= $lb->nohp ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Edit</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    $(document).ready(function() {
        var table = $('#tabel-lb').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true

        });
    });
</script>