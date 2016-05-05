<?php

function redirect_back ($return) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/format_return.php";
    $return = format_return($return);
    if ($return === null) $return = '../../home/';

    include_once "$fnsDir/redirect.php";
    redirect($return);

}
