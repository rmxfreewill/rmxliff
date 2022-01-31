<?php

function sendMessage($replyJson)
{
    $sendInfo['URL'] = "https://api.line.me/v2/bot/message/push";

    $sendInfo['AccessToken'] = "6DOzScAqBRwD/oRPwvMFua/SBvgLtXciCay4cwK10oTPA88R60mjeGdeW8NDL61dCJX2EtyHINFcj1DvY0mboZntH38a/fhTRI3rCaN4vDI/zWBCl0ze5K/AV2JoxoCwR9OZXj2Y7rHn6nABPwZMVwdB04t89/1O/w1cDnyilFU=";

    try {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $sendInfo['URL']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            $replyJson
        );
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $sendInfo["AccessToken"]
            )
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); # receive server response
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); # do not verify SSL
        $data = curl_exec($ch); # execute curl
        $httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); # http response status code
        curl_close($ch);

        $data = $data;
    } catch (Exception $ex) {
        $data = $ex;
    }
    return $data;
}

$LINEData = file_get_contents('php://input');
$jsonData = json_decode($LINEData, true);

$replyToken = $jsonData["events"][0]["replyToken"];
$replyUserId = $jsonData["events"][0]["source"]["userId"];
$MessageType = $jsonData["events"][0]["message"]["type"];
$MessageText = $jsonData["events"][0]["message"]["text"];

$postbackParams = $jsonData["events"][0]["postback"]["data"];
parse_str($postbackParams, $arr);
$ActionMenuText = $arr["action"];

$replyJson["to"] = $replyUserId;
$replyJson["replyToken"] = $replyToken;
// $replyJson["messages"][0] = ticketDetailFlexMessage();
$replyJson["messages"][0] = $jsonData;
$encodeJson = json_encode($replyJson);


$results = sendMessage($encodeJson);
echo $results;
http_response_code(200);
