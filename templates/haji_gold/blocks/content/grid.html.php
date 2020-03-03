<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>
<div class="row">
	<?php
		foreach ($cat['list'] as $k => $data)
		{
			$edit_data = (content_posted_permission() && $user->id == $data['created_by']) ? 1 : 0;
			$link      = content_link($data['id'], $data['title']);
			?>
				<div class="col-md-6 text-center newsContent" align="center">
					<?php
					if (!empty($config['thumbnail']) && !empty($data['image']))
					{
						echo content_src($data['image'], ' class="img-responsive img_200" alt="'.$data['title'].'"', false);
					}

					if(	!empty($config['created']) || !empty($config['author'] ))
					{
						?>
						<p style="font-weight: 600;"><?php echo (!empty($config['created'])) ? content_date($data['created']) : ''; ?> 
							<?php
							if (!empty($config['author']))
							{
								?>
								by <span style="color:#bc8716;"><?php echo (!empty($config['author'])) ? ucwords($data['created_by_alias']) : ''; ?></span>
								<?php
							}
							?>
						</p>
						<?php
					}

					if(!empty($config['title']))
					{
						if(!empty($config['title_link']))
						{
							?>
							<a href="<?php echo $link;?>" title="<?php echo $data['title'];?>"><h4 class="text-center"><?php echo $data['title'];?></h4></a>
							<?php
						}else{
							?>
							<h4 class="text-center"><?php echo $data['title'];?></h4>
							<?php
						}
					}
					?>
					<p><?php echo @content_title($data[$config['intro']], 10);?></p>
					<?php
					if( !empty($config['tag']) )
					{
						?>
						<div class="text-left">
							<?php
							$r = content_category($data['id'], $config['tag_link']);
							echo lang('Tags').implode(' ', $r);
							?>
						</div>
						<?php
					}
					if(empty($data['revised']))
					{
						$config['modified'] = 0;
					}
					if(!empty($config['rating']) || !empty($config['modified']) || !empty($edit_data))
					{
						?>
						<div class="row">
							<?php
							if($config['rating'])
							{
								echo '<div class="col-md-5">'.rating($data['rating']).'</div>';
							}
							if(!empty($edit_data))
							{
								?>
								<div class="col-md-7 text-right">
									<?php echo ($config['modified']) ? '<span class="text-muted">'.lang('modified').content_date($data['modified']).'</span>' : '';?>
									<a href="<?php echo $Bbc->mod['circuit'].'.posted_form&id='.$data['id'];?>" title="<?php echo lang('edit content');?>"><?php echo icon('edit');?></a>
								</div>
								<?php
							}	else {
								echo ($config['modified']) ? '<div class="col-md-7 text-right"><span class="text-muted">'.lang('modified').content_date($data['modified']).'</span></div>' : '';?>
								<div class="clearfix"></div>
								<?php
							}
							?>
						</div>
						<?php
					}
					
					echo (!empty($config['read_more'])) ? '<a href="'.$link.'" class="readmore">'.lang('Read more').'</a>' : '';
					?>
				</div>
			<?php
		}
	?>
</div>

<?php
if ($config['cat_id'] > 0)
{
	?>
	<div class="row">
		<div class="col-md-12 text-center">
			<a href="<?php echo _URL.'id.htm?cat_id='.$config['cat_id']; ?>"><?php echo lang('See More %s ', @ucwords($cat['title'])) ?><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
		</div>
	</div>
	<?php
}