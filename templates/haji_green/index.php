<!doctype html>
<html lang="en">
	<head>
		<?php echo $sys->meta() ?>    
	</head>
	<body>
		<nav class="navbar navbar-default<?php if(!_ADMIN) echo ' navbar-fixed-top' ?>">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?php echo $sys->block_show('logo');?>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<?php echo $sys->block_show('header');?>
				</div>
			</div>
		</nav>
		<?php 
		$is_home = _ADMIN != '' || @$_GET['menu_id']==-1 ? true : false;
		if (!$is_home)
		{
			?>
			<!-- <div class="jumbotron text-center"></div> -->
			<?php
		}
		echo $sys->block_show('content_top');
		echo trim($Bbc->content); 
		echo $sys->block_show('content_bottom');
		?>
		<div class="footer">
			<div class="container">
				<div class="row">
					<?php echo $sys->block_show('footer');?>  
					<div class="col-lg-7 text-right margin_tb10">
						<p><?php echo config('site','footer');?></p>
					</div>
				</div>
			</div>
		</div>
		<a href="#0" class="cd-top js-cd-top"></a>
		<?php $sys->link_js($sys->template_url.'../admin/bootstrap/js/bootstrap.min.js', false); ?>
		<?php $sys->link_js($sys->template_url.'js/script_compress.js', false); ?>
		<?php echo $sys->block_show('debug'); ?>
	</body>
</html>