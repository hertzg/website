!function(){function e(e,n,t){var o=document.createElement("script");return o.type="text/javascript",o.src=e,o.onload=n,o.onerror=t,document.body.appendChild(o),{abort:function(){o.onload=o.onerror=null}}}function n(){var e=location.hash;if(""!==e){var n=e.substr(1),t=document.getElementById(n);null!==t&&(t.classList.add("target"),t.scrollIntoView())}}function t(e,n,t,o,r){var i;i=""===n?"?":n+"&",i+="client_revision="+t;var a=new XMLHttpRequest;return a.open("get",e+"loader/"+i),a.send(),a.onerror=r,a.onload=function(){if(200!==a.status)return void r();var e;try{e=JSON.parse(a.responseText)}catch(n){return void r()}o(e)},{abort:function(){a.abort()}}}function o(e,n,t,o){return function(){var r=document.querySelectorAll(".localNavigation-link");Array.prototype.forEach.call(r,function(r){var i=r.href,a=i.match(/(?:#.*)?$/)[0];""!==a&&(i=i.substr(0,i.length-a.length));var c=i.match(/(?:\?.*)?$/)[0];""!==c&&(i=i.substr(0,i.length-c.length));var l=i.substr(e.length);void 0!==n[l]&&r.addEventListener("click",function(e){
0!==e.button||e.altKey||e.ctrlKey||e.metaKey||e.shiftKey||(e.preventDefault(),t.show(),o(i,c,a,function(){history.pushState({href:i,search:c,hash:a},document.title,i+c+a)}))})})}}function r(e,n,t){var o=document.body,r=document.head;return function(i){for(e.hide();o.lastChild;)o.removeChild(o.lastChild);!function(){var e=Array.prototype.slice.call(r.childNodes);e.forEach(function(e){var n=e.tagName;"TITLE"!==n&&"META"!==n&&"STYLE"!==n&&("LINK"!==n||"icon"!==e.rel&&!e.classList.contains("localNavigation-leave"))&&r.removeChild(e)})}(),function(){function e(e){var r="theme/color/"+o+"/images/icon"+e+".png",i=document.getElementById("icon"+e+"Link");i.href=n+r+"?"+t[r]}var o=i.themeColor;window.themeColor=o;var r="theme/color/"+o+"/common.css",a=document.getElementById("themeColorLink");a.href=n+r+"?"+t[r],e(16),e(32),e(48),e(64),e(90),e(120),e(128),e(256),e(512)}(),function(){var e=i.themeBrightness;window.themeBrightness=e;var o="theme/brightness/"+e+"/common.css",r=document.getElementById("themeBrightnessLink");
r.href=n+o+"?"+t[o]}(),scroll(0,0)}}!function(i,a,c,l,s){function u(n,o,r,i){function a(){location.assign(n+o+r)}function s(e){d=t(n,o,l,function(n){e(n,function(e){for(document.title=e;g.length>0;)g.shift()();p(n),d=null,void 0!==i&&i()})},a)}null!==d&&d.abort();var u=n.substr(v.length),h=f[u];if(void 0===h){var m=n+"loader/index.js",y=c[u];void 0===y?a():(m+="?"+y,d=e(m,function(){var e=f[u];void 0===e?a():s(e)},a))}else s(h)}function h(e){var n=e.state;null===n&&(n=m),u(n.href,n.search,n.hash)}var d=null,f=Object.create(null),v=function(){var e=document.createElement("a");return e.href=i,e.href}(),m={href:location.href.replace(/#.*$/,"").replace(/\?.*$/,""),search:location.search,hash:location.hash},g=[],p=r(s,v,a),y=o(v,c,s,u);y(),addEventListener("load",function(){setTimeout(function(){addEventListener("popstate",h)},0)}),window.localNavigation={focusTarget:n,scanLinks:y,onUnload:function(e){g.push(e)},registerPage:function(e,n){f[e]=n},unUnload:function(e){g.splice(g.indexOf(e),1)}}}(base,revisions,loaderRevisions,clientRevision,unloadProgress);
}();