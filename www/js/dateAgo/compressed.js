!function(r,a){function o(r,a,o){function t(r,a){var o=Math.floor((a-r)/1e3),t=Math.floor(o/60);if(!t)return"just now";if(1>=t)return"a minute ago";if(30==t)return"half an hour ago";var e=Math.floor(t/60);if(!e)return t+" minutes ago";if(1==e)return"an hour ago";var n=Math.floor(e/24);if(!n)return e+" hours ago";if(1==n)return"yesterday";var u=Math.floor(n/7);if(!u)return n+" days ago";if(1==u)return"a week ago";var f=Math.floor(n/30);if(!f)return u+" weeks ago";if(1==f)return"a month ago";var i=Math.floor(f/12);return i?1==i?"a year ago":i+" years ago":f+" months ago"}var e=t(r,a);return o&&(e=e.substr(0,1).toUpperCase()+e.substr(1)),e}function t(r,a){e.forEach(function(o){o.update(r,a)})}var e=[],n=document.querySelectorAll(".dateAgo");Array.prototype.forEach.call(n,function(r){var a=r.firstChild,t=r.dataset,n=1e3*t.time;e.push({update:function(r,e){var u=o(n,e,t.uppercase);a.nodeValue!==u&&(a.nodeValue=u)}})}),r.onClockUpdate(t),a.onUnload(function(){r.unClockUpdate(t)})}(batteryAndClock,localNavigation);