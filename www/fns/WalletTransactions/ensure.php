<?php

namespace WalletTransactions;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once __DIR__.'/../Table/ensure.php';
    return \Table\ensure($mysqli, 'wallet_transactions', [
        'amount' => [
            'type' => 'bigint(20)',
        ],
        'description' => [
            'type' => "varchar($maxLengths[description])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'id_wallets' => [
            'type' => 'bigint(20) unsigned',
        ],
        'insert_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'revision' => [
            'type' => 'bigint(20) unsigned',
        ],
        'update_time' => [
            'type' => 'bigint(20) unsigned',
        ],
    ]);

}
