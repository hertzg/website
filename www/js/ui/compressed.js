!function(){function n(n,a,e,t,o){var c="css/"+e+"/compressed.css";i(n,"link",function(n){n.rel="stylesheet",n.type="text/css",n.href=t+c+"?"+a[c],void 0!==o&&(n.className=o)})}function a(n,a,e,t,o){var c="js/"+e+"/compressed.js";i(n,"script",function(n){n.type="text/javascript",n.defer=!0,n.src=t+c+"?"+a[c],void 0!==o&&(n.className=o)})}function i(n,a,i){var e=document.createElement(a);n.appendChild(e),i(e)}function e(n,a,i){q(n,null,a,i)}function t(n){var a=document.createElement("div");a.className="hr",n.appendChild(a)}function o(n,a,i,e){a&&(void 0===e&&(e={}),e.logoHref=i+"home/"),q(n,a,i,e)}function c(n,a){n.appendChild(document.createTextNode(a))}function s(n,a,e){i(n,"span",function(n){n.className="title_and_description",i(n,"span",function(n){n.className="title_and_description-title",c(n,a)}),l(n),i(n,"span",function(n){n.className="title_and_description-description colorText grey",c(n,e)})})}function l(n){i(n,"br",function(n){n.className="zeroHeight"})}function u(n,a,e){i(n,"div",function(n){n.className="form-item",
i(n,"div",function(n){n.className="form-property",e(n)}),i(n,"div",function(n){n.className="form-value",a(n)})})}function r(n,a,e){i(n,"input",function(n){n.className="clickable form-button",n.type="submit",n.value=a,void 0!==e&&(n.name=e)})}function f(n,a,e){void 0===e&&(e=!1),i(n,"div",function(n){n.className="form-captcha",i(n,"img",function(n){n.alt="CAPTCHA",n.className="form-captcha-image",n.src=a+"captcha/"})}),g(n,"captcha","Verification",{required:!0,autofocus:e}),v(n,["Enter the characters shown on the image above.","This proves that you are a human and not a robot."]),t(n)}function m(n,a,e,t){i(n,"div",function(n){n.className="form-checkbox transformable",i(n,"label",function(n){n.className="form-checkbox-label clickable",i(n,"span",function(n){n.className="form-checkbox-inputWrapper",i(n,"input",function(n){n.className="form-checkbox-input",n.type="checkbox",n.id=n.name=a,t===!0&&(n.checked=!0)})}),c(n,e)})})}function d(n,a,e){i(n,"input",function(n){n.type="hidden",n.name=a,n.value=e})}function v(n,a){
u(n,function(n){i(n,"ul",function(n){n.className="form-notes",a.forEach(function(a){i(n,"li",function(n){n.className="form-notes-item",i(n,"span",function(n){n.className="form-notes-item-bullet"}),c(n,a)})})})},function(){})}function p(n,a,i,e){e.type="password",g(n,a,i,e)}function N(n,a,e,t){u(n,function(n){i(n,"textarea",function(n){var i=t.value;void 0!==i&&""!==i&&(n.value=i);var e=t.maxlength;void 0!==e&&(n.maxLength=e);var o=t.autofocus;o===!0&&(n.autofocus=o,n.focus());var c=t.readonly;void 0!==c&&(n.readOnly=c);var s=t.required;void 0!==s&&(n.required=s),n.className="form-textarea",n.id=n.name=a})},function(n){i(n,"label",function(n){n.className="form-property-label",n.htmlFor=a,c(n,e+":")})})}function g(n,a,e,t){u(n,function(n){i(n,"input",function(n){var i=t.type;void 0===i&&(i="text");var e=t.value;void 0!==e&&""!==e&&(n.value=e);var o=t.maxlength;void 0!==o&&(n.maxLength=o);var c=t.autofocus;c===!0&&(n.autofocus=c,n.focus());var s=t.readonly;void 0!==s&&(n.readOnly=s);var l=t.required;void 0!==l&&(n.required=l),
n.type=i,n.className="form-textfield",n.id=n.name=a})},function(n){i(n,"label",function(n){n.className="form-property-label",n.htmlFor=a,c(n,e+":")})})}function h(n,a,e,t){l(n),i(n,"div",function(n){n.className="tab",i(n,"div",function(n){n.className="tab-bar",i(n,"a",function(n){n.className="clickable tab-normal localNavigation-link",n.href=a.href,c(n,"« "+a.title)}),i(n,"span",function(n){n.className="tab-active limited",i(n,"span",function(n){n.className="zeroSize",c(n," » ")}),c(n,e)})})}),l(n),i(n,"div",function(n){n.className="tab-content",t(n)})}function b(n,a){l(n),i(n,"div",function(n){n.className="tab-content",a(n)})}function _(n,a){z(n,a,"errors")}function k(n,a,i,e,t,o){t.className="withArrow",y(n,a,i,e,t,o)}function x(n,a,i,e,t,o,c){void 0===o&&(o={}),o.className="withArrow",y(n,function(n){s(n,a,i)},e,t,o,c)}function y(n,a,e,t,o){i(n,"a",function(n){n.name=o.id}),i(n,"a",function(n){var s,l=o.className;s=void 0===l?"":" "+l,void 0!==o.localNavigation&&(s+=" localNavigation-link"),n.id=o.id,n.className="clickable link image_link"+s,
n.href=e,i(n,"span",function(n){n.className="image_link-icon",i(n,"span",function(n){n.className="icon "+t})}),i(n,"span",function(n){n.className="image_link-content","string"==typeof a?c(n,a):a(n)})})}function w(n,a){i(n,"div",function(n){n.className="page-infoText",a(n)})}function L(n,a){z(n,a,"messages")}function P(n,a,e){l(n),i(n,"div",function(n){n.className="panel",i(n,"div",function(n){n.className="panel-title",i(n,"div",function(n){n.className="panel-title-text",c(n,a),i(n,"span",function(n){n.className="zeroSize",c(n,":")})})}),i(n,"div",function(n){n.className="panel-content",e(n)})})}function T(n,a){w(n,function(n){c(n,'You are accessing "'),i(n,"code",function(n){c(n,a)}),c(n,"\". The address in your browser's address bar should start with it.")})}function C(n,a){void 0!==a&&_(n,a)}function F(n,a){void 0!==a&&L(n,a)}function z(n,a,e){i(n,"div",function(n){n.className="textList "+e,i(n,"ul",function(n){n.className="textList-list",1===a.length?i(n,"li",function(n){n.className="textList-list-item",n.innerHTML=a[0];
}):a.forEach(function(a){i(n,"li",function(n){n.className="textList-list-item",i(n,"span",function(n){n.className="textList-list-item-bullet "+e}),n.innerHTML+=a})})})})}function H(n,a,e){l(n),i(n,"div",function(n){n.className="tab",i(n,"div",function(n){n.className="tab-bar",i(n,"span",function(n){n.className="tab-active limited",i(n,"span",function(n){n.className="zeroSize",c(n," » ")}),c(n,a)})})}),l(n),i(n,"div",function(n){n.className="tab-content",e(n)})}function A(n,a,e){i(n,"div",function(n){n.className="twoColumns",i(n,"div",function(n){n.className="twoColumns-column1 dynamic",a(n)}),i(n,"div",function(n){n.className="twoColumns-column2 dynamic",e(n)})})}function E(n,a){z(n,a,"warnings")}var q=function(n,e){return function(t,o,s,l){void 0===l&&(l={});var u;u=o?o.theme_color:n,i(t,"div",function(n){n.id="tbar",i(n,"div",function(n){n.id="tbar-limit",i(n,"a",function(n){var a=l.logoHref;void 0===a&&(a=s),n.className="topLink logoLink",n.href=a,i(n,"img",function(n){var a="theme/color/"+u+"/images/zvini.svg";
n.alt="Zvini",n.className="logoLink-img",n.src=s+a+"?"+e[a]})}),i(n,"div",function(n){n.className="page-clockWrapper"}),o&&i(n,"div",function(n){n.className="pageTopRightLinks",i(n,"a",function(n){n.id="signOutLink",n.className="topLink",n.href=s+"sign-out/",c(n,"Sign Out")})})}),a(n,e,"batteryAndClock",s),a(n,e,"lineSizeRounding",s)})}}(defaultThemeColor,revisions);window.ui={compressed_css_link:n,compressed_js_script:a,Element:i,Form_button:r,Form_captcha:f,Form_checkbox:m,Form_hidden:d,Form_notes:v,Form_password:p,Form_textarea:N,Form_textfield:g,guest_page:e,Hr:t,page:q,Page_create:h,Page_emptyTabs:b,Page_imageArrowLink:k,Page_imageArrowLinkWithDescription:x,Page_imageLink:y,Page_infoText:w,Page_panel:P,Page_phishingWarning:T,Page_sessionErrors:C,Page_sessionMessages:F,Page_textList:z,Page_title:H,Page_twoColumns:A,Page_warnings:E,public_page:o,Text:c,ZeroHeightBr:l}}();