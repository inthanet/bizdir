<?php
define( 'GOOGLE_MAPS_API_KEY', 'AIzaSyDRVWbnZ1Soy00ScazDV-pjFEFZ2YvC59U' );
define( 'COUNTRY_NAME', 'Germany' );
define( 'COUNTRY_LANG', 'de' );

$apiKey = GOOGLE_MAPS_API_KEY;
$country = COUNTRY_NAME;
$language = COUNTRY_LANG;
$city = 'Andernach';
$result = getLatLngForCity( $city, $country, $language, $apiKey );

if ( $result ) {
    echo '<b>City:</b> '.$city. ', <b>Latitude:</b> ' . $result[ 'latitude' ] . ', <b>Longitude:</b> ' . $result[ 'longitude' ]. ', <b>State:</b> ' . $result[ 'state' ];
} else {
    echo 'City not found or there was an error.';
}

function getLatLngForCity( $city, $country, $lang, $apiKey ) {
    // URL for the Google Maps Geocoding API

    $apiUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$city.',+'.$country.'&language='.$lang.'&key='.$apiKey;
    echo $apiUrl.'<hr>';
    // Make the API request using cURL
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $apiUrl );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $response = curl_exec( $ch );
    curl_close( $ch );

    // Decode the JSON response
    $data = json_decode( $response, true );

    // Check if the API request was successful
    if ( $data[ 'status' ] === 'OK' && isset( $data[ 'results' ][ 0 ][ 'geometry' ][ 'location' ] ) ) {

        $latitude = $data[ 'results' ][ 0 ][ 'geometry' ][ 'location' ][ 'lat' ];
        $longitude = $data[ 'results' ][ 0 ][ 'geometry' ][ 'location' ][ 'lng' ];

        $address_components = $data[ 'results' ][ 0 ][ 'address_components' ];
        $state = '';
        foreach ( $address_components as $component ) {
            if ( in_array( 'administrative_area_level_1', $component[ 'types' ] ) ) {
                $state = $component[ 'long_name' ];
                break;
                // Exit the loop since we found the desired entry
            }
        }

        return array( 'latitude' => $latitude, 'longitude' => $longitude, 'state' => $state );
    } else {
        // If there was an error or no results were found, return null
        //echo 'there was an error';
        return null;
    }
}
