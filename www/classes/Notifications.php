<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';
include_once 'Channels.php';
include_once 'Notifications.php';
include_once 'Users.php';

class Notifications {

    static function add ($idusers, $idchannels, $channelname, $notificationtext) {
        global $mysqli;
        $channelname = mysqli_real_escape_string($mysqli, $channelname);
        $notificationtext = mysqli_real_escape_string($mysqli, $notificationtext);
        $inserttime = time();
        mysqli_query(
            $mysqli,
            'insert into notifications'
            .' (idusers, idchannels, channelname,'
            .' notificationtext, inserttime)'
            ." values ($idusers, $idchannels, '$channelname',"
            ." '$notificationtext', $inserttime)"
        );
        Channels::addNumNotifications($idusers, $idchannels, 1);
        Users::addNumNotifications($idusers, 1);
    }

    static function countOnUser ($idusers) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            "select count(*) count from notifications where idusers = $idusers"
        )->count;
    }

    static function deleteAll ($idusers) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            "delete from notifications where idusers = $idusers"
        );
        Channels::clearNumNotifications($idusers);
    }

    static function deleteOnChannel ($idusers, $idchannels) {
        global $mysqli;
        $notifications = self::index($idusers, $idchannels);
        Channels::addNumNotifications($idusers, $idchannels, -count($notifications));
        mysqli_query(
            $mysqli,
            "delete from notifications where idchannels = $idchannels"
        );
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            "delete from notifications where idusers = $idusers"
        );
    }

    static function index ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select * from notifications'
            ." where idusers = $idusers"
            .' order by inserttime desc'
        );
    }

    static function indexOnChannel ($idusers, $idchannels) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select * from notifications'
            ." where idusers = $idusers and idchannels = $idchannels"
            .' order by inserttime'
        );
    }

    static function textToHtml ($notificationtext) {
        return nl2br(
            preg_replace(
                '#(http://.*?)(\s|$)#',
                '<a class="a" rel="noreferrer" href="$1">$1</a>$2',
                htmlspecialchars($notificationtext)
            )
        );
    }

}
