<?php

include_once("Membre.php");

Class Seguretat
{
        const SUPERADMINISTRADOR=3;
        const ADMINISTRADOR=2;
        const GESTOR=1;
        const NORMAL=0;

        function GetUsers($min)
        {
           $str = "<br><b>Contacta amb alguna d'aquestes persones per fer-ho</b>:<br><ul>";
           
           $membres = Membre::getAll("memtipus >=".$min);
           
           foreach ($membres as $membre)
             $str = $str."<li>".$membre["memnom"]." (UF".$membre["memuf"].")</li>";
            $str = $str."</ul>";
          return $str;
        } 

        function AssertAdministrator()
        {
           if ($_SESSION["membre"]["memtipus"]>=Seguretat::ADMINISTRADOR) return;
           error("OPERACIO NO PERMESA (Cal ser usuari Administrador)".Seguretat::GetUsers(Seguretat::ADMINISTRADOR));
        }
        function AssertGestorProductes()
        {
           if ($_SESSION["membre"]["memtipus"]>=Seguretat::GESTOR) return;
           error("OPERACIO NO PERMESA (Cal ser usuari Gestor de Proveidors)".Seguretat::GetUsers(Seguretat::GESTOR));
        }
	function AssertPaymentPC()
	{
           if(Seguretat::isPaymentPC()) return;
           die("OPERACIO NO PERMESA");
	}
        function isPaymentPC()
        {
           if ($_SESSION["membre"]["memtipus"]>=Seguretat::SUPERADMINISTRADOR) return TRUE;
           return $_SESSION["membre"]["memuf"]==29;
        }
}
?>
