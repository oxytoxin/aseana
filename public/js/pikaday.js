/**
 * Minified by jsDelivr using Terser v5.3.0.
 * Original file: /npm/pikaday@1.8.2/pikaday.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
/*!
 * Pikaday
 *
 * Copyright © 2014 David Bushell | BSD & MIT license | https://github.com/Pikaday/Pikaday
 */
!function(e,t){"use strict";var n;if("object"==typeof exports){try{n=require("moment")}catch(e){}module.exports=t(n)}else"function"==typeof define&&define.amd?define((function(e){try{n=e("moment")}catch(e){}return t(n)})):e.Pikaday=t(e.moment)}(this,(function(e){"use strict";var t="function"==typeof e,n=!!window.addEventListener,a=window.document,i=window.setTimeout,s=function(e,t,a,i){n?e.addEventListener(t,a,!!i):e.attachEvent("on"+t,a)},o=function(e,t,a,i){n?e.removeEventListener(t,a,!!i):e.detachEvent("on"+t,a)},r=function(e,t){return-1!==(" "+e.className+" ").indexOf(" "+t+" ")},l=function(e,t){r(e,t)||(e.className=""===e.className?t:e.className+" "+t)},h=function(e,t){var n;e.className=(n=(" "+e.className+" ").replace(" "+t+" "," ")).trim?n.trim():n.replace(/^\s+|\s+$/g,"")},d=function(e){return/Array/.test(Object.prototype.toString.call(e))},u=function(e){return/Date/.test(Object.prototype.toString.call(e))&&!isNaN(e.getTime())},c=function(e){var t=e.getDay();return 0===t||6===t},f=function(e){return e%4==0&&e%100!=0||e%400==0},g=function(e,t){return[31,f(e)?29:28,31,30,31,30,31,31,30,31,30,31][t]},m=function(e){u(e)&&e.setHours(0,0,0,0)},p=function(e,t){return e.getTime()===t.getTime()},y=function(e,t,n){var a,i;for(a in t)(i=void 0!==e[a])&&"object"==typeof t[a]&&null!==t[a]&&void 0===t[a].nodeName?u(t[a])?n&&(e[a]=new Date(t[a].getTime())):d(t[a])?n&&(e[a]=t[a].slice(0)):e[a]=y({},t[a],n):!n&&i||(e[a]=t[a]);return e},D=function(e,t,n){var i;a.createEvent?((i=a.createEvent("HTMLEvents")).initEvent(t,!0,!1),i=y(i,n),e.dispatchEvent(i)):a.createEventObject&&(i=a.createEventObject(),i=y(i,n),e.fireEvent("on"+t,i))},b=function(e){return e.month<0&&(e.year-=Math.ceil(Math.abs(e.month)/12),e.month+=12),e.month>11&&(e.year+=Math.floor(Math.abs(e.month)/12),e.month-=12),e},v={field:null,bound:void 0,ariaLabel:"Use the arrow keys to pick a date",position:"bottom left",reposition:!0,format:"YYYY-MM-DD",toString:null,parse:null,defaultDate:null,setDefaultDate:!1,firstDay:0,firstWeekOfYearMinDays:4,formatStrict:!1,minDate:null,maxDate:null,yearRange:10,showWeekNumber:!1,pickWholeWeek:!1,minYear:0,maxYear:9999,minMonth:void 0,maxMonth:void 0,startRange:null,endRange:null,isRTL:!1,yearSuffix:"",showMonthAfterYear:!1,showDaysInNextAndPreviousMonths:!1,enableSelectionDaysInNextAndPreviousMonths:!1,numberOfMonths:1,mainCalendar:"left",container:void 0,blurFieldOnSelect:!0,i18n:{previousMonth:"Previous Month",nextMonth:"Next Month",months:["January","February","March","April","May","June","July","August","September","October","November","December"],weekdays:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],weekdaysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]},theme:null,events:[],onSelect:null,onOpen:null,onClose:null,onDraw:null,keyboardInput:!0},_=function(e,t,n){for(t+=e.firstDay;t>=7;)t-=7;return n?e.i18n.weekdaysShort[t]:e.i18n.weekdays[t]},w=function(e){var t=[],n="false";if(e.isEmpty){if(!e.showDaysInNextAndPreviousMonths)return'<td class="is-empty"></td>';t.push("is-outside-current-month"),e.enableSelectionDaysInNextAndPreviousMonths||t.push("is-selection-disabled")}return e.isDisabled&&t.push("is-disabled"),e.isToday&&t.push("is-today"),e.isSelected&&(t.push("is-selected"),n="true"),e.hasEvent&&t.push("has-event"),e.isInRange&&t.push("is-inrange"),e.isStartRange&&t.push("is-startrange"),e.isEndRange&&t.push("is-endrange"),'<td data-day="'+e.day+'" class="'+t.join(" ")+'" aria-selected="'+n+'"><button class="pika-button pika-day" type="button" data-pika-year="'+e.year+'" data-pika-month="'+e.month+'" data-pika-day="'+e.day+'">'+e.day+"</button></td>"},k=function(n,a,i,s){var o=new Date(i,a,n);return'<td class="pika-week">'+(t?e(o).isoWeek():function(e,t){e.setHours(0,0,0,0);var n=e.getDate(),a=e.getDay(),i=t,s=i-1,o=function(e){return(e+7-1)%7};e.setDate(n+s-o(a));var r=new Date(e.getFullYear(),0,i),l=(e.getTime()-r.getTime())/864e5;return 1+Math.round((l-s+o(r.getDay()))/7)}(o,s))+"</td>"},M=function(e,t,n,a){return'<tr class="pika-row'+(n?" pick-whole-week":"")+(a?" is-selected":"")+'">'+(t?e.reverse():e).join("")+"</tr>"},x=function(e,t,n,a,i,s){var o,r,l,h,u,c=e._o,f=n===c.minYear,g=n===c.maxYear,m='<div id="'+s+'" class="pika-title" role="heading" aria-live="assertive">',p=!0,y=!0;for(l=[],o=0;o<12;o++)l.push('<option value="'+(n===i?o-t:12+o-t)+'"'+(o===a?' selected="selected"':"")+(f&&o<c.minMonth||g&&o>c.maxMonth?' disabled="disabled"':"")+">"+c.i18n.months[o]+"</option>");for(h='<div class="pika-label">'+c.i18n.months[a]+'<select class="pika-select pika-select-month" tabindex="-1">'+l.join("")+"</select></div>",d(c.yearRange)?(o=c.yearRange[0],r=c.yearRange[1]+1):(o=n-c.yearRange,r=1+n+c.yearRange),l=[];o<r&&o<=c.maxYear;o++)o>=c.minYear&&l.push('<option value="'+o+'"'+(o===n?' selected="selected"':"")+">"+o+"</option>");return u='<div class="pika-label">'+n+c.yearSuffix+'<select class="pika-select pika-select-year" tabindex="-1">'+l.join("")+"</select></div>",c.showMonthAfterYear?m+=u+h:m+=h+u,f&&(0===a||c.minMonth>=a)&&(p=!1),g&&(11===a||c.maxMonth<=a)&&(y=!1),0===t&&(m+='<button class="pika-prev'+(p?"":" is-disabled")+'" type="button">'+c.i18n.previousMonth+"</button>"),t===e._o.numberOfMonths-1&&(m+='<button class="pika-next'+(y?"":" is-disabled")+'" type="button">'+c.i18n.nextMonth+"</button>"),m+"</div>"},R=function(e,t,n){return'<table cellpadding="0" cellspacing="0" class="pika-table" role="grid" aria-labelledby="'+n+'">'+function(e){var t,n=[];for(e.showWeekNumber&&n.push("<th></th>"),t=0;t<7;t++)n.push('<th scope="col"><abbr title="'+_(e,t)+'">'+_(e,t,!0)+"</abbr></th>");return"<thead><tr>"+(e.isRTL?n.reverse():n).join("")+"</tr></thead>"}(e)+("<tbody>"+t.join("")+"</tbody></table>")},N=function(o){var l=this,h=l.config(o);l._onMouseDown=function(e){if(l._v){var t=(e=e||window.event).target||e.srcElement;if(t)if(r(t,"is-disabled")||(!r(t,"pika-button")||r(t,"is-empty")||r(t.parentNode,"is-disabled")?r(t,"pika-prev")?l.prevMonth():r(t,"pika-next")&&l.nextMonth():(l.setDate(new Date(t.getAttribute("data-pika-year"),t.getAttribute("data-pika-month"),t.getAttribute("data-pika-day"))),h.bound&&i((function(){l.hide(),h.blurFieldOnSelect&&h.field&&h.field.blur()}),100))),r(t,"pika-select"))l._c=!0;else{if(!e.preventDefault)return e.returnValue=!1,!1;e.preventDefault()}}},l._onChange=function(e){var t=(e=e||window.event).target||e.srcElement;t&&(r(t,"pika-select-month")?l.gotoMonth(t.value):r(t,"pika-select-year")&&l.gotoYear(t.value))},l._onKeyChange=function(e){if(e=e||window.event,l.isVisible())switch(e.keyCode){case 13:case 27:h.field&&h.field.blur();break;case 37:l.adjustDate("subtract",1);break;case 38:l.adjustDate("subtract",7);break;case 39:l.adjustDate("add",1);break;case 40:l.adjustDate("add",7);break;case 8:case 46:l.setDate(null)}},l._parseFieldValue=function(){if(h.parse)return h.parse(h.field.value,h.format);if(t){var n=e(h.field.value,h.format,h.formatStrict);return n&&n.isValid()?n.toDate():null}return new Date(Date.parse(h.field.value))},l._onInputChange=function(e){var t;e.firedBy!==l&&(t=l._parseFieldValue(),u(t)&&l.setDate(t),l._v||l.show())},l._onInputFocus=function(){l.show()},l._onInputClick=function(){l.show()},l._onInputBlur=function(){var e=a.activeElement;do{if(r(e,"pika-single"))return}while(e=e.parentNode);l._c||(l._b=i((function(){l.hide()}),50)),l._c=!1},l._onClick=function(e){var t=(e=e||window.event).target||e.srcElement,a=t;if(t){!n&&r(t,"pika-select")&&(t.onchange||(t.setAttribute("onchange","return;"),s(t,"change",l._onChange)));do{if(r(a,"pika-single")||a===h.trigger)return}while(a=a.parentNode);l._v&&t!==h.trigger&&a!==h.trigger&&l.hide()}},l.el=a.createElement("div"),l.el.className="pika-single"+(h.isRTL?" is-rtl":"")+(h.theme?" "+h.theme:""),s(l.el,"mousedown",l._onMouseDown,!0),s(l.el,"touchend",l._onMouseDown,!0),s(l.el,"change",l._onChange),h.keyboardInput&&s(a,"keydown",l._onKeyChange),h.field&&(h.container?h.container.appendChild(l.el):h.bound?a.body.appendChild(l.el):h.field.parentNode.insertBefore(l.el,h.field.nextSibling),s(h.field,"change",l._onInputChange),h.defaultDate||(h.defaultDate=l._parseFieldValue(),h.setDefaultDate=!0));var d=h.defaultDate;u(d)?h.setDefaultDate?l.setDate(d,!0):l.gotoDate(d):l.gotoDate(new Date),h.bound?(this.hide(),l.el.className+=" is-bound",s(h.trigger,"click",l._onInputClick),s(h.trigger,"focus",l._onInputFocus),s(h.trigger,"blur",l._onInputBlur)):this.show()};return N.prototype={config:function(e){this._o||(this._o=y({},v,!0));var t=y(this._o,e,!0);t.isRTL=!!t.isRTL,t.field=t.field&&t.field.nodeName?t.field:null,t.theme="string"==typeof t.theme&&t.theme?t.theme:null,t.bound=!!(void 0!==t.bound?t.field&&t.bound:t.field),t.trigger=t.trigger&&t.trigger.nodeName?t.trigger:t.field,t.disableWeekends=!!t.disableWeekends,t.disableDayFn="function"==typeof t.disableDayFn?t.disableDayFn:null;var n=parseInt(t.numberOfMonths,10)||1;if(t.numberOfMonths=n>4?4:n,u(t.minDate)||(t.minDate=!1),u(t.maxDate)||(t.maxDate=!1),t.minDate&&t.maxDate&&t.maxDate<t.minDate&&(t.maxDate=t.minDate=!1),t.minDate&&this.setMinDate(t.minDate),t.maxDate&&this.setMaxDate(t.maxDate),d(t.yearRange)){var a=(new Date).getFullYear()-10;t.yearRange[0]=parseInt(t.yearRange[0],10)||a,t.yearRange[1]=parseInt(t.yearRange[1],10)||a}else t.yearRange=Math.abs(parseInt(t.yearRange,10))||v.yearRange,t.yearRange>100&&(t.yearRange=100);return t},toString:function(n){return n=n||this._o.format,u(this._d)?this._o.toString?this._o.toString(this._d,n):t?e(this._d).format(n):this._d.toDateString():""},getMoment:function(){return t?e(this._d):null},setMoment:function(n,a){t&&e.isMoment(n)&&this.setDate(n.toDate(),a)},getDate:function(){return u(this._d)?new Date(this._d.getTime()):null},setDate:function(e,t){if(!e)return this._d=null,this._o.field&&(this._o.field.value="",D(this._o.field,"change",{firedBy:this})),this.draw();if("string"==typeof e&&(e=new Date(Date.parse(e))),u(e)){var n=this._o.minDate,a=this._o.maxDate;u(n)&&e<n?e=n:u(a)&&e>a&&(e=a),this._d=new Date(e.getTime()),m(this._d),this.gotoDate(this._d),this._o.field&&(this._o.field.value=this.toString(),D(this._o.field,"change",{firedBy:this})),t||"function"!=typeof this._o.onSelect||this._o.onSelect.call(this,this.getDate())}},clear:function(){this.setDate(null)},gotoDate:function(e){var t=!0;if(u(e)){if(this.calendars){var n=new Date(this.calendars[0].year,this.calendars[0].month,1),a=new Date(this.calendars[this.calendars.length-1].year,this.calendars[this.calendars.length-1].month,1),i=e.getTime();a.setMonth(a.getMonth()+1),a.setDate(a.getDate()-1),t=i<n.getTime()||a.getTime()<i}t&&(this.calendars=[{month:e.getMonth(),year:e.getFullYear()}],"right"===this._o.mainCalendar&&(this.calendars[0].month+=1-this._o.numberOfMonths)),this.adjustCalendars()}},adjustDate:function(e,t){var n,a=this.getDate()||new Date,i=24*parseInt(t)*60*60*1e3;"add"===e?n=new Date(a.valueOf()+i):"subtract"===e&&(n=new Date(a.valueOf()-i)),this.setDate(n)},adjustCalendars:function(){this.calendars[0]=b(this.calendars[0]);for(var e=1;e<this._o.numberOfMonths;e++)this.calendars[e]=b({month:this.calendars[0].month+e,year:this.calendars[0].year});this.draw()},gotoToday:function(){this.gotoDate(new Date)},gotoMonth:function(e){isNaN(e)||(this.calendars[0].month=parseInt(e,10),this.adjustCalendars())},nextMonth:function(){this.calendars[0].month++,this.adjustCalendars()},prevMonth:function(){this.calendars[0].month--,this.adjustCalendars()},gotoYear:function(e){isNaN(e)||(this.calendars[0].year=parseInt(e,10),this.adjustCalendars())},setMinDate:function(e){e instanceof Date?(m(e),this._o.minDate=e,this._o.minYear=e.getFullYear(),this._o.minMonth=e.getMonth()):(this._o.minDate=v.minDate,this._o.minYear=v.minYear,this._o.minMonth=v.minMonth,this._o.startRange=v.startRange),this.draw()},setMaxDate:function(e){e instanceof Date?(m(e),this._o.maxDate=e,this._o.maxYear=e.getFullYear(),this._o.maxMonth=e.getMonth()):(this._o.maxDate=v.maxDate,this._o.maxYear=v.maxYear,this._o.maxMonth=v.maxMonth,this._o.endRange=v.endRange),this.draw()},setStartRange:function(e){this._o.startRange=e},setEndRange:function(e){this._o.endRange=e},draw:function(e){if(this._v||e){var t,n=this._o,a=n.minYear,s=n.maxYear,o=n.minMonth,r=n.maxMonth,l="";this._y<=a&&(this._y=a,!isNaN(o)&&this._m<o&&(this._m=o)),this._y>=s&&(this._y=s,!isNaN(r)&&this._m>r&&(this._m=r));for(var h=0;h<n.numberOfMonths;h++)t="pika-title-"+Math.random().toString(36).replace(/[^a-z]+/g,"").substr(0,2),l+='<div class="pika-lendar">'+x(this,h,this.calendars[h].year,this.calendars[h].month,this.calendars[0].year,t)+this.render(this.calendars[h].year,this.calendars[h].month,t)+"</div>";this.el.innerHTML=l,n.bound&&"hidden"!==n.field.type&&i((function(){n.trigger.focus()}),1),"function"==typeof this._o.onDraw&&this._o.onDraw(this),n.bound&&n.field.setAttribute("aria-label",n.ariaLabel)}},adjustPosition:function(){var e,t,n,i,s,o,r,d,u,c,f,g;if(!this._o.container){if(this.el.style.position="absolute",t=e=this._o.trigger,n=this.el.offsetWidth,i=this.el.offsetHeight,s=window.innerWidth||a.documentElement.clientWidth,o=window.innerHeight||a.documentElement.clientHeight,r=window.pageYOffset||a.body.scrollTop||a.documentElement.scrollTop,f=!0,g=!0,"function"==typeof e.getBoundingClientRect)d=(c=e.getBoundingClientRect()).left+window.pageXOffset,u=c.bottom+window.pageYOffset;else for(d=t.offsetLeft,u=t.offsetTop+t.offsetHeight;t=t.offsetParent;)d+=t.offsetLeft,u+=t.offsetTop;(this._o.reposition&&d+n>s||this._o.position.indexOf("right")>-1&&d-n+e.offsetWidth>0)&&(d=d-n+e.offsetWidth,f=!1),(this._o.reposition&&u+i>o+r||this._o.position.indexOf("top")>-1&&u-i-e.offsetHeight>0)&&(u=u-i-e.offsetHeight,g=!1),this.el.style.left=d+"px",this.el.style.top=u+"px",l(this.el,f?"left-aligned":"right-aligned"),l(this.el,g?"bottom-aligned":"top-aligned"),h(this.el,f?"right-aligned":"left-aligned"),h(this.el,g?"top-aligned":"bottom-aligned")}},render:function(e,t,n){var a=this._o,i=new Date,s=g(e,t),o=new Date(e,t,1).getDay(),r=[],l=[];m(i),a.firstDay>0&&(o-=a.firstDay)<0&&(o+=7);for(var h=0===t?11:t-1,d=11===t?0:t+1,f=0===t?e-1:e,y=11===t?e+1:e,D=g(f,h),b=s+o,v=b;v>7;)v-=7;b+=7-v;for(var _=!1,x=0,N=0;x<b;x++){var S=new Date(e,t,x-o+1),C=!!u(this._d)&&p(S,this._d),I=p(S,i),T=-1!==a.events.indexOf(S.toDateString()),Y=x<o||x>=s+o,E=x-o+1,O=t,j=e,W=a.startRange&&p(a.startRange,S),F=a.endRange&&p(a.endRange,S),A=a.startRange&&a.endRange&&a.startRange<S&&S<a.endRange;Y&&(x<o?(E=D+E,O=h,j=f):(E-=s,O=d,j=y));var L={day:E,month:O,year:j,hasEvent:T,isSelected:C,isToday:I,isDisabled:a.minDate&&S<a.minDate||a.maxDate&&S>a.maxDate||a.disableWeekends&&c(S)||a.disableDayFn&&a.disableDayFn(S),isEmpty:Y,isStartRange:W,isEndRange:F,isInRange:A,showDaysInNextAndPreviousMonths:a.showDaysInNextAndPreviousMonths,enableSelectionDaysInNextAndPreviousMonths:a.enableSelectionDaysInNextAndPreviousMonths};a.pickWholeWeek&&C&&(_=!0),l.push(w(L)),7==++N&&(a.showWeekNumber&&l.unshift(k(x-o,t,e,a.firstWeekOfYearMinDays)),r.push(M(l,a.isRTL,a.pickWholeWeek,_)),l=[],N=0,_=!1)}return R(a,r,n)},isVisible:function(){return this._v},show:function(){this.isVisible()||(this._v=!0,this.draw(),h(this.el,"is-hidden"),this._o.bound&&(s(a,"click",this._onClick),this.adjustPosition()),"function"==typeof this._o.onOpen&&this._o.onOpen.call(this))},hide:function(){var e=this._v;!1!==e&&(this._o.bound&&o(a,"click",this._onClick),this._o.container||(this.el.style.position="static",this.el.style.left="auto",this.el.style.top="auto"),l(this.el,"is-hidden"),this._v=!1,void 0!==e&&"function"==typeof this._o.onClose&&this._o.onClose.call(this))},destroy:function(){var e=this._o;this.hide(),o(this.el,"mousedown",this._onMouseDown,!0),o(this.el,"touchend",this._onMouseDown,!0),o(this.el,"change",this._onChange),e.keyboardInput&&o(a,"keydown",this._onKeyChange),e.field&&(o(e.field,"change",this._onInputChange),e.bound&&(o(e.trigger,"click",this._onInputClick),o(e.trigger,"focus",this._onInputFocus),o(e.trigger,"blur",this._onInputBlur))),this.el.parentNode&&this.el.parentNode.removeChild(this.el)}},N}));
//# sourceMappingURL=/sm/63db104c32f4072d575bbc11a983d54cf0de7cf28a9fc6426ef2d24c9e651b55.map