<?php

include_once("funcions.php");
include_once("Producte.php");
include_once("lib/ProducteComanda.php");

Class ProducteHistoric
{
   function llistatProductesDisponibles($currDate)
   {
      $rows = Producte::llistatProductes();
      $dispComanda = ProducteComanda::llistatProductesMarcats($currDate);
      
      $disponibles = array();
      foreach ( $rows as $row )
      {
	  $type=""; 
	  // if prodisstock == -1 (fresc_permanant) then no need to order, every week have product
	  // if prodisstock == 1  (stock)           and prodstockactual >0 
	  // if prodisstock == 0  (fresc=comanda)   and exists in llistatProductesMarcats

	  if ($row["prodisstock"]==-1)
	  {
             $type="COMMANDA ";
	  } else if ($row["prodisstock"]==1 && $row["prodstockactual"]>0)
	  {
	      $type="ESTOC ";
	  } else if ($row["prodisstock"]==0 && $row["prodstockactual"]>0)
	  {	
	      $type="ESTOC ";
	  } else if ($row["prodisstock"]==0)
	  {
	        foreach ($dispComanda as $dispComandaRow)
	        {
		   if ($dispComandaRow["prodid"]==$row["prodid"]) 
	           {
	              if ($dispComandaRow["checked"]!="") $type="COMMANDA ";
    		      break;
	           }
	        }
         }
         $row["type"]=$type;
         array_push($disponibles,$row);
       }
       return $disponibles;
   }
   function actualitzaProducteHistoric()
   {
       global $db;
       $data=Data::comandaActual() ;
       $strSQL = "SELECT COUNT(data) AS total FROM ProducteHistoric WHERE data='".$data."'";
       $rownum = $db->GetAll($strSQL) or die("Error en la sentencia SQL: $strSQL<br/>".$db->ErrorMsg());
       $num=$rownum[0]['total'];
       if ($num>0) return;
       $rows = ProducteHistoric::llistatProductesDisponibles( $data );
       foreach ($rows as $row)
       {
          if ($row["type"]!="")
          {
             $strSQL = "INSERT INTO ProducteHistoric (prodid,data,prodpreu) VALUES (".$row["prodid"].",'".$data."',".$row['prodpreu'].")";
             $db->Execute($strSQL) or die("Error en la sentencia SQL: $strSQL<br/>".$db->ErrorMsg());
           }
       }
   }
   function generaDiferenciesProducteHistoric()
   {
       global $db;
       $dataAquestaCommanda=Data::comandaActual() ;
       $dataAnteriorCommanda = Data::comandaAnterior( $dataAquestaCommanda );
     
       $nowAvailables = ProducteHistoric::llistatProductesDisponibles( Data::comandaSeguent($dataAquestaCommanda) );
       $strSQL = "SELECT prodid,prodpreu FROM ProducteHistoric WHERE data='".$dataAnteriorCommanda."'";
       	
       $previousAvailables = $db->GetAll($strSQL);
       if (!$previousAvailables) return;
       // -- buscar els nous
       $changes = array();
       foreach ($nowAvailables as $nowAvailable)
       {
            if ($nowAvailable['type']=='') continue;
            $productExists = FALSE;
            foreach ($previousAvailables as $previousAvailable)
            {
                if ($nowAvailable['prodid']==$previousAvailable['prodid'])
                {
                    if ($nowAvailable['prodpreu']!=$previousAvailable['prodpreu'])
                    {
                        $nowAvailable['change']='CANVI PREU '.$previousAvailable['prodpreu']."->".$nowAvailable['prodpreu'];
                        array_push($changes,$nowAvailable);
                    }
                    $productExists = TRUE;
                    break;
                }
            }
            if ($productExists === FALSE)
            {
                $nowAvailable['change']='DISPONIBLE';
                array_push($changes,$nowAvailable);
            }
       }
       return $changes;
   }

}


?>
