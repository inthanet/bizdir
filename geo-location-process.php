<?php
//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}
session_start();

$_SESSION['latitude'] = $_REQUEST['latitude'];
$_SESSION['longitude'] = $_REQUEST['longitude'];

if ($footer_row['admin_google_paid_geo_location'] == 1) {

$new = $_SESSION['latitude'].','.$_SESSION['longitude'];

$admin_geo_map_api = $footer_row['admin_geo_map_api'];

$_SESSION['google_city_name'] = getCityNameByLatitudeLongitude($new,$admin_geo_map_api);

function getCityNameByLatitudeLongitude($latlong,$admin_geo_map_api)
{

    $APIKEY = $admin_geo_map_api; // Replace this with your google maps api key 

    $googleMapsUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latlong . "&language=ar&key=" . $APIKEY;

    $response = file_get_contents($googleMapsUrl);

    $response = json_decode($response, true);
    $results = $response["results"];
    $addressComponents = $results[0]["address_components"];
    $cityName = "";

    foreach ($addressComponents as $component) {
        // echo $component;
        $types = $component["types"];
        if (in_array("locality", $types) && in_array("political", $types)) {
            $cityName = $component["long_name"];
        }
    }

    if ($cityName == "") {
        echo "Failed to get CityName";
    } else {
        return $cityName;
    }
 }
}

exit();