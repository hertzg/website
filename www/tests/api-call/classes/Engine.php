<?php

include_once __DIR__.'/execCurl.php';
include_once __DIR__.'/execJsonCurl.php';
include_once __DIR__.'/execOctetCurl.php';
include_once __DIR__.'/expectGreater.php';
include_once __DIR__.'/expectObject.php';
include_once __DIR__.'/expectType.php';
include_once __DIR__.'/expectValue.php';

class Engine {

    use execCurl;
    use execJsonCurl;
    use execOctetCurl;
    use expectGreater;
    use expectObject;
    use expectType;
    use expectValue;

    public $numRequests = 0;

    private $api_base = 'http://localhost/sites/zvini.com/www/api-call/';
    public $api_key;

    private $ch;
    private $method;
    private $params;
    private $url;
    private $response;
    private $rawResponse;

    function __construct ($api_key) {
        $this->api_key = $api_key;
    }

    function download ($method, array $params = []) {

        $this->method = $method;
        $this->params = $params;
        $this->url = $this->api_base.$method;

        $response = $this->execJsonCurl($this->url, $params);
        $this->expectStatus(403);
        $this->expectValue('', 'INVALID_API_KEY', $response);

        $params['api_key'] = $this->api_key;
        $this->response = $this->execOctetCurl($this->url, $params);
        return $this->response;

    }

    function error ($text) {
        echo "ERROR in $this->method\n"
            ."  Message: $text\n"
            ."  URL: $this->url\n"
            .'  Params: '.json_encode($this->params)."\n"
            .'  Raw response: '.json_encode($this->rawResponse)."\n";
        exit(1);
    }

    function expectEquals ($variableName1, $variableName2, $value1, $value2) {
        if ($value1 !== $value2) {
            $this->error(
                "response$variableName1 should have been"
                ." equal to response$variableName2."
            );
        }
    }

    function expectError ($error) {
        $this->expectStatus(400);
        $this->expectValue('', $error, $this->response);
    }

    function expectNatural ($variableName, $value) {
        $this->expectType($variableName, 'integer', $value);
        if ($value <= 0) {
            $this->error(
                "Expected response$variableName to be"
                ." a natural number. $value received."
            );
        }
    }

    private function expectStatus ($expectedStatus) {
        $status = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        if ($status != $expectedStatus) {
            $this->error(
                "Expected HTTP status $expectedStatus."
                ." Status $status received."
            );
        }
    }

    function expectSuccess () {
        $this->expectStatus(200);
    }

    function request ($method, array $params = []) {

        $this->method = $method;
        $this->params = $params;
        $this->url = $this->api_base.$method;

        $response = $this->execJsonCurl($this->url, $params);
        $this->expectStatus(403);
        $this->expectValue('', 'INVALID_API_KEY', $response);

        $params['api_key'] = $this->api_key;
        $this->response = $this->execJsonCurl($this->url, $params);
        return $this->response;

    }

}
