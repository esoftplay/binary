<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>
<div class="row">
  <div class="col-md-6 news-center">
  	<?php
  	$data      = reset($cat['list']); 
  	$edit_data = (content_posted_permission() && $user->id == $data['created_by']) ? 1 : 0;
		$link      = content_link($data['id'], $data['title']);

		echo (!empty($config['thumbnail']) && !empty($data['image'])) ? content_src($data['image'], ' class="img-responsive" alt="'.$data['title'].'" style="width:100%; border:15px solid #e8e8e8" ratio="1:1"', false) : '';
		?>
    <div class="news-phar">
			<?php
			if(!empty($config['title']))
			{
				if(!empty($config['title_link']))
				{
					?>
					<a href="<?php echo $link;?>" title="<?php echo $data['title'];?>"><h4 style="font-style: italic; color:green;"><?php echo $data['title'];?></h4></a>
	        <?php
	      }else{
	      	?>
	      	<h4 style="font-style: italic; color:green;"><?php echo $data['title'];?></h4>
	        <?php
	      }
			}
			?>
      <p style="font-style: italic;"><?php echo @$data[$config['intro']];?></p>
      <?php echo (!empty($config['read_more'])) ? '<a href="'.$link.'" class="readmore text_green">'.lang('Read more').'</a>' : '';?>
      <div class="clearfix"></div>
    </div>
		<?php
		if(	!empty($config['created']) || !empty($config['author'] ))
    {
    	?>
      <span>
      	<?php echo (!empty($config['author'])) ? content_date($data['created']) : ''; ?> 
      	<span style="font-weight: bold;"><?php echo (!empty($config['author'])) ? ' by '.ucwords($data['created_by_alias']) : ''; ?></span>
      </span>
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
				}	else {
					echo ($config['modified']) ? '<div class="col-md-7 text-right"><span class="text-muted">'.lang('modified').content_date($data['modified']).'</span></div>' : '';?>
					<div class="clearfix"></div>
					<?php
				}
				?>
			</div>
			<?php
		}
  	?>
  </div>
  <div class="col-md-6">
		<?php
		unset($cat['list'][0]);
		foreach ($cat['list'] as $k => $data)
		{
			$edit_data = (content_posted_permission() && $user->id == $data['created_by']) ? 1 : 0;
			$link      = content_link($data['id'], $data['title']);
			?>
		    <div class="row news-side">
		    	<?php
	    		$col1 = 0;
		    	if (!empty($config['thumbnail']) && !empty($data['image']))
		    	{
		    		$col1 = 4;
		    		?>
			      <div class="col-md-<?php echo $col1?>" align="center">
			    		<?php echo content_src($data['image'], ' class="news-img img-responsive" ratio="1:1" alt="'.$data['title'].'"', false); ?>
			      </div>
		    		<?php
		    	}
		    	$col2 = 12 - $col1;
		    	?>
		      <div class="col-md-<?php echo $col2?> no-both">
		      	<?php
		      	if(!empty($config['title']))
		      	{
		      		if(!empty($config['title_link']))
		      		{
		      			?>
		      			<a href="<?php echo $link;?>" title="<?php echo $data['title'];?>"><h4 style=" font-style: italic; color:green;"><?php echo $data['title'];?></h4></a>
		      			<?php
		      		}else{
		      			?>
				        <h4 style=" font-style: italic; color:green;"><?php echo $data['title'];?></h4>
		      			<?php
		      		}
		      	}
		      	?>
		        <p style="font-style: italic;"><?php echo @$data[$config['intro']];?></p>
			      <?php echo (!empty($config['read_more'])) ? '<a href="'.$link.'" class="readmore text_green">'.lang('Read more').'</a>' : '';?>
			      <div class="clearfix"></div>
		        <?php
		        if(	!empty($config['created']) || !empty($config['author'] ))
		        {
		        	?>
			        <span>
			        	<?php echo (!empty($config['created'])) ? content_date($data['created']) : ''; ?> 
			        	<span style="font-weight: bold;"><?php echo (!empty($config['author'])) ? ' by '.ucwords($data['created_by_alias']) : ''; ?></span>
				      </span>
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
								}	else {
									echo ($config['modified']) ? '<div class="col-md-7 text-right"><span class="text-muted">'.lang('modified').content_date($data['modified']).'</span></div>' : '';?>
									<div class="clearfix"></div>
									<?php
								}
								?>
							</div>
							<?php
						}
		        ?>
		      </div>
		    </div>
			<?php
		}
		?>
  </div>
</div>
<?php
	if ($config['cat_id'] > 0)
	{
		?>
		<div class="row">
		  <div class="col-md-12" align="center" style="margin: 60px 0 0 0;">
		    <a href="<?php echo _URL.'id.htm?cat_id='.$config['cat_id']; ?>" class="text_green"><?php echo lang('See More %s ', @ucwords($cat['title'])) ?><i class="fa fa-arrow-right"></i></a>
		  </div>
		</div>
		<?php
	}
?>