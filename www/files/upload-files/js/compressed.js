!function(){function n(n,e){var t=0;return{hasNextChunk:function(){return t<n.size},readNextChunk:function(a){var r=n.slice(t,t+e),o=new FileReader;o.readAsArrayBuffer(r),o.onload=function(){t+=e,a(o.result)}}}}function e(n,e,t){var a=new XMLHttpRequest;return a.open("post","../../api-call/"+n),a.send(e),a.onerror=function(){},a.onload=t,a}!function(t,a){var r=1048576,o=!1,i=document.querySelector(".textList.warnings");i.parentNode.removeChild(i);var u=document.getElementById("uploadButton");u.addEventListener("click",function(i){function u(){function a(n,e){var t=new Blob([new Uint8Array(e)],{type:"application/octet-binary"});n.append("file",t,d)}var o=p.shift();if(!o){var i="submit-finish.php?num_files="+l;return null!==t&&(i+="&parent_id="+t),void(location=i)}var d=o.name,f=n(o,r);f.readNextChunk(function(n){var r=new FormData;r.append("session_auth","1"),r.append("name",d),r.append("auto_rename","1"),null!==t&&r.append("parent_id",t),a(r,n);var o=e("file/add",r,function(){function n(){f.hasNextChunk()?f.readNextChunk(function(r){var o=new FormData;o.append("session_auth","1"),o.append("id",t),a(o,r),e("file/appendContent",o,n)}):u()}var t=JSON.parse(o.response);n()})})}if(i.preventDefault(),!o){o=!0,a.show();var p=[],l=0,d=document.querySelectorAll(".form-filefield");Array.prototype.forEach.call(d,function(n){Array.prototype.forEach.call(n.files,function(n){p.push(n),l++})}),u()}})}(parentId,unloadProgress)}();