<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');?>
<div class="row">
	<div class="col-md-8 col-md-offset-2" style="display: flex; justify-content: center;">
		<p style="text-align: center!important; margin-top: 30px;"><?php echo lang('Silahkan lakukan pendaftaran, Pastikan ID Sponsor, ID Upline, dan posisi node yang anda masukkan benar, karena tidak bisa melakukan perubahan lagi jika anda sudah mengetahui sponsor dan upline anda, silahkan isi form di bawah ini'); ?></p>
	</div>
</div>
<div class="no-clonner">
	<div class="row form-reg">
		<div class="col-xs-4 col-sm-2"><?php echo lang('Sponsor')?></div>
		<div class="col-xs-8 col-sm-4">
			<input value="<?php echo @$_SESSION['bin_register']['data']['params']['sponsor']; ?>" name="bin_register[params][sponsor]" class="form-control" title="<?php echo lang('Member Sponsor'); ?>" placeholder="<?php echo lang('Member Sponsor'); ?>" req="any true" type="text" />
			<p class="help-block"> <?php echo lang($custom_fields['sponsor']['tips']) ?></p>
		</div>
	</div>
	<div class="row form-reg">
		<div class="col-xs-4 col-sm-2"><?php echo lang('Upline');?></div>
		<div class="col-xs-8 col-sm-4">
			<input value="<?php echo @$_SESSION['bin_register']['data']['params']['upline']; ?>" name="bin_register[params][upline]" class="form-control" req="any true" type="text" placeholder="<?php echo lang('Member Upline') ?>" />
			<p class="help-block"> <?php echo lang($custom_fields['upline']['tips']) ?></p>
		</div>
	</div>
	<div class="row form-reg">
		<div class="col-xs-4 col-sm-2"><?php echo lang('Posisi Titik')?></div>
		<div class="col-xs-8 col-sm-4">
			<div class="radio">
				<label>
					<input name="bin_register[params][position]" value="0" type="radio"<?php echo is_checked(empty(@$_SESSION['bin_register']['data']['params']['position'])); ?> id="position0" /><?php echo lang('Kiri')?>
				</label>
				<label>
					<input name="bin_register[params][position]" value="1" type="radio"<?php echo is_checked(!empty(@$_SESSION['bin_register']['data']['params']['position']));?> id="position1" /><?php echo lang('Kanan')?>
				</label>
			</div>      
		</div>
	</div>
</div>
<div class="row form-reg">
	<div class="col-md-12 form-reg">
		<p style="text-align: center!important;">
			<label style="cursor: pointer;">
				<input class="form-check-input position-static" type="checkbox" id="bin_register_step_next" value="1">
				<?php echo lang('Saya telah mengisi form secara benar, menyetujui & Mematuhi segala peraturan perusahaan'); ?>
			</label>
		</p>
	</div>
</div>
<div class="row">
	<div class="col-md-12 text-center">
		<button type="submit" name="bin_register_step" value="1" class="w3-btn w3-ripple" style="margin-top: 25px; background-color: green; color: white; font-weight: bold;" disabled="disabled"><?php echo lang('Selanjutnya'); ?></button>
	</div>          
</div>
<script type="text/javascript">
	_Bbc(function($){
		$('#bin_register_step_next').on('change', function(event) {
			if ($(this).prop('checked')) {
				$('[name="bin_register_step"]').removeAttr('disabled');
			}else{
				$('[name="bin_register_step"]').attr('disabled', 'disabled');
			}
		});
		$('#member_reg').on('submit', function(event) {
			if (!$('#bin_register_step_next').prop('checked')) {
				return false;
			}
		});
	});
</script>