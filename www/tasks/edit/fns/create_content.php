<?php

function create_content ($id, $values) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Tasks/maxLengths.php";
    $maxLengths = Tasks\maxLengths();

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Form/button.php";
    include_once "$fnsDir/Form/checkbox.php";
    include_once "$fnsDir/Form/datefield.php";
    include_once "$fnsDir/Form/hidden.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/ItemList/itemHiddenInputs.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => ItemList\listHref(),
            ],
            [
                'title' => "Task #$id",
                'href' => '../view/'.ItemList\escapedItemQuery($id),
            ],
        ],
        'Edit',
        Page\sessionErrors('tasks/edit/errors')
        .'<form action="submit.php" method="post">'
            .Form\textarea('text', 'Text', [
                'value' => $values['text'],
                'maxlength' => $maxLengths['text'],
                'autofocus' => true,
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\datefield([
                'name' => 'deadline_day',
                'value' => $values['deadline_day'],
            ], [
                'name' => 'deadline_month',
                'value' => $values['deadline_month'],
            ], [
                'name' => 'deadline_year',
                'value' => $values['deadline_year'],
                'min' => date('Y'),
                'max' => date('Y') + 2,
            ], 'Deadline', false, true)
            .'<div class="hr"></div>'
            .Form\textfield('tags', 'Tags', [
                'value' => $values['tags'],
                'maxlength' => $maxLengths['tags'],
            ])
            .'<div class="hr"></div>'
            .Form\checkbox('../../', 'top_priority',
                'Mark as Top Priority', $values['top_priority'])
            .'<div class="hr"></div>'
            .Page\staticTwoColumns(
                Form\button('Save Changes'),
                Form\button('Send', 'sendButton')
            )
            .ItemList\itemHiddenInputs($id)
        .'</form>'
    );

}
