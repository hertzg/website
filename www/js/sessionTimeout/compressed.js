!function(){function e(e){function n(){function a(){var i=localStorage.sessionExtendTime;if(i>o)o=i,setTimeout(a,t);else{var l=new XMLHttpRequest;l.open("get",e+"api-call/session/extend"),l.send(),l.onload=function(){var e=l.status;if(400==e){var t=JSON.parse(l.responseText);"SESSION_INVALID"==t&&location.reload()}else n()}}}var o=Date.now();localStorage.sessionExtendTime=o,setTimeout(a,t)}var t=3e5;n()}function n(e,n,t){function a(){removeEventListener("keydown",l),E.removeChild(C)}function o(){var e=document.createElement("div");return e.className="hr",e}function i(e,n){var t=document.createElement("div");t.className="icon "+n;var a=document.createElement("div");a.className="image_link-icon",a.appendChild(t);var o=document.createElement("div");o.className="image_link-title",o.appendChild(document.createTextNode(e));var i=document.createElement("div");i.className="image_link-content",i.appendChild(o);var l=document.createElement("a");return l.className="clickable link image_link",l.appendChild(a),l.appendChild(i),l}function l(e){e.altKey||e.ctrlKey||e.metaKey||e.shiftKey||27==e.keyCode&&(e.preventDefault(),t())}var s=document.createElement("div");s.className="confirmDialog-aligner";var c=30,d="Your session is about to expire. Whould you like to extend your session? It will automatically sign out in "+c+" seconds.",r=document.createElement("div");r.className="page-text",r.appendChild(document.createTextNode(d));var m=i("Yes, extend session","yes");m.href=location.href,m.addEventListener("click",function(e){e.preventDefault(),a(),clearTimeout(g),n()});var u=i("No, sign out","no");u.href=e,u.addEventListener("click",function(n){n.preventDefault(),t(e)});var v=document.createElement("div");v.className="twoColumns-column1",v.appendChild(m);var p=document.createElement("div");p.className="twoColumns-column2",p.appendChild(u);var f=document.createElement("div");f.className="twoColumns dynamic",f.appendChild(v),f.appendChild(p);var h=document.createElement("div");h.className="confirmDialog-frame",h.appendChild(r),h.appendChild(o()),h.appendChild(f);var C=document.createElement("div");C.className="confirmDialog",C.appendChild(s),C.appendChild(h);var E=document.body;E.appendChild(C),addEventListener("keydown",l);var g=setTimeout(function(){t(e+"?auto=1")},1e3*c);return{hide:a}}!function(t){function a(){function e(){var l=localStorage.sessionStartTime;if(l>i)i=l,setTimeout(e,o);else var s=t+"sign-out/submit.php",c=function(e){i==localStorage.sessionStartTime?location=e:d.hide()},d=n(s,a,c)}var i=Date.now();localStorage.sessionStartTime=i,setTimeout(e,o)}var o=18e5;a(),e(t),window.sessionTimeout={extend:function(){var e=Date.now();localStorage.sessionStartTime=e,localStorage.sessionExtendTime=e}}}(base)}();