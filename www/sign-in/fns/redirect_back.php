<?php

function redirect_back ($user, $return) {

    $fnsDir = __DIR__.'/../../fns';

    if (parse_url($return, PHP_URL_HOST) !== null) $return = '';

    if ($return == '') {
        $num_signins = $user->num_signins;
        if ($num_signins) {
            include_once "$fnsDir/nth_order.php";
            $order = nth_order($user->num_signins + 1);
            $message = "Welcome back! This is your $order signin.";
        } else {
            $message = 'Welcome to Zvini!';
        }
        $_SESSION['home/messages'] = [$message];
        $return = '../home/';
    }

    include_once "$fnsDir/redirect.php";
    redirect($return);

}
