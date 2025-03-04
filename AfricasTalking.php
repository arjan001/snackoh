<?php

class AfricasTalkingSMS {
    private $username;
    private $apiKey;
    private $url = "https://api.sandbox.africastalking.com/version1/messaging";

    private $logFile = "sms_log.txt";

    public function __construct($username, $apiKey) {
        $this->username = $username;
        $this->apiKey = $apiKey;
    }

    public function sendSMS($to, $message, $from = null) {
        $postData = [
            'username' => $this->username,
            'to' => $to,
            'message' => $message
        ];

        if ($from) {
            $postData['from'] = $from;
        }

        $headers = [
            "Content-Type: application/x-www-form-urlencoded",
            "Accept: application/json",
            "apikey: " . $this->apiKey
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $decodedResponse = json_decode($response, true);

        // Log API request and response
        $this->logToFile([
            "time" => date("Y-m-d H:i:s"),
            "phone" => $to,
            "message" => $message,
            "request" => $postData,
            "http_code" => $httpCode,
            "response" => $decodedResponse
        ]);

        return $decodedResponse;
    }

    private function logToFile($data) {
        file_put_contents($this->logFile, print_r($data, true) . "\n", FILE_APPEND);
    }
}

?>
