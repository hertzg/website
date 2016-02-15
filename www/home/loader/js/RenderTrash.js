function RenderTrash (div, response) {

    var num_deleted_items = response.user.num_deleted_items

    var description
    if (num_deleted_items) description = num_deleted_items + ' total.'
    else description = 'Empty'

    ui.Page_thumbnailLinkWithDescription(div, 'Trash', function (span) {
        ui.Text(span, description)
    }, '../trash/', 'trash-bin', { id: 'trash' })

}
