!function(){function n(n){return(n/100).toFixed(2).replace(/\d+/,function(n){for(var e=n.split("").reverse().join(""),i=e.substr(0,3),t=3;t<e.length;t+=3)i+=","+e.substr(t,3);return i.split("").reverse().join("")})}function e(n,e){void 0===e&&(e=" ");for(var i=["B","KB","MB","GB","TB"],a=0;a<i.length;a++){if(!(n>=1024)){var u;return u=Math.round(10*n)%10?1:0,t(n,u)+e+i[a]}n/=1024}}function i(n,e){ui.Element(n,"span",function(n){n.className="icon calendar",ui.Element(n,"span",function(n){n.className="calendarIcon-day",ui.Text(n,new Date(e.time).getUTCDate())})})}function t(n,e){return n.toFixed(e).replace(/\d+/,function(n){for(var e=n.split("").reverse().join(""),i=e.substr(0,3),t=3;t<e.length;t+=3)i+=","+e.substr(t,3);return i.split("").reverse().join("")})}function a(n){var e={admin:u,"bar-charts":o,"new-bar-chart":_,bookmarks:c,"new-bookmark":d,calculations:s,"new-calculation":h,calendar:r,"new-event":f,contacts:l,"new-contact":v,files:m,"upload-files":j,notes:L,"new-note":k,notifications:T,"post-notification":x,
places:N,"new-place":p,tasks:D,"new-task":g,schedules:W,"new-schedule":b,wallets:C,"new-wallet":w,"new-transaction":P,"transfer-amount":y,trash:E},i=[],t=n.home;for(var a in t)!function(t){i.push(function(i){e[t](i,n)})}(a);return i}function u(n){ui.Page_thumbnailLink(n,"Administration","../admin/","administration")}function o(n,e){var i=e.user.num_bar_charts,t="Bar Charts",a="../bar-charts/",u="bar-charts",o={id:"bar-charts"};return i?void ui.Page_thumbnailLinkWithDescription(n,t,function(n){ui.Text(n,i+" total.")},a,u,o):void ui.Page_thumbnailLink(n,t,a,u,o)}function c(n,e){var i=e.user,t=i.num_bookmarks,a=i.num_received_bookmarks-i.num_archived_received_bookmarks,u="Bookmarks",o="../bookmarks/",c="bookmarks",s={id:"bookmarks"};if(t||a){var r=[];return t&&r.push(t+" total."),a&&r.push(a+" new received."),void ui.Page_thumbnailLinkWithDescription(n,u,function(n){ui.Text(n,r.join(" "))},o,c,s)}ui.Page_thumbnailLink(n,u,o,c,s)}function s(n,e){var i=e.user,t=i.num_calculations,a=i.num_received_calculations-i.num_archived_received_calculations,u="Calculations",o="../calculations/",c="calculations",s={
id:"calculations"};if(t||a){var r=[];return t&&r.push(t+" total."),a&&r.push(a+" new received."),void ui.Page_thumbnailLinkWithDescription(n,u,function(n){ui.Text(n,r.join(" "))},o,c,s)}ui.Page_thumbnailLink(n,u,o,c,s)}function r(n,e){function t(n){return 1==n?"1 event":n+" events"}var a=e.user,u=a.num_events_today+a.num_task_deadlines_today+a.num_birthdays_today,o=a.num_events_tomorrow+a.num_task_deadlines_tomorrow+a.num_birthdays_tomorrow;ui.Element(n,"a",function(n){n.name="calendar"}),ui.Element(n,"a",function(n){n.href="../calendar/",n.id="calendar",n.className="clickable link thumbnail_link",ui.Element(n,"span",function(n){n.className="thumbnail_link-icon",i(n,e)}),ui.Element(n,"span",function(n){n.className="thumbnail_link-content",ui.Element(n,"span",function(n){n.className="thumbnail_link-title",ui.Text(n,"Calendar")}),(u||o)&&(ui.ZeroHeightBr(n),ui.Element(n,"span",function(n){if(n.className="thumbnail_link-description colorText grey",u&&ui.Element(n,"span",function(n){n.className="colorText red",ui.Text(n,t(u)+" today.");
}),o){var e=t(o)+" tomorrow.";u&&(e=" "+e),ui.Text(n,e)}}))})})}function l(n,e){var i=e.user,t=i.num_contacts,a=i.num_received_contacts-i.num_archived_received_contacts,u="Contacts",o="../contacts/",c="contacts",s={id:"contacts"};if(t||a){var r=[];return t&&r.push(t+" total."),a&&r.push(a+" new received."),void ui.Page_thumbnailLinkWithDescription(n,u,function(n){ui.Text(n,r.join(" "))},o,c,s)}ui.Page_thumbnailLink(n,u,o,c,s)}function m(n,i){var t=i.user,a=t.storage_used,u=t.num_received_files+t.num_received_folders-t.num_archived_received_files-t.num_archived_received_folders,o="Files",c="../files/",s="files",r={id:"files"};if(u||a){var l=[];return a&&l.push(e(a," ")+" used."),u&&l.push(u+" new received."),void ui.Page_thumbnailLinkWithDescription(n,o,function(n){ui.Text(n,l.join(" "))},c,s,r)}ui.Page_thumbnailLink(n,o,c,s,r)}function _(n){ui.Page_thumbnailLink(n,"New Bar Chart","../bar-charts/new/","create-bar-chart")}function d(n){ui.Page_thumbnailLink(n,"New Bookmark","../bookmarks/new/","create-bookmark");
}function h(n){ui.Page_thumbnailLink(n,"New Calculation","../calculations/new/","create-calculation")}function f(n){ui.Page_thumbnailLink(n,"New Event","../calendar/new-event/","create-event")}function v(n){ui.Page_thumbnailLink(n,"New Contact","../contacts/new/","create-contact")}function k(n){ui.Page_thumbnailLink(n,"New Note","../notes/new/","create-note")}function p(n){ui.Page_thumbnailLink(n,"New Place","../places/new/","create-place")}function b(n){ui.Page_thumbnailLink(n,"New Schedule","../schedules/new/","create-schedule")}function g(n){ui.Page_thumbnailLink(n,"New Task","../tasks/new/","create-task")}function w(n){ui.Page_thumbnailLink(n,"New Wallet","../wallets/new/","create-wallet")}function P(n){ui.Page_thumbnailLink(n,"New Transaction","../wallets/quick-new-transaction/","create-transaction",{localNavigation:!0})}function L(n,e){var i=e.user,t=i.num_notes,a=i.num_received_notes-i.num_archived_received_notes,u="Notes",o="../notes/",c="notes",s={id:"notes"};if(t||a){var r=[];return t&&r.push(t+" total."),
a&&r.push(a+" new received."),void ui.Page_thumbnailLinkWithDescription(n,u,function(n){ui.Text(n,r.join(" "))},o,c,s)}ui.Page_thumbnailLink(n,u,o,c,s)}function T(n,e){var i=e.user,t=i.num_notifications,a="Notifications",u="../notifications/",o={id:"notifications"};if(t){var c=i.num_new_notifications;return c?void ui.Page_thumbnailLinkWithDescription(n,a,function(n){ui.Element(n,"span",function(n){n.className="colorText red",ui.Text(n,c+" new.")}),c!==t&&ui.Text(n," "+t+" total.")},u,"notification",o):void ui.Page_thumbnailLinkWithDescription(n,a,function(n){ui.Text(n,t+" total.")},u,"old-notification",o)}ui.Page_thumbnailLink(n,a,u,"old-notification",o)}function N(n,e){var i=e.user,t=i.num_places,a=i.num_received_places-i.num_archived_received_places,u="Places",o="../places/",c="places",s={id:"places"};if(t||a){var r=[];return t&&r.push(t+" total."),a&&r.push(a+" new received."),void ui.Page_thumbnailLinkWithDescription(n,u,function(n){ui.Text(n,r.join(" "))},o,c,s)}ui.Page_thumbnailLink(n,u,o,c,s)}function x(n){
ui.Page_thumbnailLink(n,"Post a Notification","../notifications/post/","create-notification")}function W(n,e){var i=e.user,t=i.num_schedules_today,a=i.num_schedules_tomorrow,u=i.num_received_schedules-i.num_archived_received_schedules,o="Schedules",c="../schedules/",s="schedules",r={id:"schedules"};return t||a||u?void ui.Page_thumbnailLinkWithDescription(n,o,function(n){if(t&&ui.Element(n,"span",function(n){n.className="colorText red",ui.Text(n,t+" today.")}),u){var e=u+" new received.";(t||a)&&(e=" "+e),a&&(e=a+" tomorrow."+e,t&&(e=" "+e)),ui.Text(n,e)}else if(a){var e=a+" tomorrow.";t&&(e=" "+e),ui.Text(n,e)}},c,s,r):void ui.Page_thumbnailLink(n,o,c,s,r)}function D(n,e){var i=e.user,t=i.num_tasks,a=i.num_received_tasks-i.num_archived_received_tasks,u="Tasks",o="../tasks/",c="tasks",s={id:"tasks"};if(t||a){var r=[];return t&&r.push(t+" total."),a&&r.push(a+" new received."),void ui.Page_thumbnailLinkWithDescription(n,u,function(n){ui.Text(n,r.join(" "))},o,c,s)}ui.Page_thumbnailLink(n,u,o,c,s)}function y(n){ui.Page_thumbnailLink(n,"Transfer Amount","../wallets/quick-transfer-amount/","transfer-amount",{
localNavigation:!0})}function E(n,e){var i,t=e.user.num_deleted_items;i=t?t+" total.":"Empty",ui.Page_thumbnailLinkWithDescription(n,"Trash",function(n){ui.Text(n,i)},"../trash/","trash-bin",{id:"trash"})}function j(n){ui.Page_thumbnailLink(n,"Upload Files","../files/upload-files/","upload")}function C(e,i){var t=i.user.balance_total,a="Wallets",u="../wallets/",o="wallets",c={id:"wallets"};return t?void ui.Page_thumbnailLinkWithDescription(e,a,function(e){ui.Text(e,n(t)+" balance.")},u,o,c):void ui.Page_thumbnailLink(e,a,u,o,c)}!function(n,e){n.registerPage("home/",function(i,t){t("Home");var u="../",o=[];void 0!==i.home.calendar&&o.push(e.compressed_js_script("searchForm",u)),e.page(i,u,function(n){e.Page_emptyTabs(n,function(n){e.Page_sessionMessages(n,i.messages),e.Page_sessionWarnings(n,i.warnings),e.SearchForm_create(n,"../search/",function(n){e.SearchForm_emptyContent(n,"Search...")}),e.Hr(n),e.Page_thumbnails(n,a(i))}),e.Page_panel(n,"Options",function(n){e.Page_twoColumns(n,function(n){e.Page_imageArrowLink(n,function(n){
e.Text(n,"Account")},"../account/","account",{id:"account"})},function(n){e.Page_imageArrowLink(n,function(n){e.Text(n,"Customize Home")},"customize/","edit-home",{id:"customize",localNavigation:!0})}),e.Hr(n),e.Page_imageArrowLink(n,function(n){e.Text(n,"Help")},"../help/","help",{id:"help",localNavigation:!0})})},{scripts:o,head:function(n){void 0!==i.home.calendar&&e.compressed_css_link(n,"calendarIcon",u)}}),n.scanLinks(),n.focusTarget()})}(localNavigation,ui)}();