<?php

namespace Users\Files;

function delete ($mysqli, $file) {

    include_once __DIR__.'/purge.php';
    purge($mysqli, $file);

    include_once __DIR__.'/../DeletedItems/addFile.php';
    \Users\DeletedItems\addFile($mysqli, $file);

}
