!function(){function e(e){function n(){function a(){var o=localStorage.sessionExtendTime;if(o>i)i=o,setTimeout(a,t);else{var l=e+"api-call/session/extend?session_auth=1",c=new XMLHttpRequest;c.open("get",l),c.send(),c.onload=n}}var i=Date.now();localStorage.sessionExtendTime=i,setTimeout(a,t)}var t=3e5;n()}function n(e){function n(){var e=document.createElement("div");return e.className="hr",e}function t(e,n){var t=document.createElement("div");t.className="icon "+n;var a=document.createElement("div");a.className="image_link-icon",a.appendChild(t);var i=document.createElement("div");i.className="image_link-title",i.appendChild(document.createTextNode(e));var o=document.createElement("div");o.className="image_link-content",o.appendChild(i);var l=document.createElement("a");return l.className="clickable link image_link",l.appendChild(a),l.appendChild(o),l}function a(e){e.altKey||e.ctrlKey||e.metaKey||e.shiftKey||27==e.keyCode&&(e.preventDefault(),i())}function i(){location=o}var o=base+"sign-out/submit.php",l=document.createElement("div");l.className="confirmDialog-aligner";var c=10,d="Your session is about to expire. Whould you like to extend your session? It will automatically sign out in "+c+" seconds.",s=document.createElement("div");s.className="page-text",s.appendChild(document.createTextNode(d));var m=t("Yes, extend session","yes");m.href=location.href,m.addEventListener("click",function(n){n.preventDefault(),removeEventListener("keydown",a),C.removeChild(f),clearTimeout(E),e()});var r=t("No, sign out","no");r.href=o;var u=document.createElement("div");u.className="twoColumns-column1",u.appendChild(m);var v=document.createElement("div");v.className="twoColumns-column2",v.appendChild(r);var p=document.createElement("div");p.className="twoColumns dynamic",p.appendChild(u),p.appendChild(v);var h=document.createElement("div");h.className="confirmDialog-frame",h.appendChild(s),h.appendChild(n()),h.appendChild(p);var f=document.createElement("div");f.className="confirmDialog",f.appendChild(l),f.appendChild(h);var C=document.body;C.appendChild(f),addEventListener("keydown",a);var E=setTimeout(i,1e3*c)}!function(t){function a(){function e(){var o=localStorage.sessionStartTime;o>t?(t=o,setTimeout(e,i)):n(a)}var t=Date.now();localStorage.sessionStartTime=t,setTimeout(e,i)}var i=5e3;a(),e(t)}(base)}();