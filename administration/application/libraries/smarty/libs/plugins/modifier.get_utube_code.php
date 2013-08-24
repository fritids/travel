<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 * Smarty summarize modifier plugin
 *
 * Type:     modifier<br>
 * Name:     sumamrize<br>
 * Purpose:  summarize a string down to $limit words<br>
 *  @link http://smarty.incutio.com/?page=Smarty
 *          summarize (Smarty Plugins Wiki)
 * Input:<br>
 *         - string: input string of words
 *         - limit: number of words to return
 * @param string
 * @param int
 * @return string
 */
function smarty_modifier_get_utube_code($string)
{

	$return = "";

	preg_match("/(<embed)(.*?)(>)(<\/embed>)/si",$string, $matches, PREG_OFFSET_CAPTURE);

    $return=preg_replace("/(<embed)(.*?)(>)(<\/embed>)/si","",$string);
	/*
	preg_match("/(<embed.*src=)(.*?)(type)/si",$string, $link, PREG_OFFSET_CAPTURE);

	if($link[0][0] !=null)
	{
		$return=$link[0][0].' ="application/x-shockwave-flash" wmode="transparent" height="330px" width="435px"></embed>';
		return $return;
	}
	else
	return null;*/

	if($matches[0][0])
		return $matches[0][0];
	else
		return null;
}

/* vim: set expandtab:*/

?>