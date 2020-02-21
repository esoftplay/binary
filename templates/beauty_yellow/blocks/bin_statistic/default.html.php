<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>
<section class="stat-index">
	<div class="container">
		<div class="row py-5">
			<div class="col-12 text-center mb-5">
				<h2 class="text-white"><?php echo $block->title; ?></h2>
			</div>
			<?php 
			foreach ($r_data as $key => $value) 
			{
				?>
				<div class="col-md-4 margin_tb20">
					<div class="text-center py-3 panel_head">
						<img src="templates/beauty_yellow/html/img/index/icon_statistik1.png" class="img-fluid mr-2">
						<span><?php echo lang(@$statistic_title[$config['cat'][$key]]); ?></span>
					</div>
					<div class="text-center px-3 py-4 panel_body">
						<div class="carousel slide no_margin" data-ride="carousel" data-interval="5000">
							<div class="carousel-inner">
								<?php
								$value = array_chunk($value, 4);
								foreach ($value as $key1 => $value1) 
								{
									$active = $key1 == 0 ? ' active' : '';
									?>
									<div class="item carousel-item<?php echo $active ?>">
										<?php
										foreach ($value1 as $key2 => $value2)
										{
											?>
											<div class="row mb-3 d-flex-s">
												<div class="col-5">
													<img src="<?php echo _URL?>templates/beauty_yellow/html/img/index/icon_statistik2.png" class="img-fluid">
												</div>
												<div class="col-7 text-left text-white pl-0">
													<span><?php echo strtoupper($value2['username']) ?></span><br>
													<span><?php echo ucwords($value2['name']) ?></span><br>
													<span><?php echo ucwords($value2['location_name']) ?></span>
												</div>
											</div>
											<?php
										}
										?>
									</div>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<?php 
			}
			?>
		</div>
	</div>
</section>
<?php
$block->title = '';