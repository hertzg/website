<?php

function redirect_back ($user, $return) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/format_return.php";
    $return = format_return($return);

    if ($user->should_change_password) {
        $newReturn = 'set-new-password/';
        if ($return !== null) $newReturn .= '?return='.rawurlencode($return);
        $return = $newReturn;
    }

    if ($return === null) {
        $num_signins = $user->num_signins;
        if ($num_signins) {

            include_once "$fnsDir/get_client_address.php";
            $client_address = get_client_address();

            $last_signin = 'Last signed in ';
            $last_address = $user->last_signin_remote_address;
            if ($last_address !== $client_address) {
                $last_signin .= 'from '.htmlspecialchars($last_address).' ';
            }
            include_once "$fnsDir/export_date_ago.php";
            $last_signin .= export_date_ago($user->last_signin_time).'.';

            include_once "$fnsDir/nth_order.php";
            $messages = [
                'Welcome back! This is your '
                .nth_order($user->num_signins + 1).' signin.',
                $last_signin,
            ];

        } else {
            $messages = ['Welcome to Zvini!'];
        }
        $_SESSION['home/messages'] = $messages;
        $return = '../home/';
    }

    include_once "$fnsDir/redirect.php";
    redirect($return);

}
