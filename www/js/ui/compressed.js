!function(){function n(n,a,i){function e(n,a){var i=Math.floor((a-n)/1e3),e=Math.floor(i/60);if(!e)return"just now";if(1>=e)return"a minute ago";if(30==e)return"half an hour ago";var t=Math.floor(e/60);if(!t)return e+" minutes ago";if(1==t)return"an hour ago";var o=Math.floor(t/24);if(!o)return t+" hours ago";if(1==o)return"yesterday";var c=Math.floor(o/7);if(!c)return o+" days ago";if(1==c)return"a week ago";var s=Math.floor(o/30);if(!s)return c+" weeks ago";if(1==s)return"a month ago";var r=Math.floor(s/12);return r?1==r?"a year ago":r+" years ago":s+" months ago"}var t=e(n,a);return i&&(t=t.substr(0,1).toUpperCase()+t.substr(1)),t}function a(n,a,i,e){void 0===e&&(e={}),e.logoHref=a,void 0!==n.user&&(e.logoHref+="../home/",e.localNavigation=!0),D(n,a+"../",i,e)}function i(n,a,i,e,o){var c="css/"+i+"/compressed.css";t(n,"link",function(n){n.rel="stylesheet",n.type="text/css",n.href=e+c+"?"+a[c],void 0!==o&&(n.className=o)})}function e(n,a,i,e,o){var c="js/"+i+"/compressed.js";t(n,"script",function(n){n.type="text/javascript",
n.defer=!0,n.src=e+c+"?"+a[c],void 0!==o&&(n.className=o)})}function t(n,a,i){var e=document.createElement(a);n.appendChild(e),i(e)}function o(a,i,e,o){t(a,"span",function(a){a.className="dateAgo",a.dataset.time=e,o===!0&&(a.dataset.uppercase="1"),u(a,n(1e3*e,i,o))})}function c(n,a,i,e){D(n,a,i,e)}function s(n){var a=document.createElement("div");a.className="hr",n.appendChild(a)}function r(n,a,i,e){void 0!==n.user&&(void 0===e&&(e={}),e.logoHref=a+"home/"),D(n,a,i,e)}function u(n,a){n.appendChild(document.createTextNode(a))}function l(n,a,i){t(n,"span",function(n){n.className="title_and_description",t(n,"span",function(n){n.className="title_and_description-title",a(n)}),f(n),t(n,"span",function(n){n.className="title_and_description-description colorText grey",i(n)})})}function f(n){t(n,"br",function(n){n.className="zeroHeight"})}function m(n,a,i){t(n,"div",function(n){n.className="form-item",t(n,"div",function(n){n.className="form-property",i(n)}),t(n,"div",function(n){n.className="form-value",a(n)})})}function d(n,a,i){
t(n,"input",function(n){n.className="clickable form-button",n.type="submit",n.value=a,void 0!==i&&(n.name=i)})}function v(n,a,i,e){a.captchaRequired===!0&&(void 0===e&&(e=!1),t(n,"div",function(n){n.className="form-captcha",t(n,"img",function(n){n.alt="CAPTCHA",n.className="form-captcha-image",n.src=i+"captcha/"})}),w(n,"captcha","Verification",{required:!0,autofocus:e}),N(n,["Enter the characters shown on the image above.","This proves that you are a human and not a robot."]),s(n))}function p(n,a,i,e){t(n,"div",function(n){n.className="form-checkbox transformable",t(n,"label",function(n){n.className="form-checkbox-label clickable",t(n,"span",function(n){n.className="form-checkbox-inputWrapper",t(n,"input",function(n){n.className="form-checkbox-input",n.type="checkbox",n.id=n.name=a,e===!0&&(n.checked=!0)})}),u(n,i)})})}function g(n,a,i){t(n,"input",function(n){n.type="hidden",n.name=a,n.value=i})}function h(n,a,i){m(n,function(n){t(n,"div",function(n){n.className="form-label",i(n)})},function(n){t(n,"div",function(n){
u(n,a+":")})})}function N(n,a){m(n,function(n){t(n,"ul",function(n){n.className="form-notes",a.forEach(function(a){t(n,"li",function(n){n.className="form-notes-item",t(n,"span",function(n){n.className="form-notes-item-bullet"}),u(n,a)})})})},function(){})}function b(n,a,i,e){e.type="password",w(n,a,i,e)}function _(n,a,i,e){m(n,function(n){t(n,"textarea",function(n){var i=e.value;void 0!==i&&""!==i&&(n.value=i);var t=e.maxlength;void 0!==t&&(n.maxLength=t);var o=e.autofocus;o===!0&&(n.autofocus=o,n.focus());var c=e.readonly;void 0!==c&&(n.readOnly=c);var s=e.required;void 0!==s&&(n.required=s),n.className="form-textarea",n.id=n.name=a})},function(n){t(n,"label",function(n){n.className="form-property-label",n.htmlFor=a,u(n,i+":")})})}function w(n,a,i,e){m(n,function(n){t(n,"input",function(n){var i=e.type;void 0===i&&(i="text");var t=e.value;void 0!==t&&""!==t&&(n.value=t);var o=e.maxlength;void 0!==o&&(n.maxLength=o);var c=e.autofocus;c===!0&&(n.autofocus=c,n.focus());var s=e.readonly;void 0!==s&&(n.readOnly=s);
var r=e.required;void 0!==r&&(n.required=r),n.type=i,n.className="form-textfield",n.id=n.name=a})},function(n){t(n,"label",function(n){n.className="form-property-label",n.htmlFor=a,u(n,i+":")})})}function k(n,a,i,e){f(n),t(n,"div",function(n){n.className="tab",t(n,"div",function(n){n.className="tab-bar",t(n,"a",function(n){n.className="clickable tab-normal localNavigation-link",n.href=a.href,u(n,"« "+a.title)}),t(n,"span",function(n){n.className="tab-active limited",t(n,"span",function(n){n.className="zeroSize",u(n," » ")}),u(n,i)})})}),f(n),t(n,"div",function(n){n.className="tab-content",e(n)})}function x(n,a){f(n),t(n,"div",function(n){n.className="tab-content",a(n)})}function y(n,a){W(n,a,"errors")}function L(n,a,i,e,t){t.className="withArrow",T(n,a,i,e,t)}function P(n,a,i,e,t,o){void 0===o&&(o={}),o.className="withArrow",C(n,a,i,e,t,o)}function T(n,a,i,e,o){void 0===o&&(o={});var c=o.id;void 0!==c&&t(n,"a",function(n){n.name=c}),t(n,"a",function(n){var s,r=o.className;s=void 0===r?"":" "+r,void 0!==o.localNavigation&&(s+=" localNavigation-link"),
void 0!==c&&(n.id=c),n.className="clickable link image_link"+s,n.href=i,t(n,"span",function(n){n.className="image_link-icon",t(n,"span",function(n){n.className="icon "+e})}),t(n,"span",function(n){n.className="image_link-content",a(n)})})}function C(n,a,i,e,t,o){T(n,function(n){l(n,a,i)},e,t,o)}function z(n,a){t(n,"div",function(n){n.className="page-infoText",a(n)})}function F(n,a){W(n,a,"messages")}function H(n,a,i){f(n),t(n,"div",function(n){n.className="panel",t(n,"div",function(n){n.className="panel-title",t(n,"div",function(n){n.className="panel-title-text",u(n,a),t(n,"span",function(n){n.className="zeroSize",u(n,":")})})}),t(n,"div",function(n){n.className="panel-content",i(n)})})}function M(n,a){z(n,function(n){u(n,'You are accessing "'),t(n,"code",function(n){u(n,a)}),u(n,"\". The address in your browser's address bar should start with it.")})}function A(n,a,i){void 0!==a&&(void 0!==i&&a.forEach(function(n,e){a[e]=i[a]}),y(n,a))}function E(n,a){void 0!==a&&F(n,a)}function O(n,a){t(n,"div",function(n){n.className="page-text",
a(n)})}function W(n,a,i){t(n,"div",function(n){n.className="textList "+i,t(n,"ul",function(n){n.className="textList-list",1===a.length?t(n,"li",function(n){n.className="textList-list-item",n.innerHTML=a[0]}):a.forEach(function(a){t(n,"li",function(n){n.className="textList-list-item",t(n,"span",function(n){n.className="textList-list-item-bullet "+i}),n.innerHTML+=a})})})})}function q(n,a,i){f(n),t(n,"div",function(n){n.className="tab",t(n,"div",function(n){n.className="tab-bar",t(n,"span",function(n){n.className="tab-active",t(n,"span",function(n){n.className="zeroSize",u(n," » ")}),u(n,a)})})}),f(n),t(n,"div",function(n){n.className="tab-content",i(n)})}function j(n,a,i){t(n,"div",function(n){n.className="twoColumns",t(n,"div",function(n){n.className="twoColumns-column1 dynamic",a(n)}),t(n,"div",function(n){n.className="twoColumns-column2 dynamic",i(n)})})}function S(n,a){W(n,a,"warnings")}var D=function(n,a){return function(o,c,s,r){void 0===r&&(r={});var l=o.user;window.base=c,window.time=o.time,window.timezone=o.timezone,
n.onUnload(function(){delete window.base,delete window.time,delete window.timezone}),l&&i(document.head,a,"confirmDialog",c);var f=document.body;t(f,"div",function(n){n.id="tbar",t(n,"div",function(n){n.id="tbar-limit",t(n,"a",function(n){var i=r.logoHref,e="topLink logoLink";void 0===i&&(i=c,e+=" localNavigation-link"),n.href=i,n.className=e,t(n,"img",function(n){var i="theme/color/"+o.themeColor+"/images/zvini.svg";n.alt="Zvini",n.className="logoLink-img",n.src=c+i+"?"+a[i]})}),t(n,"div",function(n){n.className="page-clockWrapper",t(n,"div",function(n){n.id="staticClockWrapper"}),t(n,"div",function(n){n.id="batteryWrapper"}),t(n,"div",function(n){n.id="dynamicClockWrapper"})}),l&&t(n,"div",function(n){n.className="pageTopRightLinks",t(n,"a",function(n){n.id="signOutLink",n.className="topLink",n.href=c+"sign-out/",u(n,"Sign Out")})})}),s(f)}),e(f,a,"batteryAndClock",c),e(f,a,"lineSizeRounding",c),l&&(e(f,a,"confirmDialog",c),window.signOutTimeout=o.signOutTimeout,n.onUnload(function(){delete window.signOutTimeout;
}),e(f,a,"signOutConfirm",c),o.session_remembered!==!0&&e(f,a,"sessionTimeout",c));var m=r.scripts;void 0!==m&&m(f)}}(localNavigation,revisions);window.ui={admin_page:a,compressed_css_link:i,compressed_js_script:e,Element:t,export_date_ago:o,Form_button:d,Form_captcha:v,Form_checkbox:p,Form_hidden:g,Form_label:h,Form_notes:N,Form_password:b,Form_textarea:_,Form_textfield:w,guest_page:c,Hr:s,page:D,Page_create:k,Page_emptyTabs:x,Page_errors:y,Page_imageArrowLink:L,Page_imageArrowLinkWithDescription:P,Page_imageLink:T,Page_imageLinkWithDescription:C,Page_infoText:z,Page_panel:H,Page_phishingWarning:M,Page_sessionErrors:A,Page_sessionMessages:E,Page_text:O,Page_title:q,Page_twoColumns:j,Page_warnings:S,public_page:r,Text:u,ZeroHeightBr:f}}();