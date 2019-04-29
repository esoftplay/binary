<!doctype html>
<html lang="en">
	<head>
		<?php echo $sys->meta() ?>    
	</head>
	<body>
		<div class="head">
			<div class="container">
				<?php echo $sys->block_show('intro');?>
			</div>
		</div>
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="navbarNavAltMarkup" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?php echo $sys->block_show('logo');?>
				</div>
				<div class="collapse navbar-collapse pull-right mobile_left" id="bs-example-navbar-collapse-1">
					<?php echo $sys->block_show('header');?>
				</div>
			</div>
		</nav>
		<?php echo $sys->block_show('top');?>
		<?php echo $sys->block_show('content_top');?>
		<?php $is_home = _ADMIN != '' || @$_GET['menu_id']==-1 ? true : false; ?>
		<?php $classes = $is_home ? 'about-index' : 'page' ?>
		<section class="<?php echo $classes?>">
			<div class="container<?php $is_home ? '' : ' d-flex-c'?>">
				<?php echo trim($Bbc->content);?>
			</div>
			<div class="clearfix"></div>
		</section>
		<?php echo $sys->block_show('content_bottom');?>
		<?php
		$bottom = trim($sys->block_show('bottom'));
		if (!empty($bottom))
		{
			?>
			<section class="stat-index">
				<div class="container">
					<div class="row py-5">
						<?php echo $sys->block_show('bottom');?>
					</div>
				</div>
			</section>
			<?php
		}
		?>
		<?php echo $sys->block_show('bottom_2');?>
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
		<?php $sys->link_js($sys->template_url.'../admin/bootstrap/js/bootstrap.min.js', false); ?>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
		<script src='http://cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js'></script>
		<?php $sys->link_js($sys->template_url.'js/script_compress.js', false); ?>
		<?php echo $sys->block_show('debug'); ?>
	</body>
</html>