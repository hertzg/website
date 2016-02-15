function HomeItems (response) {

    var items = []

    var renderers = {
        'admin': RenderAdmin,
        'bar-charts': RenderBarCharts,
        'new-bar-chart': RenderNewBarChart,
        'new-bookmark': RenderNewBookmark,
        'new-calculation': RenderNewCalculation,
        'new-event': RenderNewEvent,
        'new-contact': RenderNewContact,
        'upload-files': RenderUploadFiles,
        'new-note': RenderNewNote,
        'post-notification': RenderPostNotification,
        'new-place': RenderNewPlace,
        'new-task': RenderNewTask,
        'new-schedule': RenderNewSchedule,
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
