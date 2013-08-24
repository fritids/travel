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
function smarty_modifier_remove_utube_link($string)
{

	$return = "";

	preg_match("/(<embed)(.*?)(>)(<\/embed>)/si",$string, $matches, PREG_OFFSET_CAPTURE);

    $return=preg_replace("/(<embed)(.*?)(>)(<\/embed>)/si","",$string);
	/*$return=ereg_replace("<[^>]*>", "", $return);*/
	/*$return=$return.$matches[0][0];*/
	return $return;
	/*return $matches[0][0];*/
}

/* vim: set expandtab: */

?>