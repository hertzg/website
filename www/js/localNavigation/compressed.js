!function(){function o(o,t,e,n){function a(){unloadProgress.hide();var o=document.body,t=Array.prototype.slice.call(o.childNodes);t.forEach(function(t){t.classList.contains("localNavigation-leave")||o.removeChild(t)});var e=document.head,t=Array.prototype.slice.call(e.childNodes);t.forEach(function(o){var t=o.tagName;"TITLE"!==t&&"META"!==t&&("LINK"!==t||"icon"!==o.rel&&!o.classList.contains("localNavigation-leave"))&&e.removeChild(o)})}return console.log("LoadPage",t),e(o,n,function(){a(),console.log(t+" failed to load."),n()},a)}function t(o,t,e){console.log("LoadScript",o);var n=document.createElement("script");return n.src=o,n.onload=t,n.onerror=e,document.body.appendChild(n),{abort:function(){n.onload=null}}}!function(e,n){function a(n,a){function u(){c=null,void 0!==a&&a(),""!==h&&(removeEventListener("popstate",l),location.hash=h,addEventListener("popstate",l)),r()}console.log("loadHref",n);var d=n.href,h=n.hash;null!==c&&c.abort();var f=i[d];c=void 0===f?t(s+d+"load.js",function(){void 0===i[d]?location=s+d+h:c=o(e,d,i[d],u);
},function(){location=s+d+h}):o(e,d,f,u)}function l(o){console.log("popstate",o.state);var t=o.state;null===t&&(t=u),a(t)}function r(){var o=document.querySelectorAll(".localNavigation-link");Array.prototype.forEach.call(o,function(o){var t=o.href,e=t.substr(s.length),l=e.match(/(?:#.*)?$/)[0];""!==l&&(e=e.substr(0,e.length-l.length));var r={href:e,hash:l};o.addEventListener("click",function(o){o.preventDefault(),n.show(),a(r,function(){console.log("history.pushState",r),history.pushState(r,document.title,t)})})})}var c=null,i=Object.create(null),s=function(){var o=document.createElement("a");return o.href=e,o.href}(),u={href:location.href.substr(s.length).replace(/#.*?$/,""),hash:location.hash};addEventListener("popstate",l),r(),window.localNavigation={registerPage:function(o,t){i[o]=t}}}(base,unloadProgress)}();