!function(){function o(o){var e=document.createElement("a");return e.href=o,console.log("AbsoluteBase",o,e.href),e.href}function e(o,e,t,n){function a(){unloadProgress.hide();var o=document.body,e=Array.prototype.slice.call(o.childNodes);e.forEach(function(e){e.classList.contains("localNavigation-leave")||o.removeChild(e)});var t=document.head,e=Array.prototype.slice.call(t.childNodes);e.forEach(function(o){var e=o.tagName;"TITLE"!==e&&"META"!==e&&("LINK"!==e||"icon"!==o.rel&&!o.classList.contains("localNavigation-leave"))&&t.removeChild(o)})}return console.log("LoadPage",e),t(o,n,function(o){a(),console.log(e+" failed to load."),n(o)},a)}function t(o,e,t){console.log("LoadScript",o);var n=document.createElement("script");return n.src=o,n.onload=e,n.onerror=t,document.body.appendChild(n),{abort:function(){n.onload=null}}}!function(n,a,l){function r(o,l){function r(o){n=o,s=null,void 0!==l&&l(),""!==h&&(removeEventListener("popstate",c),location.hash=h,addEventListener("popstate",c)),i()}console.log("loadHref",o);
var d=o.href,h=o.hash;null!==s&&s.abort();var f=u[d];s=void 0===f?t(n+d+"load.js?"+a[d],function(){void 0===u[d]?location=n+d+h:s=e(n,d,u[d],r)},function(){location=n+d+h}):e(n,d,f,r)}function c(e){console.log("popstate",e.state);var t=e.state;null===t&&(t=h),d=o(t.base),r(t)}function i(){var e=document.querySelectorAll(".localNavigation-link");Array.prototype.forEach.call(e,function(e){var t=e.href,a=t.substr(d.length),c=a.match(/(?:#.*)?$/)[0];""!==c&&(a=a.substr(0,a.length-c.length));var i={base:n,href:a,hash:c};e.addEventListener("click",function(e){e.preventDefault(),l.show(),r(i,function(){console.log("history.pushState",i),history.pushState(i,document.title,t),d=o(n)})})})}var s=null,u=Object.create(null),d=o(n),h={base:n,href:location.href.substr(d.length).replace(/#.*?$/,""),hash:location.hash};addEventListener("popstate",c),i(),window.localNavigation={registerPage:function(o,e){u[o]=e}}}(base,loaderRevisions,unloadProgress)}();