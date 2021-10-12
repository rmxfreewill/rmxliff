

<?php
ini_set('memory_limit', '-1');

//ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
session_start();
include_once("define_Gobal.php");


function updateRegisterFlag($CompanyUrl,$userId,$CompanyId,$sUserName,$sEMail,$sMobileNo){    
    $Command="call sp_main_request_register ('".$userId."','".$CompanyId
        ."','".$sUserName."','".$sEMail."','".$sMobileNo."')";
    $curl_data = "Command=".$Command;
    $response = post_web_content($CompanyUrl,$curl_data);

    return $response;
}


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

    if ($err) {
        $datasReturn['result'] = 'E';
        $datasReturn['message'] = $err;
    } else {
        if($response == "{}"){
             $datasReturn['result'] = 'S';
            $datasReturn['message'] = 'Success';
        }else{
            $datasReturn['result'] = 'E';
            $datasReturn['message'] = $response;
        }
    }

    return $datasReturn;
}

function sentMultiMessage($encodeJson,$Url,$Token)
{

    $datas['url'] = $Url;
    $datas['token'] = $Token;

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

    if ($err) {
        $datasReturn['result'] = 'E';
        $datasReturn['message'] = $err;
    } else {
        if($response == "{}"){
             $datasReturn['result'] = 'S';
            $datasReturn['message'] = 'Success';
        }else{
            $datasReturn['result'] = 'E';
            $datasReturn['message'] = $response;
        }
    }

    return $datasReturn;
}


function sentLineMessage($encodeJson,$Url,$Token)
{

    $datas['url'] = $Url;
    $datas['token'] = $Token;

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

    if ($err) {
        $datasReturn['result'] = 'E';
        $datasReturn['message'] = $err;
    } else {
        if($response == "{}"){
             $datasReturn['result'] = 'S';
            $datasReturn['message'] = 'Success';
        }else{
            $datasReturn['result'] = 'E';
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

function line_multicast($url,$CompanyToken,$userId,$msg){

    $LINEDatas['url'] = $url;
    $LINEDatas['token'] = $CompanyToken;

    //$msg = "push message \n[" . $userId."]";
    $messages = [];
    $messages['to'][0] = $userId;
    $messages['messages'][0] = getFormatTextMessage($msg);
    
    $encodeJson = json_encode($messages);
    $results = sentMessage($encodeJson,$LINEDatas);
}




function put_request($CompanyUrl,$userId,$CompanyId,$text,$datas){

    $Command="call sp_comp_insert_user_resquest ('".$userId."','".$CompanyId."','".$text."','".$datas."')";
    $curl_data = "LineId=".$userId."&CompanyCode=".$CompanyId."&Command=".$Command;    

    $response = post_web_page($CompanyUrl,$curl_data);

}




   /*
        $Command="call sp_main_check_register ('".$userId."','".$CompanyId."')";
        $curl_data = "Command=".$Command;
        $response = post_web_content($CompanyUrl,$curl_data);

        $response = trim($response);
        $asRet = explode("^c", $response);
        if (count($asRet) >=4){
            $nFlg = $asRet[1];
            $sMMsg = $asRet[0];
            if ($nFlg =="-1"){

                $msg = $sMMsg;
                line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);

                updateRegisterFlag($CompanyUrl,$userId,$CompanyId,"","","");
            } else  if ($nFlg =="0"){
                if (!preg_match("/^[a-zA-Z-' ]*$/",$text)) {
                    $msg = "Only letters and white space allowed (".$text.")";
                    line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);
                } else {                
                    $msg = $sMMsg;
                    line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);
                    updateRegisterFlag($CompanyUrl,$userId,$CompanyId,$text,"","");
                }
            } else  if ($nFlg =="1"){

                if (!filter_var($text, FILTER_VALIDATE_EMAIL)) {
                    $msg = "Invalid email format (".$text.")";
                    line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);
                } else {                

                    $sUserName = $asRet[2];
                    $sEMail = $asRet[3];
                    $sMobileNo = $asRet[4];

                    $msg = $sMMsg;
                    line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);
                    updateRegisterFlag($CompanyUrl,$userId,$CompanyId,$sUserName,$text,"");
                }

            } else  if ($nFlg =="2"){

                if (!preg_match('/^[0-9]{10}+$/',$text)) {
                    $msg = "Invalid mobile format (".$text.")";
                    line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);
                } else {
                    $sUserName = $asRet[2];
                    $sEMail = $asRet[3];
                    $sMobileNo = $asRet[4];

                    $msg = $sMMsg;
                    line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);
                    updateRegisterFlag($CompanyUrl,$userId,$CompanyId,$sUserName,$sEMail,$text);
                }
            } else  if ($nFlg =="3"){
                $sUserName = $asRet[2];
                $sEMail = $asRet[3];
                $sMobileNo = $asRet[4];

                $msg = $sMMsg;
                line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);
                updateRegisterFlag($CompanyUrl,$userId,$CompanyId,$sUserName,$sEMail,$sMobileNo);
            } else {
                $sUserName = $asRet[2];
                $msg = "สวัสดีครับคุณ" . $sUserName ."\n"
                    ." ข้อความที่ส่งมา จะถูกส่งต่อให้ Admin \n\n '".$text."'";
                line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);
            }
        }
        */

?>
