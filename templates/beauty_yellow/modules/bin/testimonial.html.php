<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');?>
<div class="row">
  <div class="col-md-12">
    <h2><?php echo lang('Testimonial Member'); ?></h2>
  </div>
</div>
<?php
if (empty($datas))
{
	$datas = json_decode(file_read(_ROOT.'blocks/bin_testimonial/sample.json'), 1);
	$total = count($datas);
}

if (empty($total))
{
	?>
	<div class="jumbotron">
	  <h1><?php echo lang('no testimonial to publish'); ?></h1>
		<p><?php echo lang('Please return to this page anytime soon to get new info if any member post testimonial'); ?></p>
	</div>
	<?php
}else{
	if (!empty($datas))
	{
		?>
    <div class="row">
    	<?php
    	$item = 0;
    	foreach ($datas as $data)
    	{
    		$item++;
    		$image = '';
				$link  = 'index.php?mod=bin.testimonial_detail&id='.$data['id'];
				_func('content');
				if (!empty($data['image']))
				{
					$src = is_url($data['image'])? $data['image'] : _URL.'images/modules/bin/'.$data['image'];
				}
    		?>
	      <div class="col-md-4" align="center">
	      	<a href="<?php echo $link ?>" style="text-decoration: none;">
		        <div class="card" style="background-color: #dbdbdb; width: 80%;">
		          <div class="card-body" style="background-color: white;">
		            <div class="card-text" style="text-align: left;"><?php echo content_title($data['detail'], 20); ?></div>
		            <h6 class="card-title" style="color: #774500; font-weight: bold;"><?php echo $data['name']; ?></h6>
		          </div>
		          <div class="img_testimonial">
								<?php echo !empty($data['image']) ? content_src($src, ' class="img-circle"') : ''; ?>
		          </div>
		        </div>
	      	</a>
	      </div>
    		<?php
    		if ($item%3==0)
				{
					echo '<div class="clearfix"></div><br />';
				}
    	}
    	?>
    </div>
		<?php
	}
	echo page_list($total, $limit, $page, 'page', $Bbc->mod['circuit'].'.'.$Bbc->mod['task']);
}