<?php

trait execJsonCurl {
    private function execJsonCurl ($url, $params) {
        $this->execCurl($url, $params, 'application/json');
        return json_decode($this->rawResponse);
    }
}
