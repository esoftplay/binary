<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($cat['list']))
{
	?>
	<section class="gallery gallery_background_wrapper">
		<img src="" class="gallery_background">
		<div class="container">
			<?php 
			if(@$block->title) 
			{
				?>
				<div class="row">
					<div class="col-md-12">
						<h2><?php echo $block->title; ?></h2>
					</div>
				</div>
				<?php 
				$block->title = '';
			}
			?>
			<div class="row">
				<div class="col-md-12 heroSlider-fixed">
					<div class="overlay"></div>
					<div class="slider responsive gallery_background_list">
				  	<?php
				  	foreach($cat['list'] AS $data)
						{
							if (!empty($data['image']))
							{
								$link = content_link($data['id'], $data['title']);
								?>
						    <div>
						    	<a href="<?php echo $link;?>" title="<?php echo $data['title'];?>">
							      <?php echo content_src($data['image'], ' class="img-responsive" ratio="1:1" alt="'.$data['title'].'"', false); ?>
						    	</a>
						    </div>
								<?php
							}
						}
				  	?>
				  </div>
					<div class="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					</div>
					<div class="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
}