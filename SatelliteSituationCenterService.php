<?php
/**
 * SatelliteSituationCenterService class file
 * 
 * @author    {author}
 * @copyright {copyright}
 * @package   {package}
 */

/**
 * getAllGroundStations class
 */
require_once 'getAllGroundStations.php';

/**
 * SatelliteSituationCenterService class
 * 
 *  
 * 
 * @author    {author}
 * @copyright {copyright}
 * @package   {package}
 */
class SatelliteSituationCenterService extends SoapClient {

  public function SatelliteSituationCenterService($wsdl = "SatelliteSituationCenterService.wsdl", $options = array()) {
    parent::__construct($wsdl, $options);
  }

  /**
   *  
   *
   * @param getData $parameters
   * @return getDataResponse
   */
  public function getData(getData $parameters) {
    return $this->__call('getData', array(
            new SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://ssc.spdf.gsfc.nasa.gov/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getAllSatellites $parameters
   * @return getAllSatellitesResponse
   */
  public function getAllSatellites(getAllSatellites $parameters) {
    return $this->__call('getAllSatellites', array(
            new SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://ssc.spdf.gsfc.nasa.gov/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getGraphs $parameters
   * @return getGraphsResponse
   */
  public function getGraphs(getGraphs $parameters) {
    return $this->__call('getGraphs', array(
            new SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://ssc.spdf.gsfc.nasa.gov/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getPrivacyAndImportantNotices $parameters
   * @return getPrivacyAndImportantNoticesResponse
   */
  public function getPrivacyAndImportantNotices(getPrivacyAndImportantNotices $parameters) {
    return $this->__call('getPrivacyAndImportantNotices', array(
            new SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://ssc.spdf.gsfc.nasa.gov/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getAcknowledgements $parameters
   * @return getAcknowledgementsResponse
   */
  public function getAcknowledgements(getAcknowledgements $parameters) {
    return $this->__call('getAcknowledgements', array(
            new SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://ssc.spdf.gsfc.nasa.gov/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getAllSpaseObservatories $parameters
   * @return getAllSpaseObservatoriesResponse
   */
  public function getAllSpaseObservatories(getAllSpaseObservatories $parameters) {
    return $this->__call('getAllSpaseObservatories', array(
            new SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://ssc.spdf.gsfc.nasa.gov/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getAllGroundStations $parameters
   * @return getAllGroundStationsResponse
   */
  public function getAllGroundStations(getAllGroundStations $parameters) {
    return $this->__call('getAllGroundStations', array(
            new SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://ssc.spdf.gsfc.nasa.gov/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getDataFiles $parameters
   * @return getDataFilesResponse
   */
  public function getDataFiles(getDataFiles $parameters) {
    return $this->__call('getDataFiles', array(
            new SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://ssc.spdf.gsfc.nasa.gov/',
            'soapaction' => ''
           )
      );
  }

}

?>
