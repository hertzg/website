!function(e){function t(){r||(n.removeChild(d),r=!0)}function o(){t(),n.removeChild(s)}var n=document.querySelector(".imageProgress"),i=n.firstChild,r=!1,l=document.createElement("img");l.src=i.src,l.addEventListener("abort",o),l.addEventListener("error",o),l.addEventListener("load",o);var a=i.className;""!==a&&(l.className=a);var s=document.createElement("div");!function(t){t.position="absolute",t.right=t.bottom=t.left="0",t.backgroundColor="#fff",t.backgroundImage="url("+e+"images/progress.svg)",t.backgroundPosition="50% 0",t.height="4px"}(s.style);var d=document.createElement("div");d.addEventListener("click",t),function(e){e.position="absolute",e.top=e.right=e.bottom=e.left="0",e.background="rgba(0, 0, 0, 0.5)"}(d.style),n.removeChild(i),n.appendChild(l),n.appendChild(d),n.appendChild(s);var c=0;setInterval(function(){s.style.backgroundPosition="calc(50% + "+c+"px) 0",c=(c+1)%8},50),setTimeout(function(){var e=document.createElement("div");e.style.position="absolute",e.style.right=e.style.left="0",e.style.bottom="4px",
e.style.color="#fff",e.style.textAlign="center",e.style.fontSize="12px",e.style.lineHeight="24px",e.style.textShadow="0 0 1px #000",e.style.whiteSpace="nowrap",e.style.overflow="hidden",e.appendChild(document.createTextNode("Tap to release")),d.appendChild(e)},3e3)}(base);