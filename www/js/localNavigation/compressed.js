!function(){function o(o,n,t){console.log("LoadScript",o);var e=document.createElement("script");return e.src=o,e.onload=n,e.onerror=t,document.body.appendChild(e),{abort:function(){e.onload=e.onerror=null}}}function n(){unloadProgress.hide();var o=document.body,n=Array.prototype.slice.call(o.childNodes);n.forEach(function(n){n.classList.contains("localNavigation-leave")||o.removeChild(n)});var t=document.head,n=Array.prototype.slice.call(t.childNodes);n.forEach(function(o){var n=o.tagName;"TITLE"!==n&&"META"!==n&&("LINK"!==n||"icon"!==o.rel&&!o.classList.contains("localNavigation-leave"))&&t.removeChild(o)})}!function(t,e,a){function l(t,a,l){function r(o){i=o(u,function(){for(;h.length>0;)h.shift()();n(),i=null,void 0!==l&&l()},c)}function c(){location=t+a}console.log("loadHref",t,a),null!==i&&i.abort();var d=t.substr(u.length),f=s[d];if(void 0===f){var v=t+"load.js",g=e[d];void 0===g?c():(v+="?"+g,i=o(v,function(){var o=s[d];void 0===o?c():r(o)},c))}else r(f)}function r(o){console.log("popstate",o.state);var n=o.state;
null===n&&(n=d),l(n.href,n.hash)}function c(){var o=document.querySelectorAll(".localNavigation-link");Array.prototype.forEach.call(o,function(o){var n=o.href,t=n.match(/(?:#.*)?$/)[0];""!==t&&(n=n.substr(0,n.length-t.length)),o.addEventListener("click",function(o){o.preventDefault(),a.show(),l(n,t,function(){var o={href:n,hash:t};console.log("history.pushState",document.title,o),history.pushState(o,document.title,n+t)})})})}var i=null,s=Object.create(null),u=function(){var o=document.createElement("a");return o.href=t,o.href}(),d={href:location.href,hash:location.hash};addEventListener("popstate",r),c();var h=[];console.log("localNavigation loaded"),window.localNavigation={scanLinks:c,registerPage:function(o,n){s[o]=n},onUnload:function(o){h.push(o)}}}(base,loaderRevisions,unloadProgress)}();