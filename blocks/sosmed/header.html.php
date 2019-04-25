<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>
<div class="row">
  <div class="col-sm-6">
    <p><?php echo date('l, F d, Y') ?></p>
  </div>
  <div class="col-sm-6 head-icon text-right">
		<?php
		foreach ($sosmed as $key => $value)
		{
			?>
	    <a href="<?php echo $value['link']?>"><i class="<?php echo $value['icon']?>"></i></a>
			<?php
		}
		?>
  </div>
</div>