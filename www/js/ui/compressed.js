!function(){function n(n,a){ui.Element(n,"span",function(n){n.className="icon calendar",ui.Element(n,"span",function(n){n.className="calendarIcon-day calendarIcon-today",ui.Text(n,new Date(a.time).getUTCDate())})})}function a(n,a,e){function i(n,a){var e=Math.floor((a-n)/1e3),i=Math.floor(e/60);if(!i)return"just now";if(1>=i)return"a minute ago";if(30==i)return"half an hour ago";var t=Math.floor(i/60);if(!t)return i+" minutes ago";if(1==t)return"an hour ago";var o=Math.floor(t/24);if(!o)return t+" hours ago";if(1==o)return"yesterday";var c=Math.floor(o/7);if(!c)return o+" days ago";if(1==c)return"a week ago";var s=Math.floor(o/30);if(!s)return c+" weeks ago";if(1==s)return"a month ago";var r=Math.floor(s/12);return r?1==r?"a year ago":r+" years ago":s+" months ago"}var t=i(n,a);return e&&(t=t.substr(0,1).toUpperCase()+t.substr(1)),t}function e(n,a,e){var i=document.createElement("script");return i.type="text/javascript",i.src=n,i.onload=a,i.onerror=e,document.body.appendChild(i),{abort:function(){i.onload=i.onerror=null;
}}}function i(n){return function(a,e,i,t){void 0===t&&(t={}),t.logoHref=e,void 0!==a.user&&(t.logoHref+="../home/",t.localNavigation=!0),n(a,e+"../",i,t)}}function t(n){return n.map(function(n){return encodeURIComponent(n.key)+"="+encodeURIComponent(n.value)}).join("=")}function o(n){return function(a,e,i,t){var o="css/"+e+"/compressed.css";r(a,"link",function(a){a.rel="stylesheet",a.type="text/css",a.href=i+o+"?"+n[o],void 0!==t&&(a.className=t)})}}function c(n){return function(a,e){var i="js/"+a+"/compressed.js";return e+i+"?"+n[i]}}function s(n,a,e,i,t){void 0===t&&(t={});var o=t.id;void 0!==o&&r(n,"a",function(n){n.name=o}),r(n,"a",function(n){var c,s=t.className;c=void 0===s?"":" "+s,void 0!==t.localNavigation&&(c+=" localNavigation-link"),void 0!==o&&(n.id=o),n.className="clickable link thumbnail_link"+c,n.href=e,r(n,"span",function(n){n.className="thumbnail_link-icon",r(n,"span",function(n){n.className="icon "+i})}),r(n,"span",function(n){n.className="thumbnail_link-content",a(n)})})}function r(n,a,e){var i=document.createElement(a);
n.appendChild(i),e(i)}function u(n,e,i,t){r(n,"span",function(n){n.className="dateAgo",n.dataset.time=i,t===!0&&(n.dataset.uppercase="1"),p(n,a(1e3*i,e,t))})}function l(n){return function(a,e,i,t){n(a,e,i,t)}}function f(n){var a=document.createElement("div");a.className="hr",n.appendChild(a)}function m(n,a){function i(){if(0===n.length)return t=null,void a();var o=n.shift();t=e(o,i,i)}var t=null;return i(),{abort:function(){t.abort(),t=null}}}function d(n,a,e,i){var t=document.head,o=document.body;return function(c,s,u,l){void 0===l&&(l={});var f=c.user;window.base=s,window.time=c.time,window.timezone=c.timezone,n.onUnload(function(){delete window.base,delete window.time,delete window.timezone});var d=l.head;void 0!==d&&d(t),f&&e(t,"confirmDialog",s),r(o,"div",function(n){n.id="tbar",r(n,"div",function(n){n.id="tbar-limit",r(n,"a",function(n){var e=l.logoHref;void 0===e&&(e=""===s?"./":s),n.href=e,n.className="topLink logoLink localNavigation-link",r(n,"img",function(n){var e="theme/color/"+c.themeColor+"/images/zvini.svg";
n.alt="Zvini",n.className="logoLink-img",n.src=s+e+"?"+a[e]})}),r(n,"div",function(n){n.className="page-clockWrapper",r(n,"div",function(n){n.id="staticClockWrapper"}),r(n,"div",function(n){n.id="batteryWrapper"}),r(n,"div",function(n){n.id="dynamicClockWrapper"})}),f&&r(n,"div",function(n){n.className="pageTopRightLinks",r(n,"a",function(n){n.id="signOutLink",n.className="topLink",n.href=s+"sign-out/",p(n,"Sign Out")})})}),u(o)});var v=[i("batteryAndClock",s)];f&&(window.signOutTimeout=c.signOutTimeout,n.onUnload(function(){delete window.signOutTimeout}),v.push(i("confirmDialog",s)),v.push(i("signOutConfirm",s)),c.session_remembered!==!0&&v.push(i("sessionTimeout",s)));var h=l.scripts;void 0!==h&&v.push.apply(v,h);var g=m(v,function(){n.unUnload(g.abort)});n.onUnload(g.abort)}}function v(n){return function(a,e,i,t){void 0!==a.user&&(void 0===t&&(t={}),t.logoHref=e+"home/"),n(a,e,i,t)}}function p(n,a){n.appendChild(document.createTextNode(a))}function h(n,a,e){r(n,"span",function(n){n.className="title_and_description",
r(n,"span",function(n){n.className="title_and_description-title",a(n)}),N(n,"span"),r(n,"span",function(n){n.className="title_and_description-description colorText grey",e(n)})})}function g(n){return function(a,e,i,t){void 0===t&&(t={}),t.logoHref=e+"home/",n(a,e,i,t)}}function N(n,a){r(n,a,function(n){n.className="zeroHeight",r(n,"br",function(n){n.className="zeroHeight"})})}function b(n,a,e){r(n,"div",function(n){n.className="form-item",r(n,"div",function(n){n.className="form-property",e(n)}),r(n,"div",function(n){n.className="form-value",a(n)})})}function _(n,a,e){var i=void 0===e?"green":"not_green";r(n,"div",function(n){n.className="form-button "+i,r(n,"input",function(n){n.className="form-button-button "+i,n.type="submit",n.value=a,void 0!==e&&(n.name=e)})})}function k(n,a,e,i){a.captchaRequired===!0&&(void 0===i&&(i=!1),r(n,"div",function(n){n.className="form-captcha",r(n,"img",function(n){n.alt="CAPTCHA",n.className="form-captcha-image",n.src=e+"captcha/"})}),F(n,"captcha","Verification",{required:!0,autofocus:i
}),T(n,["Enter the characters shown on the image above.","This proves that you are a human and not a robot."]))}function y(n,a,e,i){r(n,"div",function(n){n.className="form-checkbox transformable",r(n,"label",function(n){n.className="form-checkbox-label clickable",r(n,"span",function(n){n.className="form-checkbox-inputWrapper",r(n,"input",function(n){n.className="form-checkbox-input",n.type="checkbox",n.id=n.name=a,i===!0&&(n.checked=!0)})}),p(n,e)})})}function w(n,a,e,i){r(n,"div",function(n){n.className="form-checkbox item transformable",r(n,"label",function(n){n.className="form-checkbox-label clickable",r(n,"span",function(n){n.className="form-checkbox-inputWrapper",r(n,"input",function(n){n.className="form-checkbox-input",n.type="checkbox",n.id=n.name=a,i===!0&&(n.checked=!0)})}),p(n,e)})})}function x(n,a,e){r(n,"input",function(n){n.type="hidden",n.name=a,n.value=e})}function L(n,a,e){b(n,function(n){r(n,"div",function(n){n.className="form-label",e(n)})},function(n){r(n,"div",function(n){p(n,a+":")})})}function T(n,a){
b(n,function(n){r(n,"ul",function(n){n.className="form-notes",a.forEach(function(a){r(n,"li",function(n){n.className="form-notes-item",r(n,"span",function(n){n.className="form-notes-item-bullet"}),p(n,a)})})})},function(){})}function P(n,a,e,i){i.type="password",F(n,a,e,i)}function C(n,a,e,i,t,o){b(n,function(n){r(n,"select",function(n){n.className="form-select",n.name=n.id=a,i.forEach(function(a){ui.Element(n,"option",function(n){n.value=a.key,ui.Text(n,a.value),String(t)===a.key&&(n.selected=!0)})}),o===!0&&(n.autofocus=!0,n.focus())})},function(n){r(n,"label",function(n){n.className="form-property-label",n.htmlFor=a,ui.Text(n,e+":")})})}function E(n,a,e,i){b(n,function(n){r(n,"textarea",function(n){var e=i.value;void 0!==e&&""!==e&&(n.value=e);var t=i.maxlength;void 0!==t&&(n.maxLength=t);var o=i.autofocus;o===!0&&(n.autofocus=!0,n.focus());var c=i.readonly;void 0!==c&&(n.readOnly=c);var s=i.required;void 0!==s&&(n.required=s),n.className="form-textarea",n.id=n.name=a})},function(n){r(n,"label",function(n){
n.className="form-property-label",n.htmlFor=a,p(n,e+":")})})}function F(n,a,e,i){b(n,function(n){r(n,"input",function(n){var e=i.type;void 0===e&&(e="text");var t=i.value;void 0!==t&&""!==t&&(n.value=t);var o=i.maxlength;void 0!==o&&(n.maxLength=o);var c=i.autofocus;c===!0&&(n.autofocus=!0,n.focus());var s=i.readonly;void 0!==s&&(n.readOnly=s);var r=i.required;void 0!==r&&(n.required=r),n.type=e,n.className="form-textfield",n.id=n.name=a})},function(n){r(n,"label",function(n){n.className="form-property-label",n.htmlFor=a,p(n,e+":")})})}function H(n,a,e){void 0===a&&(a="../"),void 0===e&&(e=[]);var i=a,o=n.keyword;void 0!==o&&(i+="search/",e.push({key:"keyword",value:o}));var c=n.tag;void 0!==c&&e.push({key:"tag",value:c});var s=n.offset;return void 0!==s&&e.push({key:"offset",value:s}),e.length&&(i+="?"+t(e)),i}function z(n,a,e){void 0===e&&(e=[]),a.concat(e).forEach(function(a){x(n,a.key,a.value)})}function W(a,e,i){ui.Element(a,"a",function(n){n.name="calendar"}),ui.Element(a,"a",function(a){a.id="calendar",
a.href=i,a.className="clickable link image_link withArrow localNavigation-link",ui.Element(a,"span",function(a){a.className="image_link-icon",n(a,e)}),ui.Element(a,"span",function(n){n.className="image_link-content",ui.Text(n,"Calendar")})})}function M(n,a,e,i){N(n,"div"),r(n,"div",function(n){n.className="tab",r(n,"div",function(n){n.className="tab-bar",r(n,"a",function(n){n.className="clickable tab-normal localNavigation-link",n.href=a.href,p(n,"« "+a.title)}),r(n,"span",function(n){n.className="tab-active limited",r(n,"span",function(n){n.className="zeroSize",p(n," » ")}),p(n,e)})})}),N(n,"div"),r(n,"div",function(n){n.className="tab-content",i(n)})}function A(n,a){N(n,"div"),r(n,"div",function(n){n.className="tab-content",a(n)})}function S(n,a){J(n,a,"errors")}function U(n,a,e,i,t){t.className="withArrow",O(n,a,e,i,t)}function I(n,a,e,i,t,o){void 0===o&&(o={}),o.className="withArrow",q(n,a,e,i,t,o)}function O(n,a,e,i,t){void 0===t&&(t={});var o=t.id;void 0!==o&&r(n,"a",function(n){n.name=o}),r(n,"a",function(n){
var c,s=t.className;c=void 0===s?"":" "+s,void 0!==t.localNavigation&&(c+=" localNavigation-link"),void 0!==o&&(n.id=o),n.className="clickable link image_link"+c,n.href=e,r(n,"span",function(n){n.className="image_link-icon",r(n,"span",function(n){n.className="icon "+i})}),r(n,"span",function(n){n.className="image_link-content",a(n)})})}function q(n,a,e,i,t,o){O(n,function(n){h(n,a,e)},i,t,o)}function D(n,a){r(n,"div",function(n){n.className="page-infoText",a(n)})}function j(n,a){J(n,a,"messages")}function R(n,a,e){N(n,"div"),r(n,"div",function(n){n.className="panel",r(n,"div",function(n){n.className="panel-title",r(n,"div",function(n){n.className="panel-title-text",p(n,a),r(n,"span",function(n){n.className="zeroSize",p(n,":")})})}),r(n,"div",function(n){n.className="panel-content",e(n)})})}function B(n,a){D(n,function(n){p(n,'You are accessing "'),r(n,"code",function(n){p(n,a)}),p(n,"\". The address in your browser's address bar should start with it.")})}function Z(n,a,e){void 0!==a&&(void 0!==e&&a.forEach(function(n,i){
a[i]=e[n]}),S(n,a))}function V(n,a){void 0!==a&&j(n,a)}function Y(n,a){void 0!==a&&an(n,a)}function G(n,a){r(n,"div",function(n){n.className="page-text",a(n)})}function J(n,a,e){r(n,"div",function(n){n.className="textList "+e,r(n,"ul",function(n){n.className="textList-list",1===a.length?r(n,"li",function(n){n.className="textList-list-item",n.innerHTML=a[0]}):a.forEach(function(a){r(n,"li",function(n){n.className="textList-list-item",r(n,"span",function(n){n.className="textList-list-item-bullet "+e}),n.innerHTML+=a})})})})}function K(n,a,e,i,t){s(n,function(n){r(n,"span",function(n){n.className="thumbnail_link-title",p(n,a)})},e,i,t)}function Q(n,a,e,i,t,o){s(n,function(n){r(n,"span",function(n){n.className="thumbnail_link-title",p(n,a)}),N(n,"span"),r(n,"span",function(n){n.className="thumbnail_link-description colorText grey",e(n)})},i,t,o)}function X(n,a){r(n,"div",function(n){n.className="thumbnails",a.forEach(function(a,e){e>0&&(e%2===0&&r(n,"span",function(n){n.className="hr thumbnails-br n2"}),e%3===0&&r(n,"span",function(n){
n.className="hr thumbnails-br n3"}),e%4===0&&r(n,"span",function(n){n.className="hr thumbnails-br n4"}),e%5===0&&r(n,"span",function(n){n.className="hr thumbnails-br n5"}),e%6===0&&r(n,"span",function(n){n.className="hr thumbnails-br n6"}),e%7===0&&r(n,"span",function(n){n.className="hr thumbnails-br n7"}));var i="";e%3===1&&(i+=" wide_of_three"),(e%6===1||e%6===4)&&(i+=" narrow_of_six"),r(n,"div",function(n){n.className="thumbnails-item"+i,a(n)})})})}function $(n,a,e){N(n,"div"),r(n,"div",function(n){n.className="tab",r(n,"div",function(n){n.className="tab-bar",r(n,"span",function(n){n.className="tab-active",r(n,"span",function(n){n.className="zeroSize",p(n," » ")}),p(n,a)})})}),N(n,"div"),r(n,"div",function(n){n.className="tab-content",e(n)})}function nn(n,a,e){r(n,"div",function(n){n.className="twoColumns",r(n,"div",function(n){n.className="twoColumns-column1 dynamic",a(n)}),r(n,"div",function(n){n.className="twoColumns-column2 dynamic",e(n)})})}function an(n,a){J(n,a,"warnings")}function en(n,a,e){r(n,"form",function(n){
n.action=a,n.className="search_form",e(n)}),N(n,"div")}function tn(n,a){r(n,"span",function(n){n.className="search_form-content empty",r(n,"input",function(n){n.className="form-textfield",n.type="text",n.name="keyword",n.required=!0,n.placeholder=a})}),r(n,"button",function(n){n.title="Search",n.className="search_form-button rightButton clickable",r(n,"span",function(n){n.className="rightButton-icon icon search"}),r(n,"span",function(n){n.className="displayNone",p(n,"Search")})})}!function(n){var a=o(n),e=c(n),t=d(localNavigation,n,a,e);window.ui={admin_page:i(t),compressed_css_link:a,compressed_js_script:e,Element:r,export_date_ago:u,Form_button:_,Form_captcha:k,Form_checkbox:y,Form_checkboxItem:w,Form_hidden:x,Form_label:L,Form_notes:T,Form_password:P,Form_select:C,Form_textarea:E,Form_textfield:F,guest_page:l(t),Hr:f,ItemList_listUrl:H,ItemList_pageHiddenInputs:z,page:t,Page_calendarTodayLink:W,Page_create:M,Page_emptyTabs:A,Page_errors:S,Page_imageArrowLink:U,Page_imageArrowLinkWithDescription:I,Page_imageLink:O,
Page_imageLinkWithDescription:q,Page_infoText:D,Page_panel:R,Page_phishingWarning:B,Page_sessionErrors:Z,Page_sessionMessages:V,Page_sessionWarnings:Y,Page_text:G,Page_thumbnailLink:K,Page_thumbnailLinkWithDescription:Q,Page_thumbnails:X,Page_title:$,Page_twoColumns:nn,Page_warnings:an,public_page:v(t),SearchForm_create:en,SearchForm_emptyContent:tn,Text:p,user_page:g(t),ZeroHeightBr:N}}(revisions)}();