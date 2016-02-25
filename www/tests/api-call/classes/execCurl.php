<?php

include_once '../../../../lib/defaults.php';

trait execCurl {
    private function execCurl ($url, $params, $expectedContentType) {

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
        if ($contentType != $expectedContentType) {
            $this->error(
                "Expected content type $expectedContentType."
                ." $contentType received."
            );
        }

    }
}
