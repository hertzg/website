!function(){function n(n,e){var t=0;return{hasNextChunk:function(){return t<n.size},readNextChunk:function(a){var r=n.slice(t,t+e),o=new FileReader;o.readAsArrayBuffer(r),o.onload=function(){t+=e,a(o.result)}}}}function e(n,e,t,a){var r=new XMLHttpRequest;return r.open("post","../../api-call/"+n),r.send(e),r.onerror=a,r.onload=function(){200==r.status?t():a()},r}!function(t,a,r){var o=1048576,i=!1,u=document.querySelector(".textList.warnings");u.parentNode.removeChild(u);var p=document.getElementById("uploadButton");p.addEventListener("click",function(u){function p(){var n="submit-finish.php?num_uploaded="+l+"&num_failed="+c;null!==t&&(n+="&parent_id="+t),location.assign(n)}function d(){function a(n,e){var t=new Blob([new Uint8Array(e)],{type:"application/octet-binary"});n.append("file",t,i)}var r=s.shift();if(!r)return void p();var i=r.name,u=n(r,o);u.readNextChunk(function(n){var r=new FormData;r.append("session_auth","1"),r.append("name",i),r.append("auto_rename","1"),null!==t&&r.append("parent_id",t),a(r,n);
var o=e("file/add",r,function(){function n(){u.hasNextChunk()?u.readNextChunk(function(r){var o=new FormData;o.append("session_auth","1"),o.append("id",t),a(o,r),e("file/appendContent",o,n,p)}):(l++,c--,d())}var t=JSON.parse(o.response);n()},p)})}if(u.preventDefault(),!i){i=!0,a.show();var l=0,s=[],f=document.querySelectorAll(".form-filefield");Array.prototype.forEach.call(f,function(n){Array.prototype.forEach.call(n.files,function(n){s.push(n)})});var c=s.length;d(),setInterval(r.extend,3e4)}})}(parentId,unloadProgress,sessionTimeout)}();