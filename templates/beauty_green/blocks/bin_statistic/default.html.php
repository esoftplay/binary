<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>
<section class="statistik-index" style="background-image: url('<?php echo $sys->template_url.'html/img/index/background_statistik.png'; ?>');">
	<div class="row statistik_group">
		<div class="col-12 text-center mb-5">
			<h2 class="text-white"><?php echo $block->title; ?></h2>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="statistik_group_btn_list col-md-4">
				<?php 
				foreach ($r_data as $key => $value) 
				{
					?>
					<a href="#" class="statistik_group_btn" data-id="statistik_index_<?php echo $key; ?>">
						<div class="row d-flex-c">
							<div class="col-md-8">
								<div class="py-3 stat-btn d-flex-c">
									<img src="<?php echo $sys->template_url ?>html/img/index/icon_statistik1.png" class="img-responsive mr-2" style="max-width: 15%;">
									<span><?php echo lang(@$statistic_title[$config['cat'][$key]]); ?></span>
								</div>
							</div>
						</div>
					</a>
					<?php 
				}
				?>
			</div>
			<div class="statistik_group_item_list col-md-8">
				<?php 
				foreach ($r_data as $key => $value) 
				{
					$value = array_chunk($value, 4);
					?>
					<div class="statistik_group_item" data-id="statistik_index_<?php echo $key; ?>" style="display: none;">
						<div class="carousel slide" data-ride="carousel" data-interval="5000">
							<div class="carousel-inner">
								<?php
								foreach ($value as $key1 => $value1) 
								{
									$active = $key1 == 0 ? ' active' : '';
									?>
									<div class="item carousel-item<?php echo $active ?>">
										<?php 
										foreach ($value1 as $key2 => $value2) 
										{
											?>
											<div class="col-md-6">
											  <div class="row mb-5 d-flex-c">
													<div class="col-5">
														<img src="<?php echo $sys->template_url ?>html/img/index/icon_statistik2.png" class="img-fluid"  style="max-width: 65%;">
													</div>
													<div class="col-7 text-left text-white pl-0">
														<span><?php echo strtoupper($value2['username']) ?></span><br>
														<span><?php echo ucwords($value2['name']) ?></span><br>
														<span><?php echo ucwords($value2['location_name']) ?></span>
													</div>
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
					<?php 
				}
				?>
			</div>
		</div>
	</div>
</section>
<?php
$block->title = '';