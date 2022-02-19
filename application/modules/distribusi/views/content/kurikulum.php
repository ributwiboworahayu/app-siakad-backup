<!-- Begin Page Content -->

<div class="card col-lg-9 mx-auto">
    <div class="card-header">
        <?= form_error('namakurikulum', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>
        <?= $this->session->flashdata('message'); ?>
        <a href="" class="btn btn-warning mb-3" data-toggle="modal" data-target="#NewKurikulumModal">Buat Kurikulum Baru</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tabel-kr" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Kurikulum</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php if ($kurikulum1 > 0) : ?>
                        <?php foreach ($kurikulum as $kr) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td>
                                    <?= $kr['tahun']; ?>
                                </td>
                                <td>
                                    <?= $kr['namakurikulum']; ?>
                                </td>
                                <td>
                                    <a class="badge badge-pill badge-success" href="<?= base_url('distribusi/matakuliah/') . $kr['id']; ?>">view</a>
                                    <a class="badge badge-pill badge-warning" href="" data-toggle="modal" data-target="#EditKurikulumModal<?= $kr['id']; ?>">Edit</a>
                                    <a class="badge badge-pill badge-danger" onclick="return confirm('yakin?');" href="<?= base_url(); ?>distribusi/hapusKurikulum/<?= $kr['id']; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan='4' class='text-center pt-4 pb-4'>
                                <strong>Belum Ada Data Kurikulum.</strong>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="NewKurikulumModal" tabindex="-1" aria-labelledby="NewKurikulumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewKurikulumModalLabel">Tambah Kurikulum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form action="<?= base_url('distribusi/kurikulumBaru'); ?>" method="post"> -->
            <?= form_open(base_url() . 'distribusi/kurikulum'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" min="2010" class="form-control" id="tahun" name="tahun" value="2021">
                </div>
                <div class="form-group">
                    <label for="namakurikulum">Nama</label>
                    <input type="text" class="form-control" id="namakurikulum" name="namakurikulum" placeholder="Nama Kurikulum">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-danger">Tambah</button>
            </div>
            <?= form_close(); ?>
            <!-- </form> -->
        </div>
    </div>
</div>

<!-- Modal -->
<?php foreach ($kurikulum as $kr) : ?>
    <div class="modal fade" id="EditKurikulumModal<?= $kr['id']; ?>" tabindex="-1" aria-labelledby="EditKurikulumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditKurikulumModalLabel">Edit Kurikulum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <form action="<?= base_url('distribusi/editKurikulum/'); ?>" method="post"> -->
                <?= form_open(base_url() . 'distribusi/kurikulumEdit/' . $kr['id'], ['id' => 'form-kredit']); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="hidden" name="id" id="id" value="<?= $kr['id']; ?>">
                        <input type="number" min="2010" class="form-control" id="tahun" name="tahun" value="<?= $kr['tahun']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="namakurikulum">Nama</label>
                        <input type="text" class="form-control" id="namakurikulum" name="namakurikulum" value="<?= $kr['namakurikulum']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Edit</button>
                </div>
                <?= form_close(); ?>
                <!-- </form> -->
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    $(document).ready(function() {
        var table = $('#tabel-kr').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true

        });
    });
</script>