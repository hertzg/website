<?php

namespace ApiDoc;

function methodResult ($returns) {

    if ($returns['type'] === 'binary') {
        $content = "Returns binary data - $returns[description]";
    } else {
        include_once __DIR__.'/jsonResult.php';
        $content = 'Returns a JSON document of the following format:<br />'
            .jsonResult($returns);
    }

    include_once __DIR__.'/../Page/text.php';
    return \Page\text($content);

}
