<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// echo _func('binfix', 'start') ? date('r') : 'gagal';
function binfix_start()
{
	global $db;
	$out = false;
	$first_id = $db->getOne("SELECT `id` FROM `bin` WHERE 1 ORDER BY `id` ASC LIMIT 1 ");
	if ($first_id)
	{
		$db->Execute("UPDATE `bin` SET
								 `depth_left`=0,
								 `depth_right`=0,
								 `depth_upline`=0,
								 `depth_sponsor`=0,
								 `total_downline`=0,
								 `total_left`=0,
								 `total_right`=0,
								 `total_sponsor`=0
								 WHERE 1");
		$db->Execute("DROP TABLE IF EXISTS `bbc_async`");
		$text = "CREATE TABLE `bin_list_down_left` (
			  `list_id` bigint(255) unsigned NOT NULL AUTO_INCREMENT,
			  `bin_id` bigint(20) unsigned DEFAULT NULL,
			  `user_bin_id` bigint(20) unsigned DEFAULT NULL,
			  PRIMARY KEY (`list_id`),
			  KEY `bin_id` (`bin_id`),
			  KEY `user_bin_id` (`user_bin_id`),
			  CONSTRAINT `bin_list_down_left_ibfk_1` FOREIGN KEY (`bin_id`) REFERENCES `bin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
			  CONSTRAINT `bin_list_down_left_ibfk_2` FOREIGN KEY (`user_bin_id`) REFERENCES `bin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			CREATE TABLE `bin_list_down_line` (
			  `list_id` bigint(255) unsigned NOT NULL AUTO_INCREMENT,
			  `bin_id` bigint(20) unsigned DEFAULT NULL,
			  `user_bin_id` bigint(20) unsigned DEFAULT NULL,
			  PRIMARY KEY (`list_id`),
			  KEY `bin_id` (`bin_id`),
			  KEY `user_bin_id` (`user_bin_id`),
			  CONSTRAINT `bin_list_down_line_ibfk_1` FOREIGN KEY (`bin_id`) REFERENCES `bin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
			  CONSTRAINT `bin_list_down_line_ibfk_2` FOREIGN KEY (`user_bin_id`) REFERENCES `bin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			CREATE TABLE `bin_list_down_right` (
			  `list_id` bigint(255) unsigned NOT NULL AUTO_INCREMENT,
			  `bin_id` bigint(20) unsigned DEFAULT NULL,
			  `user_bin_id` bigint(20) unsigned DEFAULT NULL,
			  PRIMARY KEY (`list_id`),
			  KEY `bin_id` (`bin_id`),
			  KEY `user_bin_id` (`user_bin_id`),
			  CONSTRAINT `bin_list_down_right_ibfk_1` FOREIGN KEY (`bin_id`) REFERENCES `bin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
			  CONSTRAINT `bin_list_down_right_ibfk_2` FOREIGN KEY (`user_bin_id`) REFERENCES `bin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			CREATE TABLE `bin_list_down_sponsor` (
			  `list_id` bigint(255) unsigned NOT NULL AUTO_INCREMENT,
			  `bin_id` bigint(20) unsigned DEFAULT NULL,
			  `user_bin_id` bigint(20) unsigned DEFAULT NULL,
			  PRIMARY KEY (`list_id`),
			  KEY `bin_id` (`bin_id`),
			  KEY `user_bin_id` (`user_bin_id`),
			  CONSTRAINT `bin_list_down_sponsor_ibfk_1` FOREIGN KEY (`bin_id`) REFERENCES `bin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
			  CONSTRAINT `bin_list_down_sponsor_ibfk_2` FOREIGN KEY (`user_bin_id`) REFERENCES `bin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			CREATE TABLE `bin_list_up_line` (
			  `list_id` bigint(255) unsigned NOT NULL AUTO_INCREMENT,
			  `bin_id` bigint(20) unsigned DEFAULT NULL,
			  `user_bin_id` bigint(20) unsigned DEFAULT NULL,
			  PRIMARY KEY (`list_id`),
			  KEY `bin_id` (`bin_id`),
			  KEY `user_bin_id` (`user_bin_id`),
			  CONSTRAINT `bin_list_up_line_ibfk_1` FOREIGN KEY (`bin_id`) REFERENCES `bin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
			  CONSTRAINT `bin_list_up_line_ibfk_2` FOREIGN KEY (`user_bin_id`) REFERENCES `bin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			CREATE TABLE `bin_list_up_sponsor` (
			  `list_id` bigint(255) unsigned NOT NULL AUTO_INCREMENT,
			  `bin_id` bigint(20) unsigned DEFAULT NULL,
			  `user_bin_id` bigint(20) unsigned DEFAULT NULL,
			  PRIMARY KEY (`list_id`),
			  KEY `bin_id` (`bin_id`),
			  KEY `user_bin_id` (`user_bin_id`),
			  CONSTRAINT `bin_list_up_sponsor_ibfk_1` FOREIGN KEY (`bin_id`) REFERENCES `bin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
			  CONSTRAINT `bin_list_up_sponsor_ibfk_2` FOREIGN KEY (`user_bin_id`) REFERENCES `bin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		$rsql = array_map('trim', explode(';', $text));
		foreach ($rsql AS $sql)
		{
			if (preg_match('~`(.*?)`~s', $sql, $tbl))
			{
				$db->Execute("DROP TABLE IF EXISTS `{$tbl[1]}`;");
				$db->Execute($sql.';');
			}
		}
		file_write('/tmp/binfix.txt', '');
		_class('async')->run('binfix_up', [$first_id]);
		$out = true;
	}
	return $out;
}

function binfix_up($bin_id)
{
	global $db;
	file_write('/tmp/binfix.txt', "\n".$bin_id, 'a+');
	$member = $db->getRow("SELECT * FROM `bin` WHERE `id`={$bin_id} LIMIT 1");
	if (!empty($member))
	{
		$upline = $db->getRow("SELECT * FROM `bin` WHERE `id`={$member['upline_id']} LIMIT 1");
		// HANYA PROSES JIKA UPLINE JIKA DATA ADA
		if (!empty($upline))
		{
			if ($member['id'] != $upline['id'])
			{
				// bin_list_up_line
				$db->Execute("INSERT INTO `bin_list_up_line` (`bin_id`, `user_bin_id`)
				             SELECT '{$member['id']}', `user_bin_id`
				             FROM `bin_list_up_line` WHERE `bin_id`={$upline['id']} ");
				$db->Insert('bin_list_up_line', array(
					'bin_id'      => $member['id'],
					'user_bin_id' => $upline['id'],
					));
			}
			_class('async')->run('binfix_node', [$bin_id, $member, $upline]);
		}
		$sponsor = $db->getRow("SELECT * FROM `bin` WHERE `id`={$member['sponsor_id']} LIMIT 1");
		// HANYA PROSES JIKA SPONSOR JIKA DATA ADA
		if (!empty($sponsor))
		{
			$total_sponsor = $db->getOne("SELECT COUNT(*) FROM `bin` WHERE `sponsor_id`={$bin_id}");
			if ($member['id'] != $sponsor['id'])
			{
				// bin_list_up_sponsor
				$db->Execute("INSERT INTO `bin_list_up_sponsor` (`bin_id`, `user_bin_id`)
				             SELECT '{$member['id']}', `user_bin_id`
				             FROM `bin_list_up_sponsor` WHERE `bin_id`={$sponsor['id']} ");
				$db->Insert('bin_list_up_sponsor', array(
					'bin_id'      => $member['id'],
					'user_bin_id' => $sponsor['id'],
					));
			}else{
				$total_sponsor--;
			}
			$db->Update('bin', ['total_sponsor' => $total_sponsor], $bin_id);
			_class('async')->run('binfix_sponsor', [$bin_id, $member, $sponsor]);
		}
	}
}

function binfix_node($bin_id, $member, $upline)
{
	global $db;
	if ($member['id'] != $upline['id'])
	{
		_func('bin');
		$mbr  = []; // array untuk update data sql member
		$upl  = []; // array untuk update data sql upline
		$pos  = $member['position'] ? 'right' : 'left';
		$data = array(
			'bin_id'      => $upline['id'],
			'user_bin_id' => $bin_id
			);

		// bin_list_down_line
		$db->Insert('bin_list_down_line', $data);
		$upl['total_downline'] = $upline['total_downline']+1;
		$mbr['depth_upline']   = $upline['depth_upline']+1;

		// bin_list_down_left // bin_list_down_right
		$db->Insert('bin_list_down_'.$pos, $data);
		$upl['total_'.$pos] = $upline['total_'.$pos]+1;
		if ($member['depth_'.$pos] >= $upline['depth_'.$pos])
		{
			$upl['depth_'.$pos] = $upline['depth_'.$pos]+1;
		}

		// UPDATE DATA MEMBER AND UPLINE
		$db->Update('bin', $mbr, $member['id']);
		$db->Update('bin', $upl, $upline['id']);

		$upupline = $db->getRow("SELECT * FROM `bin` WHERE `id`={$upline['upline_id']} LIMIT 1");
		if (!empty($upupline))
		{
			$upline = array_merge($upline, $upl);
			_class('async')->run(__FUNCTION__, [$bin_id, $upline, $upupline]);
		}
	}else{
		$next_id = $db->getOne("SELECT `id` FROM `bin` WHERE `id` > {$bin_id} ORDER BY `id` ASC LIMIT 1 ");
		if ($next_id)
		{
			_class('async')->run('binfix_up', [$next_id]);
		}else{
			binfix_alert();
		}
	}
}

function binfix_sponsor($bin_id, $member, $sponsor)
{
	global $db;
	if ($member['id']!=$sponsor['id'])
	{
		_func('bin');
		$mbr = []; // array untuk update data sql member

		// bin_list_down_sponsor
		$db->Insert('bin_list_down_sponsor', array(
			'bin_id'      => $sponsor['id'],
			'user_bin_id' => $bin_id
			));
		$mbr['depth_sponsor'] = $sponsor['depth_sponsor']+1;

		// UPDATE DATA MEMBER
		$db->Update('bin', $mbr, $member['id']);

		$upsponsor = $db->getRow("SELECT * FROM `bin` WHERE `id`={$sponsor['sponsor_id']} LIMIT 1");
		if ($upsponsor)
		{
			_class('async')->run(__FUNCTION__, [$bin_id, $sponsor, $upsponsor]);
		}
	}
}

function binfix_alert()
{
	if (function_exists('tm'))
	{
		$chat_id = defined('_CHAT_ID') ? _CHAT_ID : '';
		tm('Perbaikan file struktur sudah selesai', $chat_id);
	}
}