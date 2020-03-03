<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$count = count($sosmed);
foreach ($sosmed as $key => $value)
{
	if (($key + 1) == $count ) 
	{
		?>
		<a class="" href="<?php echo $value['link']?>"><i class="<?php echo $value['icon']?>"></i></a>
		<?php
	}else{
		?>
		<a class="glyph" href="<?php echo $value['link']?>"><i class="<?php echo $value['icon']?>"></i></a>
		<?php
	}
}
