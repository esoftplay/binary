<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>
<div class="statistikIndex">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2><?php echo $block->title; ?></h2>
			</div>
		</div>
		<?php 
		$r_class = array('newMember','topIncome','topSponsor');
		foreach ($r_data as $key => $value) 
		{
			?>
			<div class="col-md-4 statMenu">
				<div class="text-center py-3 testiHead <?php echo $r_class[$key]; ?>">
					<img src="templates/haji_blue/html/img/index/icon_statistik1.png" class="mr-2" style="max-width: 15%;">
					<span><?php echo lang(@$statistic_title[$config['cat'][$key]]); ?></span>
				</div>
				<div class="text-center px-3 py-5" style="height: 450px;">
					<div class="carousel slide" data-ride="carousel" data-interval="5000">
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
										<div class="row mb-3 d-flex-c">
											<div class="col-5">
												<img src="<?php echo _URL?>templates/haji_blue/html/img/index/icon_statistik2.png" class="img-fluid" style="width: 80%">
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
<?php
$block->title = '';