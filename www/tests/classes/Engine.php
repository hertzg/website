<?php

class Engine {

    public $numRequests;

    private $api_base = 'http://localhost/sites/zvini.com/www/api-call/';
    private $api_key = '5bde19f90d228c0212ef826c643101f47ee6f18b66f595722ca8ee9e8b78bac4';

    private $ch;
    private $method;
    private $params;
    private $url;
    private $rawResponse;

    function error ($text) {
        echo "ERROR in $this->method\n"
            ."  Message: $text\n"
            ."  URL: $this->url\n"
            .'  Params: '.json_encode($this->params)."\n"
            .'  Raw response: '.json_encode($this->rawResponse)."\n";
        exit;
    }

    private function execCurl ($url, $params) {

        if ($this->ch) curl_close($this->ch);

        $this->ch = curl_init();
        curl_setopt_array($this->ch, [
            CURLOPT_URL => $this->url,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $this->rawResponse = curl_exec($this->ch);
        $this->numRequests++;

        $contentType = curl_getinfo($this->ch, CURLINFO_CONTENT_TYPE);
        if ($contentType != 'application/json') {
            $this->error("Expected content type application/json. $contentType received.");
        }

        return json_decode($this->rawResponse);

    }

    function expectEquals ($variableName1, $variableName2, $value1, $value2) {
        if ($value1 !== $value2) {
            $this->error("response$variableName1 should have been equal to response$variableName2.");
        }
    }

    function expectGreater ($variableName1, $variableName2, $value1, $value2) {
        if ($value1 <= $value2) {
            $this->error("response$variableName1 should have been greater than response$variableName2.");
        }
    }

    function expectNatural ($variableName, $value) {
        $this->expectType($variableName, 'integer', $value);
        if ($value <= 0) {
            $this->error("Expected response$variableName to be a natural number. $value received.");
        }
    }

    function expectObject ($variableName, array $properties, $object) {
        $this->expectType($variableName, 'object', $object);
        foreach ($properties as $property) {
            if (!property_exists($object, $property)) {
                $this->error("Required property $property not present in response$variableName.");
            }
        }
        foreach ($object as $property => $value) {
            if (!in_array($property, $properties)) {
                $this->error("Extra property $property was received in response$variableName.");
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
            $this->error("Expected response$variableName to be of $expectedType type. Type $type received.");
        }
    }

    function expectValue ($variableName, $expectedValue, $value) {
        if ($value !== $expectedValue) {
            $this->error("Expected response$variableName to be ".json_encode($expectedValue).'. '.json_encode($value).' received.');
        }
    }

    function request ($method, array $params = []) {

        $this->method = $method;
        $this->params = $params;
        $this->url = $this->api_base.$method;

        $response = $this->execCurl($this->url, $params);
        $this->expectStatus(403);
        $this->expectValue('', 'INVALID_API_KEY', $response);

        $params['api_key'] = $this->api_key;
        return $this->execCurl($this->url, $params);

    }

}
