<?php

function render_file ($file, &$items) {

    include_once __DIR__.'/../../../fns/Form/label.php';
    $items[] = Form\label('File name', htmlspecialchars($file->name));

    include_once __DIR__.'/../../../fns/bytestr.php';
    $items[] = Form\label('Size', bytestr($file->size));

    // TODO preview

}
