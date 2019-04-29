<?php  if ( ! defined('_VALID_BBC')) exit('No direct script access allowed'); ?>
<section class="join_us">
  <div class="container-fluid text-center">
    <div class="row justify-content-center">
      <div class="col-lg">
        <h3><?php echo @$config['caption'] ?></h3>       
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg">
        <a href="<?php echo site_url('bin/register'); ?>"><button type="button" class="btn btn-warning"><i><?php echo lang('Join Now'); ?></i></button></a>
      </div>
    </div>
  </div>
</section>