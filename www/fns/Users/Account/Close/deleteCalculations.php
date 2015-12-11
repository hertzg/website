<?php

namespace Users\Account\Close;

function deleteCalculations ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    if ($user->num_calculations) {

        include_once "$fnsDir/Calculations/deleteOnUser.php";
        \Calculations\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/CalculationTags/deleteOnUser.php";
        \CalculationTags\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/CalculationDepends/deleteOnUser.php";
        \CalculationDepends\deleteOnUser($mysqli, $id_users);

    }

    if ($user->num_received_calculations) {
        include_once "$fnsDir/ReceivedCalculations/deleteOnReceiver.php";
        \ReceivedCalculations\deleteOnReceiver($mysqli, $id_users);
    }

}
