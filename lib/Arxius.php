<?php

Class Arxius
{
       function getAll()
        {
                global $db;
                $sql = 'SELECT id, name, mime, size, created,description,uploadedby FROM Arxius order BY id DESC';
                $db->SetFetchMode(ADODB_FETCH_ASSOC);
                $ret =$db->GetAll($sql);
                return $ret;

        }
        function add($name, $mime, $data, $size,$description)
        {
           $name = mysql_real_escape_string($name);
           $mime = mysql_real_escape_string($mime);
           $data = mysql_real_escape_string($data);
           $qui = mysql_real_escape_string($_SESSION["membre"]["memnom"]);
        // Create the SQL query
           $sql = "
            INSERT INTO `Arxius` (
                `name`, `mime`, `size`, `data`, `created`,description, uploadedby
            )
            VALUES (
                '{$name}', '{$mime}', {$size}, '{$data}', NOW(), '{$description}','{$qui}'
            )";

           global $db;
           $db->Execute($sql) or die($sql);

        }

        function download($id)
	{
            global $db;
            $sql = "
            SELECT `mime`, `name`, `size`, `data`
            FROM `Arxius`
            WHERE `id` = {$id}";
            
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $rs = $db->Execute($sql);
            if ($rs->EOF)  return;
            
            // Print headers
            header("Content-Type: ". $rs->fields['mime']);
            header("Content-Length: ". $rs->fields['size']);
            header("Content-Disposition: attachment; filename=". $rs->fields['name']);
            echo $rs->fields['data'];
            $rs -> Close();
        }


}

?>
