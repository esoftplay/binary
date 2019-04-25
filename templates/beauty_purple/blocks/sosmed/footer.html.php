<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
foreach ($sosmed as $key => $value)
{
	?>
  <a class="glyph" href="<?php echo $value['link']?>"><i class="<?php echo $value['icon']?>"></i></a>
	<?php
}
