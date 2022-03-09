

<?php

/*
https://rmx.freewillsolutions.com/LINEAPI/rmxnoti.php?userId=33333333&startDate=8/9/2017&endDate=8/9/2022
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



    //$sendUserId='Ucd102187a2dfb7494ea9d723a5ae4041';
    $sendUserId='';
    if (isset($_GET['userId'])) {
        $sendUserId =$_GET['userId'];
    }

    $startDate='';
    if (isset($_GET['startDate'])) {
        $startDate =$_GET['startDate'];
    }

    $endDate='';
    if (isset($_GET['endDate'])) {
        $endDate =$_GET['endDate'];
    }

    echo ("00");

    if ($sendUserId != '') {
        echo ("11");
        
        try {

            $retData = put_selectNoti($CompanyUrl,$CompanyId,$startDate,$endDate);
            echo ("START");
           // echo ($retData);
            if ($retData){         
                $sTicketNoList="";
                $asLineId = [];
                $asMsg = [];

                $oldSoldToCode = "";
                $asRow = explode("^r", $retData);
                $nRMax= count($asRow);

                
                for ($r=0;$r<$nRMax;$r++) {
                    $sRow = $asRow[$r];
                                        
                    $SoldToCode = "";
                    $asCol = explode("^c", $sRow);
                    if (count($asCol)>5){
                        $SoldToCode = $asCol[1];
                        $LineId = $asCol[0];
                        $TicketNo =$asCol[2];
                        if ($sTicketNoList !="") $sTicketNoList = $sTicketNoList.",";
                        $sTicketNoList = $sTicketNoList."\'".$TicketNo."\'";
                                            
                        $Msg =getTicketJSON($asCol);                                    
                        if ($oldSoldToCode == "") {
                            array_push($asLineId, $LineId);
                        } else {
                            if ($oldSoldToCode == $SoldToCode) {               
                                if (!in_array($LineId,$asLineId)) {                                    
                                    array_push($asLineId, $LineId);
                                }
                            } else {                               
                                sendToLineNoti($UrlPush,$UrlMulticast,$CompanyToken,$asLineId,$asMsg);
                                sleep(3);
                                $asLineId = [];                
                                $asMsg = [];
                                array_push($asLineId, $LineId);            
                            }
                        }
                        $oldSoldToCode=$SoldToCode;
                        array_push($asMsg,$Msg);

                    }

                }

                
                if (count($asMsg)>0){
                    sleep(3);
                    sendToLineNoti($UrlPush,$UrlMulticast,$CompanyToken,$asLineId,$asMsg);
                }

                
                if ($sTicketNoList !=""){
                    $Command="call sp_comp_update_ticket_noti ('".$sTicketNoList."')";
                    $curl_data = "LineId=LINEID&CompanyCode=".$CompanyId."&Command=".$Command;        
                
                    $response = post_web_content($CompanyUrl,$curl_data);
                }
                

            }

            echo ("END");

        }
        catch(Exception $e) {
            wh_error('Exception: ' .$e->getMessage());
        
        }
    }

    // Function
    function sendToLineNoti($UrlPush,$UrlMulticast,$CompanyToken,$asLineId,$asMsg) {
        $nRMax= count($asMsg);    
        $ret = "";

        if ($nRMax>5) {        
            $nLoop =0;
            $asSendMsg = [];

            for ($r=0;$r<$nRMax;$r++) {
                $sMsg = $asMsg[$r];
                array_push($asSendMsg, $sMsg);
                $nLoop++;
                if ($nLoop==5){
                    if (count($asLineId)===1) {
                        $ret =lineNoti_push($UrlPush,$CompanyToken,$asLineId[0],$asSendMsg);
                    } else {        
                        $ret =lineNoti_multicast($UrlMulticast,$CompanyToken,$asLineId,$asSendMsg);            
                    }
                    $nLoop =0;
                    $asSendMsg = [];
                }            
            }
            if (count($asSendMsg)>0){
                if (count($asLineId)===1) {
                    $ret =lineNoti_push($UrlPush,$CompanyToken,$asLineId[0],$asSendMsg);
                } else {        
                    $ret =lineNoti_multicast($UrlMulticast,$CompanyToken,$asLineId,$asSendMsg);            
                }
            }
            
        } else {
            if (count($asLineId)===1) {
                $ret =lineNoti_push($UrlPush,$CompanyToken,$asLineId[0],$asMsg);
            } else {

                $ret =lineNoti_multicast($UrlMulticast,$CompanyToken,$asLineId,$asMsg);            
            }
        }

    }

    function lineNoti_push($url,$CompanyToken,$userId,$asMsg){

        $LINEDatas['url'] = $url;
        $LINEDatas['token'] = $CompanyToken;

        //$jsonLink= '{"to":".$userId.",
        //    "messages":['.$sRet.','.$sRet2.','.$sRet3.','.$sRet4.','.$sRet5.']}';
        //print_r ($asMsg);
        $jsonLink= '';
        $nRMax= count($asMsg);
        for ($r=0;$r<$nRMax;$r++) {            
            $sMsg = $asMsg[$r];        
            if ($jsonLink != '') {$jsonLink = $jsonLink.',';}
            $jsonLink= $jsonLink .$sMsg;
        }       
        $jsonLink= '{"to":"'.$userId.'","messages":['.$jsonLink.']}';
        $decodedText = json_decode($jsonLink, true);
        $encodeJson = json_encode($decodedText);

        echo ("\n\n PUSH *****************************************************************************************\n\n");
        $results = sendMessage($encodeJson,$LINEDatas);
        print_r ($results);
        echo ("\n\n********************************************************************************************\n\n");

    // echo ($results);
        return $results;
    }


    function lineNoti_multicast($url,$CompanyToken,$asLineId,$asMsg){

        $LINEDatas['url'] = $url;
        $LINEDatas['token'] = $CompanyToken;

        $jsonLink= '';
        $nRMax= count($asMsg);
        for ($r=0;$r<$nRMax;$r++) {            
            $sMsg = $asMsg[$r];        
            if ($jsonLink != '') {$jsonLink = $jsonLink.',';}
            $jsonLink= $jsonLink .$sMsg;
        }
        //"to": ["U4af4980629...","U0c229f96c4..."],
        $userId = '';
        $nRMax= count($asLineId);

        for ($r=0;$r<$nRMax;$r++) {            
            $sId = $asLineId[$r];         
            if ($userId != '') $userId = $userId.',';        
            $userId= $userId .'"'.$sId.'"';
        }

        $jsonLink= '{"to":['.$userId.'],"messages":['.$jsonLink.']}';

        $decodedText = json_decode($jsonLink, true);
        $encodeJson = json_encode($decodedText);

        echo ("\n\n MULTI ================================================================\n\n");        
        $results = sendMessage($encodeJson,$LINEDatas);        
        print_r ($results);
        echo ("\n\n*******************************************************************************************\n\n");

        return $results;
    }


    function put_selectNoti($CompanyUrl,$CompanyId,$startDate,$endDate){

        //call sp_comp_send_ticket_noti('','8/10/2017','8/9/2018');
        $Command="call sp_comp_send_ticket_noti ('','".$startDate."','".$endDate."')";
        $curl_data = "LineId=LINEID&CompanyCode=".$CompanyId."&Command=".$Command;        

        wh_log('put_selectNoti:'.$curl_data);
        $response = post_web_content($CompanyUrl,$curl_data);
        wh_log('put_selectNoti:'.$response);
        return $response;
        //print_r ($response);

    }

    

   

    /*================================================================*/


?>
