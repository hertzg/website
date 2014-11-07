<?php

include_once '../fns/require_not_installed.php';
require_not_installed('../');

$nextSteps = ['Requirements', 'General Information',
    'MySQL Configuration', 'Administrator', 'Finalize Installation'];

include_once '../fns/echo_page.php';
include_once '../fns/steps.php';
include_once '../fns/wizard_layout.php';
echo_page(
    'Step 1 - Agreement',
    '<form action="submit.php" method="post">'
        .wizard_layout(
            steps([], 'Agreement', $nextSteps),
            '<span class="title-step">Step 1</span>'
            .'<h2>Agreement</h2>'
            .'<p>'
                .'This program is free software: you can redistribute it'
                .' and/or modify it under the terms of the GNU Affero'
                .' General Public License as published by the Free Software'
                .' Foundation, either version 3 of the License, or (at'
                .' your option) any later version.'
            .'</p>'
            .'<p>'
                .'This program is distributed in the hope that it will'
                .' be useful, but WITHOUT ANY WARRANTY; without even the'
                .' implied warranty of MERCHANTABILITY or FITNESS FOR'
                .' A PARTICULAR PURPOSE. See the GNU Affero General Public'
                .' License for more details.'
            .'</p>'
            .'<p>'
                .'You should have received a copy of the GNU Affero'
                .' General Public License along with this program. If not, see'
                .' <a class="link" href="http://www.gnu.org/licenses/">'
                .'http://www.gnu.org/licenses/</a>'
            .'</p>',
            '<a class="button nextButton" href="submit.php">I Agree</a>'
        )
    .'</form>'
);
