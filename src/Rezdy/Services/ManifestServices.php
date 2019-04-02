<?php
namespace Rezdy\Services;

use Rezdy\Util\Config;

use Rezdy\Requests\EmptyRequest;
use Rezdy\Requests\Manifest;

use Rezdy\Responses\ResponseStandard;
use Rezdy\Responses\ResponseNoData;

use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7;

/**
 * Performs all actions pertaining to booking Rezdy API Manifest Service Calls
 *
 * @package Services
 * @author Brad Ploeger
 */
class ManifestServices extends BaseService {

	public function checkInSession(Manifest $request) {
        $baseUrl = Config::get('endpoints.base_url') . Config::get('endpoints.manifest_check_in_session');
            
        // Verify the extra request has the minimum information required prior to submission.
        if ( !$request->isValid() ) return $request;     

        // try to Send the request
        try {  
            $response = parent::sendRequestWithoutBody('PUT', $baseUrl, $request->toArray());              
        } catch (TransferException $e) { 
            return $this->returnExceptionAsErrors($e, $request);         
        }    
        
        // Handle the Response
        return new ResponseNoData('Everyone in the Session has had their Check-in status updated');
    }

    public function findSessionCheckIn(Manifest $request) {
        $baseUrl = Config::get('endpoints.base_url') . Config::get('endpoints.manifest_check_in_status');
            
        // Verify the extra request has the minimum information required prior to submission.
        if ( !$request->isValid() ) return $request;     

        // try to Send the request
        try {  
            $response = parent::sendRequestWithoutBody('GET', $baseUrl, $request->toArray());              
        } catch (TransferException $e) { 
            return $this->returnExceptionAsErrors($e, $request);         
        }    
        
        // Handle the Response
        return new ResponseStandard($response->getBody(), 'checkin');
    }

    public function removeSessionCheckIn(Manifest $request) {
        $baseUrl = Config::get('endpoints.base_url') . Config::get('endpoints.manifest_remove_check_in');
            
        // Verify the extra request has the minimum information required prior to submission.
        if ( !$request->isValid() ) return $request;     

        // try to Send the request
        try {  
            $response = parent::sendRequestWithoutBody('DELETE', $baseUrl, $request->toArray());              
        } catch (TransferException $e) { 
            return $this->returnExceptionAsErrors($e, $request);         
        }    
        
        // Handle the Response
        return new ResponseNoData('Everyone in the Session has had their Check-in status updated');
    }

    public function checkInOrderItem(Manifest $request) {
        $baseUrl = Config::get('endpoints.base_url') . Config::get('endpoints.manifest_check_in_item');

        // Verify the extra request has the minimum information required prior to submission.
        if ( !$request->isValid() ) return $request;     

        // try to Send the request
        try {  
            $response = parent::sendRequestWithoutBody('PUT', $baseUrl, $request->toArray());              
        } catch (TransferException $e) { 
            return $this->returnExceptionAsErrors($manifest, $e);         
        }  

        // Handle the Response
        return new ResponseNoData('The Item has been checked');  
    }

    public function getOrderItemCheckIn(Manifest $manifest) {
        $baseUrl = Config::get('endpoints.base_url') . Config::get('endpoints.manifest_check_in_item');

        // Verify the extra request has the minimum information required prior to submission.
        if ( !$request->isValid() ) return $request;     

        // try to Send the request
        try {  
            $response = parent::sendRequestWithoutBody('GET', $baseUrl, $request->toArray());              
        } catch (TransferException $e) { 
            return $this->returnExceptionAsErrors($e, $request);         
        }

        // Handle the Response
        return new ResponseStandard($response->getBody(), 'checkin');    
    }

    public function removeOrderItemCheckIn(Manifest $request) {
        $baseUrl = Config::get('endpoints.base_url') . Config::get('endpoints.manifest_check_in_item');

        // Verify the extra request has the minimum information required prior to submission.
        if ( !$request->isValid() ) return $request;     

        // try to Send the request
        try {  
            $response = parent::sendRequestWithoutBody('DELETE', $baseUrl, $request->toArray());              
        } catch (TransferException $e) { 
            return $this->returnExceptionAsErrors($e, $request);         
        }

        // Handle the Response
        return new ResponseNoData('The items check-in status has been cleared');  
    }
}