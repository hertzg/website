!function(){function n(n,o,e){var t=document.createElement("script");return t.src=n,t.onload=o,t.onerror=e,document.body.appendChild(t),{abort:function(){t.onload=t.onerror=null}}}function o(){unloadProgress.hide();var n=document.body,o=Array.prototype.slice.call(n.childNodes);o.forEach(function(o){o.classList.contains("localNavigation-leave")||n.removeChild(o)});var e=document.head,o=Array.prototype.slice.call(e.childNodes);o.forEach(function(n){var o=n.tagName;"TITLE"!==o&&"META"!==o&&("LINK"!==o||"icon"!==n.rel&&!n.classList.contains("localNavigation-leave"))&&e.removeChild(n)})}!function(e,t,a){function r(e,a,r){function i(n){c=n(u,function(){for(;h.length>0;)h.shift()();o(),c=null,void 0!==r&&r()},l)}function l(){location=e+a}null!==c&&c.abort();var d=e.substr(u.length),f=s[d];if(void 0===f){var v=e+"loader/index.js",p=t[d];void 0===p?l():(v+="?"+p,c=n(v,function(){var n=s[d];void 0===n?l():i(n)},l))}else i(f)}function i(n){var o=n.state;null===o&&(o=d),r(o.href,o.hash)}function l(){var n=document.querySelectorAll(".localNavigation-link");
Array.prototype.forEach.call(n,function(n){var o=n.href,e=o.match(/(?:#.*)?$/)[0];""!==e&&(o=o.substr(0,o.length-e.length)),n.addEventListener("click",function(n){n.preventDefault(),a.show(),r(o,e,function(){var n={href:o,hash:e};history.pushState(n,document.title,o+e)})})})}var c=null,s=Object.create(null),u=function(){var n=document.createElement("a");return n.href=e,n.href}(),d={href:location.href,hash:location.hash};addEventListener("popstate",i),l();var h=[];window.localNavigation={scanLinks:l,registerPage:function(n,o){s[n]=o},onUnload:function(n){h.push(n)}}}(base,loaderRevisions,unloadProgress)}();