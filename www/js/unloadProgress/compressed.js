!function(e){function t(){if(!n){n=document.createElement("div");var t=n.style;t.position="fixed",t.zIndex="1",t.right=t.bottom=t.left="0",t.height="4px",t.backgroundColor="#fff",t.backgroundImage="url("+e+"images/progress.svg)",t.backgroundPosition="50% 0";var d=0;i=setInterval(function(){var e="calc(50% + "+d+"px) 0";n.style.backgroundPosition=e,d=(d+1)%8},50),r.appendChild(n)}if(!o){o=document.createElement("div"),o.addEventListener("click",function(){r.removeChild(o),o=null});var t=o.style;t.position="fixed",t.zIndex="1",t.top=t.right=t.bottom=t.left="0",t.background="rgba(0, 0, 0, 0.5)",r.insertBefore(o,n),l=setTimeout(function(){var e=document.createElement("div");e.style.position="absolute",e.style.right=e.style.left="0",e.style.bottom="4px",e.style.color="#fff",e.style.textAlign="center",e.style.fontSize="12px",e.style.lineHeight="24px",e.style.textShadow="0 0 1px #000",e.style.whiteSpace="nowrap",e.style.overflow="hidden",e.appendChild(document.createTextNode("Tap to release")),o.appendChild(e)},3e3)}
}var o,n,i,l,r=document.body;addEventListener("beforeunload",t),window.unloadProgress={show:t,hide:function(){clearInterval(i),clearTimeout(l),n&&r.removeChild(n),o&&r.removeChild(o)}}}(base);