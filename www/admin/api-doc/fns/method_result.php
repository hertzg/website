<?php

function method_result ($returns) {

    if ($returns['type'] === 'binary') {
        $content = "Returns binary data - $returns[description]";
    } else {
        include_once __DIR__.'/json_result.php';
        $content = 'Returns a JSON document of the following format:<br />'
            .json_result($returns);
    }

    include_once __DIR__.'/../../../fns/Page/text.php';
    return Page\text($content);

}
