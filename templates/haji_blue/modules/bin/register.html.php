<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
if (@$_POST['bin_register_step']==1 and @$_POST['bin_register']) 
{
	$_SESSION['bin_register']['step'] = 1;
	$_SESSION['bin_register']['data'] = $_POST['bin_register'];
}
if (isset($_GET['bin_register_step_back'])) {
	$_SESSION['bin_register']['step'] = $_GET['bin_register_step_back'];
	redirect(site_url('bin/register'));
}
if (@$output['ok'] and @$user_id) {
	$output['user_data'] = $db->getRow('SELECT * FROM `bin` WHERE `user_id`='.$user_id);
	if ($output['user_data']) {
		$_SESSION['bin_register']['step'] = 2;
	}
}else
if (@$_SESSION['bin_register']['step'] == 2){
	$_SESSION['bin_register']['step'] = 0;
}

link_js(_LIB.'pea/includes/FormTags.js', false);
link_js(_LIB.'pea/includes/formIsRequire.js', false);
$location_token = array(
	'table'  => 'bin_location',
	'field'  => 'detail',
	'id'     => 'id',
	'sql'    => 'publish=1 AND type=3',
	'expire' => strtotime('+2 HOURS'),
);
$current_fields = user_field_group(get_config('bin', 'plan_a', 'group_id'));
$remove_fields  = ['serial', 'pin', 'sponsor', 'upline', 'position', 'Phone', 'location_address', 'location_id', 'location_latlong'];
$custom_fields  = array();
$user_fields    = array();
foreach ($current_fields as $field)
{
	if (!in_array($field['title'], $remove_fields))
	{
		$user_fields[] = $field;
	}else{
		$custom_fields[$field['title']] = $field;
	}
}
$btn_link = '';
if (!empty($user->id) && _ADMIN=='')
{
	$sponsor = $db->getOne("SELECT `username` FROM `bin` WHERE `user_id`={$user->id}");
	if (!empty($sponsor))
	{
		$_POST['params']['sponsor'] = $sponsor;
		if (_ADMIN=='')
		{
			$_POST['params']['sponsor'] .= '" readonly="true';
		}
	}
	$btn_link = '<a class="btn btn-xs btn-default pull-right hidden" id="btn-duplicate">'.icon('duplicate').' '.lang('Clone Profile').'</a>';
}
$progress_bar_width = 0;
switch (@intval($_SESSION['bin_register']['step'])) {
	case '0':
		$progress_bar_width = 15;
		break;
	case '1':
		$progress_bar_width = 50;
		break;
	case '2':
		$progress_bar_width = 100;
		break;
}
?>
<section class="contentReg">
	<form method="POST" action="" id="member_reg" name="member_reg" class="formIsRequire" enctype="multipart/form-data" role="form">
		<div class="content registrasi">
			<div class="container">
				<div class="row text-center formTitle">
					<div class="col-md-12">
						<h6><?php echo lang('Registrasi Member').$btn_link; ?></h6>
					</div>
				</div>
				<div class="row regIcon">
					<div class="col-md-12 text-center">
						<img src="<?php echo $sys->template_url; ?>html/img/registrasi/icon1.png" alt="">
						<img src="<?php echo $sys->template_url; ?>html/img/registrasi/icon2.png" alt="">
						<img src="<?php echo $sys->template_url; ?>html/img/registrasi/icon3.png" alt="">
					</div>
				</div>
				<div class="row prBar">
					<div class="col-md-12">
						<div class="progress">
							<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress_bar_width; ?>%;"></div>
						</div>
					</div>
				</div>
				<?php include tpl('register'.@intval($_SESSION['bin_register']['step']).'.html.php'); ?>
			</div>
		</div>
	</form>	
</section>
