!function(r){function a(r,a){var o=Math.floor((a-r)/1e3),t=Math.floor(o/60);if(!t)return"just now";if(1>=t)return"a minute ago";if(30==t)return"half an hour ago";var n=Math.floor(t/60);if(!n)return t+" minutes ago";if(1==n)return"an hour ago";var e=Math.floor(n/24);if(!e)return n+" hours ago";if(1==e)return"yesterday";var u=Math.floor(e/30);if(!u)return e+" days ago";if(1==u)return"a month ago";var f=Math.floor(u/12);return f?1==f?"a year ago":f+" years ago":u+" months ago"}var o=[],t=document.querySelectorAll(".dateAgo");Array.prototype.forEach.call(t,function(r){var t=r.firstChild,n=1e3*r.dataset.time;o.push({update:function(r,o){t.nodeValue=a(n,o)}})}),r.onClockUpdate(function(r,a){o.forEach(function(o){o.update(r,a)})})}(batteryAndClock);