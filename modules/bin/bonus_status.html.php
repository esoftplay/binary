<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

echo table($rows, $columns);
if (!empty($plan_a['is_withdraw']) && !empty($plan_a['min_transfer']))
{
	if ($Bbc->member['balance'] >= $plan_a['min_transfer'])
	{
		if (!empty($Bbc->member['active']))
		{
			?>
			<a href="index.php?mod=bin.bonus_status_withdraw" class="btn btn-default"><?php echo icon('fa-money').' '.lang('Tarik Dana'); ?></a>
			<?php
		}else{
			echo msg(lang('Maaf, saat ini anda tidak memiliki akses untuk menarik bonus anda'), 'danger');
		}
	}
}
