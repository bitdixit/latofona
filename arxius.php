<?

include_once('capcelera_segura.php');
include_once('Arxius.php');

$smartyObj = new Smarty;
$smartyObj -> assign("tipus_usuari",$_SESSION["membre"]["memtipus"]);
$smartyObj -> assign("membre",$_SESSION["membre"]);

if(isset($_GET['download']))
{
   Arxius::download($_GET['download']);
   return;
}
else if(isset($_FILES['uploaded_file'])) {
    if($_FILES['uploaded_file']['error'] == 0) {

        // Gather all required data
        $name = $_FILES['uploaded_file']['name'];
        $mime = $_FILES['uploaded_file']['type'];
        $data = file_get_contents($_FILES  ['uploaded_file']['tmp_name']);
        $size = intval($_FILES['uploaded_file']['size']);
       
        Arxius::add($name,$mime,$data,$size,$_REQUEST['description']);
  }
}

$smartyObj -> assign("arxius",Arxius::getAll());
$smartyObj -> display("arxius.tpl");
?>
