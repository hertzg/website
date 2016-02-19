<?php

function create_transfer_form_items ($values) {

    $fnsDir = __DIR__.'/../../fns';
    $focus = $values['focus'];

    include_once "$fnsDir/WalletTransactions/maxLengths.php";
    $maxLengths = WalletTransactions\maxLengths();

    include_once "$fnsDir/Form/button.php";
    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textfield('amount', 'Amount', [
            'value' => $values['amount'],
            'required' => true,
            'autofocus' => $focus === 'amount',
        ])
        .'<div class="hr"></div>'
        .Form\textfield('description', 'Description', [
            'value' => $values['description'],
            'maxlength' => $maxLengths['description'],
        ])
        .'<div class="hr"></div>'
        .Form\button('Transfer');

}
