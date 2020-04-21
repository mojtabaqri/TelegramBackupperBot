<?php
const apiKey='1071516275:AAEeeXE2QrXSYdUJ3yi_ihGV7YfDh9mgulg';
const firstChannelId='-1001426712406';
const backupChannelId='-1001417747193';
$data=json_decode(file_get_contents("php://input"));
$json_data=json_encode($data);
file_put_contents('data.json', $json_data);
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot" . apiKey . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($datas));
    $res = curl_exec($ch);
    if (curl_error($ch))
    {
        var_dump(curl_error($ch));
    }
    else
    {
        return json_decode($res);
    }
}

 function forwardMessage($messageId)
{
    //https://api.telegram.org/bot1071516275:AAEeeXE2QrXSYdUJ3yi_ihGV7YfDh9mgulg/forwardMessage?chat_id=-1001417747193&from_chat_id=-1001426712406&message_id=521
    bot('forwardMessage',[
        'chat_id'=>backupChannelId,
        'from_chat_id'=>firstChannelId,
        'message_id'=>$messageId,
    ]);
}

function analyze($data){
$data=json_decode($data);
if($data->channel_post->chat->id==firstChannelId)
    forwardMessage($data->channel_post->message_id);
}
analyze($json_data);
?>