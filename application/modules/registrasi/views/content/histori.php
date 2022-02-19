<div class="row">
    <?php foreach ($histori as $data): ?>
        <?php $bg=($data->status=='Proses')? 'bg-simple-c-blue':($data->status=='Aktif'? 'bg-simple-c-green' : 'bg-simple-c-pink')?>
        <div class="col-xl-4 col-md-3" style="cursor: pointer;" onclick="cekHistory(<?=$data->id_rreg?>)">
            <div class="card social-card <?=$bg?>">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <i class="feather icon-check-square f-34 text-c-blue social-icon"></i>
                        </div>
                        <div class="col">
                            <div class="row">
                                <h5 class="col-sm-6 m-b-10">Semester <?=$data->semester_sebelum?></h5>
                                <h5 class="col-sm-6 m-b-10"><?=getDetailAKD2($data->takad_id)?> </h5>
                                <div class="col-sm-6"> 
                                    <p class="m-b-0 " style="font-size: 11px">S Sebelum : <?=$data->semester_sebelum?></p>
                                    <p class="m-b-0 " style="font-size: 11px">S Pengajuan : <?=$data->semester_pengajuan?></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="m-b-0" style="font-size: 11px">Terdaftar : <?=tgl_format($data->tgl_terdaftar)?></p>
                                    <?php if ($data->tgl_selesai=='0000-00-00 00:00:00'): ?>
                                        <p class="m-b-0 " style="font-size: 11px">Selesai : Proses</p>
                                    <?php endif ?>
                                    <?php if ($data->tgl_selesai!='0000-00-00 00:00:00'): ?>
                                        <p class="m-b-0 " style="font-size: 11px">Selesai : <?=tgl_format($data->tgl_selesai)?></p>
                                    <?php endif ?>
                                </div>

                                <p class="col-sm-12 text-center m-t-10" style="font-size: 24px;">Status : <?=$data->status?></p>  
                            </div>

                        </div>
                    </div>
                </div>
                <a href="<?=base_url()?>registrasi/lihatDetailHistori/<?=$data->id_rreg?>" class="download-icon"><i class="feather icon-arrow-down"></i></a>
            </div>
        </div>
    <?php endforeach ?>
        
</div>
<script>
    function cekHistory(a) {
        window.location.href="<?=base_url()?>registrasi/lihatDetailHistori/"+a;
    }
</script>