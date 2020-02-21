<?php  if ( ! defined('_VALID_BBC')) exit('No direct script access allowed');
if (!empty($r_data))
{
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="carousel slide" data-ride="carousel" id="quote-carousel">
				<ol class="carousel-indicators">
					<?php
					foreach ($r_data as $k => $data)
					{
						$active = $k == 0 ? ' class="active"' : '';
						if (!empty($data['image']))
						{
							$src = is_url($data['image'])? $data['image'] : _URL.'modules/bin/'.$data['image'];
						}else{
							$src = '';
						}
						?>
						<li data-target="#quote-carousel" data-slide-to="<?php echo $k ?>"<?php echo $active?>>
							<img class="img-responsive" src="<?php echo $src ?>" alt="<?php echo $data['name'];?>">
						</li>
						<?php
					}
					?>
				</ol>
				<div class="carousel-inner text-center">
					<?php
					foreach ($r_data as $k =>  $data)
					{
						$active = $k == 0 ? ' active' : '';
						$link   = 'index.php?mod=bin.testimonial_detail&id='.$data['id'];
						?>
						<div class="item<?php echo $active?>">
							<div class="row">
								<div class="col-md-12">
									<h4><?php echo $data['name'];?></h4>
									<h6><?php echo $data['location_name'];?></h6>
									<p><?php echo $data['detail']; ?></p>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<div class="col-md-12 text-center">
					<a href="<?php echo site_url('bin/testimonial'); ?>"><?php echo lang('See More Testimonial') ?></a>
				</div>
			</div>
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

