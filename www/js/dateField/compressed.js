!function(){var e=document.querySelectorAll(".datefield");Array.prototype.forEach.call(e,function(e){function a(){var e=r.value,a=n.value,v=i.value,c=!0;if(""!==e&&""!==a&&""!==v){e=parseInt(e,10),a=parseInt(a,10),v=parseInt(v,10);var o=new Date(v,a,0).getDate();c=o>=e}c?(t.remove("invalid"),l.remove("invalid"),d.remove("invalid")):(t.add("invalid"),l.add("invalid"),d.add("invalid"))}var r=e.querySelector(".form-select.day");r.addEventListener("change",a);var t=r.classList,n=e.querySelector(".form-select.month");n.addEventListener("change",a);var l=n.classList,i=e.querySelector(".form-select.year");i.addEventListener("change",a);var d=i.classList;a()})}();