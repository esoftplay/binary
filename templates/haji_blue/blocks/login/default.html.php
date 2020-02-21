<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if($user->id > 0){
	include 'logged.html.php';
}else{
	?>
	<ul class="nav navbar-nav navbar-right login mobile_left">
		<a href="<?php echo site_url('user/login'); ?>"><?php echo lang('Login') ?></a>  
		<?php 
		if(@$config['register']) 
		{
			?>
			<a href="<?php echo site_url('bin/register'); ?>"><?php echo lang('Registrasi') ?></a> 
			<?php 
		}
		?>
	</ul>
	<?php
}