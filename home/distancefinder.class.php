<?php
/**
 * Calculates distance between two given Addresses or given two pair of latitudes and longitudes
 *
 * @category Class
 * @package  PHPClasses
 * @author   Md. Tariqul Islam <tareq@webkutir.net>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://webkutir.net
 */
class distanceFinder
{
    private $_type = '';
    private $_mode = '';
    private $_unit = 'km';
    private $_from = '';
    private $_key = '';

    /**
     * Class Constructor
     * 
     * @param string $type It could be "Geographic", "Car Drive", "Walking", "Bicycle"
     * @param string $key  Google API Key
     * 
     * @return void
     */
    function __construct($type, $key="")
    {
        switch (strtolower($type)) {
        case "geographic":
            $this->_type = "Geographical";
            $this->_mode = '';
            break;
        case "car drive":
            $this->_type = "Driving";
            $this->_mode = "car";
            break;
        case "walking":
            $this->_type = "Driving";
            $this->_mode = "walking";
            break;
        case "bicycle":
            $this->_type = "Driving";
            $this->_mode = "bicycling";
            break;
        default:
            return false;
            break;
        }
        $this->_key = $key;
    }

    /**
     * Sets Distance Unit
     * It could be "KM", "Mile" or "All"
     * 
     * @param string $unit String of Result Unit Name
     * 
     * @return void
     */
    function setDistanceUnit($unit)
    {
        $this->_unit = strtolower($unit);
    }

    /**
     * Finds Distance between two Addresses or two pair of latitudes and longitudes
     * 
     * @param array | string $elm1 Address or an array of Latitude and Longitude
     * @param array | string $elm2 Address or an array of Latitude and Longitude
     *
     * @return array | string
     */
    function findDistance($elm1, $elm2)
    {
        if (is_array($elm1)) {
            $this->_from = "LatLng";
        } else {
            $this->_from = "Address";
        }

        $method = "_calculate".$this->_type."DistanceFrom".$this->_from;
        return $this->$method($elm1, $elm2);
    }

    /**
     * Calculates Driving Distance from Latitude and Longitude Pairs
     * 
     * @param array $pair1 Array of first Pair
     * @param array $pair2 Array of second Pair
     * 
     * @return string
     */
    private function _calculateDrivingDistanceFromLatLng($pair1, $pair2)
    {
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.urlencode("$pair1[0], $pair1[1]").'&sensor=false&language=en-En';
        if ($this->_key!='') {
            $url .= "&key=".$this->_key;
        }
        $result = @file_get_contents($url);
        $data = json_decode(utf8_encode($result), true);
        $address1 = $data['results'][0]['formatted_address'];

        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.urlencode("$pair2[0], $pair2[1]").'&sensor=false&language=en-En';
        if ($this->_key!='') {
            $url .= "&key=".$this->_key;
        }
        $result = @file_get_contents($url);
        $data = json_decode(utf8_encode($result), true);
        $address2 = $data['results'][0]['formatted_address'];

        return $this->_calculateDrivingDistanceFromAddress($address1, $address2);
    }

    /**
     * Calculates Driving Distance from Addresses
     * 
     * @param string $address1 First Address
     * @param string $address2 Second Address
     * 
     * @return string
     */
    private function _calculateDrivingDistanceFromAddress($address1, $address2)
    {
        $url  = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=".urlencode($address1);
        $url .= "&destinations=".urlencode($address2)."&mode=".$this->_mode."&language=en-EN&sensor=false";
        if ($this->_key!='') {
            $url .= "&key=".$this->_key;
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        $data = json_decode(utf8_encode($result), true);

        if (isset($data['rows'][0]['elements'][0]['distance']['text'])) {
            $kmText = $data['rows'][0]['elements'][0]['distance']['text'];
            $kmText = explode(" ", $kmText);
            $km = $kmText[0];

            if ($this->_unit == "all") {
                $miles = $km * 0.621371192;
                return array("KM" => round($km, 2), "Mile" => round($miles, 2));
            } elseif ($this->_unit == "mile") {
                $miles = $km * 0.621371192;
                return round($miles, 2);
            } else {
                return round($km, 2);
            }
        } else {
            return array("error"=>true, "msg"=>"Please check your provided Parameters.");
        }
    }

    /**
     * Calculates Geographical Distance from Latitude and Longitude Pairs
     * 
     * @param array $pair1 Array of first Pair
     * @param array $pair2 Array of second Pair
     * 
     * @return string
     */
    private function _calculateGeographicalDistanceFromLatLng($pair1, $pair2)
    {
        $pi80  = M_PI / 180;
        $pair1[0] *= $pi80;
        $pair1[1] *= $pi80;
        $pair2[0] *= $pi80;
        $pair2[1] *= $pi80;

        $r = 6372.797; // mean radius of Earth in km
        $dlat = $pair2[0] - $pair1[0];
        $dlng = $pair2[1] - $pair1[1];
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($pair1[0]) * cos($pair2[0]) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c / 1000;

        if ($this->_unit == "all") {
            $miles = $km * 0.621371192;
            return array("KM" => round($km, 2), "Mile" => round($miles, 2));
        } elseif ($this->_unit == "mile") {
            $miles = $km * 0.621371192;
            return round($miles, 2);
        } else {
            return round($km, 2);
        }
    }

    /**
     * Calculates Geographical Distance from Addresses
     * 
     * @param string $address1 First Address
     * @param string $address2 Second Address
     * 
     * @return string
     */
    private function _calculateGeographicalDistanceFromAddress($address1, $address2)
    {
        $url = "http://maps.google.com/maps/api/geocode/json?address=".urlencode($address1)."&sensor=false";
        if ($this->_key!='') {
            $url .= "&key=".$this->_key;
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        $data = json_decode(utf8_encode($result), true);
        try {
            $lat1 = $data['results'][0]['geometry']['location']['lat'];
            $lng1 = $data['results'][0]['geometry']['location']['lng'];
        } catch (Exception $ex) {
            return array("error"=>true, "msg"=>$data['error_message']);
        }

        $url = "http://maps.google.com/maps/api/geocode/json?address=".urlencode($address2)."&sensor=false";
        if ($this->_key!='') {
            $url .= "&key=".$this->_key;
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        $data = json_decode(utf8_encode($result), true);
        try {
            $lat2 = $data['results'][0]['geometry']['location']['lat'];
            $lng2 = $data['results'][0]['geometry']['location']['lng'];
        } catch (Exception $ex) {
            return array("error"=>true, "msg"=>$data['error_message']);
        }

        return $this->_calculateGeographicalDistanceFromLatLng(array($lat1, $lng1), array($lat2, $lng2));
    }
}