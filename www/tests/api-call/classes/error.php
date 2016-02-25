<?php

include_once '../../../../lib/defaults.php';

trait error {
    function error ($text) {
        echo "ERROR in $this->method\n"
            ." Message: $text\n"
            ." URL: $this->url\n"
            .' Params: '.json_encode($this->params)."\n"
            .' Raw response: '.json_encode($this->rawResponse)."\n";
        exit(1);
    }
}
