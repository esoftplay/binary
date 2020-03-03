<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>
<section class="content product">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><?php echo $cat['title'];?></h2>
			</div>
		</div>
		<div class="row productContent">
			<div class="col-md-12 pb-4">
				<?php
				if($cat['total_page'] > 1)
				{
					?>
					<span class="text text-muted text-justify"><?php echo lang('page').' '.($page+1).' '.lang('of').' '.items($cat['total_page'], 'page');?></span>
					<div class="clearfix"></div>
					<?php
				}
				?>
			</div>
			
			<div class="col-md-12 productCol text-center">
				<?php
				$item = 0;
				foreach((array)$cat['list'] AS $data)
				{
					$item++;
					$edit_data = (content_posted_permission() && $user->id == $data['created_by']) ? 1 : 0;
					$link      = content_link($data['id'], $data['title']);
					?>	
					<div class="col-md-4 productItem text-center" align="center">
						<?php echo (!empty($config['thumbnail']) && !empty($data['image'])) ? content_src($data['image'], ' class="img-responsive"', true) : ''; ?>
						<?php
						if(!empty($config['title']))
						{
							if(!empty($config['title_link']))
							{
								?>
								<a href="<?php echo $link;?>" title="<?php echo $data['title'];?>"><h4 class="text-left"><?php echo $data['title'];?></h4></a>
								<?php
							}else{
								?>
								<h4 class="text-left"><?php echo $data['title'];?></h4>
								<?php
							}
						}
						?>
						<div class="text-center">
							<span><?php echo content_title(nl2br(strip_tags($data['intro'])),20);?></span>
							<?php 
							echo (!empty($config['read_more'])) ? ' <a href="'.$link.'" class="readmore">'.lang('Read more').'</a>' : '';
							echo '<div class="clearfix"></div><br/>';
							?>
						</div>
						<?php
							if(	!empty($config['created']) || !empty($config['author'] ))
							{
								echo (!empty($config['author'])) ? '<div class="pull-left"><span class="text-muted">'.lang('author').$data['created_by_alias'].'</span></div>' : '';
								echo (!empty($config['created'])) ? '<div class="pull-left"><span class="text-muted">'.lang('created').content_date($data['created']).'</span></div>' : '';
							}
							if( !empty($config['tag']) )
							{
								?>
								<div class="pull-left text-left">
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
								if($config['rating'])
								{
									echo rating($data['rating']).'<br />';
								}
								if(!empty($edit_data))
								{
									echo ($config['modified']) ? '<div class="pull-left"><span class="text-muted">'.lang('modified').content_date($data['modified']).'</span></div>' : '';
									?>
									<a href="<?php echo $Bbc->mod['circuit'].'.posted_form&id='.$data['id'];?>" title="<?php echo lang('edit content');?>"><?php echo icon('edit');?></a>
									<?php
								}	else {
									echo ($config['modified']) ? '<div class="pull-left"><span class="text-muted">'.lang('modified').content_date($data['modified']).'</span></div>' : '';?>
									<div class="clearfix"></div>
									<?php
								}
							}
						?>
					</div>
					<?php
					if ($item%3==0)
					{
						echo '<div class="clearfix"></div><br />';
					}
				}
				?>
			</div>
		</div>
	</div>
</section>

<?php
echo '<div class="text-center">'.page_list($cat['total'], $config['tot_list'], $page, 'page', $cat['link']).'</div>';
if (!empty($cat['rss']))
{
	?>
	<a href="<?php echo $cat['rss'];?>" class="btn btn-warning btn-sm pull-right" title="<?php echo lang('category feed');?>"><?php echo icon('fa-rss-square');?> <?php echo lang('category feed');?></a>
	<?php
}
?>
<div class="clearfix"></div>

<section class="join_us">
  <div class="container-fluid text-center">
    <div class="row justify-content-center">
        <div class="col-lg">
            <h3><?php echo lang('#Bergabunglah dan Sukses Bersama Kami') ; ?> </h3>       
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg">
            <a href="<?php echo site_url('bin/register'); ?>"><button type="button" class="btn btn-warning">Join Now</button></a>
        </div>
    </div>
  </div>
</section>