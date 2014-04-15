<?php

namespace SubscribedChannels;

function deleteOnChannel ($mysqli, $id_channels) {

    include_once __DIR__.'/indexOnChannel.php';
    $subscribedChannels = indexOnChannel($mysqli, $id_channels);

    include_once __DIR__.'/deleteArray.php';
    deleteArray($mysqli, $subscribedChannels);

}
