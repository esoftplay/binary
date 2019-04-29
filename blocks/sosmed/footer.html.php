<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>
<div class="row">
  <div class="col-sm-12 text-white pull-right footer_icon">
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