<div class="row">
	<div class="col-xl-12">
		<a href="<?=base_url()?>pengumuman" class="btn btn-warning text-left"><i class="ion-arrow-left-a"></i>Kembali</a><hr>
		<?= form_open(base_url().'pengumuman/saveHslReview', array('method' =>"post",'class'=>"j-pro",'id'=>"rvw-form")); ?>
		<input type="hidden" name="role" value="<?=$role?>" >
		<input type="hidden" name="id_p" value="<?=$hsl->id_pengumuman?>">
		<div class="j-content">
			<!-- start name -->
			<div class="j-unit">
				<label class="j-label">Tahun Akademik</label>
				<div class="j-input">
					<input type="text" id="no_surat" name="no_surat" readonly="" value="<?=$hsl->thun_akademik?> - <?=$hsl->ta_tipe?>">
				</div>
			</div>
			<div class="j-unit">
				<label class="j-label">No Pengumuman/Surat</label>
				<div class="j-input">
					<input type="text" id="no_surat" name="no_surat" readonly="" value="<?=$hsl->no_pengumuman?>"> 
				</div>
			</div>
			
			<div class="j-divider j-gap-bottom-25"></div>
			
			<div class="j-unit">
				<label class="j-label">Isi Pengumuman/Surat</label>
				<div class="j-input">
					<textarea spellcheck="false" name="isi" class="ckeditor" id="ckeditor" readonly=""><?=$hsl->isi_pengumuman?></textarea>
				</div>
			</div>
			
			<div class="j-response"></div>
			<div class="j-unit ">
				<label class="j-label">Action</label>
				<div class="j-unit">
					<label class="j-input j-select">
						<?php $selected = ($review == 0) ? '' : 'selected'; ?>
						<select name="action" id="action" required="">
							<option value="">Pilih aksi</option>
							<option value="review" <?=$selected?>>Review</option>
							<?php if ($role=='kabak'): ?>
								<option value="validasi">Validasi</option>
							<?php endif ?>
							<?php if ($role=='wadir'): ?>
								<option value="publish">Publish</option>
							<?php endif ?>
							
						</select>
						<i></i>
					</label>
					<small style="color: red;" id="nb"></small>
				</div>

			</div>
			<div class="j-unit" id="note">
				<label class="j-label">Note</label>
				<div class="j-input">
					<textarea spellcheck="false" name="note" style="font-size: 14px;"><?=$review_isi?></textarea>
				</div>
			</div>
		</div>
		
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
			if (<?=$review== 0?>) {
				$('#note').hide();
			}else{
				$('#note').show();
			}
			
			$('#action').change(function(event) {
				/* Act on the event */
				const val=$(this).val();
				if (val=='review') {
					$('#nb').text('NB: Action Yang Wajib Di isi Note review Untuk Operator, Silahkan Di isi note review pada bagian bawah berikut');
					$('#note').show();
				}else if(val=='publish'){
					$('#nb').text('NB: Action Untuk Mempublish Pengumuman Ke Telegram');
					$('#note').hide();
				}else if(val=='validasi'){
					$('#nb').text('NB : Action Untuk Memvalidasi pengumuman Dan mengirim Ke Wadir Untuk Di Validasi Dan di publish oleh wadir');
					$('#note').hide();
				}else if(val==''){
					$('#nb').text('');
					$('#note').hide();
				}
			});

			$('#rvw-form').on('submit',function(event) {
				event.preventDefault();
				$.ajax({
					url: $(this).attr('action'),
					type: 'post',
					data: $(this).serialize(),
					success : function(res) {
						if (res.status) {
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

					}
				})
			});
		});
	</script>