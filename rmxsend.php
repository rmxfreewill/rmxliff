

<?php
/* 
https://rmxline.herokuapp.com/?link=https://api.line.me/v2/bot/message/reply&token=m5ukw4jmYNNVqyIdVyXGQc1qdKqJSFxVCPpxfQRvYvRLXhn2+JvY+0uLU1inncWInYmDka3KYqBH/i3zfFq3oNHIAUnO7DXYu+3iIbzWp0eft69ZrxVv6qEDblNHVhlCRAWX6/Gkm//7h8yY0kX7XwdB04t89/1O/w1cDnyilFU=
&value={"replyToken":"nHuyWiB7yP5Zw52FIkcQobQuGDXCTA","messages":[{"type":"text","text":"Hello, user"},{"type":"text","text":"May I help you?"}]}

https://rmxline.herokuapp.com/?link=https://api.line.me/v2/bot/message/quota/consumption
https://api.line.me/v2/bot/message/delivery/reply?date={yyyyMMdd}
https://api.line.me/v2/bot/message/delivery/reply?date=20210915


https://rmxline.herokuapp.com/linePush.php

https://rmxline.herokuapp.com/?link=https://api.line.me/v2/bot/message/push&value={"to":"@728ohvhl","messages":[{"type":"text","text":"Hello, user"},{"type":"text","text":"May I help you?"}]}



https://rmxline.herokuapp.com/index.php?msg=test for push msg&userId=Ucd102187a2dfb7494ea9d723a5ae4041&type=push

https://rmxline.herokuapp.com/rmxsend.php?msg=test%20tetst%20test%20&userId=Ucd102187a2dfb7494ea9d723a5ae4041&type=push

https://rmxline.herokuapp.com/index.php?msg=test for push msg&userId=Ucd102187a2dfb7494ea9d723a5ae4041&type=push

https://rmxline.herokuapp.com/rmxsend.php?msg=123456789 test &userId=Ucd102187a2dfb7494ea9d723a5ae4041&type=push
*/
    ini_set('max_input_time','500');
    ini_set('max_execution_time','500'); 
    set_time_limit(300); 
    include_once("define_Gobal.php");




    $CompanyUrl = COMPANY_URL;
    $RegisterUrl = REGISTER_URL;
    $CompanyId = COMPANY_CODE;
    $LiffId = LIFF_ID;
    $CompanyToken = TOKEN_ID;
  
    $UrlReply= LINE_REPLY;
    $UrlMulticast= LINE_MULTICAST;
    $UrlPush= LINE_PUSH;
  
    // $CompanyToken = "m5ukw4jmYNNVqyIdVyXGQc1qdKqJSFxVCPpxfQRvYvRLXhn2+JvY+0uLU1inncWInYmDka3KYqBH/i3zfFq3oNHIAUnO7DXYu+3iIbzWp0eft69ZrxVv6qEDblNHVhlCRAWX6/Gkm//7h8yY0kX7XwdB04t89/1O/w1cDnyilFU=";
    
   // $CompanyId = "00001";
    //$CompanyUrl = "https://rmx.freewillsolutions.com/rmxline/rmxLineCmd.php";
    //$UrlReply= "https://api.line.me/v2/bot/message/reply";
    //$UrlMulticast= "https://api.line.me/v2/bot/message/multicast";
    //$UrlPush= "https://api.line.me/v2/bot/message/push";

    $sendMsg='';
    if (isset($_GET['msg'])) {
        $sendmsg =$_GET['msg'];
    }


   // $sendUserId='Ucd102187a2dfb7494ea9d723a5ae4041';
    $sendUserId='';
    if (isset($_GET['userId'])) {
        $sendUserId =$_GET['userId'];
    //} else {
      //  $sendUserId='Ucd102187a2dfb7494ea9d723a5ae4041';
    }


    $type='push';
    if (isset($_GET['type'])) {
        $type =$_GET['type'];
    }

    /*
        print_r ($sendUserId.','.$sendmsg);
        echo "\n\n";
        echo "\n\n";
        echo urlencode($CompanyToken);
        echo "\n\n";
    */
    echo $UrlPush."\n\n";
    echo $CompanyToken."\n\n";        
    echo $sendUserId."\n\n";
    echo $sendmsg."\n\n";
    echo $type."\n\n";

    if ($sendUserId != '') {
        //line_multicast($UrlMulticast,$CompanyToken,$sendUserId,$sendmsg);
        $ret = "";
        if ($type=='push') {
            $ret =line_push($UrlPush,$CompanyToken,$sendUserId,$sendmsg);
            put_send($CompanyUrl,$sendUserId,$CompanyId,$type,$sendmsg,implode(" ",$ret));

        } else {
            $ret =line_multicast($UrlMulticast,$CompanyToken,$sendUserId,$sendmsg);

            $asId = explode("^", $sendUserId);
            
            $sVal = implode(" ",$ret);
            foreach ($sId as $asId) {
                put_send($CompanyUrl,$sId,$CompanyId,$type,$sendmsg,$sVal);
            }

            
            //implode(" ",$arr);

        }
        
        echo "=========================\n\n";

        print_r ($ret);
        //echo $ret."\n\n";
       // http_response_code(200);

    }


/*================================================================*/


function getFormatTextMessage($text)
{
    $datas = [];
    $datas['type'] = 'text';
    $datas['text'] = $text;

    return $datas;
}

function sentMessage($encodeJson,$datas)
{
    $datasReturn = [];
    $curl = curl_init();
    curl_setopt_array($curl, array(
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

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

     if (isset($err)) {
        $datasReturn['result'] = 'E';
        $datasReturn['message'] = $err;
    } else {
        if($response == "{}"){
            $datasReturn['result'] = 'S';
            $datasReturn['message'] = 'Success';
        }else{
            $datasReturn['result'] = 'S';
            $datasReturn['message'] = $response;
        }
    }

    return $datasReturn;
}


function post_web_page( $url,$curl_data )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,         // return web page
        CURLOPT_HEADER         => false,        // don't return headers
        CURLOPT_FOLLOWLOCATION => true,         // follow redirects
        CURLOPT_ENCODING       => "",           // handle all encodings
        CURLOPT_USERAGENT      => "kai",     // who am i
        CURLOPT_AUTOREFERER    => true,         // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
        CURLOPT_TIMEOUT        => 120,          // timeout on response
        CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
        CURLOPT_POST            => 1,            // i am sending post data
           CURLOPT_POSTFIELDS     => $curl_data,    // this are my post vars
        CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
        CURLOPT_SSL_VERIFYPEER => false,        //
        CURLOPT_VERBOSE        => 1                //
    );

    $ch      = curl_init($url);
    curl_setopt_array($ch,$options);
    $content = curl_exec($ch);
    $err     = curl_errno($ch);
    $errmsg  = curl_error($ch) ;
    $header  = curl_getinfo($ch);
    curl_close($ch);

  //  $header['errno']   = $err;
  //  $header['errmsg']  = $errmsg;
  //  $header['content'] = $content;
    return $header;
}




function post_web_content( $url,$curl_data )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,         // return web page
        CURLOPT_HEADER         => false,        // don't return headers
        CURLOPT_FOLLOWLOCATION => true,         // follow redirects
        CURLOPT_ENCODING       => "",           // handle all encodings
        CURLOPT_USERAGENT      => "kai",     // who am i
        CURLOPT_AUTOREFERER    => true,         // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
        CURLOPT_TIMEOUT        => 120,          // timeout on response
        CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
        CURLOPT_POST            => 1,            // i am sending post data
           CURLOPT_POSTFIELDS     => $curl_data,    // this are my post vars
        CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
        CURLOPT_SSL_VERIFYPEER => false,        //
        CURLOPT_VERBOSE        => 1                //
    );

    $ch      = curl_init($url);
    curl_setopt_array($ch,$options);
    $content = curl_exec($ch);
    $err     = curl_errno($ch);
    $errmsg  = curl_error($ch) ;
    $header  = curl_getinfo($ch);
    curl_close($ch);

  //  $header['errno']   = $err;
  //  $header['errmsg']  = $errmsg;
  //  $header['content'] = $content;
  
    return trim($content);
}


function line_reply($url,$CompanyToken,$userId,$replyToken,$msg){
    //$msg = "ถามอะไรมาก็ตอบได้ UserId[" . $userId."] ".$text."[replay[".$replyToken."]]";
   
    $LINEDatas['url'] = $url;
    $LINEDatas['token'] = $CompanyToken;

    $messages = [];
    $messages['replyToken'] = $replyToken;
    $messages['messages'][0] = getFormatTextMessage($msg);

    $encodeJson = json_encode($messages);

    $results = sentMessage($encodeJson,$LINEDatas);
}


function line_push($url,$CompanyToken,$userId,$msg){

    $LINEDatas['url'] = $url;
    $LINEDatas['token'] = $CompanyToken;

    //$msg = "push message \n[" . $userId."]";
    $messages = [];
    $messages['to'] = $userId;
    $messages['messages'][0] = getFormatTextMessage($msg);
    
    $encodeJson = json_encode($messages);
    $results = sentMessage($encodeJson,$LINEDatas);

   // print_r ($results);
   // echo ($results);
    return $results;
}


function line_multicast($url,$CompanyToken,$userId,$msg){

    $LINEDatas['url'] = $url;
    $LINEDatas['token'] = $CompanyToken;

    //$msg = "push message \n[" . $userId."]";
    $messages = [];
    //"to": ["U4af4980629...","U0c229f96c4..."],

    $asId = explode("^", $userId);
    $messages['to'] = $asId;
    $messages['messages'][0] = getFormatTextMessage($msg);
    
    $encodeJson = json_encode($messages);
    $results = sentMessage($encodeJson,$LINEDatas);

    print_r ($results);
    return $results;
}


function put_request($CompanyUrl,$userId,$CompanyId,$text,$datas){

    $Command="call sp_comp_insert_user_resquest ('".$userId."','".$CompanyId."','".$text."','".$datas."')";
    $curl_data = "LineId=".$userId."&CompanyCode=".$CompanyId."&Command=".$Command;    

    $response = post_web_page($CompanyUrl,$curl_data);

}


function put_send($CompanyUrl,$userId,$CompanyId,$type,$datas,$sRet){


    $Command="call sp_comp_insert_line_send ('".$userId."','".$CompanyId."','".$type."','".$datas."','".$sRet."')";
    $curl_data = "LineId=".$userId."&CompanyCode=".$CompanyId."&Command=".$Command;    


    print_r ($curl_data);
    $response = post_web_page($CompanyUrl,$curl_data);

}

?>
