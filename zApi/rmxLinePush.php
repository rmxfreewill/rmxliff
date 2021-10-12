

<?php
/* 
https://rmxline.herokuapp.com/?link=https://api.line.me/v2/bot/message/reply&token=m5ukw4jmYNNVqyIdVyXGQc1qdKqJSFxVCPpxfQRvYvRLXhn2+JvY+0uLU1inncWInYmDka3KYqBH/i3zfFq3oNHIAUnO7DXYu+3iIbzWp0eft69ZrxVv6qEDblNHVhlCRAWX6/Gkm//7h8yY0kX7XwdB04t89/1O/w1cDnyilFU=
&value={"replyToken":"nHuyWiB7yP5Zw52FIkcQobQuGDXCTA","messages":[{"type":"text","text":"Hello, user"},{"type":"text","text":"May I help you?"}]}

https://rmxline.herokuapp.com/?link=https://api.line.me/v2/bot/message/quota/consumption
https://api.line.me/v2/bot/message/delivery/reply?date={yyyyMMdd}
https://api.line.me/v2/bot/message/delivery/reply?date=20210915


https://rmxline.herokuapp.com/linePush.php

https://rmxline.herokuapp.com/?link=https://api.line.me/v2/bot/message/push&value={"to":"@728ohvhl","messages":[{"type":"text","text":"Hello, user"},{"type":"text","text":"May I help you?"}]}


*/
    ini_set('max_input_time','500');
    ini_set('max_execution_time','500'); 
    error_reporting(E_ALL & ~E_NOTICE);
    set_time_limit(300); 

    include_once ("rmxLineFunction.php");


    $CompanyToken = "m5ukw4jmYNNVqyIdVyXGQc1qdKqJSFxVCPpxfQRvYvRLXhn2+JvY+0uLU1inncWInYmDka3KYqBH/i3zfFq3oNHIAUnO7DXYu+3iIbzWp0eft69ZrxVv6qEDblNHVhlCRAWX6/Gkm//7h8yY0kX7XwdB04t89/1O/w1cDnyilFU=";
    $CompanyId = "00001";        
    $UrlMulticast= "https://api.line.me/v2/bot/message/multicast";

    
    $userId1 = "Ucd102187a2dfb7494ea9d723a5ae4041";
    $userId2 = "Udec130bc9006e11217378370fc75436c";
    $asId = array($userId1,$userId1);

    $LINEDatas['url'] = $UrlMulticast;
    $LINEDatas['token'] = $CompanyToken;

 /*888888888888888888888888888888888888888888888888888888*/

    //echo "\nTest";
    $msg = "push message Test for all " .date('Y-m-d H:i:s');
    $messages = [];
    $messages['to'] = array($userId1,$userId2);
    $messages['messages'][0] = getFormatTextMessage($msg);
    $encodeJson = json_encode($messages);
    
    $results =sentMultiMessage($encodeJson,$UrlMulticast,$CompanyToken);    
    echo $results['result']."(".$results['message'].")\n";

  /*888888888888888888888888888888888888888888888888888888*/

    $msg = "push message Test to (".$userId1.") " .date('Y-m-d H:i:s');
    $messages = [];
    $messages['to'][0] = $userId1;
    $messages['messages'][0] = getFormatTextMessage($msg);
    $encodeJson = json_encode($messages);
    
    $results =sentMultiMessage($encodeJson,$UrlMulticast,$CompanyToken);    
    echo $results['result']."(".$results['message'].") \n";

    /*888888888888888888888888888888888888888888888888888888*/

    $liffId ='1656443389-VDWg8mJ3';

    $datas = [];
    $datas['type'] = 'full';
    $datas['url'] = 'https://liff.line.me/1656443389-VDWg8mJ3';

    $url= "https://api.line.me/liff/v1/apps";

    //$msg = "push message Test to (".$userId1.") " .date('Y-m-d H:i:s');
    $messages = [];
    $messages['view'][0] = $datas;
    $encodeJson = json_encode($messages);
    
    $results =sentMultiMessage($encodeJson,$url,$CompanyToken);       
    echo $results['result']."(".$results['message'].") \n";

    

/*
curl -X POST https://api.line.me/liff/v1/apps \
-H "Authorization: Bearer YOUR_CHANNEL_ACCESS_TOKEN" \
-H "Content-Type: application/json" \
-d '{
  "view":{
    "type":"LIFF_SITE",
    "url":"YOUR_APP_URL"
  }
}'
*/

?>
