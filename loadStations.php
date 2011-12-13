<?php 
/**
 * The following classes were generated from the WSDL using wsdl2php
 * (http://sourceforge.net/projects/wsdl2php/).
 */
 
//Code provided by http://sscweb.gsfc.nasa.gov/WebServices/
require_once 'SatelliteSituationCenterService.php';
	
	// SSC Web service endpoint URL
    $endpoint = "http://sscweb.gsfc.nasa.gov/WS/ssc/2/SatelliteSituationCenterService?WSDL";
                                       
	// Web service options
    $soapOptions = array("trace" => 1, 
            "user_agent" => "WsExample.php PHP-SOAP/" . phpversion());

	// the SSC Web service
	$ssc = new SatelliteSituationCenterService($endpoint, $soapOptions);
    $result = $ssc->getAllGroundStations(new getAllGroundStations());

	//Process each ground station
    //foreach ($result->return as $station) {
    //}
	//$output .= "}";
	echo json_encode($result->return);//$output;
?>
