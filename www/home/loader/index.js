(function () {
function amount_text (n) {
    return (n / 100).toFixed(2).replace(/(\d+)\./, function (a, digits, decimals) {
        var reverseDigits = digits.split('').reverse().join('')
        var result = '.' + reverseDigits.substr(0, 3)
        for (var i = 3; i < reverseDigits.length; i += 3) {
            result += ',' + reverseDigits.substr(i, 3)
        }
        return result.split('').reverse().join('')
    })
}
;
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
function RenderBookmarks (div, response) {

    var user = response.user
    var num_bookmarks = user.num_bookmarks
    var num_new_received = user.num_received_bookmarks -
        user.num_archived_received_bookmarks

    var title = 'Bookmarks'
    var href = '../bookmarks/'
    var icon = 'bookmarks'
    var options = { id: 'bookmarks' }
    if (num_bookmarks || num_new_received) {

        var descriptions = []
        if (num_bookmarks) descriptions.push(num_bookmarks + '\xa0total.')
        if (num_new_received) {
            descriptions.push(num_new_received + '\xa0new\xa0received.')
        }
        description = descriptions.join(' ')

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, description)
        }, href, icon, options)

    } else {
        ui.Page_thumbnailLink(div, title, href, icon, options)
    }

}
;
function RenderContacts (div, response) {

    var user = response.user
    var num_contacts = user.num_contacts
    var num_new_received = user.num_received_contacts -
        user.num_archived_received_contacts

    var title = 'Contacts'
    var href = '../contacts/'
    var icon = 'contacts'
    var options = { id: 'contacts' }
    if (num_contacts || num_new_received) {

        var descriptions = []
        if (num_contacts) descriptions.push(num_contacts + '\xa0total.')
        if (num_new_received) {
            descriptions.push(num_new_received + '\xa0new\xa0received.')
        }
        description = descriptions.join(' ')

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, description)
        }, href, icon, options)

    } else {
        ui.Page_thumbnailLink(div, title, href, icon, options)
    }

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
function RenderNotes (div, response) {

    var user = response.user
    var num_notes = user.num_notes
    var num_new_received = user.num_received_notes -
        user.num_archived_received_notes

    var title = 'Notes'
    var href = '../notes/'
    var icon = 'notes'
    var options = { id: 'notes' }
    if (num_notes || num_new_received) {

        var descriptions = []
        if (num_notes) descriptions.push(num_notes + '\xa0total.')
        if (num_new_received) {
            descriptions.push(num_new_received + '\xa0new\xa0received.')
        }
        description = descriptions.join(' ')

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, description)
        }, href, icon, options)

    } else {
        ui.Page_thumbnailLink(div, title, href, icon, options)
    }

}
;
function RenderPostNotification (div) {
    ui.Page_thumbnailLink(div, 'Post a Notification',
        '../notifications/quick-post-notification/', 'create-notification')
}
;
function RenderTasks (div, response) {

    var user = response.user
    var num_tasks = user.num_tasks
    var num_new_received = user.num_received_tasks -
        user.num_archived_received_tasks

    var title = 'Tasks'
    var href = '../tasks/'
    var icon = 'tasks'
    var options = { id: 'tasks' }
    if (num_tasks || num_new_received) {

        var descriptions = []
        if (num_tasks) descriptions.push(num_tasks + '\xa0total.')
        if (num_new_received) {
            descriptions.push(num_new_received + '\xa0new\xa0received.')
        }
        description = descriptions.join(' ')

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, description)
        }, href, icon, options)

    } else {
        ui.Page_thumbnailLink(div, title, href, icon, options)
    }

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
function RenderWallets (div, response) {

    var balance_total = response.user.balance_total

    var title = 'Wallets'
    var href = '../wallets/'
    var icon = 'wallets'
    var options = { id: 'wallets' }

    if (balance_total) {
        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, amount_text(balance_total) + ' balance.')
        }, href, icon, options)
    } else {
        ui.Page_thumbnailLink(div, title, href, icon, options)
    }

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