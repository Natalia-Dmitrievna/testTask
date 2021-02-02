<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class IndexController extends Controller
{
	public function index(){

        //$this->getAuthToken(); //get token

        //create deal
		$recordObjectDeal = array();
		$recordObjectDeal["Deal_Name"]="testNew";
		$recordObjectDeal["Stage"]="Qualification";
		(new InsertRecords())->execute('Deals',$recordObjectDeal);


		//create task

		$recordObjectTask = array();
		$recordObjectTask["Subject"]="Call";
		$recordObjectTask['$se_module']="Deals";

		$recordObjectTask["What_Id"]="4748167000000313001";
		(new InsertRecords())->execute('Tasks',$recordObjectTask);
		
	}




	public function getAuthToken(){

		$postdata = http_build_query(
			array(
				'grant_type' => 'authorization_code',
				'client_id' => '1000.GOII36WI4IOHWXFN66N797Q1BC1FHB',
				'client_secret' => '646dc9bc88943fa199f8082efb322741dd765eb9dd',
				'redirect_uri' => 'https://test.com',
				'code' => '1000.e983c9129e7b9c7eb22470f05414d9b2.b535f0702be058bc96e74002fa0419a3'
			)
		);

		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('https://accounts.zoho.com/oauth/v2/token', false, $context);

		var_dump($result);
	}



	



}

class InsertRecords
{
	public function execute($apiName, $recordObject){
		$curl_pointer = curl_init();

		$curl_options = array();
		$url = "https://www.zohoapis.com/crm/v2/".$apiName;

		$curl_options[CURLOPT_URL] =$url;
		$curl_options[CURLOPT_RETURNTRANSFER] = true;
		$curl_options[CURLOPT_HEADER] = 1;
		$curl_options[CURLOPT_CUSTOMREQUEST] = "POST";
		$requestBody = array();
		$recordArray = array();





		$recordArray[] = $recordObject;
		$requestBody["data"] =$recordArray;
		$curl_options[CURLOPT_POSTFIELDS]= json_encode($requestBody);
		$headersArray = array();

		$headersArray[] = "Authorization". ":" . "Zoho-oauthtoken " . "1000.84d06acbb518448fadd53d7ed09991a5.1506df5ca0b6a2b416aeda6817eb9169";

		$curl_options[CURLOPT_HTTPHEADER]=$headersArray;

		curl_setopt_array($curl_pointer, $curl_options);

		$result = curl_exec($curl_pointer);
		$responseInfo = curl_getinfo($curl_pointer);
		curl_close($curl_pointer);
		list ($headers, $content) = explode("\r\n\r\n", $result, 2);
		if(strpos($headers," 100 Continue")!==false){
			list( $headers, $content) = explode( "\r\n\r\n", $content , 2);
		}
		$headerArray = (explode("\r\n", $headers, 50));
		$headerMap = array();
		foreach ($headerArray as $key) {
			if (strpos($key, ":") != false) {
				$firstHalf = substr($key, 0, strpos($key, ":"));
				$secondHalf = substr($key, strpos($key, ":") + 1);
				$headerMap[$firstHalf] = trim($secondHalf);
			}
		}
		$jsonResponse = json_decode($content, true);
		if ($jsonResponse == null && $responseInfo['http_code'] != 204) {
			list ($headers, $content) = explode("\r\n\r\n", $content, 2);
			$jsonResponse = json_decode($content, true);
		}
		var_dump($headerMap);
		var_dump($jsonResponse);
		var_dump($responseInfo['http_code']);

	}

}



