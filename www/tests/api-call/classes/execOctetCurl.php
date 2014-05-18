<?php

trait execOctetCurl {
    private function execOctetCurl ($url, $params) {
        $this->execCurl($url, $params, 'application/octet-stream');
        return $this->rawResponse;
    }
}
