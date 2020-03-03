<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$config = $output['config'];
$arr		= $output['data'];
if (!empty($arr))
{
	?>
	<div id="myCarouselContent" class="carousel slide" data-ride="carousel" data-interval="0">
		<div class="carousel-inner">
			<?php
			foreach((array)$arr as $k => $data)
			{
				$active = $k == 0 ? ' active' : '';
				$link   = content_link($data['id'], $data['title']);
				?>
				<div class="item carousel-item<?php echo $active?>">
					<section class="aboutIndex">
						<div class="container">
							<div class="row">
								<div class="col-md-3 aboutImage" align="center">
									<?php echo (!empty($config['thumbnail'])) ? content_src($data['image'], ' class="img-responsive" title="'.$data['title'].'" alt="'.$data['title'].'"') : '';?>
								</div>

								<div class="col-md-9 aboutContent" style="margin-top: 0;">
									<?php
									if($config['title'])
									{
										if($config['title_link'])
										{
											?>
											<h2><a href="<?php echo $link;?>" title="<?php echo $data['title'];?>"><?php echo $data['title'];?></a></h2>
											<?php
										}else{
											?>
											<h2><?php echo $data['title'];?></h2>
											<?php
										}
									}
									if (str_word_count($data['content']) > 7 ) 
									{
										$words = explode(" ",$data['content']);
										echo "<p>";
										echo implode(" ",array_splice($words,0,75));
										echo "</p>";
										echo "<br>";
									}else{
									?>
										<p><?php echo $data['content']; ?></p>
									<?php			            	
									}
									if (!empty($config['read_more']))
									{
										?>
										<a href="<?php echo $link; ?>">
											<?php echo lang('View More'); ?>
										</a>
										<?php
									}
									?>

									<div class="col-md-12">
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
							</div>
						</div>
					</section>
				</div>
				<?php
			}
			?>
		</div>
		<?php
		if (count($arr) > 1) 
		{
			?>
			<a class="left carousel-control" href="#myCarouselContent" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			</a>
			<a class="right carousel-control" href="#myCarouselContent" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			</a>
			<?php
		}
		?>
	</div>
	<?php
}
