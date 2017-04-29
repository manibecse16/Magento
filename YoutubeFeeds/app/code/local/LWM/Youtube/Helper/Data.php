<?php
class LWM_Youtube_Helper_Data extends Mage_Core_Helper_Abstract
{
	
	public function getTokenKey()
    {
		$username = Mage::getStoreConfig('lwmyoutubesetting/general/username');
		$key = Mage::getStoreConfig('lwmyoutubesetting/general/api_key');
	    $url = "https://www.googleapis.com/youtube/v3/channels?part=contentDetails&forUsername=".$username."&key=".$key;
		$curl = curl_init( $url );

		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $curl, CURLOPT_HEADER, 0 );
		curl_setopt( $curl, CURLOPT_USERAGENT, '' );
		curl_setopt( $curl, CURLOPT_TIMEOUT, 10 );

		$response = curl_exec( $curl );
		if( 0 !== curl_errno( $curl ) || 200 !== curl_getinfo( $curl, CURLINFO_HTTP_CODE ) ) {
			$response = null;
		} // end if
		curl_close( $curl );

		// return $response;
		return json_decode($response);
	}
	public function getVideos($pageToken)
    {
		$channel_id = Mage::getStoreConfig('lwmyoutubesetting/general/channel');
		$key = Mage::getStoreConfig('lwmyoutubesetting/general/api_key');
	   	$url = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=".$channel_id."&order=date&maxResults=6&key=".$key."&pageToken=".$pageToken;
	   	$curl = curl_init( $url );

		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $curl, CURLOPT_HEADER, 0 );
		curl_setopt( $curl, CURLOPT_USERAGENT, '' );
		curl_setopt( $curl, CURLOPT_TIMEOUT, 10 );

		$response = curl_exec( $curl );
		if( 0 !== curl_errno( $curl ) || 200 !== curl_getinfo( $curl, CURLINFO_HTTP_CODE ) ) {
			$response = null;
		} // end if
		curl_close( $curl );

		// return $response;
		$val = json_decode($response);
		$data = array();
		$data['nextPageToken'] = $val->nextPageToken;
		$data['prevPageToken'] = $val->prevPageToken;
		foreach ($val as $key => $value) {
			if(is_array($value))
			{
				$data['items'] = $value;
			}else
			{
				$data['totalResults'] = $value->totalResults;
			}
		}
		return $data;
	}
}
	 