function HomeItems (response) {

    var items = []

    var renderers = {
        'bar-charts': RenderBarChart,
    }

    var home = response.home
    for (var key in home) items.push(renderers[key](response))

    return items
}
