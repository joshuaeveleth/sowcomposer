// Generated by CoffeeScript 1.3.3
(function(){(function(e){var t;t=["font","letter-spacing"];return e.fn.autoGrow=function(n){var r,i,s;i=n==="remove"||n===!1||(n!=null?!!n.remove:!!void 0);r=(s=n!=null?n.comfortZone:void 0)!=null?s:n;r!=null&&(r=+r);return this.each(function(){var n,s,o,u,a,f,l,c,h,p;o=e(this);f=o.next().filter("pre.autogrow");if(f.length&&i){o.unbind("input.autogrow");return f.remove()}if(f.length){a={};for(l=0,h=t.length;l<h;l++){u=t[l];a[u]=o.css(u)}f.css(a);if(r!=null){n=function(){f.text(o.val());return o.width(f.width()+r)};o.unbind("input.autogrow");o.bind("input.autogrow",n);return n()}}else if(!i){o.css("min-width")==="0px"&&o.css("min-width",""+o.width()+"px");a={position:"absolute",top:-99999,left:-99999,width:"auto",visibility:"hidden"};for(c=0,p=t.length;c<p;c++){u=t[c];a[u]=o.css(u)}f=e('<pre class="autogrow"/>').css(a);f.insertAfter(o);s=r!=null?r:70;n=function(){f.text(o.val());return o.width(f.width()+s)};o.bind("input.autogrow",n);return n()}})}})(typeof Zepto!="undefined"&&Zepto!==null?Zepto:jQuery)}).call(this);