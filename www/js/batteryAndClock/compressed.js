!function(){function e(e){function t(t,n){var a=document.createElement("img");a.alt=n,a.src=e+"images/"+t+".svg";var o=a.style;return o.display="inline-block",o.verticalAlign="top",o.position="absolute",o.top="-1px",o.right=o.left="0",o.margin="auto",o.width="9px",o.height=o.lineHeight="11px",o.backgroundRepeat="no-repeat",o.color="#444",o.textAlign="center",o.fontSize="11px",a}function n(){var e=Math.round(5*c.level)/5;o.style.width=100*e+"%";var t=e>.2?"#ccc":"#ee2020";r.style.borderColor=t,i.style.background=t,o.style.background=t}function a(){var e=c.charging?"inline-block":"none";d.style.display=e}var o=document.createElement("div");!function(e){e.display="inline-block",e.verticalAlign="top",e.height="100%",e.backgroundColor="#ccc"}(o.style);var i=document.createElement("div");!function(e){e.position="absolute",e.top=e.bottom=e.left="0",e.height="30%",e.margin="auto",e.background="#ccc",e.width="2px"}(i.style);var r=document.createElement("div");r.appendChild(o),function(e){e.textAlign="right",e.position="absolute",e.top=e.right=e.bottom="3px",e.lineHeight="7px",e.left="2px",e.border="1px solid #ccc",e.padding="1px",e.borderRadius="1px"}(r.style);var l=document.getElementById("batteryWrapper");l.appendChild(i),l.appendChild(r);var c=navigator.battery;if(c){c.addEventListener("chargingchange",a),c.addEventListener("levelchange",n);var d=t("charging","⚡");r.appendChild(d),a(),n()}else r.appendChild(t("question","?"))}function t(e){function t(e){return document.createTextNode(e)}function n(e){return 10>e?"0"+e:e}function a(){var e=Date.now();l(function(){var t=new Date(Date.now()-o);c.nodeValue=n(t.getUTCHours()),d.nodeValue=n(t.getUTCMinutes()),p.nodeValue=n(t.getUTCSeconds()),g.forEach(function(e){e(t)}),setTimeout(a,Math.max(0,e+1e3-Date.now()))})}var o,i=parseInt(localStorage.lastRemoteTime,10);if(i>=e)o=parseInt(localStorage.lastLocalTime,10)-i;else{var r=Date.now();o=r-e,localStorage.lastLocalTime=r,localStorage.lastRemoteTime=e}var l=window.requestAnimationFrame;l||(l=window.mozRequestAnimationFrame),l||(l=function(e){setTimeout(e,0)});var c=t(""),d=t(""),p=t(""),u=document.getElementById("dynamicClockWrapper");u.appendChild(c),u.appendChild(t(":")),u.appendChild(d),u.appendChild(t(":")),u.appendChild(p);var s=document.getElementById("staticClockWrapper");s.parentNode.removeChild(s),a();var g=[];return{onUpdate:function(e){g.push(e)}}}!function(n,a){e(n);var o=t(a);window.batteryAndClock={onClockUpdate:o.onUpdate}}(base,time)}();