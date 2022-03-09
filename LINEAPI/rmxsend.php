

<?php
/*
https://rmx.freewillsolutions.com/LINEAPI/rmxsend.php?msg=123456789 test &userId=Ucd102187a2dfb7494ea9d723a5ae4041&type=push
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
    }

    $sendUserId='';
    if (isset($_GET['userId'])) {
        $sendUserId =$_GET['userId'];
    }


    $type='push';
    if (isset($_GET['type'])) {
        $type =$_GET['type'];
    }

   
    echo $UrlPush."\n\n";
    echo $CompanyToken."\n\n";        
    echo $sendUserId."\n\n";
    echo $sendmsg."\n\n";
    echo $type."\n\n";


    try {

        if ($sendUserId != '') {
            
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
            }
            
            echo "=========================\n\n";
            
           // print_r ($ret);
            //echo $ret."\n\n";
        // http_response_code(200);
        }
    }
    catch(Exception $e) {
        wh_error('rmxsend.php Exception: ' .$e->getMessage());
    
    }

    


/*================================================================*/



?>
