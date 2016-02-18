(function (localNavigation, ui) {

    function loader (response, loadCallback) {

        var item = response.item

        var key = item.key,
            title = item.title

        loadCallback('Move "' + title + '"')

        ui.user_page(response, '../../../../', function (body) {
            ui.Page_create(body, {
                title: 'Reorder Items',
                href: '../#' + key,
            }, 'Move Item', function (div) {
                ui.Page_text(div, function (div) {
                    ui.Text(div, 'Where would you like to move "')
                    ui.Element(div, 'b', function (b) {
                        ui.Text(b, title)
                    })
                    ui.Text(div, '"?')
                })
                ui.Hr(div)
                ui.Page_imageLink(div, function (div) {
                    ui.Text(div, 'Move to the Top')
                }, 'submit-to-top.php?key=' + key, 'move-to-top')
                ui.Hr(div)
                ui.Page_imageLink(div, function (div) {
                    ui.Text(div, 'Move Up')
                }, 'submit-up.php?key=' + key, 'move-up')
                ui.Hr(div)
                ui.Page_imageLink(div, function (div) {
                    ui.Text(div, 'Move Down')
                }, 'submit-down.php?key=' + key, 'move-down')
                ui.Hr(div)
                ui.Page_imageLink(div, function (div) {
                    ui.Text(div, 'Move to the Bottom')
                }, 'submit-to-bottom.php?key=' + key, 'move-to-bottom')
            })
        })

        localNavigation.scanLinks()

    }

    localNavigation.registerPage('home/customize/reorder/move/', loader)

})(localNavigation, ui)
