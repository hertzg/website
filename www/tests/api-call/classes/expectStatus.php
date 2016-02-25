<?php

include_once '../../../../lib/defaults.php';

trait expectStatus {
    private function expectStatus ($expectedStatus) {
        $status = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        if ($status != $expectedStatus) {
            $this->error(
                "Expected HTTP status $expectedStatus."
                ." Status $status received."
            );
        }
    }
}
