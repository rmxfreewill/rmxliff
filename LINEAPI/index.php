

<?php

/*
https://rmx.freewillsolutions.com/LINEAPI/index.php
*/

    error_reporting(E_ALL & ~E_NOTICE);

    ini_set('max_input_time','500');
    ini_set('max_execution_time','500'); 
    set_time_limit(300); 

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


    $sendMsg='';
    if (isset($_GET['msg'])) {
        $sendmsg =$_GET['msg'];
    } else {
        $sendmsg='';
    }


    //$sendUserId='Ucd102187a2dfb7494ea9d723a5ae4041';
    $sendUserId='';
    if (isset($_GET['userId'])) {
        $sendUserId =$_GET['userId'];
    }


    $type='push';
    if (isset($_GET['type'])) {
        $type =$_GET['type'];
    }



    //wh_log('index.php: '.'-------------------------------------------');
    /*Get Data From POST Http Request*/
    $datas = file_get_contents('php://input');
    if ($datas) {
        
        //wh_log('index.php: '.$datas);
       
        $deCode = json_decode($datas,true);

        $replyToken = $deCode['events'][0]['replyToken'];
        $userId = $deCode['events'][0]['source']['userId'];
        $text = $deCode['events'][0]['message']['text'];

        /*=================================================================*/

        if ($text === "®Register"){
            $msg = "text (".$response.")(".$text.")";
            line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);
        
        } else {        
            if(!empty($text)){   

                if($text ==="@mobile"){   
                    sendAtCommand($userId,$CompanyId,$CompanyUrl,$UrlReply
                        ,$CompanyToken,$replyToken,$text);

                } else {
               
                    if(substr($text,6) ==="®query"){   
                        sendAtCommand($userId,$CompanyId,$CompanyUrl,$UrlReply
                        ,$CompanyToken,$replyToken,$text);
                    } else if ($text ==="®lastticket"){   
                                           
                        $Command = "call sp_comp_select_last('".$userId."','TICKET')";
                        $sRet = send_command($CompanyUrl,$userId,$CompanyId,$Command);
                        
                        $asData = explode("^c", $sRet);
                        if (count($asData) >=1){                                                      							
							$sRet = getTicketMessage($asData);							
							sendLineMessage($UrlPush,$CompanyToken,$userId,$sRet);
                        } else {
                            $sRet = getDisplayMessage("Not Found Data");
                            sendLineMessage($UrlPush,$CompanyToken,$userId,$sRet);     
                        }
					
                        
                    } else if ($text ==="®lastorder"){   
                        $Command = "call sp_comp_select_last('".$userId."','ORDER')";
                        $sRet = send_command($CompanyUrl,$userId,$CompanyId,$Command);
                        
                        $asData = explode("^c", $sRet);
                        if (count($asData) >=1){                         
							$sRet = getOrderMessage($asData);
							//wh_log('index.php: '.$sRet);
							sendLineMessage($UrlPush,$CompanyToken,$userId,$sRet);                               
                        } else {
                            $sRet = getDisplayMessage("Not Found Data");
                            sendLineMessage($UrlPush,$CompanyToken,$userId,$sRet);     
                        }

                    } else if ($text ==="®viewuser"){   

                        $asTitle =["User Id","Company Code","Liff Id","Token"];
                        $asData =[$userId,$CompanyId,$LiffId,$CompanyToken];
                        $sRet =getArrayColMessage($asTitle,$asData);             
						//wh_log('index.php: '.$sRet);						
                        sendLineMessage($UrlPush,$CompanyToken,$userId,$sRet);     
                    } else {
                        
                        checkUserRegister($userId,$CompanyId,$CompanyUrl,$UrlReply
                            ,$CompanyToken,$replyToken,$text);     
                        
                        put_request($CompanyUrl,$userId,$CompanyId,$text,$datas);
                    }
                }
            } 
            
        }

        http_response_code(200);
    } else {

        if ($sendMsg != "") {
            print_r ($sendUserId.','.$sendmsg);
            echo "\n\n";
            echo "\n\n";
            echo urlencode($CompanyToken);
            echo "\n\n";
        
            //line_multicast($UrlMulticast,$CompanyToken,$sendUserId,$sendmsg);
            if ($type=='push')
                line_push($UrlPush,$CompanyToken,$sendUserId,$sendmsg);
            else
                line_multicast($UrlMulticast,$CompanyToken,$sendUserId,$sendmsg);


            http_response_code(200);
        }
    }



    function checkUserRegister($userId,$CompanyId,$CompanyUrl,$UrlReply
        ,$CompanyToken,$replyToken,$text){


        $Command="call sp_main_check_register ('".$userId."','".$CompanyId."')";
        $curl_data = "Command=".$Command;

        $response = post_web_content($CompanyUrl,$curl_data);

        $asRet = explode("^c", $response);
        if (count($asRet) >=4){
            $nFlg = $asRet[1];
            $sMMsg = $asRet[0];
            $sSoldToName=$asRet[6];
            $sShipToName=$asRet[8];
        
            if ($nFlg =="3" || $nFlg =="4"  || $nFlg =="5"){
                
                    
                    $sUserName = $asRet[2];
                    $msg = "สวัสดีครับคุณ " . $sUserName ."\n"
                        ." (".$sSoldToName."-".$sShipToName.") \n"
                        ." ข้อความที่ส่งมาจะถูกส่งต่อให้ Admin ของ ".$sSoldToName." \n\n '".$text."'";

                    line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);


                   
                
            } else {
                $sUserName = $asRet[2];
                $msg = 'ยังไม่ได้ลงทะเบียน กรุณาลงทะเบียน ก่อนการส่งข้อความครับ';
                line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);
            }
        }
        return "";
    }


    function sendAtCommand($userId,$CompanyId,$CompanyUrl,$UrlReply
        ,$CompanyToken,$replyToken,$text){

        $asAr = explode('^', $text);
        $sT ="";
        $sC ="";
        $sT =$asAr[0];
        if (count($asAr)===2){        
            $sC =$asAr[1];    
        }

        $Command="call sp_main_atcommand ('".$CompanyId."','".$sT."','".$sC."')";
        $curl_data = "Command=".$Command;
        $response = post_web_content($CompanyUrl,$curl_data);
        
        $asRow = explode("^r", $response);
        if (count($asRow) >=1){

            $msg = str_replace("^r", "\n", $response);
            $msg = str_replace("^c", "\t", $msg);
            line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);
        } else {
            $msg = $response;       
            line_reply($UrlReply,$CompanyToken,$userId,$replyToken,$msg);
        }
        return "";
    }

    
    function sendLineMessage($UrlPush,$CompanyToken,$userId,$sRet){
        $jsonLink= '{"to":"'.$userId.'","messages":['.$sRet.']}';  
        $decodedText = json_decode($jsonLink, true);
        $msg = json_encode($decodedText);    
        line_pushMsg($UrlPush,$CompanyToken,$msg);
    }

/*================================================================*/

    function line_pushMsg($url,$CompanyToken,$encodeJson){

        $LINEDatas['url'] = $url;
        $LINEDatas['token'] = $CompanyToken;

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

               //wh_log('-------------------------------------------');
                wh_error('sendMessage: 1)   '.$datas['token']);
                wh_error('sendMessage: 2)   '.$datas['url']);
                wh_error('sendMessage: 3)   '.$encodeJson);
                wh_error('sendMessage: Err) '.$err);
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


/*================================================================*/

?>
