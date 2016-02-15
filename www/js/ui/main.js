(function (revisions) {

    var compressed_css_link = CompressedCssLink(revisions),
        compressed_js_script = CompressedJsScript(revisions),
        page = Page(localNavigation, revisions,
            compressed_css_link, compressed_js_script)

    window.ui = {
        admin_page: AdminPage(page),
        compressed_css_link: compressed_css_link,
        compressed_js_script: compressed_js_script,
        Element: Element,
        export_date_ago: export_date_ago,
        Form_button: Form_button,
        Form_captcha: Form_captcha,
        Form_checkbox: Form_checkbox,
        Form_checkboxItem: Form_checkboxItem,
        Form_hidden: Form_hidden,
        Form_label: Form_label,
        Form_notes: Form_notes,
        Form_password: Form_password,
        Form_select: Form_select,
        Form_textarea: Form_textarea,
        Form_textfield: Form_textfield,
        guest_page: GuestPage(page),
        Hr: Hr,
        ItemList_listUrl: ItemList_listUrl,
        ItemList_pageHiddenInputs: ItemList_pageHiddenInputs,
        page: page,
        Page_create: Page_create,
        Page_emptyTabs: Page_emptyTabs,
        Page_errors: Page_errors,
        Page_imageArrowLink: Page_imageArrowLink,
        Page_imageArrowLinkWithDescription: Page_imageArrowLinkWithDescription,
        Page_imageLink: Page_imageLink,
        Page_imageLinkWithDescription: Page_imageLinkWithDescription,
        Page_infoText: Page_infoText,
        Page_panel: Page_panel,
        Page_phishingWarning: Page_phishingWarning,
        Page_sessionErrors: Page_sessionErrors,
        Page_sessionMessages: Page_sessionMessages,
        Page_text: Page_text,
        Page_thumbnailLink: Page_thumbnailLink,
        Page_thumbnailLinkWithDescription: Page_thumbnailLinkWithDescription,
        Page_thumbnails: Page_thumbnails,
        Page_title: Page_title,
        Page_twoColumns: Page_twoColumns,
        Page_warnings: Page_warnings,
        public_page: PublicPage(page),
        SearchForm_create: SearchForm_create,
        SearchForm_emptyContent: SearchForm_emptyContent,
        Text: Text,
        ZeroHeightBr: ZeroHeightBr,
    }
})(revisions)
