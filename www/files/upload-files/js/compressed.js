!function(){function n(n,e){var t=0;return{hasNextChunk:function(){return t<n.size},readNextChunk:function(a){var r=n.slice(t,t+e),o=new FileReader;o.readAsArrayBuffer(r),o.onload=function(){t+=e,a(o.result)}}}}function e(n,e,t,a){var r=new XMLHttpRequest;return r.open("post","../../api-call/"+n),r.send(e),r.onerror=a,r.onload=function(){200==r.status?t():a()},r}!function(t,a){var r=1048576,o=!1,i=document.querySelector(".textList.warnings");i.parentNode.removeChild(i);var u=document.getElementById("uploadButton");u.addEventListener("click",function(i){function u(){var n="submit-finish.php?num_uploaded="+d+"&num_failed="+f;null!==t&&(n+="&parent_id="+t),location.assign(n)}function s(){function a(n,e){var t=new Blob([new Uint8Array(e)],{type:"application/octet-binary"});n.append("file",t,i)}var o=p.shift();if(!o)return void u();var i=o.name,l=n(o,r);l.readNextChunk(function(n){var r=new FormData;r.append("session_auth","1"),r.append("name",i),r.append("auto_rename","1"),null!==t&&r.append("parent_id",t),a(r,n);var o=e("file/add",r,function(){
function n(){l.hasNextChunk()?l.readNextChunk(function(r){var o=new FormData;o.append("session_auth","1"),o.append("id",t),a(o,r),e("file/appendContent",o,n,u)}):(d++,f--,s())}var t=JSON.parse(o.response);n()},u)})}if(i.preventDefault(),!o){o=!0,a.show();var d=0,p=[],l=document.querySelectorAll(".form-filefield");Array.prototype.forEach.call(l,function(n){Array.prototype.forEach.call(n.files,function(n){p.push(n)})});var f=p.length;s(),window.sessionTimeout&&setInterval(sessionTimeout.extend,3e4)}})}(parentId,unloadProgress)}();