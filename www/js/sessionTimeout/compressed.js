!function(){function e(e){function n(){function a(){var i=localStorage.sessionExtendTime;if(i>o)o=i,setTimeout(a,t);else{var l=new XMLHttpRequest;l.open("get",e+"api-call/session/extend"),l.send(),l.onload=function(){400==l.status?location.reload():n()}}}var o=Date.now();localStorage.sessionExtendTime=o,setTimeout(a,t)}var t=3e5;n()}function n(e,n,t){function a(){removeEventListener("keydown",l),g.removeChild(C)}function o(){var e=document.createElement("div");return e.className="hr",e}function i(e,n){var t=document.createElement("div");t.className="icon "+n;var a=document.createElement("div");a.className="image_link-icon",a.appendChild(t);var o=document.createElement("div");o.className="image_link-content",o.appendChild(document.createTextNode(e));var i=document.createElement("a");return i.className="clickable link image_link",i.appendChild(a),i.appendChild(o),i}function l(e){e.altKey||e.ctrlKey||e.metaKey||e.shiftKey||27==e.keyCode&&(e.preventDefault(),t())}var c=document.createElement("div");c.className="confirmDialog-aligner";var s=30,d="Your session is about to expire. Whould you like to extend your session? It will automatically sign out in "+s+" seconds.",r=document.createElement("div");r.className="page-text",r.appendChild(document.createTextNode(d));var m=i("Yes, extend session","yes");m.href=location.href,m.addEventListener("click",function(e){e.preventDefault(),a(),clearTimeout(E),n()});var u=i("No, sign out","no");u.href=e,u.addEventListener("click",function(n){n.preventDefault(),t(e)});var v=document.createElement("div");v.className="twoColumns-column1",v.appendChild(m);var p=document.createElement("div");p.className="twoColumns-column2",p.appendChild(u);var f=document.createElement("div");f.className="twoColumns dynamic",f.appendChild(v),f.appendChild(p);var h=document.createElement("div");h.className="confirmDialog-frame",h.appendChild(r),h.appendChild(o()),h.appendChild(f);var C=document.createElement("div");C.className="confirmDialog",C.appendChild(c),C.appendChild(h);var g=document.body;g.appendChild(C),addEventListener("keydown",l);var E=setTimeout(function(){t(e+"?auto=1")},1e3*s);return{hide:a}}!function(t){function a(){function e(){var l=localStorage.sessionStartTime;if(l>i)i=l,setTimeout(e,o);else var c=t+"sign-out/submit.php",s=function(e){i==localStorage.sessionStartTime?location=e:d.hide()},d=n(c,a,s)}var i=Date.now();localStorage.sessionStartTime=i,setTimeout(e,o)}var o=18e5;a(),e(t),window.sessionTimeout={extend:function(){var e=Date.now();localStorage.sessionStartTime=e,localStorage.sessionExtendTime=e}}}(base)}();