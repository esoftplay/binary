<!doctype html>
<html lang="en">
	<head>
	<?php echo $sys->meta(); ?>    
	</head>
	<body <?php if(@$_GET['menu_id']==-1) echo 'class="page_home"' ?>>
		<div class="head<?php if(!_ADMIN) echo ' navbar-fixed-top' ?>">
			<div class="container">
				<?php echo $sys->block_show('intro');?>
			</div>
		</div>
		<nav class="navbar navbar-default<?php if(!_ADMIN) echo ' navbar-fixed-top' ?>">
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
				<div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
					<?php echo $sys->block_show('header');?>
				</div>
			</div>
		</nav>
		<div id="0"></div>
		<?php echo $sys->block_show('top');?>
		<?php echo $sys->block_show('content_top');?>
		<?php 
		if(@$_GET['menu_id'] != -1) 
		{
			?>
			<section class="content_wrapper">
				<div class="container"><?php echo trim($Bbc->content); ?></div>
			</section>
			<?php 
		}else{
			echo trim($Bbc->content);
		}
		?>
		<?php echo $sys->block_show('content_bottom');?>
		<?php
		$bottom = trim($sys->block_show('bottom'));
		if (!empty($bottom))
		{
			?>
			<section class="statistik-index" style="background-image: url('<?php echo $sys->template_url.'html/img/index/background_statistik.png'; ?>');">
				<div class="container">
					<div class="row statistik_group">
						<?php echo $sys->block_show('bottom');?>
					</div>
					<div class="row">
						<div class="statistik_group_btn_list col-md-4"></div>
						<div class="statistik_group_item_list col-md-8"></div>
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
					<div class="col-lg-7 text-right copyright">
						<p><?php echo config('site','footer');?></p>
					</div>
				</div>
			</div>  
		</div>
		<a href="#0" class="cd-top js-cd-top" style="background-image: url('<?php echo $sys->template_url.'html/img/cd-top-arrow.svg'; ?>')"></a>
		<?php $sys->link_js($sys->template_url.'../admin/bootstrap/js/bootstrap.min.js', false); ?>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.js'></script>
		<?php $sys->link_js($sys->template_url.'js/script_compress.js', false); ?>
	</body>
</html>