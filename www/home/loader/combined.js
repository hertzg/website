(function () {
function HomeItems (response) {

    var items = []

    var renderers = {
        'bar-charts': RenderBarCharts,
        'new-bar-chart': RenderNewBarChart,
    }

    var home = response.home
    for (var key in home) items.push(function (div) {
        renderers[key](div, response)
    })

    return items
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
function RenderNewBarChart (div, response) {
    ui.Page_thumbnailLink(div, 'New Bar Chart',
        '../bar-charts/new/', 'create-bar-chart')
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