function HomeItems (response) {

    var items = []

    var renderers = {
        'admin': RenderAdmin,
        'bar-charts': RenderBarCharts,
        'new-bar-chart': RenderNewBarChart,
        'bookmarks': RenderBookmarks,
        'new-bookmark': RenderNewBookmark,
        'new-calculation': RenderNewCalculation,
        'new-event': RenderNewEvent,
        'contacts': RenderContacts,
        'new-contact': RenderNewContact,
        'upload-files': RenderUploadFiles,
        'notes': RenderNotes,
        'new-note': RenderNewNote,
        'post-notification': RenderPostNotification,
        'new-place': RenderNewPlace,
        'tasks': RenderTasks,
        'new-task': RenderNewTask,
        'new-schedule': RenderNewSchedule,
        'wallets': RenderWallets,
        'new-wallet': RenderNewWallet,
        'new-transaction': RenderNewTransaction,
        'transfer-amount': RenderTransferAmount,
        'trash': RenderTrash,
    }

    var home = response.home
    for (var key in home) {
        (function (key) {
            items.push(function (div) {
                renderers[key](div, response)
            })
        })(key)
    }

    return items
}
