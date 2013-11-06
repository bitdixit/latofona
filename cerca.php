<?php

   function norm($str)
   {
      $s = array ( "à","á","À","Á","è","é","È","É","ì","í","Í","Ì","ò","ó","Ò","Ó","ù","ú","Ú","Ù","ñ","Ñ","Ç","ç");
      $r = array ( "a","a","a","a","e","e","e","e","i","i","i","i","o","o","o","o","u","u","u","u","n","n","c","c");
      return str_replace($s,$r,strtolower($str));
   }

   include_once('capcelera.php');
   include_once('Producte.php');
   include_once('ProducteComanda.php');
   $smartyObj = new Smarty;
   if ($_REQUEST["nomproducte"] != "")
   {
      $smartyObj -> display("cerca.tpl");
      $prodnom=trim($_REQUEST["nomproducte"]);
      $currDate=Data::getBestDateForComanda();
      $dispComanda = ProducteComanda::llistatProductesMarcats($currDate);
      $rows = Producte::llistatProductes();
      echo "<br><table><tr><td></td><td class='cela_titol'><b>Producte</b></td><td class='cela_titol'><b>Proveidor</b></td><td class='cela_titol'><b>€</b></td><td class='cela_titol'><b>Disponible stock o comanda ".$currDate."</b></td></tr>";
      $lastProvnom = "";
      foreach ( $rows as $row )
      {
	  if (strstr(norm($row["prodnom"]),norm($prodnom))===FALSE) continue;
		
	  $type=""; 
	    // if prodisstock == -1 (fresc_permanant) then no need to order, every week have product
	    // if prodisstock == 1  (stock)           and prodstockactual >0 
	    // if prodisstock == 0  (fresc=comanda)   and exists in llistatProductesMarcats

	    if ($row["prodisstock"]==-1)
	    {
               $type="comanda";
	    } else if ($row["prodisstock"]==1 && $row["prodstockactual"]>0)
	    {
	        $type="estoc";
	    } else if ($row["prodisstock"]==0 && $row["prodstockactual"]>0)
	    {	
	        $type="estoc";
	    } else if ($row["prodisstock"]==0)
	    {
	        foreach ($dispComanda as $dispComandaRow)
	        {
	           if ($dispComandaRow["prodid"]==$row["prodid"]) 
	           {
	              if ($dispComandaRow["checked"]!="") $type="comanda";
    		      break;
	           }
	        }

           }
             
          $nomprod=$row["prodnom"];
 		
          if (array_key_exists("disponibles", $_REQUEST) && $type=="") continue;
          if (!array_key_exists("disponibles", $_REQUEST))
	     if ($type=="") $type=":("; else $nomprod="<b>".$nomprod."</b>";
              

	  if ($lastProvnom != "" && $lastProvnom!=$row["provnom"]) echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";

	  echo "<tr><td class='cela_titol'>".$row["prodid"]."</td><td class='cela_nom'>".$nomprod."</td><td class='cela_nom'>".$row["provnom"]."</td><td class='cela_nom'>".$row["prodpreu"]."</td>";
          echo "<td class='cela_nom'>".$type."</td>";
          echo "</tr>"; 

	  $lastProvnom=$row["provnom"];
      }
      echo "</table>";
   } else
   {
      $smartyObj -> display("cerca.tpl");
   }
?>
