<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');?>
<div class="row">
	<div class="col-md-12 text-center" style="margin:80px 0 30px;">
		<img src="<?php echo $sys->template_url ?>html/img/registrasi/icon_sukses.png" alt="">
	</div>
</div>
<div class="row">
	<div class="col-md-12 text-center" style="margin:0 0 20px;">
		<span><?php echo lang('SUKSES'); ?></span>
	</div>
</div>
<div class="row">
	<div class="col-md-12" align="center">
	 <?php echo lang('Registrasi Member Berhasil Di proses'); ?> <br> <?php echo lang('Member ID Anda adalah'); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h4 class="text-center" style="color: #774500; font-weight: bold;"><?php echo @$output['user_data']['username']; ?></h4>
	</div>
</div>
<div class="row">
	<div class="col-md-12 text-center">
		<a href=""><button class="w3-btn w3-ripple" style="margin-top: 25px; background-color: #774500; color:white;"><?php echo lang('Daftar Lagi') ?></button></a>
	</div>          
</div>