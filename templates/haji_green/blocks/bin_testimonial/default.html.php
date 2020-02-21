<?php  if ( ! defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($r_data))
{
	?>
	<div id="myCarouselTestimonials" class="carousel slide no_margin" data-ride="carousel" data-interval="5000">
		<div class="container">
			<div class="col-xs-12">
				<div class="carousel-inner">
					<?php
					foreach ($r_data as $k => $data)
					{
						$active = $k == 0 ? ' active' : '';
						$src    = !empty($data['image']) ? is_url($data['image'])? $data['image'] : _URL.'modules/bin/'.$data['image'] : '';
						?>
						<div class="item carousel-item<?php echo $active ?>">
							<div class="row">
								<div class="col-md-4" align="center">
									<?php
									if (!empty($src))
									{
										?>
										<img src="<?php echo $src; ?>" alt="<?php echo $data['name'];?>" class="img-fluid img-circle">
										<?php
									}
									?>
								</div>
								<div class="col-md-8">
									<h5><?php echo $data['name'];?></h5>
									<small><?php echo $data['location_name'];?></small>
									<p><?php echo strip_tags($data['detail']); ?></p>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php
		if (count($r_data) > 1) 
		{
			?>
			<a class="left carousel-control" href="#myCarouselTestimonials" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			</a>
			<a class="right carousel-control" href="#myCarouselTestimonials" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			</a>
			<?php
		}
		?>
	</div>

	<div class="row">
		<div class="col-md-12" align="center" style="margin: 30px 0;">
			<a href="<?php echo site_url('bin/testimonial'); ?>"><?php echo lang('See More Testimonial') ?><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
		</div>
	</div>
	<?php
}else{
	?>
	<div class="text-center">
		<?php echo msg(lang('Belum ada testimoni dari member.')); ?>
	</div>
	<?php
}
