<?php

function render_schedules ($user, &$items) {

    if (!$user->show_schedules) return;

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    $items['schedules'] = Page\imageArrowLink('Schedules', '../schedules/', 'TODO');

}
