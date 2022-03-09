

<?php
/* 
https://rmxline.herokuapp.com/?link=https://api.line.me/v2/bot/message/reply&token=m5ukw4jmYNNVqyIdVyXGQc1qdKqJSFxVCPpxfQRvYvRLXhn2+JvY+0uLU1inncWInYmDka3KYqBH/i3zfFq3oNHIAUnO7DXYu+3iIbzWp0eft69ZrxVv6qEDblNHVhlCRAWX6/Gkm//7h8yY0kX7XwdB04t89/1O/w1cDnyilFU=
&value={"replyToken":"nHuyWiB7yP5Zw52FIkcQobQuGDXCTA","messages":[{"type":"text","text":"Hello, user"},{"type":"text","text":"May I help you?"}]}

https://rmxline.herokuapp.com/?link=https://api.line.me/v2/bot/message/quota/consumption
https://api.line.me/v2/bot/message/delivery/reply?date={yyyyMMdd}
https://api.line.me/v2/bot/message/delivery/reply?date=20210915

https://rmxline.herokuapp.com/linePush.php


https://rmx.freewillsolutions.com/LINEAPI/linePush.php
?msg=123456789 test &userId=Ucd102187a2dfb7494ea9d723a5ae4041&type=push

*/
    ini_set('max_input_time','500');
    ini_set('max_execution_time','500'); 
    set_time_limit(300); 
	error_reporting(E_ALL & ~E_NOTICE);

    include_once("define_Gobal.php");
    include_once("lineFunction.php");

    $CompanyUrl = COMPANY_URL;
    $RegisterUrl = REGISTER_URL;
    $CompanyId = COMPANY_CODE;
    $LiffId = LIFF_ID;
    $CompanyToken = TOKEN_ID;
  
    $UrlReply= LINE_REPLY;
    $UrlMulticast= LINE_MULTICAST;
    $UrlPush= LINE_PUSH;

    $sendUserId='Ucd102187a2dfb7494ea9d723a5ae4041';
    
    if (isset($_GET['userId'])) {
        $sendUserId =$_GET['userId'];
    } else {
        $sendUserId='Ucd102187a2dfb7494ea9d723a5ae4041';
    }
	/*
    $asData =["Test Namm","Sold To 9903333","Ship To 44fdfgfsdsd","Messsafe test"];
    ///$sRet = getChatMessage($asData);
	$sRet = getMenuMessage($asData);
    $jsonLink= '{"to":"Ucd102187a2dfb7494ea9d723a5ae4041",
      "messages":['.$sRet.']}';
  
    print_r ($jsonLink);
	*/
	
	$function='';
    if (isset($_GET['function'])) {
        $function =$_GET['function'];
    } 


    if ($function=='MENU'){
        $asData =["Test Namm","Sold To 9903333","Ship To 44fdfgfsdsd","Messsafe test"];    
        $sRet = getMenuMessage($asData);
        $jsonLink= '{"to":"'.$sendUserId.'","messages":['.$sRet.']}';  
        print_r ($jsonLink);

    } else {
        $asData =["Test Namm","Sold To 9903333","Ship To 44fdfgfsdsd","Messsafe test"];    
        $sRet = getChatMessage($asData);
        $jsonLink= '{"to":"Ucd102187a2dfb7494ea9d723a5ae4041","messages":['.$sRet.']}';  
        print_r ($jsonLink);
    }
	
    $decodedText = json_decode($jsonLink, true);
    $msg = json_encode($decodedText);    
   // print_r ($msg);

    echo line_pushMsg($UrlPush,$CompanyToken,$msg);

    
    /*------------------------------------------------------------------------------*/

    /*--------------------------------------------------------------------------*/


     

    function line_pushMsg($url,$CompanyToken,$encodeJson){

      $LINEDatas['url'] = $url;
      $LINEDatas['token'] = $CompanyToken;

      //print_r ($encodeJson);
    
      $results = sendMessageTest($encodeJson,$LINEDatas);
      return $results;
    
		//return "test";
    
    }


    
function sendMessageTest($encodeJson,$datas)
{
    $datasReturn = [];
    try {
        

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_URL => $datas['url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $encodeJson,
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".$datas['token'],
                "cache-control: no-cache",
                "content-type: application/json; charset=UTF-8",
            ),
        ));
        //wh_log('sendMessage: 2 =='.$datas['token']);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        
        if ($err) {
            $datasReturn['result'] = 'E';
            $datasReturn['message'] = $err;

            wh_log('-------------------------------------------');
            wh_log('sendMessage: 1)   '.$datas['token']);
            wh_log('sendMessage: 2)   '.$datas['url']);
            wh_log('sendMessage: 3)   '.$encodeJson);
            wh_log('sendMessage: Err) '.$err);
        } else {
            if($response == "{}"){
                $datasReturn['result'] = 'S';
                $datasReturn['message'] = 'Success';
            }else{
                $datasReturn['result'] = 'E';
                $datasReturn['message'] = $response;
            }
        }
		
		 print_r ($datasReturn);
		
		
    }
    catch(Exception $e) {
        wh_log('Exception: ' .$e->getMessage());
      
    }
    return $datasReturn;
}



    
?>
