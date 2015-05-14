<?php

namespace Users\Account\Close;

function deletePlaces ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    if ($user->num_places) {

        include_once "$fnsDir/Places/deleteOnUser.php";
        \Places\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/PlaceTags/deleteOnUser.php";
        \PlaceTags\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/PlacePoints/deleteOnUser.php";
        \PlacePoints\deleteOnUser($mysqli, $id_users);

    }

    if ($user->num_received_places) {
        include_once "$fnsDir/ReceivedPlaces/deleteOnReceiver.php";
        \ReceivedPlaces\deleteOnReceiver($mysqli, $id_users);
    }

}
