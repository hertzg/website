<?php

function redirect_back ($user, $return) {

    $fnsDir = __DIR__.'/../../fns';

    if (parse_url($return, PHP_URL_HOST) !== null) $return = '';

    if ($return == '') {
        $num_logins = $user->num_logins;
        if ($num_logins) {
            include_once "$fnsDir/nth_order.php";
            $order = nth_order($user->num_logins + 1);
            $message = "Welcome back! This is your $order login.";
        } else {
            $message = 'Welcome to Zvini!';
        }
        $_SESSION['home/messages'] = [$message];
        $return = '../home/';
    }

    include_once "$fnsDir/redirect.php";
    redirect($return);

}
