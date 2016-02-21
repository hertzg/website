function Page_sessionErrors (parentNode, errors, values) {
    if (errors === undefined) return
    if (values !== undefined) {
        errors.forEach(function (error, index) {
            errors[index] = values[error]
        })
    }
    Page_errors(parentNode, errors)
}
