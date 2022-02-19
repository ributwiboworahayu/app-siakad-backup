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
                    <div class="form-group">
                        <label for="">Prodi</label>
                        <select name="ftprodi" id="ftprodi" class="form-control">
                            <option disabled selected> -- Pilih Prodi -- </option>
                            <?php foreach ($prodi as $pr) : ?>
                                <option value="<?= $pr->kode_prodi ?>"><?= $pr->nama_prodi ?></option>
                            <?php endforeach ?>
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
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Silahkan pilih prodi terlebih dahulu!
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#ftprodi').on('change', function() {
            var taid = $('#ftthnakad').val();
            var pid = $(this).val();
            $('#verif').load('<?= base_url() ?>distribusi/t_verifwadir?taid=' + taid + '&prid=' + pid);
        });

    });
</script>