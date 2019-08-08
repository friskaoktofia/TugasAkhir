<?php

include_once("database.php");
/**
* 
*/
class info extends database
{
	function __construct()
	{
		$this->table="tabelfriska";
		$this->order="id";
	}
}