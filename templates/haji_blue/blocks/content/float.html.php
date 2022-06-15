<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($cat['list']) && is_array($cat['list']))
{
	?>
	<div class="row whyusRow">
		<?php
		foreach ($cat['list'] as $k => $data)
		{
			$cls = (($k+1)%3 == 0) ? ' shadowRight' : ($k+1)%2 == 0 ? ' shadowCenter' : ' shadowLeft';
			$edit_data = (content_posted_permission() && $user->id == $data['created_by']) ? 1 : 0;
			$link = content_link($data['id'], $data['title']);
			?>
			<div class="col-md-4 whyusContent<?php echo $cls?>" align="center">
				<div class="row">
					<div class="col-md-12" align="center">
						<?php echo (!empty($config['thumbnail'])) ? content_src($data['image'], ' class="img_100" title="'.$data['title'].'" alt="'.$data['title'].'"') : '';?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-center">
						<?php
						if(!empty($config['title']))
						{
							if(!empty($config['title_link']))
							{
								?>
								<a href="<?php echo $link;?>" title="<?php echo $data['title'];?>">
									<h4><?php echo content_title($data['title'], 4, 'word', '');?></h4>
								</a>
								<?php
							}else{
								?>
								<h4><?php echo content_title($data['title'], 4, 'word', '');?></h4>
								<?php
							}
						}
						?>
						<p><?php echo @content_title($data[$config['intro']], 10);?></p>
						<?php echo (!empty($config['read_more'])) ? '<a href="'.$link.'" class="readmore">'.lang('Read more').'</a>' : '';?>

						<?php
						if( !empty($config['created']) || !empty($config['author'] ))
						{
							?>
							<div>
								<?php echo (!empty($config['author'])) ? '<span class="text-muted pull-left">'.lang('author').$data['created_by_alias'].'</span>' : '';?>
								<?php echo (!empty($config['created'])) ? '<span class="text-muted pull-right">'.lang('created').content_date($data['created']).'</span>' : '';?>
								<div class="clearfix"></div>
							</div>
							<?php
						}
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
								} else {
									echo ($config['modified']) ? '<div class="col-md-7 text-right"><span class="text-muted">'.lang('modified').content_date($data['modified']).'</span></div>' : '';?>
									<div class="clearfix"></div>
									<?php
								}
								?>
							</div>
							<?php
						}
						?>
						<br />
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>	        
	<?php
}