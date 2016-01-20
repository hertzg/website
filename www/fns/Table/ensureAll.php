<?php

namespace Table;

function ensureAll ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/AdminApiKeyAuths/ensure.php";
    include_once "$fnsDir/AdminApiKeys/ensure.php";
    include_once "$fnsDir/AdminConnectionAuths/ensure.php";
    include_once "$fnsDir/AdminConnections/ensure.php";
    include_once "$fnsDir/ApiKeyAuths/ensure.php";
    include_once "$fnsDir/ApiKeys/ensure.php";
    include_once "$fnsDir/BarChartBars/ensure.php";
    include_once "$fnsDir/BarCharts/ensure.php";
    include_once "$fnsDir/BarChartTags/ensure.php";
    include_once "$fnsDir/BookmarkRevisions/ensure.php";
    include_once "$fnsDir/Bookmarks/ensure.php";
    include_once "$fnsDir/BookmarkTags/ensure.php";
    include_once "$fnsDir/CalculationDepends/ensure.php";
    include_once "$fnsDir/Calculations/ensure.php";
    include_once "$fnsDir/CalculationTags/ensure.php";
    include_once "$fnsDir/Channels/ensure.php";
    include_once "$fnsDir/Connections/ensure.php";
    include_once "$fnsDir/ContactPhotos/ensure.php";
    include_once "$fnsDir/ContactRevisions/ensure.php";
    include_once "$fnsDir/Contacts/ensure.php";
    include_once "$fnsDir/ContactTags/ensure.php";
    include_once "$fnsDir/CrossSiteApiKeys/ensure.php";
    include_once "$fnsDir/DeletedFiles/ensure.php";
    include_once "$fnsDir/DeletedFolders/ensure.php";
    include_once "$fnsDir/DeletedItems/ensure.php";
    include_once "$fnsDir/Events/ensure.php";
    include_once "$fnsDir/Feedbacks/ensure.php";
    include_once "$fnsDir/Files/ensure.php";
    include_once "$fnsDir/Folders/ensure.php";
    include_once "$fnsDir/InvalidSignins/ensure.php";
    include_once "$fnsDir/Invitations/ensure.php";
    include_once "$fnsDir/Notes/ensure.php";
    include_once "$fnsDir/NoteTags/ensure.php";
    include_once "$fnsDir/Notifications/ensure.php";
    include_once "$fnsDir/Places/ensure.php";
    include_once "$fnsDir/PlacePoints/ensure.php";
    include_once "$fnsDir/PlaceTags/ensure.php";
    include_once "$fnsDir/ReceivedBookmarks/ensure.php";
    include_once "$fnsDir/ReceivedCalculations/ensure.php";
    include_once "$fnsDir/ReceivedContacts/ensure.php";
    include_once "$fnsDir/ReceivedFiles/ensure.php";
    include_once "$fnsDir/ReceivedFolderFiles/ensure.php";
    include_once "$fnsDir/ReceivedFolders/ensure.php";
    include_once "$fnsDir/ReceivedFolderSubfolders/ensure.php";
    include_once "$fnsDir/ReceivedNotes/ensure.php";
    include_once "$fnsDir/ReceivedPlaces/ensure.php";
    include_once "$fnsDir/ReceivedSchedules/ensure.php";
    include_once "$fnsDir/ReceivedTasks/ensure.php";
    include_once "$fnsDir/Schedules/ensure.php";
    include_once "$fnsDir/ScheduleTags/ensure.php";
    include_once "$fnsDir/SendingBookmarks/ensure.php";
    include_once "$fnsDir/SendingCalculations/ensure.php";
    include_once "$fnsDir/SendingContacts/ensure.php";
    include_once "$fnsDir/SendingNotes/ensure.php";
    include_once "$fnsDir/SendingPlaces/ensure.php";
    include_once "$fnsDir/SendingSchedules/ensure.php";
    include_once "$fnsDir/SendingTasks/ensure.php";
    include_once "$fnsDir/Signins/ensure.php";
    include_once "$fnsDir/SubscribedChannels/ensure.php";
    include_once "$fnsDir/TaskRevisions/ensure.php";
    include_once "$fnsDir/Tasks/ensure.php";
    include_once "$fnsDir/TaskTags/ensure.php";
    include_once "$fnsDir/TokenAuths/ensure.php";
    include_once "$fnsDir/Tokens/ensure.php";
    include_once "$fnsDir/Users/ensure.php";
    include_once "$fnsDir/Wallets/ensure.php";
    include_once "$fnsDir/WalletTransactions/ensure.php";
    return \AdminApiKeyAuths\ensure($mysqli)
        .\AdminApiKeys\ensure($mysqli)
        .\AdminConnectionAuths\ensure($mysqli)
        .\AdminConnections\ensure($mysqli)
        .\ApiKeyAuths\ensure($mysqli)
        .\ApiKeys\ensure($mysqli)
        .\BarChartBars\ensure($mysqli)
        .\BarCharts\ensure($mysqli)
        .\BarChartTags\ensure($mysqli)
        .\BookmarkRevisions\ensure($mysqli)
        .\Bookmarks\ensure($mysqli)
        .\BookmarkTags\ensure($mysqli)
        .\CalculationDepends\ensure($mysqli)
        .\Calculations\ensure($mysqli)
        .\CalculationTags\ensure($mysqli)
        .\Channels\ensure($mysqli)
        .\Connections\ensure($mysqli)
        .\ContactPhotos\ensure($mysqli)
        .\ContactRevisions\ensure($mysqli)
        .\Contacts\ensure($mysqli)
        .\ContactTags\ensure($mysqli)
        .\CrossSiteApiKeys\ensure($mysqli)
        .\DeletedFiles\ensure($mysqli)
        .\DeletedFolders\ensure($mysqli)
        .\DeletedItems\ensure($mysqli)
        .\Events\ensure($mysqli)
        .\Feedbacks\ensure($mysqli)
        .\Files\ensure($mysqli)
        .\Folders\ensure($mysqli)
        .\InvalidSignins\ensure($mysqli)
        .\Invitations\ensure($mysqli)
        .\Notes\ensure($mysqli)
        .\NoteTags\ensure($mysqli)
        .\Notifications\ensure($mysqli)
        .\Places\ensure($mysqli)
        .\PlacePoints\ensure($mysqli)
        .\PlaceTags\ensure($mysqli)
        .\ReceivedBookmarks\ensure($mysqli)
        .\ReceivedCalculations\ensure($mysqli)
        .\ReceivedContacts\ensure($mysqli)
        .\ReceivedFiles\ensure($mysqli)
        .\ReceivedFolderFiles\ensure($mysqli)
        .\ReceivedFolders\ensure($mysqli)
        .\ReceivedFolderSubfolders\ensure($mysqli)
        .\ReceivedNotes\ensure($mysqli)
        .\ReceivedPlaces\ensure($mysqli)
        .\ReceivedSchedules\ensure($mysqli)
        .\ReceivedTasks\ensure($mysqli)
        .\Schedules\ensure($mysqli)
        .\ScheduleTags\ensure($mysqli)
        .\SendingBookmarks\ensure($mysqli)
        .\SendingCalculations\ensure($mysqli)
        .\SendingContacts\ensure($mysqli)
        .\SendingNotes\ensure($mysqli)
        .\SendingPlaces\ensure($mysqli)
        .\SendingSchedules\ensure($mysqli)
        .\SendingTasks\ensure($mysqli)
        .\Signins\ensure($mysqli)
        .\SubscribedChannels\ensure($mysqli)
        .\TaskRevisions\ensure($mysqli)
        .\Tasks\ensure($mysqli)
        .\TaskTags\ensure($mysqli)
        .\TokenAuths\ensure($mysqli)
        .\Tokens\ensure($mysqli)
        .\Users\ensure($mysqli)
        .\Wallets\ensure($mysqli)
        .\WalletTransactions\ensure($mysqli);

}
