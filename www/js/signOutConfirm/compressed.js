!function(t,n){var i,e=!1,o=document.getElementById("signOutLink");o.addEventListener("click",function(u){if(u.preventDefault(),o.blur(),!e){var c="Yes, sign out",s="Are you sure you want to sign out? It will automatically sign out in "+n+" seconds.";confirmDialog(s,c,t,function(){e=!1,clearTimeout(i)}),e=!0,i=setTimeout(function(){location=t},1e3*n)}})}(signOutHref,signOutTimeout);