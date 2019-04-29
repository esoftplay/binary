<?php  if ( ! defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($r_data))
{
	?>
	<div id="myCarouselTestimonials" class="carousel slide myCarouselTestimonials" data-ride="carousel" data-interval="5000">
		<div class="carousel-inner">
			<?php
			foreach ($r_data as $k => $data)
			{
				$active = $k == 0 ? ' active' : '';
				$src    = !empty($data['image']) ? is_url($data['image'])? $data['image'] : _URL.'modules/bin/'.$data['image'] : '';
				?>
				<div class="item carousel-item<?php echo $active ?>">
					<div class="row" align="center">
						<div class="col-md-8 col-md-offset-2" align="center" style="background-color: #e0e0e0;">
							<p><?php echo strip_tags($data['detail']); ?></p>
						</div>
					</div>
					<div class="row" align="center" style="margin-top: 20px;">
						<div class="col-md-2"></div>
						<?php
						if (!empty($src))
						{
							?>
							<div class="col-xs-3 col-md-3" align="end">
								<img src="<?php echo $src; ?>" alt="<?php echo $data['name'];?>">
							</div>
							<?php
						}
						?>
						<div class="col-xs-9 col-md-5" align="left">
							<h4 style="font-style: italic; color:green;"><?php echo $data['name'];?></h4>
							<p><?php echo str_replace(' - ', '<br>- ', $data['location_name']);?></p>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		<a class="carousel-control left" href="#myCarouselTestimonials" data-slide="prev">
			<i class="glyphicon glyphicon-chevron-left"></i>
		</a>
		<a class="carousel-control right" href="#myCarouselTestimonials" data-slide="next">
			<i class="glyphicon glyphicon-chevron-right"></i>
		</a>
	</div>
	<div class="row">
		<div class="col-md-12" align="center" style="margin-top: 50px;">
			<a href="<?php echo site_url('bin/testimonial'); ?>" class="text_green"><?php echo lang('See More Testimonial') ?>
				<i class="fa fa-arrow-right"></i>
			</a>
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
