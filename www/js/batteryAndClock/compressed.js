!function(){function e(e){function t(t){var n=document.createElement("div"),a=n.style;return a.width="9px",a.height="11px",a.backgroundRepeat="none",a.backgroundImage="url("+e+"images/"+t+".svg)",a.position="absolute",a.top="-1px",a.right=a.left="0",a.margin="auto",n}function n(){var e=Math.round(5*l.level)/5;o.style.width=100*e+"%";var t=e>.2?"#ccc":"#ee2020";r.style.borderColor=t,i.style.background=t,o.style.background=t}function a(){var e=l.charging?"inline-block":"none";c.style.display=e}var o=document.createElement("div");!function(e){e.display="inline-block",e.verticalAlign="top",e.height="100%",e.backgroundColor="#ccc"}(o.style);var i=document.createElement("div");!function(e){e.position="absolute",e.top=e.bottom=e.left="0",e.height="30%",e.margin="auto",e.background="#ccc",e.width="2px"}(i.style);var r=document.createElement("div");r.appendChild(o),function(e){e.textAlign="right",e.position="absolute",e.top=e.right=e.bottom="3px",e.left="2px",e.border="1px solid #ccc",e.padding="1px",e.borderRadius="1px"}(r.style);var d=document.getElementById("batteryWrapper");d.appendChild(i),d.appendChild(r);var l=navigator.battery;if(l){l.addEventListener("chargingchange",a),l.addEventListener("levelchange",n);var c=t("charging");r.appendChild(c),a(),n()}else r.appendChild(t("question"))}function t(e){function t(e){return document.createTextNode(e)}function n(e){return 10>e?"0"+e:e}function a(){var e=Date.now();d(function(){var t=new Date(Date.now()-o);l.nodeValue=n(t.getUTCHours()),c.nodeValue=n(t.getUTCMinutes()),p.nodeValue=n(t.getUTCSeconds()),g.forEach(function(e){e(t)}),setTimeout(a,Math.max(0,e+1e3-Date.now()))})}var o,i=parseInt(localStorage.lastRemoteTime,10);if(i>=e)o=parseInt(localStorage.lastLocalTime,10)-i;else{var r=Date.now();o=r-e,localStorage.lastLocalTime=r,localStorage.lastRemoteTime=e}var d=window.requestAnimationFrame;d||(d=window.mozRequestAnimationFrame);var l=t(""),c=t(""),p=t(""),u=document.getElementById("dynamicClockWrapper");u.appendChild(l),u.appendChild(t(":")),u.appendChild(c),u.appendChild(t(":")),u.appendChild(p);var s=document.getElementById("staticClockWrapper");s.parentNode.removeChild(s),a();var g=[];return{onUpdate:function(e){g.push(e)}}}!function(n,a){e(n);var o=t(a);window.batteryAndClock={onClockUpdate:o.onUpdate}}(base,time)}();