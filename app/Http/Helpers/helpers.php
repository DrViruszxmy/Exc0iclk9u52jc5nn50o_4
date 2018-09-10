<?php  
use Carbon\Carbon;
function v($vstring)
{
	$str = '{{' . $vstring . '}}';
	if (trim($str) != '' || trim($str) != null || $str != '') {
		return $str;
	}
    return '123123';
}

function pre($data)
{
	echo "<pre>";
    print_r($data->toArray());
    echo "</pre>";
}

function set_active($path, $defaultClass = 'navbar-active')
{
	return Request::is($path) ? "$defaultClass" : '';
}

function accessModule($accesses, $functionality)
{
	foreach ($accesses as $access) {
		if (Request::is($access['active_class'])) {
			foreach ($access['sub_modules'] as $action) {
				if ($action['sub_module'] == $functionality && count($action['accessiblities']) != 0) {
					return true;
				}
			}
			return false;
		}
	}
}

function generateTransactionNo()
{
    $date = Carbon::now();
    $str = explode('20', $date->year);
    $last_digit_year = $str[1];

    $first_key = 'TR-' . $last_digit_year .'-'. $date->month;
    $pool = '0123456789';
    $length = 16;
    $id =  $first_key.'-'.substr(str_shuffle(str_repeat($pool, $length)), -4, $length);

    return $id;
}

function generateControlNo()
{
    $date = Carbon::now();
    $str = explode('20', $date->year);
    $last_digit_year = $str[1];

    $first_key = 'OCN-' . $last_digit_year .'-'. $date->month;
    $pool = '0123456789';
    $length = 16;
    $id =  $first_key.'-'.substr(str_shuffle(str_repeat($pool, $length)), -5, $length);

    return $id;
}
?>