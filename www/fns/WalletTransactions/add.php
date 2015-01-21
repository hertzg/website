<?php

namespace WalletTransactions;

function add ($mysqli, $id_users, $id_wallets,
    $amount, $description, $insertApiKey) {

    $description = $mysqli->real_escape_string($description);
    $insert_time = $update_time = time();
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into wallet_transactions'
        .' (id_users, id_wallets, amount,'
        .' description, insert_time, update_time,'
        .' insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, $id_wallets, $amount,"
        ." '$description', $insert_time, $update_time,"
        ." $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
