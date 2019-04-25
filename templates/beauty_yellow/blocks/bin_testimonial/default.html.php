<?php  if ( ! defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($r_data))
{
	?>
  <div id="myCarouselTestimonials" class="carousel slide no_margin" data-ride="carousel" data-interval="5000">
		<div class="carousel-inner">
			<?php
			foreach ($r_data as $k => $data)
			{
				$active = $k == 0 ? ' active' : '';
				$src    = !empty($data['image']) ? is_url($data['image'])? $data['image'] : _URL.'modules/bin/'.$data['image'] : '';
				?>
				<div class="item carousel-item<?php echo $active ?>">
			    <div class="row">
			      <div class="col-md-12" align="center">
			        <p><?php echo strip_tags($data['detail']); ?></p>
			      </div>
			    </div>
		     	<div class="row tester no_margin">
						<div class="col-md-6 col-md-offset-3">
						  <div class="row">
						    <div class="col-md-4 no-left" align="center">
						    	<?php
									if (!empty($src))
									{
										?>
										<img src="<?php echo $src; ?>" alt="<?php echo $data['name'];?>" class="img-fluid img-circle" alt="" style="filter: grayscale(0%); width: 100px; height: 100px;">
										<?php
									}
									?>
						    </div>
						    <div class="col-md-8 testi-user no-right text-left">
						      <h5><?php echo $data['name'];?></h5>
						      <small><?php echo $data['location_name'];?></small>
						    </div>
						  </div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>

		<a class="carousel-control left carousel-control-prev" href="#myCarouselTestimonials" data-slide="prev">
      <i class="fa fa-angle-left"></i>
    </a>
    <a class="carousel-control right carousel-control-next" href="#myCarouselTestimonials" data-slide="next">
      <i class="fa fa-angle-right"></i>
    </a>
  </div>

  <div class="row">
    <div class="col-md-12" align="center" style="margin: 30px 0;">
      <a href="<?php echo site_url('bin/testimonial'); ?>" style="color:#774500;"><?php echo lang('See More Testimonial') ?><i class="fa fa-arrow-right" aria-hidden="true" style="color: #774500;"></i></a>
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
