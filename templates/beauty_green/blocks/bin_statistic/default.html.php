<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>
<a href="#" class="statistik_group_btn" data-id="<?php echo $block->id; ?>" style="display: none;">
	<div class="row d-flex-c">
		<div class="col-md-8">
			<div class="py-3 stat-btn d-flex-c">
				<img src="<?php echo $sys->template_url ?>html/img/index/icon_statistik1.png" class="img-responsive mr-2" style="max-width: 15%;">
				<span><?php echo @$block->title; ?></span>
			</div>
		</div>
	</div>
</a>
<div class="statistik_group_item" data-id="<?php echo $block->id; ?>" style="display: none;">
	<div class="carousel slide" data-ride="carousel" data-interval="5000">
		<div class="carousel-inner">
			<?php
			if (!empty($member_data))
			{
				foreach ($member_data as $k => $datas)
				{
					$active = $k == 0 ? ' active' : '';
					?>
					<div class="item carousel-item<?php echo $active ?>">
						<?php 
						foreach (array($datas,(@$member_data[$k+1])?$member_data[$k+1]:$member_data[0]) as $k2 => $datas2) 
						{
							?>
							<div class="col-md-6 <?php if($k2==1) echo 'hidden-xs'; ?>">
								<?php
								foreach ($datas2 as $data)
								{
									$location_name = explode(',', $data['location_name']);
									$location_name = explode('-', end($location_name));
									?>
								  <div class="row mb-5 d-flex-c">
										<div class="col-5">
											<img src="<?php echo $sys->template_url ?>html/img/index/icon_statistik2.png" class="img-fluid"  style="max-width: 65%;">
										</div>
										<div class="col-7 text-left text-white pl-0">
											<span><?php echo strtoupper($data['username']) ?></span><br>
											<span><?php echo ucwords($data['name']) ?></span><br>
											<span><?php echo ucwords(reset($location_name)) ?></span>
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
					<?php
				}
			}else{
				echo lang(msg('Belum ada member yang terdaftar'));
			}
			?>
		</div>
	</div>
</div>