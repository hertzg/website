!function(e){var t=!1;addEventListener("beforeunload",function(){if(!t){t=!0;var n=document.createElement("div");!function(t){t.position="fixed",t.right=t.bottom=t.left="0",t.height="4px",t.backgroundColor="#fff",t.backgroundImage="url("+e+"images/progress.svg)",t.backgroundPosition="50% 0"}(n.style);var o=document.createElement("div");!function(e){e.position="fixed",e.top=e.right=e.bottom=e.left="0",e.background="rgba(0, 0, 0, 0.5)"}(o.style),o.addEventListener("click",function(){i.removeChild(o)});var i=document.body;i.appendChild(o),i.appendChild(n);var r=0;setInterval(function(){n.style.backgroundPosition="calc(50% + "+r+"px) 0",r=(r+1)%8},50)}})}(base);