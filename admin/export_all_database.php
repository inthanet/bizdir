<?php

/* Backup Database Using PHP Function */
include "config/info.php";

//ENTER THE RELEVANT INFO BELOW
$mysqlUserName = DB_USERNAME; 
$mysqlPassword = DB_PASSWORD; 
$mysqlHostName = DB_HOSTNAME; 
$DbName = DB_NAME;            



if(empty($_POST['table_prefix'])){
    $_SESSION['msg'] = 'Table Prefix missing';
    header("location:admin-export.php");
    exit;
}


$table_prefix = $_POST['table_prefix'];
if(!empty($_POST['table_prefix']) AND $_POST['table_prefix'] != 'all'){
    $table_prefix = $_POST['table_prefix'];
  } else {
    $table_prefix = $_POST['table_prefix'].'_';  
  }


if(!empty($_POST['new_table_prefix']) AND $table_prefix != 'all_'){
  $new_table_prefix = $_POST['new_table_prefix'];
} else {
  $new_table_prefix = $table_prefix;  
}  


$backup_name  = $new_table_prefix."BizDir_Database_";  //Backup Download file Name

Export_Database($mysqlHostName, $mysqlUserName, $mysqlPassword, $DbName, $tables = false, $backup_name, $table_prefix, $new_table_prefix);

function Export_Database($host, $user, $pass, $name, $tables = false, $backup_name, $table_prefix, $new_table_prefix)
{

    //$logfile = fopen('/home/bizdir/public_html/logs/db-export.log', 'w'); 
    //fwrite($logfile, $table_prefix.' | '. $new_table_prefix ."\n"); 

    $mysqli = new mysqli($host, $user, $pass, $name);
    $mysqli->select_db($name);
    $mysqli->query("SET NAMES 'utf8'");
    
    if($table_prefix == 'all_'){
        $sql = "SHOW TABLES";
    } else {
        $sql = "SHOW TABLES LIKE '".$table_prefix."%'";
    }
    
    //fwrite($logfile,$sql ."\n");

    $queryTables = $mysqli->query($sql);
       

    while ($row = $queryTables->fetch_row()) {
        $target_tables[] = $row[0];
    }
    if ($tables !== false) {
        $target_tables = array_intersect($target_tables, $tables);
    }

    //fwrite($logfile,print_r($target_tables,true) ."\n");

    foreach ($target_tables as $table) {
        $result = $mysqli->query('SELECT * FROM ' . $table);
        $fields_amount = $result->field_count;
        $rows_num = $mysqli->affected_rows;
        $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
        $TableMLine = $res->fetch_row();
        $content = (!isset($content) ? '' : $content) . "\n\n" . $TableMLine[1] . ";\n\n";

        for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
            while ($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
                if ($st_counter % 100 == 0 || $st_counter == 0) {
                    $content .= "\nINSERT INTO " . $table . " VALUES";
                }
                $content .= "\n(";
                for ($j = 0; $j < $fields_amount; $j++) {
                    //$row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                    
                    if (isset($row[$j])) {
                        $content .= '"' . $row[$j] . '"';
                    } else {
                        $content .= '""';
                    }
                    if ($j < ($fields_amount - 1)) {
                        $content .= ',';
                    }
                }
                $content .= ")";
                //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle earlier
                if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                    $content .= ";";
                } else {
                    $content .= ",";
                }
                $st_counter = $st_counter + 1;
            }
        }
        $content .= "\n\n\n";
    }
    $backup_name .= date('Y-m-d').".sql";
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . $backup_name . "\"");

    if($table_prefix == 'all_'){
        $export_data = $content;
    } else {
        $export_data = str_replace($table_prefix, $new_table_prefix, $content);
    }

    echo $export_data;

    exit;

}

header("location:admin-export.php");

?>
