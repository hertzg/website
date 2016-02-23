(function () {
function amount_text (amount) {
    return (amount / 100).toFixed(2).replace(/\d+/, function (digits) {
        var reverseDigits = digits.split('').reverse().join('')
        var result = reverseDigits.substr(0, 3)
        for (var i = 3; i < reverseDigits.length; i += 3) {
            result += ',' + reverseDigits.substr(i, 3)
        }
        return result.split('').reverse().join('')
    })
}
;
function bytestr (bytes, space) {

    if (space === undefined) space = ' '

    var names = ['B', 'KB', 'MB', 'GB', 'TB']
    for (var i = 0; i < names.length; i++) {
        if (bytes >= 1024) bytes /= 1024
        else {
            var decimals
            if (Math.round(bytes * 10) % 10) decimals = 1
            else decimals = 0
            return number_format(bytes, decimals) + space + names[i]
        }
    }

}
;
function create_calendar_icon_today (parentNode, response) {
    ui.Element(parentNode, 'span', function (span) {
        span.className = 'icon calendar'
        ui.Element(span, 'span', function (span) {
            span.className = 'calendarIcon-day'
            ui.Text(span, new Date(response.time).getUTCDate())
        })
    })
}
;
function number_format (number, decimals) {
    return number.toFixed(decimals).replace(/\d+/, function (digits) {
        var reverseDigits = digits.split('').reverse().join('')
        var result = reverseDigits.substr(0, 3)
        for (var i = 3; i < reverseDigits.length; i += 3) {
            result += ',' + reverseDigits.substr(i, 3)
        }
        return result.split('').reverse().join('')
    })
}
;
function HomeItems (response) {

    var renderers = {
        'admin': RenderAdmin,
        'bar-charts': RenderBarCharts,
        'new-bar-chart': RenderNewBarChart,
        'bookmarks': RenderBookmarks,
        'new-bookmark': RenderNewBookmark,
        'calculations': RenderCalculations,
        'new-calculation': RenderNewCalculation,
        'calendar': RenderCalendar,
        'new-event': RenderNewEvent,
        'contacts': RenderContacts,
        'new-contact': RenderNewContact,
        'files': RenderFiles,
        'upload-files': RenderUploadFiles,
        'notes': RenderNotes,
        'new-note': RenderNewNote,
        'notifications': RenderNotifications,
        'post-notification': RenderPostNotification,
        'places': RenderPlaces,
        'new-place': RenderNewPlace,
        'tasks': RenderTasks,
        'new-task': RenderNewTask,
        'schedules': RenderSchedules,
        'new-schedule': RenderNewSchedule,
        'wallets': RenderWallets,
        'new-wallet': RenderNewWallet,
        'new-transaction': RenderNewTransaction,
        'transfer-amount': RenderTransferAmount,
        'trash': RenderTrash,
    }

    var items = []
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
    ui.Page_thumbnailLink(div, 'Administration',
        '../admin/', 'administration', { id: 'admin' })
}
;
function RenderBarCharts (div, response) {

    var num_bar_charts = response.user.num_bar_charts

    var title = 'Bar Charts',
        href = '../bar-charts/',
        icon = 'bar-charts',
        options = { id: 'bar-charts' }

    if (num_bar_charts) {
        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, num_bar_charts + ' total.')
        }, href, icon, options)
        return
    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

}
;
function RenderBookmarks (div, response) {

    var user = response.user

    var num_bookmarks = user.num_bookmarks
    var num_new_received = user.num_received_bookmarks -
        user.num_archived_received_bookmarks

    var title = 'Bookmarks',
        href = '../bookmarks/',
        icon = 'bookmarks',
        options = { id: 'bookmarks' }

    if (num_bookmarks || num_new_received) {

        var descriptions = []
        if (num_bookmarks) descriptions.push(num_bookmarks + '\xa0total.')
        if (num_new_received) {
            descriptions.push(num_new_received + '\xa0new\xa0received.')
        }

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, descriptions.join(' '))
        }, href, icon, options)
        return

    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

}
;
function RenderCalculations (div, response) {

    var user = response.user

    var num_calculations = user.num_calculations
    var num_new_received = user.num_received_calculations -
        user.num_archived_received_calculations

    var title = 'Calculations',
        href = '../calculations/',
        icon = 'calculations',
        options = { id: 'calculations' }

    if (num_calculations || num_new_received) {

        var descriptions = []
        if (num_calculations) descriptions.push(num_calculations + '\xa0total.')
        if (num_new_received) {
            descriptions.push(num_new_received + '\xa0new\xa0received.')
        }

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, descriptions.join(' '))
        }, href, icon, options)
        return

    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

}
;
function RenderCalendar (div, response) {

    function n_events (n) {
        if (n == 1) return '1\xa0event'
        return n + '\xa0events'
    }

    var user = response.user

    var today = user.num_events_today +
        user.num_task_deadlines_today + user.num_birthdays_today

    var tomorrow = user.num_events_tomorrow +
        user.num_task_deadlines_tomorrow + user.num_birthdays_tomorrow

    ui.Element(div, 'a', function (a) {
        a.name = 'calendar'
    })
    ui.Element(div, 'a', function (a) {
        a.href = '../calendar/'
        a.id = 'calendar'
        a.className = 'clickable link thumbnail_link'
        ui.Element(a, 'span', function (span) {
            span.className = 'thumbnail_link-icon'
            create_calendar_icon_today(span, response)
        })
        ui.Element(a, 'span', function (span) {
            span.className = 'thumbnail_link-content'
            ui.Element(span, 'span', function (span) {
                span.className = 'thumbnail_link-title'
                ui.Text(span, 'Calendar')
            })
            if (today || tomorrow) {
                ui.ZeroHeightBr(span)
                ui.Element(span, 'span', function (span) {

                    span.className = 'thumbnail_link-description colorText grey'

                    if (today) {
                        ui.Element(span, 'span', function (span) {
                            span.className = 'colorText red'
                            ui.Text(span, n_events(today) + '\xa0today.')
                        })
                    }

                    if (tomorrow) {
                        var text = n_events(tomorrow) + '\xa0tomorrow.'
                        if (today) text = ' ' + text
                        ui.Text(span, text)
                    }

                })
            }
        })
    })

}
;
function RenderContacts (div, response) {

    var user = response.user

    var num_contacts = user.num_contacts
    var num_new_received = user.num_received_contacts -
        user.num_archived_received_contacts

    var title = 'Contacts',
        href = '../contacts/',
        icon = 'contacts',
        options = { id: 'contacts' }

    if (num_contacts || num_new_received) {

        var descriptions = []
        if (num_contacts) descriptions.push(num_contacts + '\xa0total.')
        if (num_new_received) {
            descriptions.push(num_new_received + '\xa0new\xa0received.')
        }

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, descriptions.join(' '))
        }, href, icon, options)
        return

    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

}
;
function RenderFiles (div, response) {

    var user = response.user

    var storage_used = user.storage_used
    var num_new_received = user.num_received_files +
        user.num_received_folders - user.num_archived_received_files -
        user.num_archived_received_folders

    var title = 'Files',
        href = '../files/',
        icon = 'files',
        options = { id: 'files' }

    if (num_new_received || storage_used) {

        var descriptions = []
        if (storage_used) {
            descriptions.push(bytestr(storage_used, '\xa0') + '\xa0used.')
        }
        if (num_new_received) {
            descriptions.push(num_new_received + '\xa0new\xa0received.')
        }

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, descriptions.join(' '))
        }, href, icon, options)
        return

    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

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
        '../wallets/quick-new-transaction/', 'create-transaction',
        { localNavigation: true })
}
;
function RenderNotes (div, response) {

    var user = response.user

    var num_notes = user.num_notes
    var num_new_received = user.num_received_notes -
        user.num_archived_received_notes

    var title = 'Notes',
        href = '../notes/',
        icon = 'notes',
        options = { id: 'notes' }

    if (num_notes || num_new_received) {

        var descriptions = []
        if (num_notes) descriptions.push(num_notes + '\xa0total.')
        if (num_new_received) {
            descriptions.push(num_new_received + '\xa0new\xa0received.')
        }

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, descriptions.join(' '))
        }, href, icon, options)
        return

    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

}
;
function RenderNotifications (div, response) {

    var user = response.user

    var num_notifications = user.num_notifications

    var title = 'Notifications',
        href = '../notifications/',
        options = { id: 'notifications' }

    if (num_notifications) {

        var num_new_notifications = user.num_new_notifications
        if (num_new_notifications) {
            ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
                ui.Element(span, 'span', function (span) {
                    span.className = 'colorText red'
                    ui.Text(span, num_new_notifications + '\xa0new.')
                })
                if (num_new_notifications !== num_notifications) {
                    ui.Text(span, ' ' + num_notifications + '\xa0total.')
                }
            }, href, 'notification', options)
            return
        }

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, num_notifications + ' total.')
        }, href, 'old-notification', options)
        return

    }

    ui.Page_thumbnailLink(div, title, href, 'old-notification', options)

}
;
function RenderPlaces (div, response) {

    var user = response.user

    var num_places = user.num_places
    var num_new_received = user.num_received_places -
        user.num_archived_received_places

    var title = 'Places',
        href = '../places/',
        icon = 'places',
        options = { id: 'places' }

    if (num_places || num_new_received) {

        var descriptions = []
        if (num_places) descriptions.push(num_places + '\xa0total.')
        if (num_new_received) {
            descriptions.push(num_new_received + '\xa0new\xa0received.')
        }

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, descriptions.join(' '))
        }, href, icon, options)
        return

    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

}
;
function RenderPostNotification (div) {
    ui.Page_thumbnailLink(div, 'Post a Notification',
        '../notifications/post/', 'create-notification')
}
;
function RenderSchedules (div, response) {

    var user = response.user

    var today = user.num_schedules_today
    var tomorrow = user.num_schedules_tomorrow
    var num_new_received = user.num_received_schedules -
        user.num_archived_received_schedules

    var title = 'Schedules',
        href = '../schedules/',
        icon = 'schedules',
        options = { id: 'schedules' }

    if (today || tomorrow || num_new_received) {
        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            if (today) {
                ui.Element(span, 'span', function (span) {
                    span.className = 'colorText red'
                    ui.Text(span, today + '\xa0today.')
                })
            }
            if (num_new_received) {
                var text = num_new_received + '\xa0new\xa0received.'
                if (today || tomorrow) text = ' ' + text
                if (tomorrow) {
                    text = tomorrow + '\xa0tomorrow.' + text
                    if (today) text = '\xa0' + text
                }
                ui.Text(span, text)
            } else {
                if (tomorrow) {
                    var text = tomorrow + '\xa0tomorrow.'
                    if (today) text = ' ' + text
                    ui.Text(span, text)
                }
            }
        }, href, icon, options)
        return
    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

}
;
function RenderTasks (div, response) {

    var user = response.user

    var num_tasks = user.num_tasks
    var num_new_received = user.num_received_tasks -
        user.num_archived_received_tasks

    var title = 'Tasks',
        href = '../tasks/',
        icon = 'tasks',
        options = { id: 'tasks' }

    if (num_tasks || num_new_received) {

        var descriptions = []
        if (num_tasks) descriptions.push(num_tasks + '\xa0total.')
        if (num_new_received) {
            descriptions.push(num_new_received + '\xa0new\xa0received.')
        }

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, descriptions.join(' '))
        }, href, icon, options)
        return

    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

}
;
function RenderTransferAmount (div) {
    ui.Page_thumbnailLink(div, 'Transfer Amount',
        '../wallets/quick-transfer-amount/', 'transfer-amount',
        { localNavigation: true })
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

    var title = 'Wallets',
        href = '../wallets/',
        icon = 'wallets',
        options = { id: 'wallets' }

    if (balance_total) {
        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, amount_text(balance_total) + ' balance.')
        }, href, icon, options)
        return
    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

}
;
(function (localNavigation, ui) {
    localNavigation.registerPage('home/', function (response, loadCallback) {

        loadCallback('Home')

        var base = '../'

        var scripts = []
        if (response.home.calendar !== undefined) {
            scripts.push(ui.compressed_js_script('searchForm', base))
        }

        ui.page(response, base, function (body) {
            ui.Page_emptyTabs(body, function (div) {
                ui.Page_sessionMessages(div, response.messages)
                ui.Page_sessionWarnings(div, response.warnings)
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
            scripts: scripts,
            head: function (head) {
                if (response.home.calendar !== undefined) {
                    ui.compressed_css_link(head, 'calendarIcon', base)
                }
            },
        })

        localNavigation.scanLinks()
        localNavigation.focusTarget()

    })
})(localNavigation, ui)
;

})()