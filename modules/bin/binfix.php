<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$ips = ['52.76.122.17'];
if (in_array(@$_SERVER['REMOTE_ADDR'], $ips))
{
	$out = array(
		'ok'      => 1,
		'message' => 'success',
		'result'  => [],
		'path'    => @$_GET['id'],
		);
	switch ($out['path'])
	{
		case '':
			$out['result'] = $db->getAll("SELECT `id`, `name` FROM `bin_serial_type` WHERE 1");
			break;
		case 'async':
			$data = $db->getRow("SELECT * FROM `bbc_async` WHERE 1 ORDER BY `id` ASC LIMIT 1");
			if (!empty($data['created']))
			{
				_func('date');
				$data['created'] .= ' ('.timespan(strtotime($data['created'])).')';
			}
			$result    = array(
				'function' => @$data['function'],
				'created'  => @$data['created'],
				'total'    => intval($db->getOne("SELECT COUNT(*) FROM `bbc_async` WHERE 1")),
				);
			$out['result'] = $result;
			break;
		case 'status':
			$out['result'] = _class('async')->status();
			break;
		case 'restart':
			$exec = _class('async')->restart();
			$out['result'] = !empty($exec) ? $exec.' -  async akan di restart tunggu kabar selanjutnya' : ' async akan di restart tunggu kabar selanjutnya';
			break;
		case 'view':
			$serial_id = @intval($_GET['serial_id']);
			$result    = array(
				'available' => intval($db->getOne("SELECT COUNT(*) FROM `bin_serial` WHERE `type_id`={$serial_id} AND `used`=0 AND `active`=1")),
				'active'    => intval($db->getOne("SELECT COUNT(*) FROM `bin_serial` WHERE `type_id`={$serial_id} AND `used`=1 AND `active`=1")),
				'disabled'  => intval($db->getOne("SELECT COUNT(*) FROM `bin_serial` WHERE `type_id`={$serial_id} AND `active`=0")),
				);
			$out['result'] = $result;
			break;
		case 'generate':
			$out['message'] = 'GAGAL memnbuat serial!';
			if (!empty($_POST['name']) && !empty($_POST['total']) && !empty($_POST['serial_id']))
			{
				$name      = $_POST['name'];
				$total     = intval($_POST['total']);
				$serial_id = intval($_POST['serial_id']);
				if ($total > 0 && $serial_id > 0)
				{
					$serial = $db->getOne("SELECT `name` FROM `bin_serial_type` WHERE `id`={$serial_id}");
					if (!empty($serial))
					{
						$tbl = $db->getRow("SHOW TABLE STATUS LIKE 'bin_serial'");
						$ai  = @intval($tbl['Auto_increment']);
						$pre = config('plan_a', 'prefix');
						$db->Execute('START TRANSACTION');
						for ($i=0; $i < $total; $i++)
						{
							$code = $pre.(100000+$ai);
							$pass = true;
							$ai++;
							$q = "INSERT INTO `bin_serial` SET
								`code`    = '{$code}',
								`pin`     = '".substr(rand(), 0, 6)."',
								`type_id` = ".$serial_id.",
								`used`    = 0,
								`active`  = 0
								";
							if(!$db->Execute($q))
							{
								$pass = false;
							}
						}
						$total = money($total);
						$q     = $pass ? 'COMMIT' : 'ROLLBACK';
						$db->Execute($q);
						if ($pass)
						{
							$out['message'] = "Dear {$name}, anda telah berhasil membuat {$total} serial untuk {$serial} pada ".@$_SERVER['HTTP_HOST'];
						}else{
							$out['message'] = "Maaf, {$total} serial telah GAGAL dibuat!";
						}
					}else{
						$out['message'] = "Maaf, tipe serial dengan ID {$serial_id} tidak tersedia!";
					}
				}else{
					$out['message'] = 'Maaf, anda harus memasukkan jumlah berapa serial yang ingin anda buat minimal 1 atau lebih!';
				}
			}
			break;
	}
	output_json($out);
}
$sys->set_layout('blank');
// echo sys_get_temp_dir();
?>
<div class="container-fluid">
	<div class="jumbotron">
		<?php
		if (!empty($_POST['submit']))
		{
			if ($_POST['submit'] == 'do_now')
			{
				$_SESSION['binfix'] = rand();
				tm(lang("URL: "._URL."\nfrom: ".$_SERVER['REMOTE_ADDR']."\ntoken: ".$_SESSION['binfix']));
				?>
				<form action="" method="POST" class="form-inline" role="form">
					<div class="form-group">
						<input type="text" name="binfix" id="inputBinfix" class="form-control" required="required" placeholder="masukkan token.." autocomplete="OFF" />
					</div>
					<button class="btn btn-primary" type="submit" name="submit" value="submit_now">Submit</button>
				</form>
				<?php
			}else
			if ($_POST['submit']=='submit_now' && isset($_POST['binfix']))
			{
				$token = @$_SESSION['binfix'];
				unset($_SESSION['binfix']);
				if (is_numeric($_POST['binfix']) && $token == $_POST['binfix'])
				{
					if (_func('binfix', 'start'))
					{
						echo msg('Perbaikan jaringan binary telah dimulai', 'success');
					}else{
						echo msg('Maaf, perbaikan jaringan gagal dimulai', 'danger');
					}
				}else{
					echo msg('Maaf, perbaikan jaringan gagal dilakukan karena kesalahan token!', 'danger');
				}
			}
			echo '<div class="clearfix"></div><a href="bin/binfix"><button class="btn btn-default">'.icon('fa-angle-double-left').'</button></a>';
		}else{
			?>
			<form action="" method="POST" class="form-inline" role="form">
				<p>Sebelum anda memproses perbaikan jaringan networking dalam binary sebaiknya anda mem-backup terlebih dahulu table `bin` setelah itu anda bisa mengklik tombol di bawah</p>
				<p>
					<button class="btn btn-primary btn-lg" type="submit" name="submit" value="do_now">table `bin` sudah dibackup!</button>
				</p>
			</form>
			<p>
				<?php
				include _ROOT.'modules/user/async.php';
				?>
			</p>
			<?php
		}
		?>
	</div>
</div>