<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$config = $output['config'];
$arr		= $output['data'];
if (!empty($arr))
{
	?>
		<div id="myCarouselContent" class="carousel slide no_margin" data-ride="carousel" data-interval="0">
			<div class="carousel-inner">
				<?php
				foreach((array)$arr as $k => $data)
				{
					$active = $k == 0 ? ' active' : '';
					$link   = content_link($data['id'], $data['title']);
					?>
					<div class="item carousel-item<?php echo $active?>">
				    <div class="row">
				      <div class="col-md-2"></div>
				      <div class="col-md-3" align="center">
				        <div class="card">
				          <div class="card-body">
		          			<?php echo (!empty($config['thumbnail']) && !empty($data['image'])) ? content_src($data['image'], ' class="img-responsive" title="'.$data['title'].'" alt="'.$data['title'].'"') : '';?>
				          </div>
				        </div>
				      </div>
				      <div class="col-md-6">
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
				        <p><?php echo $data['content'];?></p>
				        <?php 
				        if (!empty($config['read_more']))
				        {
				        	?>
					        <a href="<?php echo $link ?>" class="btn btn-danger" style="background-color: #774500; color:#fff;">See More <i class="fa fa-arrow-right" aria-hidden="true" style="color: #ffff;"></i></a>
				        	<?php
				        }
				        ?>
				      </div>
				    </div>
				    <div class="row">
				    	<?php
				    	if(	$config['created'] || $config['author'] )
							{
								?>
								<hr />
								<div class="row">
									<?php echo ($config['author']) ? '<div class="col-md-6"><span>'.lang('author').$data['created_by_alias'].'</span></div>' : '';?>
									<?php echo ($config['created']) ? '<div class="col-md-6 text-right"><span>'.lang('created').content_date($data['created']).'</span></div>' : '';?>
									<div class="clearfix"></div>
								</div>
								<?php
							}
							if($config['tag'])
							{
								$r = content_category($data['id'], $config['tag_link']);
								echo '<div>'.lang('Tags').implode(' ', $r).'</div>';
							}
							if(	$config['rating'] || $config['modified'] )
							{
								?>
								<div class="row">
									<?php
									if ($config['rating'])
									{
										?>
										<div class="col-md-6 no-both">
											<?php echo rating($data['rating']); ?>
										</div>
										<?php
									}
									if(empty($data['revised']))
									{
										$config['modified'] = 0;
									}
									if (!empty($config['modified']))
									{
										?>
										<div class="col-md-6 no-left text-right">
											<em class="text-right pull-right"><?php echo lang('modified').content_date($data['modified']); ?></em>
										</div>
										<?php
									}
									?>
									<div class="clearfix"></div>
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
			<?php
			if (count($arr) > 1) 
			{
				?>
			  <a class="carousel-control left carousel-control-prev" href="#myCarouselContent" data-slide="prev">
			    <i class="fa fa-angle-left"></i>
			  </a>
			  <a class="carousel-control right carousel-control-next" href="#myCarouselContent" data-slide="next">
			    <i class="fa fa-angle-right"></i>
			  </a>
				<?php
			}
			?>
		</div>
	<?php
}