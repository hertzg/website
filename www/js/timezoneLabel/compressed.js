!function(e,a){function n(e){return document.createTextNode(e)}function t(e){return 10>e?"0"+e:e}var o=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],d=document.querySelectorAll(".localTime");Array.prototype.forEach.call(d,function(d){function l(){var e=new Date(Date.now()-h),a=t(e.getUTCHours());a!=i.nodeValue&&(i.nodeValue=a);var n=t(e.getUTCMinutes());n!=u.nodeValue&&(u.nodeValue=n);var d=o[e.getUTCMonth()];d!=p.nodeValue&&(p.nodeValue=d);var l=e.getUTCDate();l!=c.nodeValue&&(c.nodeValue=l)}var r=d.classList;if(!r.contains("processed")){r.add("processed");for(var i=n(""),u=n(""),p=n(""),c=n("");d.firstChild;)d.removeChild(d.firstChild);d.appendChild(i),d.appendChild(n(":")),d.appendChild(u),d.appendChild(n(", ")),d.appendChild(p),d.appendChild(n(" ")),d.appendChild(c);var s=d.dataset.local_timezone,C=60*(a-s)*1e3,h=Date.now()-e+C;setInterval(l,5e3),l()}})}(time,timezone);