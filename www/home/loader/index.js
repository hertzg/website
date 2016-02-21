!function(){function n(n){return(n/100).toFixed(2).replace(/\d+/,function(n){for(var i=n.split("").reverse().join(""),e=i.substr(0,3),t=3;t<i.length;t+=3)e+=","+i.substr(t,3);return e.split("").reverse().join("")})}function i(n,i){void 0===i&&(i=" ");for(var e=["B","KB","MB","GB","TB"],a=0;a<e.length;a++){if(!(n>=1024)){var o;return o=Math.round(10*n)%10?1:0,t(n,o)+i+e[a]}n/=1024}}function e(n,i){ui.Element(n,"span",function(n){n.className="icon calendar",ui.Element(n,"span",function(n){n.className="calendarIcon-day",ui.Text(n,new Date(i.time).getUTCDate())})})}function t(n,i){return n.toFixed(i).replace(/\d+/,function(n){for(var i=n.split("").reverse().join(""),e=i.substr(0,3),t=3;t<i.length;t+=3)e+=","+i.substr(t,3);return e.split("").reverse().join("")})}function a(n){var i={admin:o,"bar-charts":u,"new-bar-chart":d,bookmarks:c,"new-bookmark":_,calculations:r,"new-calculation":h,calendar:s,"new-event":f,contacts:l,"new-contact":v,files:m,"upload-files":j,notes:L,"new-note":k,notifications:T,"post-notification":x,
places:N,"new-place":p,tasks:D,"new-task":g,schedules:W,"new-schedule":b,wallets:C,"new-wallet":w,"new-transaction":P,"transfer-amount":y,trash:E},e=[],t=n.home;for(var a in t)!function(t){e.push(function(e){i[t](e,n)})}(a);return e}function o(n){ui.Page_thumbnailLink(n,"Administration","../admin/","administration")}function u(n,i){var e=i.user.num_bar_charts,t="Bar Charts",a="../bar-charts/",o="bar-charts",u={id:"bar-charts"};return e?void ui.Page_thumbnailLinkWithDescription(n,t,function(n){ui.Text(n,e+" total.")},a,o,u):void ui.Page_thumbnailLink(n,t,a,o,u)}function c(n,i){var e=i.user,t=e.num_bookmarks,a=e.num_received_bookmarks-e.num_archived_received_bookmarks,o="Bookmarks",u="../bookmarks/",c="bookmarks",r={id:"bookmarks"};if(t||a){var s=[];return t&&s.push(t+" total."),a&&s.push(a+" new received."),description=s.join(" "),void ui.Page_thumbnailLinkWithDescription(n,o,function(n){ui.Text(n,description)},u,c,r)}ui.Page_thumbnailLink(n,o,u,c,r)}function r(n,i){var e=i.user,t=e.num_calculations,a=e.num_received_calculations-e.num_archived_received_calculations,o="Calculations",u="../calculations/",c="calculations",r={
id:"calculations"};if(t||a){var s=[];return t&&s.push(t+" total."),a&&s.push(a+" new received."),description=s.join(" "),void ui.Page_thumbnailLinkWithDescription(n,o,function(n){ui.Text(n,description)},u,c,r)}ui.Page_thumbnailLink(n,o,u,c,r)}function s(n,i){function t(n){return 1==n?"1 event":n+" events"}var a=i.user,o=a.num_events_today+a.num_task_deadlines_today+a.num_birthdays_today,u=a.num_events_tomorrow+a.num_task_deadlines_tomorrow+a.num_birthdays_tomorrow;ui.Element(n,"a",function(n){n.name="calendar"}),ui.Element(n,"a",function(n){n.href="../calendar/",n.id="calendar",n.className="clickable link thumbnail_link",ui.Element(n,"span",function(n){n.className="thumbnail_link-icon",e(n,i)}),ui.Element(n,"span",function(n){n.className="thumbnail_link-content",ui.Element(n,"span",function(n){n.className="thumbnail_link-title",ui.Text(n,"Calendar")}),(o||u)&&(ui.ZeroHeightBr(n),ui.Element(n,"span",function(n){if(n.className="thumbnail_link-description colorText grey",o&&ui.Element(n,"span",function(n){n.className="colorText red",
ui.Text(n,t(o)+" today.")}),u){var i=t(u)+" tomorrow.";o&&(i=" "+i),ui.Text(n,i)}}))})})}function l(n,i){var e=i.user,t=e.num_contacts,a=e.num_received_contacts-e.num_archived_received_contacts,o="Contacts",u="../contacts/",c="contacts",r={id:"contacts"};if(t||a){var s=[];return t&&s.push(t+" total."),a&&s.push(a+" new received."),description=s.join(" "),void ui.Page_thumbnailLinkWithDescription(n,o,function(n){ui.Text(n,description)},u,c,r)}ui.Page_thumbnailLink(n,o,u,c,r)}function m(n,e){var t=e.user,a=t.storage_used,o=t.num_received_files+t.num_received_folders-t.num_archived_received_files-t.num_archived_received_folders,u="Files",c="../files/",r="files",s={id:"files"};if(o||a){var l=[];return a&&l.push(i(a," ")+" used."),o&&l.push(o+" new received."),description=l.join(" "),void ui.Page_thumbnailLinkWithDescription(n,u,function(n){ui.Text(n,description)},c,r,s)}ui.Page_thumbnailLink(n,u,c,r,s)}function d(n){ui.Page_thumbnailLink(n,"New Bar Chart","../bar-charts/new/","create-bar-chart")}function _(n){ui.Page_thumbnailLink(n,"New Bookmark","../bookmarks/new/","create-bookmark");
}function h(n){ui.Page_thumbnailLink(n,"New Calculation","../calculations/new/","create-calculation")}function f(n){ui.Page_thumbnailLink(n,"New Event","../calendar/new-event/","create-event")}function v(n){ui.Page_thumbnailLink(n,"New Contact","../contacts/new/","create-contact")}function k(n){ui.Page_thumbnailLink(n,"New Note","../notes/new/","create-note")}function p(n){ui.Page_thumbnailLink(n,"New Place","../places/new/","create-place")}function b(n){ui.Page_thumbnailLink(n,"New Schedule","../schedules/new/","create-schedule")}function g(n){ui.Page_thumbnailLink(n,"New Task","../tasks/new/","create-task")}function w(n){ui.Page_thumbnailLink(n,"New Wallet","../wallets/new/","create-wallet")}function P(n){ui.Page_thumbnailLink(n,"New Transaction","../wallets/quick-new-transaction/","create-transaction",{localNavigation:!0})}function L(n,i){var e=i.user,t=e.num_notes,a=e.num_received_notes-e.num_archived_received_notes,o="Notes",u="../notes/",c="notes",r={id:"notes"};if(t||a){var s=[];return t&&s.push(t+" total."),
a&&s.push(a+" new received."),description=s.join(" "),void ui.Page_thumbnailLinkWithDescription(n,o,function(n){ui.Text(n,description)},u,c,r)}ui.Page_thumbnailLink(n,o,u,c,r)}function T(n,i){var e=i.user,t=e.num_notifications,a="Notifications",o="../notifications/",u={id:"notifications"};if(t){var c=e.num_new_notifications;return c?void ui.Page_thumbnailLinkWithDescription(n,a,function(n){ui.Element(n,"span",function(n){n.className="colorText red",ui.Text(n,c+" new.")}),c!==t&&ui.Text(n," "+t+" total.")},o,"notification",u):void ui.Page_thumbnailLinkWithDescription(n,a,function(n){ui.Text(n,t+" total.")},o,"old-notification",u)}ui.Page_thumbnailLink(n,a,o,"old-notification",u)}function N(n,i){var e=i.user,t=e.num_places,a=e.num_received_places-e.num_archived_received_places,o="Places",u="../places/",c="places",r={id:"places"};if(t||a){var s=[];return t&&s.push(t+" total."),a&&s.push(a+" new received."),description=s.join(" "),void ui.Page_thumbnailLinkWithDescription(n,o,function(n){ui.Text(n,description)},u,c,r);
}ui.Page_thumbnailLink(n,o,u,c,r)}function x(n){ui.Page_thumbnailLink(n,"Post a Notification","../notifications/post/","create-notification")}function W(n,i){var e=i.user,t=e.num_schedules_today,a=e.num_schedules_tomorrow,o=e.num_received_schedules-e.num_archived_received_schedules,u="Schedules",c="../schedules/",r="schedules",s={id:"schedules"};return t||a||o?void ui.Page_thumbnailLinkWithDescription(n,u,function(n){if(t&&ui.Element(n,"span",function(n){n.className="colorText red",ui.Text(n,t+" today.")}),o){var i=o+" new received.";(t||a)&&(i=" "+i),a&&(i=a+" tomorrow."+i,t&&(i=" "+i)),ui.Text(n,i)}else if(a){var i=a+" tomorrow.";t&&(i=" "+i),ui.Text(n,i)}},c,r,s):void ui.Page_thumbnailLink(n,u,c,r,s)}function D(n,i){var e=i.user,t=e.num_tasks,a=e.num_received_tasks-e.num_archived_received_tasks,o="Tasks",u="../tasks/",c="tasks",r={id:"tasks"};if(t||a){var s=[];return t&&s.push(t+" total."),a&&s.push(a+" new received."),description=s.join(" "),void ui.Page_thumbnailLinkWithDescription(n,o,function(n){ui.Text(n,description);
},u,c,r)}ui.Page_thumbnailLink(n,o,u,c,r)}function y(n){ui.Page_thumbnailLink(n,"Transfer Amount","../wallets/quick-transfer-amount/","transfer-amount",{localNavigation:!0})}function E(n,i){var e,t=i.user.num_deleted_items;e=t?t+" total.":"Empty",ui.Page_thumbnailLinkWithDescription(n,"Trash",function(n){ui.Text(n,e)},"../trash/","trash-bin",{id:"trash"})}function j(n){ui.Page_thumbnailLink(n,"Upload Files","../files/upload-files/","upload")}function C(i,e){var t=e.user.balance_total,a="Wallets",o="../wallets/",u="wallets",c={id:"wallets"};return t?void ui.Page_thumbnailLinkWithDescription(i,a,function(i){ui.Text(i,n(t)+" balance.")},o,u,c):void ui.Page_thumbnailLink(i,a,o,u,c)}!function(n,i){n.registerPage("home/",function(e,t){t("Home");var o="../";i.page(e,o,function(n){i.Page_emptyTabs(n,function(n){i.Page_sessionMessages(n,e.messages),i.Page_sessionWarnings(n,e.warnings),i.SearchForm_create(n,"../search/",function(n){i.SearchForm_emptyContent(n,"Search...")}),i.Hr(n),i.Page_thumbnails(n,a(e))}),i.Page_panel(n,"Options",function(n){
i.Page_twoColumns(n,function(n){i.Page_imageArrowLink(n,function(n){i.Text(n,"Account")},"../account/","account",{id:"account"})},function(n){i.Page_imageArrowLink(n,function(n){i.Text(n,"Customize Home")},"customize/","edit-home",{id:"customize",localNavigation:!0})}),i.Hr(n),i.Page_imageArrowLink(n,function(n){i.Text(n,"Help")},"../help/","help",{id:"help",localNavigation:!0})})},{head:function(n){void 0!==e.home.calendar&&i.compressed_css_link(n,"calendarIcon",o)},scripts:function(n){void 0!==e.home.calendar&&i.compressed_js_script(n,"searchForm",o)}}),n.scanLinks(),n.focusTarget()})}(localNavigation,ui)}();