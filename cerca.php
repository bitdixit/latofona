<?php
   include_once('capcelera.php');
   include_once('Producte.php');
   include_once('ProducteComanda.php');
   include_once('ProducteHistoric.php');

   function norm($str)
   {
      $s = array ( "à","á","À","Á","è","é","È","É","ì","í","Í","Ì","ò","ó","Ò","Ó","ù","ú","Ú","Ù","ñ","Ñ","Ç","ç");
      $r = array ( "a","a","a","a","e","e","e","e","i","i","i","i","o","o","o","o","u","u","u","u","n","n","c","c");
      return str_replace($s,$r,strtolower($str));
   }

   $smartyObj = new Smarty;
   if ($_REQUEST["nomproducte"] != "")
   {
      $smartyObj -> display("cerca.tpl");
      $prodnom=trim($_REQUEST["nomproducte"]);
      $rows = ProducteHistoric::llistatProductesDisponibles( Data::getBestDateForComanda() );
      echo "<br><table><tr><td></td><td class='cela_titol'><b>Producte</b></td><td class='cela_titol'><b>Proveidor</b></td><td class='cela_titol'><b>€</b></td><td class='cela_titol'><b>Disponible stock o comanda ".$currDate."</b></td></tr>";
      $lastProvnom = "";
      foreach ( $rows as $row )
      {
	  if (strstr(norm($row["prodnom"]),norm($prodnom))===FALSE) continue;
          if (array_key_exists("disponibles", $_REQUEST) && $row['type']=="") continue;
          
          $nomprod=$row["prodnom"];
          if (!array_key_exists("disponibles", $_REQUEST))
	     if ($row['type']=="") $row['type']=":("; else $nomprod="<b>".$nomprod."</b>";
              
	  if ($lastProvnom != "" && $lastProvnom!=$row["provnom"]) echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
	
	  echo "<tr><td class='cela_titol'>".$row["prodid"]."</td><td class='cela_nom'>".$nomprod."</td><td class='cela_nom'>".$row["provnom"]."</td><td class='cela_nom'>".$row["prodpreu"]."</td>";
          echo "<td class='cela_nom'>".$row['type']."</td>";
          echo "</tr>"; 

	  $lastProvnom=$row["provnom"];
      }
      echo "</table>";
   } else
   {
      $smartyObj -> display("cerca.tpl");
   }
?>
