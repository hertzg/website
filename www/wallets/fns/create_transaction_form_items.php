<?php

function create_transaction_form_items ($values) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/WalletTransactions/maxLengths.php";
    $maxLengths = WalletTransactions\maxLengths();

    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textfield('amount', 'Amount', [
            'value' => $values['amount'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('description', 'Description', [
            'value' => $values['description'],
            'maxlength' => $maxLengths['description'],
        ]);

}
