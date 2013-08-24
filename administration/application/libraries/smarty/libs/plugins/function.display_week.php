<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     random
 * Purpose:  output a random number between $varIn and $varOut:
 *	{random in=$varIn out=$varOut}
 *	If you want to assign the random number to a variable
 *	instead of displaying it, you must write:
 *	{random in=$varIn out=$varOut assign=yourVar}
 *	Where yourVar can be anything. Then you'll get
 *	$yourVar equal to a random number between $varIn and $varOut.
 * Author:   Philippe Morange
 * Modified: 25-03-2003
 * -------------------------------------------------------------
 */

function smarty_function_display_week($params, &$smarty)
{
	//extract($params);
	 $name = 'select_name';
	$id="select_id";
	$select="-";
	  foreach($params as $_key => $_val) {
        switch($_key) {
            case 'name':
            			$name=$_val;
            			break;
            case 'id':
            			$id=$_val;
            			break;
            case 'select':
            			 {$select=$_val;
            			 if($select=="" || $select==null)$select="Saturday";
            			 break;
            			 }

        }
	  }

	$day=array('-','Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday');
	echo "<select name='".$name."' id='".$name."' class='abc'>";
	foreach ($day as $value)
	{
    	echo "<option value='".$value."'";
    	if($select==$value)
    	echo "selected";

    	echo ">".$value."</option>";
	}

	echo "</select>";
}