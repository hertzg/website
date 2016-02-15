(function () {
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
;
function RenderAdmin (div) {
    ui.Page_thumbnailLink(div, 'Administration', '../admin/', 'administration')
}
;
function RenderBarCharts (div, response) {

    var num_bar_charts = response.user.num_bar_charts

    var title = 'Bar Charts'
    var href = '../bar-charts/'
    var icon = 'bar-charts'
    var options = { id: 'bar-charts' }

    if (num_bar_charts > 0) {
        return ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, num_bar_charts + ' total.')
        }, href, icon, options)
    }

    return ui.Page_thumbnailLink(div, title, href, icon, options)

}
;
function RenderNewBarChart (div) {
    ui.Page_thumbnailLink(div, 'New Bar Chart',
        '../bar-charts/new/', 'create-bar-chart')
}
;
function RenderNewBookmark (div) {
    ui.Page_thumbnailLink(div, 'New Bookmark',
        '../bookmarks/new/', 'create-bookmark')
}
;
function RenderNewCalculation (div) {
    ui.Page_thumbnailLink(div, 'New Calculation',
        '../calculations/new/', 'create-calculation')
}
;
function RenderNewEvent (div) {
    ui.Page_thumbnailLink(div, 'New Event',
        '../calendar/new-event/', 'create-event')
}
;
function RenderNewContact (div) {
    ui.Page_thumbnailLink(div, 'New Contact',
        '../contacts/new/', 'create-contact')
}
;
function RenderNewNote (div) {
    ui.Page_thumbnailLink(div, 'New Note', '../notes/new/', 'create-note')
}
;
function RenderNewPlace (div) {
    ui.Page_thumbnailLink(div, 'New Place', '../places/new/', 'create-place')
}
;
function RenderNewSchedule (div) {
    ui.Page_thumbnailLink(div, 'New Schedule',
        '../schedules/new/', 'create-schedule')
}
;
function RenderNewTask (div) {
    ui.Page_thumbnailLink(div, 'New Task', '../tasks/new/', 'create-task')
}
;
function RenderNewWallet (div) {
    ui.Page_thumbnailLink(div, 'New Wallet', '../wallets/new/', 'create-wallet')
}
;
function RenderNewTransaction (div) {
    ui.Page_thumbnailLink(div, 'New Transaction',
        '../wallets/quick-new-transaction/', 'create-transaction')
}
;
function RenderPostNotification (div) {
    ui.Page_thumbnailLink(div, 'Post a Notification',
        '../notifications/quick-post-notification/', 'create-notification')
}
;
function RenderTransferAmount (div) {
    ui.Page_thumbnailLink(div, 'Transfer Amount',
        '../wallets/quick-transfer-amount/', 'transfer-amount')
}
;
function RenderTrash (div, response) {

    var num_deleted_items = response.user.num_deleted_items

    var description
    if (num_deleted_items) description = num_deleted_items + ' total.'
    else description = 'Empty'

    ui.Page_thumbnailLinkWithDescription(div, 'Trash', function (span) {
        ui.Text(span, description)
    }, '../trash/', 'trash-bin', { id: 'trash' })

}
;
function RenderUploadFiles (div) {
    ui.Page_thumbnailLink(div, 'Upload Files',
        '../files/upload-files/', 'upload')
}
;
(function (localNavigation, ui) {
    localNavigation.registerPage('home/', function (response, loadCallback) {

        loadCallback('Home')

        ui.page(response, '../', function (body) {
            ui.Page_emptyTabs(body, function (div) {
                ui.Page_sessionMessages(div, response.messages)
                ui.SearchForm_create(div, '../search/', function (div) {
                    ui.SearchForm_emptyContent(div, 'Search...')
                })
                ui.Hr(div)
                ui.Page_thumbnails(div, HomeItems(response))
            })
            ui.Page_panel(body, 'Options', function (div) {
                ui.Page_twoColumns(div, function (div) {
                    ui.Page_imageArrowLink(div, function (div) {
                        ui.Text(div, 'Account')
                    }, '../account/', 'account', { id: 'account' })
                }, function (div) {
                    ui.Page_imageArrowLink(div, function (div) {
                        ui.Text(div, 'Customize Home')
                    }, 'customize/', 'edit-home', {
                        id: 'customize',
                        localNavigation: true,
                    })
                })
                ui.Hr(div)
                ui.Page_imageArrowLink(div, function (div) {
                    ui.Text(div, 'Help')
                }, '../help/', 'help', {
                    id: 'help',
                    localNavigation: true,
                })
            })
        }, {
            head: function (head) {
                ui.compressed_css_link(head, 'calendarIcon', '../')
            },
            scripts: function (body) {
                ui.compressed_js_script(body, 'searchForm', '../')
            },
        })

        localNavigation.scanLinks()
        localNavigation.focusTarget()

    })
})(localNavigation, ui)
;

})()