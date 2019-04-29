<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');?>
<div class="row">
	<div class="col-md-8 col-md-offset-2" style="display: flex; justify-content: center;">
		<p style="text-align: center!important; margin-top: 30px;"><?php echo lang('Silahkan isi form yang ada dengan benar, Pastikan identitas yang diisikan sudah sesuai untuk keanggotaan anda'); ?></p>
	</div>
</div>
<div>
	<input value="<?php echo @$_SESSION['bin_register']['data']['params']['sponsor']; ?>" name="params[sponsor]" type="hidden" />
	<input value="<?php echo @$_SESSION['bin_register']['data']['params']['upline']; ?>" name="params[upline]" type="hidden" />
	<input value="<?php echo @$_SESSION['bin_register']['data']['params']['position']; ?>" name="params[position]" type="hidden" />
</div>
<div class="row d-flex-c">
	<div class="col-md-10">
		<p style="color: #774500; font-weight: bold; text-align: left;"><?php echo lang('Data Jaringan'); ?></p>
		<br>
		<hr>
	</div>
</div>
<div class="row d-flex">
	<div class="col-xs-4 col-sm-2 col-sm-offset-1">
		<p><?php echo lang('Sponsor')?></p>
	</div>
	<div class="col-xs-8">
		<p>: <?php echo @$_SESSION['bin_register']['data']['params']['sponsor']; ?></p>
	</div>
</div>
<div class="row d-flex">
	<div class="col-xs-4 col-sm-2 col-sm-offset-1">
		<p><?php echo lang('Upline');?></p>
	</div>
	<div class="col-xs-8">
		<p>: <?php echo @$_SESSION['bin_register']['data']['params']['upline']; ?></p>
	</div>
</div>
<div class="row d-flex">
	<div class="col-xs-4 col-sm-2 col-sm-offset-1">
		<p><?php echo lang('Posisi Titik')?></p>
	</div>
	<div class="col-xs-8">
		<p>: <?php echo (@$_SESSION['bin_register']['data']['params']['position']) ? lang('Kanan') : lang('Kiri') ; ?></p>
	</div>
</div>
<div class="row d-flex-c">
	<div class="col-md-10">
		<br>
		<p style="color: #774500; font-weight: bold; text-align: left;"><?php echo lang('Data Kartu'); ?></p>
		<br>
		<hr>
	</div>
</div>
<div class="row d-flex">
	<div class="col-md-2 col-md-offset-1"><?php echo lang('Serial')?></div>
	<div class="col-md-8">
		<input value="<?php echo @$_POST['params']['serial']; ?>" name="params[serial]" class="form-control" title="<?php echo lang('Serial'); ?>" placeholder="<?php echo lang('Serial'); ?>" req="any true" type="text" />
		<p class="help-block"> <?php echo lang($custom_fields['serial']['tips']) ?></p>
	</div>
</div>
<div class="row d-flex">
	<div class="col-md-2 col-md-offset-1"><?php echo lang('PIN Serial')?></div>
	<div class="col-md-8">
		<input value="<?php echo @$_POST['params']['pin']; ?>" name="params[pin]" class="form-control" title="<?php echo lang('PIN Serial')?>" placeholder="<?php echo lang('PIN Serial')?>" req="any true" type="text">
	</div>
</div>
<div class="row d-flex-c">
	<div class="col-md-10">
		<br>
		<p style="color: #774500; font-weight: bold; text-align: left;"><?php echo lang('Data Pribadi'); ?></p>
		<br>
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-md-5 col-md-offset-1">
		<div class="no-clonner">
			<div class="form-group">
				<label><?php echo lang('Nama Member')?></label>
				<input value="<?php echo @$_POST['name']; ?>" name="name" class="form-control" title="<?php echo lang('Nama Member')?>" placeholder="<?php echo lang('Nama Member')?>" req="any true" type="text" />
			</div>
			<div class="form-group">
				<label><?php echo lang('Phone')?></label>
				<input value="<?php echo @$_POST['params']['Phone']; ?>" name="params[Phone]" class="form-control" title="<?php echo lang($custom_fields['Phone']['title']) ?>" placeholder="<?php echo lang($custom_fields['Phone']['title']) ?>" req="phone false" type="text" />
				<p class="help-block"> <?php echo lang($custom_fields['Phone']['tips']) ?></p>
			</div>
			<div class="form-group">
				<label><?php echo lang('Alamat') ?></label>
				<input value="<?php echo @$_POST['params']['location_address']; ?>" name="params[location_address]" class="form-control" title="<?php echo lang('Alamat')?>" placeholder="<?php echo lang('Alamat')?>" req="any true" type="text" />
				<p class="help-block"> <?php echo lang($custom_fields['location_address']['tips']) ?></p>
			</div>
			<div class="form-group location_id">
				<label><?php echo lang('Lokasi') ?></label>
				<input value="<?php echo @$_POST['params']['location_id']; ?>" name="params[location_id]" class="form-control" req="any true" rel="ac" type="text" placeholder="<?php echo lang('Kecamatan / Kota') ?>" data-token="<?php echo encode(json_encode($location_token)); ?>" />
				<p class="help-block"> <?php echo lang($custom_fields['location_id']['tips']) ?></p>
			</div>
			<div class="form-group">
				<label><?php echo lang('Posisi Domisili') ?></label>
				<div class="form-inline">
					<input value="<?php echo @$_POST['params']['location_latlong']; ?>" name="params[location_latlong]" class="form-control" title="<?php echo lang('Latitude Longitude')?>" placeholder="<?php echo lang('Latitude Longitude')?>" req="any false" type="text" />
					<div class="input-group">
						<a href="#marker" class="btn btn-default btn-sm gmap_marker"> <i class="glyphicon glyphicon-map-marker" title="map marker"></i></a>
					</div>
					<?php echo user_location('[name=params\\[location_latlong\\]], .gmap_marker', '.ac_input'); ?>
				</div>
				<p class="help-block"> <?php echo lang($custom_fields['location_latlong']['tips']) ?></p>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="no-clonner">
			<?php
			$params = array(
				'title'       => 'Header of form or title',
				'table'       => 'bbc_account',
				'config_pre'  => array() ,
				'config'      => $user_fields,
				'name'        => 'params',
				'config_post' => array()
				);
			$f = _class('params', $params);
			echo $f->show_param($f->config, @$_POST['params'], $params['name']);
			?>
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
		<a href="<?php echo site_url('bin/register') ?>?bin_register_step_back=0" class="w3-btn w3-ripple" style="margin-top: 25px; background-color: white; color: #774500; font-weight: bold; border: 1px solid #774500;"><?php echo lang('Kembali'); ?></a>
		<button type="submit" name="add_submit_add" value="Register" class="w3-btn w3-ripple" style="margin-top: 25px; background-color: #774500; color: white; font-weight: bold;border: 1px solid #774500;" disabled="disabled"><?php echo lang('Aktifkan Akun'); ?></button>
	</div>          
</div>
<script type="text/javascript">
	_Bbc(function($){
		$('#bin_register_step_next').on('change', function(event) {
			if ($(this).prop('checked')) {
				$('[name="add_submit_add"]').removeAttr('disabled');
			}else{
				$('[name="add_submit_add"]').attr('disabled', 'disabled');
			}
		});
		$('#member_reg').on('submit', function(event) {
			if (!$('#bin_register_step_next').prop('checked')) {
				return false;
			}
		});
	});
</script>