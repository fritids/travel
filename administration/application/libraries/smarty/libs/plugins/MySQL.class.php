<?php
/*********************************************************************************************
** 	Autor		:	Andrés Darío Gutiérrez Poveda.			          																**
** 	Fecha  	:	Abril 21 de 2004.	         				   	          															**
** 	Versión	:	1.0.4.                      			   	          															**
**																																													**
**********************************************************************************************
**	Proposito:																																							**
**																																													**
** 		This class in meant to do differents operations of MySQL.															**
**																																													**
**********************************************************************************************
**	Nota																																										**
**																																													**
**	Esta clase utiliza una función de MySQL Optimizer.																			**
**********************************************************************************************
**	Version 1.0.1  -  Abril 21 de 2004																											**
** 	Changelog for version 1.0.1																															**
**																																													**
** 		- Added a method for optimization, analize, repair.																		**
**		- Added methods to do backup and restore with mysqldump and mysql.										**
**		- Added a method to do remote copies of databases.																		**
**		-	The tabloid can activate or deactivate automaticly fileds with No and Si.						**
**																																													**
**********************************************************************************************
**	Version 1.0.2  -  Mayo 3 de 2004																												**
** 	Changelog for version 1.0.2																															**
**																																													**
**		- Added the posibility of sort the tabloid by any of the fields shown, ascendently as **
**			descendently.																																				**
**		-	Configuration of local and remote conections separately.														**
**********************************************************************************************
**	Version 1.0.3  -  Junio 9 de 2004																												**
** 	Changelog for version 1.0.3																															**
**																																													**
**		- Adición de bloqueo y desbloqueo de tablas.																					**
**		-	Adición de manejo de errores.																												**
**********************************************************************************************
**	Version 1.0.4  -  Agosto 9 de 2004																											**
** 	Changelog for version 1.0.4																															**
**																																													**
**		- Added methods for sentences INSERT, UPDATE, DELETE, DROP TABLE, CREATE TABLE.				**
**		-	All comments have been translated to english.																				**
*********************************************************************************************/

class mysql{

	/*******************************************************************************************
 	** 	PRIVATE PROPERTIES																																		**
  *******************************************************************************************/
	var $mysql_link;					// Conection to the database.
	var $mysql_remote_link;		// Conection to a remote database.
	var $mysql_host;					// IP of the MySQL host.
	var $mysql_port;					// MySQL Port.
	var $mysql_remote_host;		// Remote IP of the MySQL host.
	var $mysql_remote_port;		// Remote MySQL Port.
	var $mysql_user;					// MySQL Login.
	var $mysql_pass;					// MySQL Password.
	var $mysql_remote_user;		// Remote MySQL Login.
	var $mysql_remote_pass;		// Remote MySQL Password.
	var $mysql_db;						// Database name.
	var $mysql_remote_db;			// Remote database name.
	var $mysql_error;					// Error name.
	var $mysql_errno;					// Error number.
	var $mysql_locked;				// Lock flag.
	var $mysql_feedback;			// Text of answer.
	var $mysql_file;					// Name of the file for the backup and restore. (Ex. /tmp/backup/backup.sql)
	
	
	/*******************************************************************************************
 	** 	METHODS																																								**
  *******************************************************************************************/		
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_link.													**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_link(){
		return $this->mysql_link;
	} 
	
	function set_mysql_link($value){
		$this->mysql_link = $value;
	} 
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_remote_link.										**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_remote_link(){
		return $this->mysql_remote_link;
	} 
	
	function set_mysql_remote_link($value){
		$this->mysql_remote_link = $value;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_host.													**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_host(){
		return $this->mysql_host;
	} 
	
	function set_mysql_host($value){
		$this->mysql_host = $value;
	} 
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_port.													**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_port(){
		return $this->mysql_port;
	} 
	
	function set_mysql_port($value){
		$this->mysql_port = $value;
	} 
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_remote_host.										**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_remote_host(){
		return $this->mysql_remote_host;
	} 
	
	function set_mysql_remote_host($value){
		$this->mysql_remote_host = $value;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_remote_port.										**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_remote_port(){
		return $this->mysql_remote_port;
	} 
	
	function set_mysql_remote_port($value){
		$this->mysql_remote_port = $value;
	}

	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_user.													**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_user(){
		return $this->mysql_user;
	}
	
	function set_mysql_user($value){
		$this->mysql_user = $value;
	} 
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_pass.													**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_pass(){
		return $this->mysql_pass;
	}
	
	function set_mysql_pass($value){
		$this->mysql_pass = $value;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_remote_user.										**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_remote_user(){
		return $this->mysql_remote_user;
	}
	
	function set_mysql_remote_user($value){
		$this->mysql_remote_user = $value;
	} 
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_remote_pass.										**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_remote_pass(){
		return $this->mysql_remote_pass;
	}
	
	function set_mysql_remote_pass($value){
		$this->mysql_remote_pass = $value;
	}


	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_db.														**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_db(){
		return $this->mysql_db;
	}
	
	function set_mysql_db($value){
		$this->mysql_db = $value;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_remote_db.											**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_remote_db(){
		return $this->mysql_remote_db;
	}
	
	function set_mysql_remote_db($value){
		$this->mysql_remote_db = $value;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_feedback.											**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_feedback(){
		return $this->mysql_feedback;
	} 
	
	function set_mysql_feedback($value){
		$this->mysql_feedback = $value;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	SET y GET for the private property mysql_file.													**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Method to set and get tha value of the property.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- value: Value to set.																									**
 	*****************************************************************************/
	function get_mysql_file(){
		return $this->mysql_file;
	} 
	
	function set_mysql_file($value){
		$this->mysql_file = $value;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql ()																																**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Class Constructor.																											**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	*****************************************************************************/
	function mysql(){
		
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_connect ()																												**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Create the connection to the database.																	**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	*****************************************************************************/
	function mysql_connect(){
		$this->mysql_link = @mysql_connect($this->mysql_host.':'.$this->mysql_port, $this->mysql_user, $this->mysql_pass);
	  @mysql_select_db($this->mysql_db);
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_remote_connect ()																									**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Create the connection to a remote database.															**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	*****************************************************************************/
	function mysql_remote_connect(){
		$this->mysql_remote_link = @mysql_connect($this->mysql_remote_host.':'.$this->mysql_remote_port, $this->mysql_remote_user, $this->mysql_remote_pass);
	  @mysql_select_db($this->mysql_remote_db);
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_configure ($host,$port,$user,$pass,$db)														**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Set the host, port, login, password	and database.												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- host: Host IP where MySQL is.																					**
 	**	- port: Port in which MySQL listens.																		**
 	**	- user: MySQL Login.																										**
 	**	- pass: MySQL Password.																									**
 	**	- db: Database name.																										**
 	*****************************************************************************/
	function mysql_configure($host,$port,$user,$pass,$db){
		$this->mysql_host = $host;
		$this->mysql_port = $port;
		$this->mysql_pass = $pass;
		$this->mysql_user = $user;
		$this->mysql_db = $db;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_configure_remote ($remote_host,$remote_port,$remote_user,					**
 	**													$remote_pass,$remote_db)												**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Set the remote host, port, login, password and database.								**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- remote_host: Remote host IP where MySQL is.														**
 	**	- remote_port: Remote port in which MySQL listens.											**
 	**	- remote_user: Remote MySQL Login.																			**
 	**	- remote_pass: Remote MySQL Password.																		**
 	**	- remote_db: Remote database name.																			**
 	*****************************************************************************/
	function mysql_configure_remote($remote_host,$remote_port,$remote_user,$remote_pass,$remote_db){
		$this->mysql_remote_host = $remote_host;
		$this->mysql_remote_port = $remote_port;
		$this->mysql_remote_pass = $remote_pass;
		$this->mysql_remote_user = $remote_user;
		$this->mysql_remote_db = $remote_db;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	get_db_tables ()																												**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	List the tables that exists in the database.														**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	*****************************************************************************/
	function get_db_tables(){
	 	$result = @mysql_list_tables($this->mysql_db);
		if (!$result)
			$this->mysql_feedback .= $this->mysql_manejo_errores("Imposible listar las tablas de la bases de datos!!");
	  
	  while($row = mysql_fetch_row($result)){
			$tables[] = $row[0];
		}
	  
		return $tables;		
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_delete ($table,$condition)																				**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Execute the sentence DELETE.																						**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	-	table: Name of the table.																							**
 	**	- condition: Rules to delete the regs.																	**
 	*****************************************************************************/
	function mysql_delete($table,$condition){
		$noerror = true;
		$sqld = "DELETE FROM ".$table." WHERE ".$condition;
		if(!($noerror = $this->mysql_query($sqld)))
	 		$this->mysql_feedback .= $this->mysql_manejo_errores("Imposible realizar la operación de DELETE.");
	 	else
	 		$this->mysql_feedback .= " Borrado exitoso! ";
	  	  
		return $noerror;		
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_insert ($table,$fields,$values)																		**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Execute the sentence INSERT.																						**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	-	table: Name of the table.																							**
 	**	- fields: List of the fields.																						**
 	**	-	values: Values of the fields to insert.																**
 	*****************************************************************************/
	function mysql_insert($table,$fields,$values){
		$noerror = true;
		$sqld = "INSERT INTO ".$table." (".$fields.") VALUES (".$condition.")";
		if(!($noerror = $this->mysql_query($sqld)))
	 		$this->mysql_feedback .= $this->mysql_manejo_errores("Imposible realizar la operación de INSERT.");
	 	else
	 		$this->mysql_feedback .= " Inserción exitosa! ";
	  	  
		return $noerror;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_update ($table,$sets,$condition)																	**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Execute the sentence UPDATE.																						**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	-	table: Name of the table.																							**
 	**	- sets: List of the SET clauses to update.															**
 	**	-	condition: Rules to update the regs.																	**
 	*****************************************************************************/
	function mysql_update($table,$sets,$condition){
		$noerror = true;
		$sqld = "UPDATE ".$table." SET ".$sets." WHERE ".$condition;
		if(!($noerror = $this->mysql_query($sqld)))
	 		$this->mysql_feedback .= $this->mysql_manejo_errores("Imposible realizar la operación de UPDATE.");
	 	else
	 		$this->mysql_feedback .= " Actualización exitosa! ";
	  	  
		return $noerror;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_create_table ($table,$fields)																			**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Execute the sentence CREATE TABLE.																			**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- table: Name of the table to drop.																			**
 	*****************************************************************************/
	function mysql_create_table($table,$fields){
		$noerror = true;
		$sqld = "CREATE TABLE ".$table." (".$fields.")";
		if(!($noerror = $this->mysql_query($sqld)))
	 		$this->mysql_feedback .= $this->mysql_manejo_errores("Imposible realizar la operación de CREATE TABLE.");
	  	  
		return $noerror;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_drop_table ($table)																								**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Execute the sentence DROP TABLE.																				**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- table: Nombre de la tabla a borrar.																		**
 	*****************************************************************************/
	function mysql_drop_table($table){
		$noerror = true;
		$sqld = "DROP TABLE ".$table;
		if(!($noerror = $this->mysql_query($sqld)))
	 		$this->mysql_feedback .= $this->mysql_manejo_errores("Imposible realizar la operación de DROP TABLE.");
	  	  
		return $noerror;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_operation ($operation = "OPTIMIZE")																**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Operate the MySQL tables.																								**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- operation: Name of the operation.																			**
 	**								1. OPTIMIZE: Optimize a table.														**
 	**								2. ANALYZE: Analize a table.															**
 	**								3. REPAIR: Repair a table.																**
 	*****************************************************************************/
	function mysql_operation($operacion){
		$colores['backg'] = "#0099cc";
		$colores['textg'] = "#FFFFFF";
		$colores['middleg'] = "#fff8da";
		$colores['topg'] = "#daf8ff";
		
		$res = "<table align=center border='0' class='grid' bordercolor='".$colores['backg']."' cellspacing='1' cellpadding='0'>";
		$res .= "<tr>";
		$res .= "<td bgcolor='".$colores['backg']."' height='15' align='center'><strong><font color='".$colores['textg']."'>Tabla</font></strong></td>";
		$res .= "<td bgcolor='".$colores['backg']."' height='15' align='center'><strong><font color='".$colores['textg']."'>Operaci&#243n</font></strong></td>";
		$res .= "<td bgcolor='".$colores['backg']."' height='15' align='center'><strong><font color='".$colores['textg']."'>Tipo</font></strong></td>";
		$res .= "<td bgcolor='".$colores['backg']."' height='15' align='center'><strong><font color='".$colores['textg']."'>Mensaje</font></strong></td>";
		$res .= "</tr>";
		
		$tablas = $this->get_db_tables();
		foreach($tablas as $k=>$v){
			$sql .= ", $v";
		}
		$sql = substr($sql,1,strlen($sql));
		$sql = "$operacion TABLE ".$sql;
		
		$result = mysql_query($sql,$this->mysql_link);
		while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
	  	$res .= "<tr>";
	    foreach ($line as $mensaje){
				if($mensaje == "OK")
					$bgcolor = "#EEAACC";
				else
					$bgcolor = "";
	      $res .= "<td valign='top' bgcolor='".$bgcolor."'>$mensaje $optimizar</td>";
	    }
	    $res .= "</tr>";
		}
		$res .= "</table>";
		$res .= "<p align=center><a href='?hoja=dbmanagement&operation=OPTIMIZE'>Optimizar</a></p>";
		return $res;
	}	
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_backup ()																													**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Do the backup and put it as a file defined by mysql_file.								**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	*****************************************************************************/
	function mysql_backup(){
		$linea = 'mysqldump -u '.$this->mysql_user.' -p'.$this->mysql_pass.' '.$this->mysql_db.' > '.$this->mysql_file;
		exec($linea,$algo,$error);
		
		if($error == 0)
			$this->mysql_feedback .= " Backup realizado con exito!! ";
		else
			$this->mysql_feedback .= $this->mysql_manejo_errores("Error al realizar el Backup!!");
			
		return $error;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_restore ()																												**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Restore the backup defined by mysql_file.																**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	*****************************************************************************/
	function mysql_restore(){
		$linea = 'mysql --debug=d:t:o,/tmp/mysql.trace '.$this->mysql_db.' < '.$this->mysql_file;
		exec($linea,$algo,$error);
		
		if($error == 0)
			$this->mysql_feedback .= " Restore realizado con exito!! ";
		else
			$this->mysql_feedback .= $this->mysql_manejo_errores("Error al realizar el Restore!!");
		
		return $error;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_remote_copy ()																										**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Make a copy of the database to a remote MySQL host.											**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	*****************************************************************************/
	function mysql_remote_copy(){
		mysql_drop_db($this->mysql_remote_db,$this->mysql_remote_link);
		mysql_create_db($this->mysql_remote_db,$this->mysql_remote_link);
		
		$linea = 'mysqldump -u '.$this->mysql_user.' -p'.$this->mysql_pass.' '.$this->mysql_db.' | mysql -u'.$this->mysql_remote_user.' -p'.$this->mysql_remote_pass.'  --host='.$this->mysql_remote_host.' -C '.$this->mysql_db;
		exec($linea,$algo,$error);
		
		if($error == 0)
			$this->mysql_feedback .= " Copia Remota realizada con exito!! ";
		else
			$this->mysql_feedback .= $this->mysql_manejo_errores("Error al realizar el Copia Remota!");
		
		return $error;
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_lock ($table, $mode = "write")																		**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Block the access to the table(s) for the mode.													**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	-	tabla: Name(s) of the table(s) to protect.														**
 	**	-	mode: Mode of protection. Those are:																	**
 	**					-	read																													**
 	**					-	read local																										**
 	**					-	write							 																						**
 	**					-	low priority write																						**
 	*****************************************************************************/
	function mysql_lock($tabla, $mode = "write"){
    /*$noerror = true;
    
    $sql = "lock tables ";
    if(is_array($tabla)){
      while(list($key,$valor) = each($tabla)){
        if(is_int($key)) 
        	$key = $mode;
        if(strpos($valor, ","))
          $sql .= str_replace(",", " $key, ", $value) . " $key, ";
        else
          $sql .= "$valor $key, ";
      }
      $sql = substr($sql, 0, -2);
    }else if(strpos($tabla, ","))
      $sql .= str_replace(",", " $mode, ", $tabla) . " $mode";
    else
      $sql .= "$tabla $mode";
    
    if(!$this->mysql_query($sql)){
      $this->mysql_feedback .= $this->mysql_manejo_errores("Bloqueo de tablas fall&#243!!");
    	$noerror = false;
    }
    
    $this->locked = true;
    
    return $noerror;*/
  }
  
  
  /*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_unlock ()																													**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Unblock the tables.																											**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	*****************************************************************************/
  function mysql_unlock() {
   /* $noerror = true;
    $this->locked = false;
		
		if(!($noerror = $this->mysql_query("unlock tables")))
      $this->mysql_feedback .= $this->mysql_manejo_errores("Desbloqueo de tablas fall&#243!!");
    
    return $noerror;*/
  }
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_query ($sql)																											**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Execute sql sentences.																									**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	*****************************************************************************/
	function mysql_query($sql){
		$noerror = true;
    if(!empty($sql)){
    	$result = @mysql_query($sql,$this->mysql_link);
    	$this->mysql_errno = mysql_errno();
    	$this->mysql_error = mysql_error();
    	if(!$result){
      	$this->mysql_feedback .= $this->mysql_manejo_errores("SQL No v&#225lido: ".$sql);
      	$noerror = false;
      }
		}else
			$noerror = false;
    		
    return $noerror;
  }
  
  
  /*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_mysql_manejo_errores ($error)																			**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Handle errors.																													**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	-	error: Error caused.																									**
 	*****************************************************************************/
  function mysql_manejo_errores($error) {
    $this->mysql_error = @mysql_error($this->mysql_link);
    $this->mysql_errno = @mysql_errno($this->mysql_link);

    if ($this->mysql_locked)
      $this->mysql_unlock();

   return $this->mysql_mensaje_error($error);
  }

	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_mensaje_error ($error)																						**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Format the error.																												**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	-	error: Error caused.																									**
 	*****************************************************************************/
  function mysql_mensaje_error($error) {
    $mensaje = "<b>Database Error: ".$error."</b><br>";
    $mensaje .= "<b>MySQL Error</b>: ".$this->mysql_error." (".$this->mysql_errno.")<br>";
    return $mensaje;
  }
  
  
  /*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	mysql_manejo_exito ($tipo,$tabla)																				**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	Format the success.																											**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	-	tipo: Kind of movement.																								**
 	**	-	tabla: Table over which the movement were execute.										**
 	*****************************************************************************/
  function mysql_manejo_exito($tipo,$tabla){
    $mensaje = "<b>Exito!!</b> ";
    $mensaje .= "<b>Tipo</b>: ".$tipo." ";
    $mensaje .= "<b>Tabla</b>: ".$tabla."<br>";
    return $mensaje;
  }
	
		
/******************************************************************************************************************************************
The next three fucntions works for the implementation of movements management: confirm, rollback.
******************************************************************************************************************************************/
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	ejecutarsql($info)																											**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	This function executes sql sentences.																		**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- info: Array as show next:																							**
 	**				[tabla] => Name of the table.																			**
 	**				[campos] => Fields of the table.																	**
 	**				[antes] => Values of the fields before changes.										**
 	**				[despues] => Values of the fields after changes.									**
 	**				[usuarioid] => Id of the user that made the change.								**
 	**				[movimientoid] => Type of movement.																**
 	**				[tiemstamp] => Timestamp of the change.														**
 	**				[sql] => SQL Sentence SQL to execute.															**	
 	*****************************************************************************/
	function ejecutarsql($info){
		$info['sql'] = str_replace("\\","",$info['sql']);
		$this->mysql_lock($info['tabla'],"write");
		switch($info['movimientoid']){
			/** Inserción de registros */
			case 1:
				if(!mysql_query($info['sql']))
					$this->mysql_feedback .= $this->mysql_manejo_errores("No se pudo insertar el registro!!");
				else
					$this->mysql_feedback .= $this->mysql_manejo_exito("Inserci&#243n",$info['tabla']);
				break;
				
			/** Actualización de registros */
			case 2:
				if(!mysql_query($info['sql'],$this->mysql_link))
					$this->mysql_feedback .= $this->mysql_manejo_errores("No se pudo actualizar el registro!!");
				else
					$this->mysql_feedback .= $this->mysql_manejo_exito("Actializaci&#243n",$info['tabla']);
				break;
				
			/** Eliminación de registros */
			case 3:
				if(!mysql_query($info['sql']))
					$this->mysql_feedback .= $this->mysql_manejo_errores("No se pudo borrar el registro!.");
				else
					$this->mysql_feedback .= $this->mysql_manejo_exito("Borrado",$info['tabla']);
				break;
				
			case 4:
				break;	
				
			case 5:
				$sql = "SELECT * FROM ".$info['tabla']." WHERE id = ".$info['id'];
				$result = mysql_query($sql,$this->mysql_link);
				$row = mysql_fetch_array($result);
				$tablarb = $row['tabla'];
				$camposrb = $row['campos'];
				$antesrb = $row['valoresantes'];
				$despuesrb = $row['valoresdespues'];
				$tiporb = $row['fk_tipomovimientoid'];
				$this->deshacer($tablarb,$camposrb,$antesrb,$despuesrb,$tiporb);
				$sqlf = "UPDATE ".$info['tabla']." SET rollbacked = 1 WHERE id = ".$info['id'];
				if(!mysql_query($sqlf,$this->mysql_link))
					$this->mysql_feedback .= $this->mysql_manejo_errores("No se pudo actualizar el movimiento!!");
				else	
					$this->mysql_feedback .= $this->mysql_manejo_exito("Rollback","Movimiento");
				mysql_free_result($result);
				break;
				
			case 6:
				$result = mysql_query($info['sql'],$this->mysql_link);
				return $result;
				break;
		}
		$this->mysql_unlock();
		
		/*$this->mysql_lock('movimiento',"write");
		$sqlt = "INSERT INTO movimiento (id,tabla,campos,valoresantes,valoresdespues,fk_usuarioid,fk_tipomovimientoid,rollbacked,razon) VALUES ('','".$info['tabla']."','".$info['campos']."','".$info['antes']."','".$info['despues']."',".$info['usuarioid'].",".$info['movimientoid'].",0,'".$info['razon']."')";
		if(!mysql_query($sqlt))
			$feedback .= $this->mysql_manejo_errores("No se pudo ingresar el movimiento!!");
		$this->mysql_unlock();*/
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	guardarsql($tipo,$tabla,$camposAr,$valores,$id,$idusuario)							**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	This function stores sql sentences.																			**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- tipo: Types of sql to execute.																				**
	**						1. Insert																											**
	** 						2. Update																											**
	** 						3. Delete																											**
	** 						4. BackUp																											**
	**						5. RollBack																										**
	** 	-	tabla: Table over which tha action is executed.												**
	** 	-	camposAr: Fields to modify.																						**
	** 	-	valores: New Values of the fields.																		**
	** 	-	id: Id of the reg to modify or delete.																**
	** 	-	idusuario: ID of the user that makes the change.											**
	**	-	razon: Reason for the movements.																			**
 	*****************************************************************************/
	function guardarsql($tipo,$tabla,$camposAr,$valores,$id,$idusuario,$razon){
		global $feedback;
		
		if($tipo != 6){
			$camposA = mysql_list_fields($this->mysql_db,$tabla,$this->mysql_link);
			$columns = mysql_num_fields($camposA);
			$campos = mysql_field_name($camposA,0);
			for ($i = 1; $i < $columns; $i++) {
	 			$campos .= ",".mysql_field_name($camposA,$i);
			}
			$camposA = explode(",",$campos);
			
			$sqlantes = "SELECT ".$campos." FROM ".$tabla." WHERE id = ".$id;
			$resultantes = mysql_query($sqlantes,$this->mysql_link);
			if($rowantes = mysql_fetch_array($resultantes)){
				$antes = $rowantes[$camposA[0]];
				for($i = 1; $i < $columns; $i++)
					$antes .= ":".$rowantes[$camposA[$i]];
				mysql_free_result($resultantes);
			}
		}
			
		$despues = $valores;
		
		$camposC = explode(",",$camposAr);
		$numcamposC = count($camposC);
		
		$valoresA = explode(":",$valores);
		$numvaloresA = count($valoresA);
		
		switch($tipo){
			/** Inserción de registros */
			case 1:
				$sql = "INSERT INTO ".$tabla." VALUES ('',";
				$sql .= "'".$valoresA[0]."'";
				for($i = 1; $i < $numvaloresA; $i++){
					$sql .= ",'".$valoresA[$i]."'";
				}
				$sql .= ")";
				break;
				
			/** Actualización de registros */
			case 2:
				if($numvaloresA == $numcamposC){
					$sql = "UPDATE ".$tabla." SET ";
					$sql .= $camposC[0]." = '".$valoresA[0]."'";
					for($i = 1; $i < $numvaloresA; $i++){
						$sql .= ",".$camposC[$i]." = '".$valoresA[$i]."'";
					}
					$sql .= " WHERE id = $id";	
				}else
					$feedback .= " El n&#250mero de argumentos de campos y valores no es igual!! ";
				break;
				
			/** Eliminación de registros */
			case 3:
				$sql = "DELETE FROM ".$tabla." WHERE id = $id";
				break;
				
			case 4:
				break;	
				
			case 5:
				$sql = "UPDATE ".$tabla." SET rollbacked = 1 WHERE id = ".$id;
				break;
		}
		
		/*$this->mysql_lock('movimientoconfirmacion','write');
		$sqlt = "INSERT INTO movimientoconfirmacion (id,tabla,campos,valoresantes,valoresdespues,fk_usuarioid,fk_tipomovimientoid,sqlquery,confirmado,razon) VALUES ('','$tabla','$campos','$antes','$despues',$idusuario,$tipo,\"".$sql."\",'No','$razon')";
		if(!mysql_query($sqlt))
			$feedback .= $this->mysql_manejo_errores("No se pudo ingresar el movimiento a confirmar!!");
		else
			$feedback .= " Movimiento a Confirmar por Autoridad correspondiente!! ";
		$this->mysql_unlock();*/
	}
	
	
	/*****************************************************************************
 	** 	NAME:																																		**
  **																																					**
 	** 	deshacer($tabla,$campos,$antes,$despues,$tipo,$link,$fp)								**
  **																																					**
  ******************************************************************************
 	** 	DESCRIPTION:																													 	**
  **																																					**
  ** 	This function executes rollbacks.																				**
 	**																																					**
 	******************************************************************************
 	**	ARGUMENTS:																															**
 	**																																					**
 	**	- tipo:	Types of sql to execute.																				**
	**					1. Insert																												**
	** 					2. Update																												**
	** 					3. Delete																												**
	**					4. RollBack																											**
	** 	- tabla: Table over which tha action is executed.												**
	** 	- campos:	Fields modified.																							**
	** 	- antes: Old Values.																										**
	** 	- despues: New Values.																									**
 	*****************************************************************************/
	function deshacer($tabla,$campos,$antes,$despues,$tipo){
		global $feedback;
		
		/* Separación los campos y contamos cuantos son */
		$camposA = explode(",",$campos);
		$numcampos = count($camposA);
		
		/* Separación los valores anteriores y contamos cuantos son */
		$antesA = explode(":",$antes);
		$numantes = count($antesA);
		
		/* Separación los valores después y contamos cuantos son */
		$despuesA = explode(":",$despues);
		$numdespues = count($despuesA);
		$this->mysql_lock($tabla,'write');
		switch($tipo){
			case 1:
				$sqlrb = "DELETE FROM ".$tabla." WHERE ";
				$sqlrb .= $camposA[1]." = '".$despuesA[0]."'";
				for($i = 1; $i < $numdespues; $i++)
					$sqlrb .= " AND ".$camposA[$i+1]." = '".$despuesA[$i]."'"; 
				if(!mysql_query($sqlrb))
					$feedback .= $this->mysql_manejo_errores("(RollBack) No se pudo borrar el registro!!");
				else
					$feedback .= $this->mysql_manejo_exito("(RollBack) Borrado",$tabla);
				break;	
			
			case 2:
				$sqlrb = "UPDATE ".$tabla." SET ";
				$sqlrb .= $camposA[1]." = '".$antesA[1]."'";
				for($i = 2; $i < $numantes; $i++)
					$sqlrb .= ", ".$camposA[$i]." = '".$antesA[$i]."'"; 
				$sqlrb .= " WHERE id = ".$antesA[0];
				if(!mysql_query($sqlrb,$this->mysql_link))
					$feedback .= $this->mysql_manejo_errores("(RollBack) No se pudo actualizar el registro!!");
				else
					$feedback .= $this->mysql_manejo_exito("(RollBack) Actializaci&#243n",$tabla);
				break;	
			
			case 3:
				$sqlrb = "INSERT INTO ".$tabla." VALUES (";
				$sqlrb .= "'".$antesA[0]."'";
				for($i = 1; $i < $numcampos; $i++)
					$sqlrb .= ",'".$antesA[$i]."'"; 
				$sqlrb .= ")";
				if(!mysql_query($sqlrb))
					$feedback .= $this->mysql_manejo_errores("(RollBack) No se pudo insertar el registro!!");
				else
					$feedback .= $this->mysql_manejo_exito("(RollBack) Inserci&#243n",$tabla);
				break;
		}
		$this->mysql_unlock();
	}
}
?>