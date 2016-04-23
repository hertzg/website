<?php

function redirect_back ($user, $return) {

    $fnsDir = __DIR__.'/../../fns';

    if ($return !== '') {
        $parsed_url = parse_url($return);
        if ($parsed_url === false ||
            array_key_exists('scheme', $parsed_url) ||
            array_key_exists('host', $parsed_url) ||
            array_key_exists('fragment', $parsed_url)) {

            $return = '';

        } else {
            if (array_key_exists('query', $parsed_url)) $return .= '&';
            else $return .= '?';
            $return .= 'just_signed_in=1';
        }
    }

    if ($return === '') {
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
