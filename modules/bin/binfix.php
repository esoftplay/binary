<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$sys->set_layout('blank');
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
				<p>Sebelum anda memproses perbaikan jaringan networking dalam binary sebaiknya anda mem-backup terlebih dahulu table `bin` setelah itu nada bisa mengklik tombol di bawah</p>
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
		include _ROOT.'modules/bin/admin/serial_list.php';
		?>
	</div>
</div>