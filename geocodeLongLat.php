<?
/*
This PHP script takes in a longitude and latitude from
a GET request and outputs either a two letter ISO 3166-1 alpha-2
code, or 'None' if it cannot determine one or lacks the icon for the country.
*/

//Confirm that values were inputted.
if (!(array_key_exists('long', $_GET) && array_key_exists('lat', $_GET)))
	die();

$long = $_GET['long'];
$lat = $_GET['lat'];

//Confirm that values were valid.
if (!(is_numeric($long) && is_numeric($lat))) 
	die();

/*
If we try to send queries to google too quickly, we get an error,
but we should wait and try again until we succeed or ten tries go by.
*/
$counter = 0;
do{
	$retry = false;
	
	/*
	This line refers to Google Geocoder v3, which I have apparently gone over the
	usage limits for, because it will only return Over_Query_Limit
	If you uncomment the line below, you'll need to change all $address->Status to $address->status
	*/
	//$r = file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".floatval($lat)."," . floatval($long) . "&sensor=false");
	
	/*
	This line refers to a previous version of Google Geocoder
	I prefer v3 because it does a better job at recognizing Antarctic locations
	*/
	$r = file_get_contents("http://maps.google.com/maps/geo?output=json&q=".floatval($lat)."," . floatval($long) . "&sensor=false");
	$address = json_decode($r);
	if (($address->Status == "OVER_QUERY_LIMIT" || $address->Status->code == 620) && $counter < 10){
		//Wait one quarter of a second
		usleep(250000);
		$retry = true;
		$counter++;
	}
}while($retry);

//This code works for Google Geocoder APIv3
if ($address->Status == "OK"){
	try{
		//This assumes the first result is correct (that we only have one result)
		//Because this is a country-wide result, this shouldn't matter.
		foreach ($address->results[0]->address_components as $potential)
			if (in_array("country", $potential->types)){
				$country = $potential->short_name;
				break;
			}
		//Make sure we have an icon for this country.
		if (file_exists("png/" . $country . ".png"))
			echo $country;
		else
			echo "None";
	}catch(Exception $e){
		echo "None";
	}
	
//This code works for previous versions of Google Geocoder
}else if($address->Status->code == 200){
	//Geocoder v2 is nice because the CountryCode is in a consistent place
	if (property_exists($address->Placemark[0]->AddressDetails, "Country")){
		$country = $address->Placemark[0]->AddressDetails->Country->CountryNameCode;
		
		//Make sure we have an icon for this country.
		if (file_exists("png/" . $country . ".png"))
			echo $country;
		else
			echo "None";
	}else{
		echo "None";
	}
}else{
	echo "None";
}
?>