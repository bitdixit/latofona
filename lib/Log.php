<?php

include_once('UnitatFamiliar.php');
include_once('Proveidor.php');

Class Log
{	
	function AddLogUF($lgwhat, $ufid)
	{
		$ufrow = UnitatFamiliar::get($ufid);
		Log::Add($lgwhat,$ufrow["ufname"],'UF',$ufid);
		
	}
	function AddLogProveidor($lgwhat, $provid, $provname = NULL)
	{	
		if ($provname == NULL )
		{
			$provrow = Proveidor::getById($provid);
			$provname = $provrow["provnom"];
		}			
		Log::Add($lgwhat,$provname,'PROV',$provid);		
	}
	function AddLogGeneral($lgwhat)
	{
		Log::Add($lgwhat,"","GENERAL",0);	
	}

	function Add($lgwhat, $lgwhatobj, $lgwhatobjty, $lgwhatobjid)
	{
		global $db;
		$fetchMode=$db->SetFetchMode(ADODB_FETCH_BOTH);
		$logged = $_SESSION["membre"];
		$ufrow = UnitatFamiliar::get($logged["memuf"]);
		$lgwho = $ufrow["ufname"]." (".$logged["memnom"].")";
		$lgwhoufid = $logged["memuf"];
	
                $lgwhat=str_replace("'","`",$lgwhat);
		$lgwhatobj=str_replace("'","`",$lgwhatobj);

		$sql = "insert into Log (lgdate, lgwho, lgwhoufid, lgwhat, lgwhatobj,lgwhatobjid,lgwhatobjty) ".
			"VALUES (NOW(), '$lgwho', $lgwhoufid, '$lgwhat', '$lgwhatobj',$lgwhatobjid,'$lgwhatobjty')";

		$db -> Execute($sql) or die(mysql_error());
		$db->SetFetchMode($fetchMode);
	}
	function ListUFLogs($ufid)
	{
		global $db;
		$sql = "SELECT lgdate AS Data,lgwho as Qui,lgwhat as Operacio, lgwhatobj as UF FROM `Log` WHERE lgwhatobjty='UF' and lgwhatobjid=".$ufid." ORDER BY lgid DESC";
		$db -> SetFetchMode(ADODB_FETCH_ASSOC);
		return $db -> GetAll($sql);	

	}
	function ListProveidorLogs($provid)
	{
		global $db;
		$sql = "SELECT lgdate AS Data,lgwho as Qui,lgwhat as Operacio, lgwhatobj as Proveidor FROM `Log` WHERE lgwhatobjty='PROV' and lgwhatobjid=".$provid." ORDER BY lgid DESC";
		$db -> SetFetchMode(ADODB_FETCH_ASSOC);
		return $db -> GetAll($sql);	
	}
	function ListLogs()
	{
		global $db;
		$sql = "SELECT lgdate AS Data,lgwhoufid AS UF, lgwho as Qui,lgwhat as Operacio, lgwhatobj as Entitat FROM `Log` ORDER BY lgid DESC LIMIT 400";
		$db -> SetFetchMode(ADODB_FETCH_ASSOC);
		return $db -> GetAll($sql);	



	}


}

?>
