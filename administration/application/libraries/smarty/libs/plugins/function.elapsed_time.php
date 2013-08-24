<?php 
/* 
* Smarty plugin 
* ------------------------------------------------------------- 
* Type: function 
* Name: elapsed_time 
* Author: Goran Pilipovic fka bluesman 
* Purpose: print time pased since specific time 
* Example: {elapsed_time timestamp=$ts} 
* ------------------------------------------------------------- 
*/ 
function smarty_function_elapsed_time($params, &$smarty) 
{ 
extract($params); 
if (empty($timestamp)) 
{ 
return ''; 
} 
if (empty($names)) 
{ 
$names = "day, hour, minute, few seconds"; 
} 
$n = explode (",",$names); 
if (count($n) < 4) 
{ 
$n = array ("day", "hour", "minute", "few seconds"); 
} 
$curdatetime = date("Y-m-d H:i:s");
//echo "<br>";
//echo $timestamp;
//echo "<br>";
$difference = intval(strtotime($curdatetime)) - intval(strtotime($timestamp)); 
//echo "<br>";
$days = floor($difference / (60 * 60 * 24)); 
$hours = floor($difference / (60 * 60)); 
$minutes = floor($difference / 60); 
$s = ""; 
$val = 0; 
if ($minutes > 0) 
{ 
	$val = $minutes; 
	$s = $n[2]; 
	if ($hours > 0) 
	{ 
		$val = $hours; 
		$s = $n[1]; 
		if ($days > 0) 
		{ 
			$val = $days; 
			$s = $n[0]; 
			if ($days > 3) 
			{ 
				$val = "pi&ugrave; di un mese fa"; 
				$s = null; 
				setlocale(LC_ALL, 'it_IT');
				//strftime("%A %e %B %Y");
				return strftime("%d %b %Y",strtotime($timestamp));				
				//return date("d M Y",strtotime($timestamp));
			} 
		} 
	} 
} 
else 
{ 
	return $n[3]." fa"; 
} 
$rest = $val % 10; 
if ($s == $n[0]) 
{ 
	$s = "giorno"; 
	if ($rest > 1) { $s ="giorni"; } 
} 
elseif ($s == $n[1]) 
{ 
	$s = "ora"; 
	if ($rest > 1) { $s ="ore"; } 
} 
elseif ($s == $n[2]) 
{ 
	$s = "minuto"; 
	if ($rest > 1) 
	{ $s = "minuti"; } 
} 
if (!empty($assign)) 
{ 
	$smarty->assign($assign, $difference); 
} 
return "{$val} {$s} fa"; 
} 
/* vim: set expandtab: */ 
?>