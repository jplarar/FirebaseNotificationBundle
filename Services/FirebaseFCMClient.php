<?php

namespace JP\FirebaseNotificationBundle\Services;

/**
 * Class FirebaseFCMClient
 * @package JP\FirebaseNotificationBundle\Services
 */
class FirebaseFCMClient
{
    protected $server_key;
    protected $message;

    const FCM_URL = "https://fcm.googleapis.com/fcm/send";

    /**
     * FirebaseFCMClient constructor.
     * @param $server_key
     */
    public function __construct($server_key)
    {
        $this->server_key = $server_key;
    }

    /**
     * @param $message
     * @return bool
     */
    public function createMessage($message)
    {
        if (!array_key_exists("to", $message)) return false;
        $this->message["to"] = $message["to"];
        if (array_key_exists("title", $message)) {
            $this->message["notification"]["title"] = $message["title"];
        }
        if (array_key_exists("body", $message)) {
            $this->message["notification"]["body"] = $message["body"];
        }
        if (array_key_exists("badge", $message)) {
            $this->message["notification"]["badge"] = $message["badge"];
        }
        if (array_key_exists("data", $message)) {
            $this->message["data"] = $message["data"];
        }
        return true;
    }

    /**
     * @return mixed
     */
    public function sendMessage()
    {
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

    /**
     * @param $message
     * @return bool
     */
    public function createTopicMessage($message)
    {
        if (!array_key_exists("topic", $message)) return false;
        $this->message["topic"] = $message["topic"];
        if (array_key_exists("title", $message)) {
            $this->message["notification"]["title"] = $message["title"];
        }
        if (array_key_exists("body", $message)) {
            $this->message["notification"]["body"] = $message["body"];
        }
        if (array_key_exists("badge", $message)) {
            $this->message["notification"]["badge"] = $message["badge"];
        }
        if (array_key_exists("data", $message)) {
            $this->message["data"] = $message["data"];
        }
        return true;
    }


    public function deleteMessage()
    {
        $this->message = [];
    }

}