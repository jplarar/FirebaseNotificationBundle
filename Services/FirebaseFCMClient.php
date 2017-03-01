<?php

namespace JP\FirebaseNotificationBundle\Services;

class FirebaseFCMClient
{
    protected $server_key;
    protected $message;

    const FCM_URL = "https://fcm.googleapis.com/fcm/send";

    public function __construct($server_key)
    {
        $this->server_key = $server_key;
    }

    public function createMessage($message)
    {
        if (!in_array("to", $message)) return false;
        $this->message["to"] = $message["to"];

        if (in_array("title", $message)) {
            $this->message["notification"]["title"] = $message["title"];
        }

        if (in_array("body", $message)) {
            $this->message["notification"]["body"] = $message["body"];
        }

        if (in_array("badge", $message)) {
            $this->message["notification"]["badge"] = $message["badge"];
        }
        if (in_array("data", $message)) {
            $this->message["data"] = $message["data"];
        }

        return true;
    }

    public function sendMessage()
    {
        if ($this->message == null) return null;

        $content = json_encode($this->message);

        $curl = curl_init(self::FCM_URL);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "Content-type: application/json",
                "Authorization: key=".$this->server_key
            )
        );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ( $status != 200 ) {}

        curl_close($curl);
        $response = json_decode($json_response, true);

        return $response;
    }

}