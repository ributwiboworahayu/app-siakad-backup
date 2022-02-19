<li>
  <h6>Notifications</h6>
  <label class="label label-danger"><?=$jml?> New</label>
</li>
 
<?php if ($notif->num_rows()>0): ?>
  <?php foreach ($notif->result() as $ntf): ?>
    <?php $bg=($ntf->status==1)? 'darkgrey':'' ; ?>
    <li style="background: <?=$bg?>">
      <div class="media">
        <img class="d-flex align-self-center img-radius" src="<?=base_url()?>\assets\plkm.png" alt="Generic placeholder image">
        <div class="media-body">
          <h5 class="notification-user"><?=GetUsernameAkun($ntf->pengirim)?></h5>
          <p class="notification-msg"><?=$ntf->pesan?></p>
          <span class="notification-time" style="color:black"><?=lastSeen($ntf->tgl_notif)?></span>
        </div> 
      </div>
    </li>
  <?php endforeach ?>
  <li>
  <h6 style="color:blue" id="read-all">Tandai sebagai sudah di baca semua</h6>
</li>
<?php endif ?>

