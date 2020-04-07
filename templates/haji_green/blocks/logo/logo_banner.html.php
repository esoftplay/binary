<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$title = '';
if (!empty($_GET['menu_id'])) {
	$title = $db->getOne('SELECT `title` FROM `bbc_menu_text` WHERE `menu_id`='.$_GET['menu_id']);
}
?>
<div class="jumbotron text-center">
	<?php 
		if ($title) 
		{
			?>
				<h2><?php echo $title; ?></h2>
			<?php
		}
	?>
</div>
<style type="text/css">
	.jumbotron{
		background-image: url(<?php echo _URL.$output['image'] ;?>) !important;
	}
</style>