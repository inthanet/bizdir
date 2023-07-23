<?php

//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}

$type_id = $_POST['type_id'];

if ($type_id == 1) {     //Listings City

    $all_city_array = array();
    foreach (getAllListingPageCities() as $city_listrow) {
        $arr34 = explode(',', $city_listrow['city_id']);
        foreach ($arr34 as $row) {
            if (trim($row) != '') {
                $all_city_array[] = trim($row);
            }
        }
    }
    $city_input = array();
    $city_input = array_unique($all_city_array);

    foreach ($city_input as $places) {
        $cityrow = getCity($places);
        $hyphend_city_name = urlModifier($cityrow['city_name']);
        ?>
        <option value="<?php echo urlModifier($hyphend_city_name); ?>"><?php echo $cityrow['city_name']; ?></option>
        <?php
    }

} elseif ($type_id == 2) {  //Service Experts City

    foreach (getAllExpertsGroupByCity() as $expert_location_row) {
        $expert_location = $expert_location_row['city_id'];

        $row = getExpertCity($expert_location);

        $hyphend_city_name = urlModifier($row['country_name']);
        ?>
        <option value="<?php echo $hyphend_city_name; ?>"><?php echo $row['country_name']; ?></option>
        <?php
    }
} elseif ($type_id == 3) {  //Jobs City

//get matched data from Jobs City table
    foreach (getAllJobGroupByCity() as $job_location_row) {
        $job_location = $job_location_row['job_location'];

        $row = getJobCity($job_location);

        $hyphend_city_name = urlModifier($row['city_name']);

        ?>
        <option value="<?php echo $hyphend_city_name; ?>"><?php echo $row['city_name']; ?></option>
        <?php
    }
} elseif ($type_id == 5) {  //News City

//get matched data from News City table
    foreach (getAllNewsCities() as $row) {

        $hyphend_city_name = urlModifier($row['city_name']);

        ?>
        <option value="<?php echo $hyphend_city_name; ?>"><?php echo $row['city_name']; ?></option>
        <?php
    }
} else {
    ?>
    <option value=""></option>
    <?php
}
?>