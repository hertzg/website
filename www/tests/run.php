#!/usr/bin/php
<?php

class Expect {

    public $expectError;
    public $expectObject;
    public $expectStatusCode;
    public $expectType;

    function error ($response, $expectError) {
        $f = $this->expectError;
        $f($response, $expectError);
    }

    function object ($object, array $properties) {
        $f = $this->expectObject;
        $f($object, $properties);
    }

    function statusCode ($statusCode) {
        $f = $this->expectStatusCode;
        $f($statusCode);
    }

    function type ($variableName, $expectedType, $value) {
        $f = $this->expectType;
        $f($variableName, $expectedType, $value);
    }

}

$request = function ($method, array $params, $callback) {

    $api_key = '4ad37a505e6c58ecb0609cfb6b8aaf84ee9709b83627c8502cf13dd573700647';
    $api_base = 'http://localhost/sites/zvini.com/www/api-call/';

    $url = $api_base.$method;

    $logError = function ($message) use ($method, $url, $params) {
        echo "ERROR in $method\n"
            ."  Message: $message\n"
            ."  URL: $url\n"
            .'  Params: '.json_encode($params)."\n";
        exit;
    };

    $newCurl = function (array $params) use ($url) {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $response = curl_exec($ch);
        return [$ch, $response];
    };

    $expectStatusCode = function ($ch, $expectedStatusCode) use ($logError) {
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($status != $expectedStatusCode) {
            $logError("Expected HTTP status $expectedStatusCode. $status received.");
        }
    };

    $expectJsonContentType = function ($ch) use ($logError) {
        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        if ($contentType != 'application/json') {
            $logError("Expected content type application/json. $contentType received.");
        }
    };

    $expectObject = function ($object, array $properties) use ($logError) {
        foreach ($properties as $property) {
            if (!property_exists($object, $property)) {
                $logError("Required property $property not present in ".json_encode($object).'.');
            }
        }
        foreach ($object as $key => $value) {
            if (!in_array($key, $properties)) {
                $logError("Extra property $key was received in ".json_encode($object).'.');
            }
        }
    };

    $expectError = function ($response, $expectedError) use ($logError, $expectObject) {
        $expectObject($response, ['error']);
        $error = $response->error;
        if ($error !== $expectedError) {
            $logError("Expected error $expectedError. ".json_encode($response).' received.');
        }
    };

    list($ch, $response) = $newCurl($params);
    $expectStatusCode($ch, 403);
    $expectJsonContentType($ch);
    $response = json_decode($response);
    $expectError($response, 'INVALID_API_KEY');

    $params['api_key'] = $api_key;
    list($ch, $response) = $newCurl($params);
    $expectJsonContentType($ch);
    $response = json_decode($response);

    $expect = new Expect;
    $expect->expectError = $expectError;
    $expect->expectObject = $expectObject;
    $expect->expectStatusCode = function ($statusCode) use ($ch, $expectStatusCode) {
        $expectStatusCode($ch, $statusCode);
    };
    $expect->expectType = function ($variableName, $expectedType, $value) use ($logError) {
        $type = gettype($value);
        if ($type != $expectedType) {
            $logError("Expected type $expectedType in \"response$variableName\". $type received.");
        }
    };

    $callback($response, $expect);

};

$request('note/add', [], function ($response, $expect) {
    $expect->statusCode(400);
    $expect->error($response, 'ENTER_TEXT');
});

$request('note/add', [
    'text' => 'sample note content',
], function ($response, $expect) {
    $expect->statusCode(200);
    $expect->object($response, ['id']);
    $expect->type('.id', 'integer', $response->id);
});

$request('note/list', [], function ($notes, $expect) {
    $expect->statusCode(200);
    $expect->type('', 'array', $notes);
    foreach ($notes as $i => $note) {
        $expect->object($note, ['id', 'text', 'tags', 'insert_time', 'update_time']);
        $expect->type("[$i].id", 'integer', $note->id);
        $expect->type("[$i].text", 'string', $note->text);
        $expect->type("[$i].tags", 'string', $note->tags);
        $expect->type("[$i].insert_time", 'integer', $note->insert_time);
        $expect->type("[$i].update_time", 'integer', $note->update_time);
    }
});

echo "Done\n";
