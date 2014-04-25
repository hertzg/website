<?php

class Engine {

    private $api_base = 'http://localhost/sites/zvini.com/www/api-call/';
    private $api_key = '5bde19f90d228c0212ef826c643101f47ee6f18b66f595722ca8ee9e8b78bac4';

    private $ch;
    private $method;
    private $params;
    private $url;

    function error ($text) {
        echo "ERROR in $this->method\n"
            ."  Message: $text\n"
            ."  URL: $this->url\n"
            .'  Params: '.json_encode($this->params)."\n";
        exit;
    }

    function expectError ($response, $expectedError) {
        $this->expectObject($response, ['error']);
        $error = $response->error;
        if ($error !== $expectedError) {
            $logError("Expected error $expectedError. ".json_encode($response).' received.');
        }
    }

    function expectNatural ($variableName, $value) {
        $this->expectType($variableName, 'integer', $value);
        if ($value <= 0) {
            $this->error("Expected $variableName to be >= 0. $value received.");
        }
    }

    function expectObject ($object, array $properties) {
        foreach ($properties as $property) {
            if (!property_exists($object, $property)) {
                $this->error("Required property $property not present in ".json_encode($object).'.');
            }
        }
        foreach ($object as $key => $value) {
            if (!in_array($key, $properties)) {
                $this->error("Extra property $key was received in ".json_encode($object).'.');
            }
        }
    }

    function expectStatus ($expectedStatus) {
        $status = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        if ($status != $expectedStatus) {
            $this->error("Expected HTTP status $expectedStatus. Status $status received.");
        }
    }

    function expectType ($variableName, $expectedType, $value) {
        $type = gettype($value);
        if ($type != $expectedType) {
            $this->error("Expected $variableName to be $expectedType. $type received.");
        }
    }

    private function newCurl ($url, $params) {

        $this->ch = curl_init();
        curl_setopt_array($this->ch, [
            CURLOPT_URL => $this->url,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $response = curl_exec($this->ch);

        $contentType = curl_getinfo($this->ch, CURLINFO_CONTENT_TYPE);
        if ($contentType != 'application/json') {
            $this->error("Expected content type application/json. $contentType received.");
        }

        return $response;

    }

    function request ($method, array $params) {

        $this->method = $method;
        $this->params = $params;
        $this->url = $this->api_base.$method;

        $response = $this->newCurl($this->url, $params);
        $this->expectStatus(403);

        $params['api_key'] = $this->api_key;
        $response = $this->newCurl($this->url, $params);
        $response = json_decode($response);
        return $response;

    }

}
