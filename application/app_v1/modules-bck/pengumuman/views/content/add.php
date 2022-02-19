<div class="row">
	<div class="col-xl-12">
		<!-- <div class="card">
			<div class="card-block"> -->
				<!-- <div class="j-wrapper j-wrapper-640"> -->
					<!-- <form action="" method="post" class="j-pro" id="j-pro" novalidate=""> -->
					<?= form_open(base_url().'pengumuman/save', array('method' =>"post",'class'=>"j-pro",'id'=>"add-form")); ?>
					<input type="hidden" name="method" value="add" >
						<div class="j-content">
							<!-- start name -->
							<div class="j-unit">
								<label class="j-label">Tahun Akademik</label>
								<div class="j-unit">
									<label class="j-input j-select">
										<select name="akademik" id="akademik">
											<option value="">Pilih TA</option>
											
											<?php foreach ($akd as $akd):?>
												
											<option value="<?=$akd->id_thnakad?>" ><?=$akd->thun_akademik?> - <?=$akd->ta_tipe?></option>
										<?php endforeach?>
										</select>
										<i></i>
									</label>
								</div>
							</div>
							<div class="j-unit">
								<label class="j-label">No Pengumuman/Surat</label>
								<div class="j-input">
									<label class="j-icon-right" for="name">
										<i class="icofont icofont-ui-calendar"></i>
									</label>
									<input type="text" id="no_surat" name="no_surat">
								</div>
							</div>
							<!-- end date -->
							<div class="j-divider j-gap-bottom-25"></div>
							<!-- start message -->
							<div class="j-unit">
								<label class="j-label">Isi Pengumuman/Surat</label>
								<div class="j-input">
									<textarea spellcheck="false" name="isi" class="ckeditor" id="ckeditor"></textarea>
								</div>
							</div>
							<!-- end message -->
							<!-- start response from server -->
							<div class="j-response"></div>
							<!-- end response from server -->
						</div>
						<!-- end /.content -->
						<div class="j-footer">
							<button type="submit"  class="btn btn-primary">Simpan</button>
						</div>
						<!-- end /.footer -->
					<?= form_close(); ?>
				<!-- </div> -->
			<!-- </div>
		</div> -->
	</div>
</div>
<script type="text/javascript">
   
$(document).ready(function() {
	ajaxcsrf();
	// $('textarea#editor').ckeditor();
	$('#add-form').on('submit',function(event) {
		event.preventDefault();
         CKEDITOR.instances['ckeditor'].updateElement();
		$.ajax({
			url: $(this).attr('action'),
			type: 'post',
			data: $(this).serialize(),
			success : function(res) {
				Swal.fire({
					title: 'Berhasil',
					text: res.pesan,
					icon: 'success',
					showCancelButton: false,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'OK'
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = "<?=base_url()?>pengumuman";
					}
				})
			}
		})
	
		
	});
	
});
   

</script>