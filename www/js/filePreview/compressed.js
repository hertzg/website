!function(e){function t(){a||(s.removeChild(c),a=!0)}var i=document.querySelector(".preview"),n=i.firstChild,o=n.tagName;if("IMG"==o){var a=!1,l=n,r=document.createElement("img");r.src=l.src,r.addEventListener("load",function(){t(),s.removeChild(d)}),function(e){e.display="inline-block",e.verticalAlign="top",e.maxWidth="100%",e.maxHeight="150px"}(r.style);var d=document.createElement("div");!function(t){t.position="absolute",t.right=t.bottom=t.left="0",t.backgroundColor="#fff",t.backgroundImage="url("+e+"images/progress.svg)",t.backgroundPosition="50% 0",t.height="4px"}(d.style);var c=document.createElement("div");c.addEventListener("click",t),function(e){e.position="absolute",e.top=e.right=e.bottom=e.left="0",e.background="rgba(0, 0, 0, 0.5)"}(c.style);var s=document.createElement("div");s.appendChild(r),s.appendChild(c),s.appendChild(d),function(e){e.display="inline-block",e.verticalAlign="top",e.maxWidth="100%",e.maxHeight="150px",e.position="relative"}(s.style),i.removeChild(l),i.appendChild(s);var m=0;setInterval(function(){d.style.backgroundPosition="calc(50% + "+m+"px) 0",m=(m+1)%8},50)}}(base);