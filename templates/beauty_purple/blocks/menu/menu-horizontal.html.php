<?php
_func('bin_tpl');
$r = explode(' ', $config['submenu']);
$y = @$r[0]=='top' ? 'top' : '';
$x = @$r[1]=='left' ? 'left' : '';
echo bin_tpl_menu_horizontal($menus, $y, $x);
