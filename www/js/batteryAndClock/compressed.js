!function(){function e(e){function t(t,n){var a=document.createElement("img");a.alt=n,a.src=e+"images/"+t+".svg";var o=a.style;return o.display="inline-block",o.verticalAlign="top",o.position="absolute",o.top="-1px",o.right=o.left="0",o.margin="auto",o.width="9px",o.height=o.lineHeight="11px",o.backgroundRepeat="no-repeat",o.color="#444",o.textAlign="center",o.fontSize="11px",a}function n(){var e=Math.round(5*d.level)/5;o.style.width=100*e+"%";var t=e>.2?"#ccc":"#ee2020";r.style.borderColor=t,i.style.background=t,o.style.background=t}function a(){var e=d.charging?"inline-block":"none";c.style.display=e}var o=document.createElement("div");!function(e){e.display="inline-block",e.verticalAlign="top",e.height="100%",e.backgroundColor="#ccc"}(o.style);var i=document.createElement("div");!function(e){e.position="absolute",e.top=e.bottom=e.left="0",e.height="30%",e.margin="auto",e.background="#ccc",e.width="2px"}(i.style);var r=document.createElement("div");r.appendChild(o),function(e){e.textAlign="right",e.position="absolute",
e.top=e.right=e.bottom="3px",e.lineHeight="7px",e.left="2px",e.border="1px solid #ccc",e.padding="1px",e.borderRadius="1px"}(r.style);var l=document.getElementById("batteryWrapper");l.appendChild(i),l.appendChild(r);var d=navigator.battery;if(d){d.addEventListener("chargingchange",a),d.addEventListener("levelchange",n);var c=t("charging","⚡");r.appendChild(c),a(),n()}else r.appendChild(t("question","?"))}function t(e,t){function n(e){return document.createTextNode(e)}function a(e){var t=String(e);return 10>e&&(t="0"+t),t}function o(){var e=Date.now();d(function(){var n=new Date(Date.now()+60*t*1e3-i),r=a(n.getUTCHours());r!==c.nodeValue&&(c.nodeValue=r);var l=a(n.getUTCMinutes());p.nodeValue!==l&&(p.nodeValue=l);var d=a(n.getUTCSeconds());u.nodeValue!==d&&(u.nodeValue=d),m.forEach(function(e){e(n,n.getTime())}),setTimeout(o,Math.max(0,e+1e3-Date.now()))})}var i;if(window.localStorage){var r=parseInt(localStorage.lastRemoteTime,10);if(r>=e)i=parseInt(localStorage.lastLocalTime,10)-r;else{var l=Date.now();i=l-e,
localStorage.lastLocalTime=l,localStorage.lastRemoteTime=e}}else i=Date.now()-e;var d=window.requestAnimationFrame;d||(d=window.mozRequestAnimationFrame),d||(d=function(e){setTimeout(e,0)});var c=n(""),p=n(""),u=n(""),g=document.getElementById("dynamicClockWrapper");g.appendChild(c),g.appendChild(n(":")),g.appendChild(p),g.appendChild(n(":")),g.appendChild(u);var s=document.getElementById("staticClockWrapper");s.parentNode.removeChild(s),o();var m=[];return{onUpdate:function(e){m.push(e)}}}!function(n,a,o){e(n);var i=t(a,o);window.batteryAndClock={onClockUpdate:i.onUpdate}}(base,time,timezone)}();