<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
link_js('includes/lib/pea/includes/formIsRequire.js', false);
?>
<section class="pageLogin">
	<div class="container">
		<div class="col-md-3"></div>
		<div class="col-md-6 loginBox">
			<div class="col-12 logoLogin">
				<img src="<?php echo _URL.'images/'.config('site','logo'); ?>">
			</div>
			<div class="col-12">
				<h4><?php echo lang('Please sign in');?></h4>
			</div>
			<form class="form-signin formIsRequire" method="POST" action="">
				<div class="col-md-12 usernameLogin">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
						<input class="form-control" placeholder="<?php echo lang('Username');?>" req="any true" autofocus="" type="username" name="usr" aria-describedby="basic-addon1">
					</div>
				</div>
				<div class="col-md-12 passwordLogin">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
						<input id="myPassword" class="form-control" placeholder="<?php echo lang('Password');?>" req="any true" type="password" name="pwd" aria-describedby="basic-addon1">
						<span class="input-group-addon" style="padding-bottom: 0;"><span class="btn glyphicon glyphicon-eye-open" onclick="showPswd()" style="padding: 0; margin: 0;"></span></span>
					</div>
				</div>
				<div class="col-md-8 captaLogin">
					<div class="input-group">
						<div class="checkbox">
							<label>
								<input value="1" type="checkbox" name="rememberme" /> <?php echo lang('Remember me');?>
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-12 formLoginBtn">
					<input type="hidden" name="url" value="<?php echo $user_url; ?>" />
					<button class="btn btn-primary" role="button" type="submit"><?php echo lang('Login');?></button>
				</div>
			</form>
			<div class="col-md-12 toRegistrasi">
				<p><?php echo lang('Belum menjadi member ? Silahkan %sRegistrasi disini%s','<a href="'.site_url('bin/register').'">','</a>'); ?></p>
			</div>
		</div>
	</div>
</section>
<div class="clearfix"></div>