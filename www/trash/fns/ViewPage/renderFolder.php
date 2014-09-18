<?php

namespace ViewPage;

function renderFolder ($folder, &$items) {
    include_once __DIR__.'/../../../fns/Form/label.php';
    $items[] = \Form\label('Folder name', htmlspecialchars($folder->name));
}
