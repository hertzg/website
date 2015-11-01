<?php

namespace AdminConnectionAuths;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/../';

    include_once "$fnsDir/IPAddress/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'admin_connection_auths', [
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_admin_connections' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'remote_address' => \IPAddress\column(),
    ]);

}
