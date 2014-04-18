<?
	include_once("capcelera_segura.php");
	include_once("Data.php");

        $smartyObj = new Smarty;
        $smartyObj -> assign("membre", $_SESSION["membre"]);

        if ($_REQUEST["action"]=="creardiacomanda")
        {
        if (($_REQUEST['year'] != "") && ($_REQUEST['month'] != "") && ($_REQUEST['day'] != "")) { //we're trying to create a new order day....
                Data::createOrderDay($_REQUEST['year'], $_REQUEST['month'], $_REQUEST['day']);
                header( 'Location: data.php' ) ;
                return;
        }

                $currDate = Data::getLastDayComanda();
                $nextweek = Data::nextWeekFromDate($currDate);
                list($year, $month, $day) = explode("-", $nextweek);
                
                $smartyObj -> assign("lastdate", $currDate);
                $smartyObj -> assign("year",$year);
                $smartyObj -> assign("month",$month);
                $smartyObj -> assign("day",$day);
                $smartyObj -> display("creardiacomanda.tpl");
                return;
        }
	
	$smartyObj -> assign("dia", get_current_date());


       //t FERVENDA=1;
       // const COBRARVENDA=2;
       // const FERCOMANDA=4;

      if($_REQUEST["action"] == "on1") Data::canviarEstat($_REQUEST["data"],Data::FERVENDA,TRUE);
      else if($_REQUEST["action"] == "off1") Data::canviarEstat($_REQUEST["data"],Data::FERVENDA,FALSE);
      else if($_REQUEST["action"] == "on2") Data::canviarEstat($_REQUEST["data"],Data::COBRARVENDA,TRUE);
      else if($_REQUEST["action"] == "off2") Data::canviarEstat($_REQUEST["data"],Data::COBRARVENDA,FALSE);
      else if($_REQUEST["action"] == "on4") Data::canviarEstat($_REQUEST["data"],Data::FERCOMANDA,TRUE);
      else if($_REQUEST["action"] == "off4") Data::canviarEstat($_REQUEST["data"],Data::FERCOMANDA,FALSE);


	
	$smartyObj -> assign("dates",Data::getAll("datestat>=0 order by datdata desc limit 52"));
	$smartyObj -> display("data.tpl");

?>
