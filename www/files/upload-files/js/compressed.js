!function(){function n(n,e){var t=0;return{hasNextChunk:function(){return t<n.size},readNextChunk:function(a){var r=n.slice(t,t+e),o=new FileReader;o.readAsArrayBuffer(r),o.onload=function(){t+=e,a(o.result)}}}}function e(n,e,t){var a=new XMLHttpRequest;return a.open("post","../../api-call/"+n),a.send(e),a.onerror=function(){},a.onload=t,a}!function(t,a,r){var o=1048576,i=!1,u=document.querySelector(".textList.warnings");u.parentNode.removeChild(u);var p=document.getElementById("uploadButton");p.addEventListener("click",function(u){function p(){function a(n,e){var t=new Blob([new Uint8Array(e)],{type:"application/octet-binary"});n.append("file",t,u)}var r=l.shift();if(!r){var i="submit-finish.php?num_files="+d;return null!==t&&(i+="&parent_id="+t),void(location=i)}var u=r.name,f=n(r,o);f.readNextChunk(function(n){var r=new FormData;r.append("session_auth","1"),r.append("name",u),r.append("auto_rename","1"),null!==t&&r.append("parent_id",t),a(r,n);var o=e("file/add",r,function(){function n(){f.hasNextChunk()?f.readNextChunk(function(r){var o=new FormData;o.append("session_auth","1"),o.append("id",t),a(o,r),e("file/appendContent",o,n)}):p()}var t=JSON.parse(o.response);n()})})}if(u.preventDefault(),!i){i=!0,a.show();var l=[],d=0,f=document.querySelectorAll(".form-filefield");Array.prototype.forEach.call(f,function(n){Array.prototype.forEach.call(n.files,function(n){l.push(n),d++})}),p(),setInterval(r.extend,3e4)}})}(parentId,unloadProgress,sessionTimeout)}();