<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if($user->id > 0){
  include 'logged.html.php';
}else{
  ?>
  <ul class="nav navbar-nav navbar-right login mobile_left">
    <a href="<?php echo site_url('user/login'); ?>"><?php echo lang('Login') ?></a>  
    <a href="<?php echo site_url('user/register'); ?>"><?php echo lang('Registrasi') ?></a> 
  </ul>
  <?php
}