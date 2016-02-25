<?php

include_once '../../../../lib/defaults.php';

include_once __DIR__.'/error.php';
include_once __DIR__.'/execCurl.php';
include_once __DIR__.'/execJsonCurl.php';
include_once __DIR__.'/execOctetCurl.php';
include_once __DIR__.'/expectEquals.php';
include_once __DIR__.'/expectGreater.php';
include_once __DIR__.'/expectNatural.php';
include_once __DIR__.'/expectObject.php';
include_once __DIR__.'/expectStatus.php';
include_once __DIR__.'/expectType.php';
include_once __DIR__.'/expectValue.php';

class Engine {

    use error;
    use execCurl;
    use execJsonCurl;
    use execOctetCurl;
    use expectEquals;
    use expectGreater;
    use expectNatural;
    use expectObject;
    use expectStatus;
    use expectType;
    use expectValue;

    public $numRequests = 0;

    private $api_base;
    public $api_key;

    private $ch;
    private $method;
    private $params;
    private $url;
    private $response;
    private $rawResponse;

    function __construct ($api_key) {
        include_once __DIR__.'/../../../fns/get_absolute_base.php';
        $this->api_base = get_absolute_base().'api-call/';
        $this->api_key = $api_key;
    }

    function download ($method, $params = []) {

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

    function expectError ($error) {
        $this->expectStatus(400);
        $this->expectValue('', $error, $this->response);
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
