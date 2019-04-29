<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($cat['list']) && is_array($cat['list']))
{
	?>
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8 valueBox" align="center">
    	<?php
    	foreach ($cat['list'] as $data)
    	{
				$edit_data = (content_posted_permission() && $user->id == $data['created_by']) ? 1 : 0;
				$link = content_link($data['id'], $data['title']);
    		?>
        <div class="col-sm-4 text-center" align="center">
					<?php echo (!empty($config['thumbnail'])) ? content_src($data['image'], ' class="img_100" title="'.$data['title'].'" alt="'.$data['title'].'"') : '';?>
        	<?php
          if(!empty($config['title']))
					{
						if(!empty($config['title_link']))
						{
							?>
							<a href="<?php echo $link;?>" title="<?php echo $data['title'];?>">
								<p><?php echo content_title($data['title'], 4, 'word', '');?></p>
							</a>
			        <?php
						}else{
							?>
							<p><?php echo content_title($data['title'], 4, 'word', '');?></p>
							<?php
						}
					}
          ?>
          <p><?php echo @content_title($data[$config['intro']], 20);?></p>
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
    		<?php
    	}
    	?>
    </div>
  </div>	        
	<?php
}