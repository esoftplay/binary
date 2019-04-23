<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (isset($_seo['URI']))
{
	$_seo['r'] = explode('/', $_seo['URI']);
	if (!empty($_seo['r']))
	{
		switch ($_seo['r'][0])
		{
			case 'user': // menangkap module user
				switch (@$_seo['r'][1])
				{
					case 'account': // edit profile melalui user/account
						redirect('bin/profile_edit');
						break;
					case 'register': // registrasi melalui user/register
						redirect('bin/register');
						break;
				}
				break;
		}
	}
}