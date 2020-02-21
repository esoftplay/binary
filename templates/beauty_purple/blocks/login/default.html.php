<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if($user->id > 0){
	include 'logged.html.php';
}else{
	?>
	<div class="login_button mobile_left">
		<a href="<?php echo site_url('user/login'); ?>" class="w3-btn w3-round-xxlarge btn-login"><?php echo lang('Login') ?></a>  
		<?php 
		if(@$config['register']) 
		{
			?>
			<a href="<?php echo site_url('bin/register'); ?>" class="w3-btn w3-round-xxlarge btn-reg"><?php echo lang('Registrasi') ?></a> 
			<?php 
		}
		?>
	</div>
	<?php
}