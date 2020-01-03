<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$id = @intval($_GET['id']);
if (empty($id))
{
	$id = $Bbc->member['id'];
}else{
	if ($id!=$Bbc->member['id'] && !bin_isDownline($id, $Bbc->member['id']))
	{
		$id = 0;
	}
}
if (empty($id))
{
	echo msg('Maaf, data yang anda akses bukan termasuk dalam jaringan anda', 'danger');
}else{
	$r_type  = bin_bonus_list();
	$r_bonus = $db->getAll("SELECT * FROM `bin_bonus` WHERE `bin_id`={$id}");
	$rows    = array();
	$columns = array_map('lang', array('Title', 'Debit', 'Credit', 'Balance'));
	$credit  = 0;
	$debit   = 0;
	$balance = 0;
	foreach ($r_bonus as $bonus)
	{
		$data = array(
			$r_type[$bonus['type_id']]['link'],
			'',
			'',
			'',
			);
		if ($bonus['credit'])
		{
			$credit += $bonus['amount'];
			$data[2] = money($bonus['amount']);
		}else{
			$debit  += $bonus['amount'];
			$data[1] = money($bonus['amount']);
		}
		$rows[] = $data;
	}
	$balance = $debit - $credit;
	$rows[]  = array(
		'<b>'.lang('Total').'</b>',
		'<b>'.money($debit).'</b>',
		'<b>'.money($credit).'</b>',
		'<b>'.money($balance).'</b>'
		);
	include tpl('bonus_status.html.php');
}