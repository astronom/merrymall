	    var req = false;
	    function createRequestObject() {
		if (XMLHttpRequest == undefined) {
	    	    XMLHttpRequest = function() {
	        	try { return new ActiveXObject("Msxml2.XMLHTTP.6.0"); }
	                catch(e) {}
	                try { return new ActiveXObject("Msxml2.XMLHTTP.3.0"); }
	                catch(e) {}
	                try { return new ActiveXObject("Msxml2.XMLHTTP"); }
	                catch(e) {}
	                try { return new ActiveXObject("Microsoft.XMLHTTP"); }
	                catch(e) {}
	                throw new Error("This browser does not support XMLHttpRequest.");
	            };
	        } else {
	            return new XMLHttpRequest();
	        }
	    }
	    function sendmsg() {
		var el = document.getElementById("msg");
		if ((el) && (el.value)) {
		    //alert(el.value);
		    if (!req)
			req = createRequestObject();
		    var url = "http://chat.merrymall.ru:443/?action=msg&id="+ chatId + "&msg=" + escape(el.value);
		    try {req.abort();}catch(e){};
		    req.open("GET", url, true);
		    req.send(null);
		    el.value = '';
		    el.focus();
		}
	    }