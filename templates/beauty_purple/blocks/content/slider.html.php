<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($cat['list']) && is_array($cat['list']))
{
	?>
	<div class="row">
    <div class="col-md-12">
      <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
        <!-- Carousel indicators -->
        <!-- 
	      	<ol class="carousel-indicators">
	           <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	           <li data-target="#myCarousel" data-slide-to="1"></li>
	           <li data-target="#myCarousel" data-slide-to="2"></li>
	        </ol> 
         -->   
        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">
        	<?php
        	foreach($cat['list'] AS $k => $data)
					{
						$active    = $k == 0 ? ' active' : '';
						$edit_data = (content_posted_permission() && $user->id == $data['created_by']) ? 1 : 0;
						$link      = content_link($data['id'], $data['title']);
						?>
						<div class="item carousel-item<?php echo $active?>">
						  <div class="container">
						    <div class="row">
						      <div class="col-md-6" align="center">
						        <?php echo (!empty($config['thumbnail'])) ? content_src($data['image'], ' class="img-responsive" title="'.$data['title'].'" alt="'.$data['title'].'"') : '';?>
						      </div>
						      <div class="col-md-6 productContent">
						        <?php
										if($config['title'])
										{
											if($config['title_link'])
											{
												?>
												<h3><a href="<?php echo $link;?>" title="<?php echo $data['title'];?>"><?php echo $data['title'];?></a></h3>
												<?php
											}else{
												?>
												<h3><?php echo $data['title'];?></h3>
												<?php
											}
										}
										?>
						        <p>
				            	<?php 
				            	echo @content_title($data[$config['intro']], 20);
											if (!empty($config['read_more']))
											{
												?>
												<a href="<?php echo $link; ?>" class="text_green">
								        	<button class="w3-btn w3-ripple" style="margin-top: 25px; background-color: #6b4ff9; color:white; line-height: normal;"><?php echo lang('See More'); ?></button>
												</a>
												<?php
											}
											?>
										</p>
										<div class="col-md-12">
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
										</div>
						      </div>
						    </div>
						  </div>
						</div>
						<?php
					}
        	?>
        </div>
        <!-- Carousel controls -->
        <?php
				if (count($cat['list']) > 1) 
				{
					?>
					<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					</a>
					<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</a>
					<?php
				}
				?>
      </div>
    </div>
  </div>
	<?php
}