<?php

echo json_encode(get_geocode('Guwahati'));
function get_geocode($address){
    $address = urlencode($address);
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}&sensor=true";
    $resp_json = file_get_contents($url);
    $resp = json_decode($resp_json, true);
    if($resp['status']=='OK'){
        $data_arr = array();
        $data_arr['latitude'] = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : '';
        $data_arr['longitude'] = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : '';
        $data_arr['formatted_address'] = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : '';

        if(!empty($data_arr) && !empty($data_arr['latitude']) && !empty($data_arr['longitude'])){
            return $data_arr;

        }else{
            return "abc";
        }

    }else{
        return $resp['status'];
    }
}
?>
