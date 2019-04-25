<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>
<div class="text-center px-3 py-4 statBoxBtm">
	<div class="carousel slide no_margin" data-ride="carousel" data-interval="5000">
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
						foreach ($datas as $data)
						{
							$location_name = explode(',', $data['location_name']);
							$location_name = explode('-', end($location_name));
							?>
						  <div class="row mb-3 d-flex-s px-5">
								<div class="col-5">
									<img src="<?php echo _URL?>templates/haji_green/html/img/icon_statistik2.png" class="img-fluid" style="max-width: 65%;">
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
			}else{
				echo lang(msg('Belum ada member yang terdaftar'));
			}
			?>
		</div>
	</div>
</div>