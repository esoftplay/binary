<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($cat['list']))
{
	?>
	<section class="galleryIndex">
		<?php 
		if(@$block->title) 
		{
			?>
			<div class="row">
				<h2><?php echo $block->title; ?></h2>
			</div>
			<?php 
			$block->title = '';
		}
		?>
		<div class="row">
			<?php
			foreach($cat['list'] AS $data)
			{
				if (!empty($data['image']))
				{
					$link = content_link($data['id'], $data['title']);
					?>
					<div class="column">
						<a href="<?php echo $link;?>" title="<?php echo $data['title'];?>">
							<?php echo content_src($data['image'], ' class="hover-shadow cursor img-responsive" alt="'.$data['title'].'"', false); ?>
						</a>
					</div>
					<?php
				}
			}
			?>
		</div>
	</section>
	<?php
}
