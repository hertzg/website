!function(){function n(n,a,t){var i=document.createElement(a);n.appendChild(i),t(i)}function a(a,t){n(a,"div",function(a){a.id="tbar",n(a,"div",function(a){a.id="tbar-limit",n(a,"a",function(a){a.className="topLink logoLink",a.href=t,n(a,"img",function(n){n.alt="Zvini",n.className="logoLink-img"})})})})}function t(n){var a=document.createElement("div");a.className="hr",n.appendChild(a)}function i(n,a){n.appendChild(document.createTextNode(a))}function e(a,t,e){n(a,"span",function(a){a.className="title_and_description",n(a,"span",function(n){n.className="title_and_description-title",i(n,t)}),o(a),n(a,"span",function(n){n.className="title_and_description-description colorText grey",i(n,e)})})}function o(a){n(a,"br",function(n){n.className="zeroHeight"})}function c(a,t,i){n(a,"div",function(a){a.className="form-item",n(a,"div",function(n){n.className="form-property",i(n)}),n(a,"div",function(n){n.className="form-value",t(n)})})}function s(a,t,i){n(a,"input",function(n){n.className="clickable form-button",n.type="submit",
n.value=t,void 0!==i&&(n.name=i)})}function l(a,i,e){void 0===e&&(e=!1),n(a,"div",function(a){a.className="form-captcha",n(a,"img",function(n){n.alt="CAPTCHA",n.className="form-captcha-image",n.src=i+"captcha/"})}),f(a,"captcha","Verification",{required:!0,autofocus:e}),u(a,["Enter the characters shown on the image above.","This proves that you are a human and not a robot."]),t(a)}function u(a,t){c(a,function(a){n(a,"ul",function(a){a.className="form-notes",t.forEach(function(t){n(a,"li",function(a){a.className="form-notes-item",n(a,"span",function(n){n.className="form-notes-item-bullet"}),i(a,t)})})})},function(){})}function m(n,a,t,i){i.type="password",f(n,a,t,i)}function r(a,t,e,o){c(a,function(a){n(a,"textarea",function(n){var a=o.value;void 0!==a&&(n.value=a);var i=o.maxlength;void 0!==i&&(n.maxlength=i);var e=o.autofocus;void 0!==e&&(n.autofocus=e);var c=o.readonly;void 0!==c&&(n.readOnly=c);var s=o.required;void 0!==s&&(n.required=s),n.className="form-textarea",n.id=n.name=t})},function(a){n(a,"label",function(n){
n.className="form-property-label",n.htmlFor=t,i(n,e+":")})})}function f(a,t,e,o){c(a,function(a){n(a,"input",function(n){var a=o.type;void 0===a&&(a="text");var i=o.value;void 0!==i&&(n.value=i);var e=o.maxlength;void 0!==e&&(n.maxLength=e);var c=o.autofocus;void 0!==c&&(n.autofocus=c);var s=o.readonly;void 0!==s&&(n.readOnly=s);var l=o.required;void 0!==l&&(n.required=l),n.type=a,n.className="form-textfield",n.id=n.name=t})},function(a){n(a,"label",function(n){n.className="form-property-label",n.htmlFor=t,i(n,e+":")})})}function d(a,t,e,c){o(a),n(a,"div",function(a){a.className="tab",n(a,"div",function(a){a.className="tab-bar",n(a,"a",function(n){n.className="clickable tab-normal localNavigation-link",n.href=t.href,i(n,"« "+t.title)}),n(a,"span",function(a){a.className="tab-active limited",n(a,"span",function(n){n.className="zeroSize",i(n," » ")}),i(a,e)})})}),o(a),n(a,"div",function(n){n.className="tab-content",c(n)})}function v(a,t){o(a),n(a,"div",function(n){n.className="tab-content",t(n)})}function p(n,a,t,i,e,o){
e.className="withArrow",g(n,a,t,i,e,o)}function N(n,a,t,i,o,c,s){c.className="withArrow",g(n,function(n){e(n,a,t)},i,o,c,s)}function g(a,t,e,o,c){n(a,"a",function(n){n.name=c.id}),n(a,"a",function(a){var s,l=c.className;s=void 0===l?"":" "+l,void 0!==c.localNavigation&&(s+=" localNavigation-link"),a.id=c.id,a.className="clickable link image_link"+s,a.href=e,n(a,"span",function(a){a.className="image_link-icon",n(a,"span",function(n){n.className="icon "+o})}),n(a,"span",function(n){n.className="image_link-content","string"==typeof t?i(n,t):t(n)})})}function h(a,t,e){o(a),n(a,"div",function(a){a.className="panel",n(a,"div",function(a){a.className="panel-title",n(a,"div",function(a){a.className="panel-title-text",i(a,t),n(a,"span",function(n){n.className="zeroSize",i(n,":")})})}),n(a,"div",function(n){n.className="panel-content",e(n)})})}function b(a,t,e){o(a),n(a,"div",function(a){a.className="tab",n(a,"div",function(a){a.className="tab-bar",n(a,"span",function(a){a.className="tab-active limited",n(a,"span",function(n){
n.className="zeroSize",i(n," » ")}),i(a,t)})})}),o(a),n(a,"div",function(n){n.className="tab-content",e(n)})}function _(a,t,i){n(a,"div",function(a){a.className="twoColumns",n(a,"div",function(n){n.className="twoColumns-column1 dynamic",t(n)}),n(a,"div",function(n){n.className="twoColumns-column2 dynamic",i(n)})})}window.ui={Element:n,Form_button:s,Form_captcha:l,Form_notes:u,Form_password:m,Form_textarea:r,Form_textfield:f,guest_page:a,Hr:t,Page_create:d,Page_emptyTabs:v,Page_imageArrowLink:p,Page_imageArrowLinkWithDescription:N,Page_imageLink:g,Page_panel:h,Page_title:b,Page_twoColumns:_,Text:i,ZeroHeightBr:o}}();