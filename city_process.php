<?php
$debug = false;
//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}

if($debug) $logfile = fopen('/home/bizdir/public_html/logs/city_process.log', 'w'); 
        

$country_id = $_POST['country_id'];

//get matched data from State table
$state_sql = "SELECT * FROM  " . COUNTRY_PREFIX . "states where country_id='" . $country_id . "'";
$state_rs = mysqli_query($conn, $state_sql);


$state_row_count = mysqli_num_rows($state_rs);

if ($state_row_count <= 0) {
    ?>
    <option value=""><?php echo $BIZBOOK['NO_CITY_FOUND_MESSAGE']; ?></option>
    <?php
} else {
    $data = '';
    while ($state_row = mysqli_fetch_array($state_rs)) {
        $city_sql = "SELECT * FROM  " . COUNTRY_PREFIX . "cities where state_id='" . $state_row['state_id'] . "'";
        $city_rs = mysqli_query($conn, $city_sql);
       
        if($debug) fwrite($logfile, 'city_sql :'.$city_sql."\n");
       
        while ($city_row = mysqli_fetch_array($city_rs)) {
            if($debug) fwrite($logfile, 'city_row :'.$city_row."\n");
            $data .= '<option value="'.$city_row["city_id"].'">'.$city_row["city_name"].'</option>';

            ?>
    
            <option value="<?php echo $city_row['city_id']; ?>"><?php echo $city_row['city_name']; ?></option>

            <?php
        }
    }
    if($debug) fwrite($logfile, 'data :'.$data."\n");
}

?>