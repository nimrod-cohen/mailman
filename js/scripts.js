if(!window["MailMan"])
	MailMan = {
		spinner : null,

		doLoading : function()
		{
			$(document.body).prepend("<div id='loadingFilter' style='position:fixed;top:0;left:0;margin:0;width:100%;height:100%;z-index:9999;background:rgba(255,255,255,0.5);'></div>");
			this.spinner.spin($("#loadingFilter").get(0));
		},
		stopLoading : function ()
		{
			this.spinner.stop();
			$("#loadingFilter").remove();
		},
		showAlert : function(message,type)
		{
			$("#dvAlert span.alert-content").text(message);
			$("#dvAlert").removeClass("alert-danger alert-success alert-info alert-warning");
			$("#dvAlert").addClass("alert-"+type);
			$("#dvAlert").show();
		},
		hideAlert : function()
		{
			$("#dvAlert").hide();
		},

		getCookie : function(name)
		{
			var b = new RegExp("(?:^|; )"+name+"=([^;]*)", "i");
			var c = document.cookie.match(b);
			return (c && c.length == 2) ? c[1] : null
		},

		submitAjaxForm : function(url,formQuery,doDone,doFail)
		{
			MailMan.hideAlert();
			MailMan.doLoading();
			$.ajax(
				{
					url: url,
					type: 'POST',
					dataType: 'json',
					cache: false,
					data: $(formQuery).serialize()
				})
				.done(doDone)
				.fail(doFail)
				.always(function()
				{
					MailMan.stopLoading();
					$("input[name='csrf_token']").val(MailMan.getCookie('csrf_cookie'));
				});
		},

		//turn hebrew chars to unicode HTML entities.
		hebrew2Unicode: function(txt)
		{
			return txt.replace(/א/g,'&#x5D0;')
				.replace(/ב/g,'&#x5D1;')
				.replace(/ג/g,'&#x5D2;')
				.replace(/ד/g,'&#x5D3;')
				.replace(/ה/g,'&#x5D4;')
				.replace(/ו/g,'&#x5D5;')
				.replace(/ז/g,'&#x5D6;')
				.replace(/ח/g,'&#x5D7;')
				.replace(/ט/g,'&#x5D8;')
				.replace(/י/g,'&#x5D9;')
				.replace(/ך/g,'&#x5DA;')
				.replace(/כ/g,'&#x5DB;')
				.replace(/ל/g,'&#x5DC;')
				.replace(/ם/g,'&#x5DD;')
				.replace(/מ/g,'&#x5DE;')
				.replace(/ן/g,'&#x5DF;')
				.replace(/נ/g,'&#x5E0;')
				.replace(/ס/g,'&#x5E1;')
				.replace(/ע/g,'&#x5E2;')
				.replace(/ף/g,'&#x5E3;')
				.replace(/פ/g,'&#x5E4;')
				.replace(/ץ/g,'&#x5E5;')
				.replace(/צ/g,'&#x5E6;')
				.replace(/ק/g,'&#x5E7;')
				.replace(/ר/g,'&#x5E8;')
				.replace(/ש/g,'&#x5E9;')
				.replace(/ת/g,'&#x5EA;')
		},

		base64_encode : function(data)
		{
			var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
			var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
				ac = 0,
				enc = '',
				tmp_arr = [];

			if (!data) {
				return data;
			}

			do { // pack three octets into four hexets
				o1 = data.charCodeAt(i++);
				o2 = data.charCodeAt(i++);
				o3 = data.charCodeAt(i++);

				bits = o1 << 16 | o2 << 8 | o3;

				h1 = bits >> 18 & 0x3f;
				h2 = bits >> 12 & 0x3f;
				h3 = bits >> 6 & 0x3f;
				h4 = bits & 0x3f;

				// use hexets to index into b64, and append result to encoded string
				tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
			} while (i < data.length);

			enc = tmp_arr.join('');

			var r = data.length % 3;

			return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
		}
	};

jQuery.fn.extend({
	insertAtCaret : function (text)
	{
		var txtarea = this.get(0);
		var scrollPos = txtarea.scrollTop;
		var strPos = 0;
		if(txtarea.selectionStart)
			strPos = txtarea.selectionStart;
		else if(document.selection)
		{
			txtarea.focus();
			var range = document.selection.createRange();
			range.moveStart ('character', -txtarea.value.length);
			strPos = range.text.length;
		}

		var front = (txtarea.value).substring(0,strPos);
		var back = (txtarea.value).substring(strPos,txtarea.value.length);
		txtarea.value=front+text+back;
		strPos = strPos + text.length;
		if (txtarea.selectionStart)
		{
			txtarea.selectionStart = strPos;
			txtarea.selectionEnd = strPos;
			txtarea.focus();
		}
		else if(document.selection)
		{
			txtarea.focus();
			var range = document.selection.createRange();
			range.moveStart ('character', -txtarea.value.length);
			range.moveStart ('character', strPos);
			range.moveEnd ('character', 0);
			range.select();
		}

		txtarea.scrollTop = scrollPos;
	}
});

$(document).ready(function()
{
	var opts = {
		lines: 13, // The number of lines to draw
		length: 0, // The length of each line
		width: 3, // The line thickness
		radius: 30, // The radius of the inner circle
		corners: 1, // Corner roundness (0..1)
		rotate: 90, // The rotation offset
		direction: 1, // 1: clockwise, -1: counterclockwise
		color: '#000', // #rgb or #rrggbb or array of colors
		speed: 1, // Rounds per second
		trail: 30, // Afterglow percentage
		shadow: false, // Whether to render a shadow
		hwaccel: false, // Whether to use hardware acceleration
		className: 'spinner', // The CSS class to assign to the spinner
		zIndex: 2e9, // The z-index (defaults to 2000000000)
		top: '50%', // Top position relative to parent
		left: '50%' // Left position relative to parent
	};

	MailMan.spinner = new Spinner(opts);

	$("#dvAlert button.close").click(function()
	{
		$("#dvAlert").hide(1000);
	});

	$('.btn-toggle').click(function()
	{
		$(this).find('.btn').toggleClass('active');
		$(this).find('.btn').toggleClass('btn-primary');
		$(this).find('.btn').toggleClass('btn-default');

		return false;
	});

	//list filtering
	$(".list-filter-text").keydown(function(ev) {
		if(ev.keyCode == 13) {
			ev.preventDefault();
			$(ev.target).trigger("change");
			return false;
		}
	});
	$(".list-filter-text").change(function(ev)
	{
		ev.preventDefault();

		var search = $(this).val().trim().toLowerCase();

		var listId = $(this).attr("data-for");
		var searchId = this.id;

		$("#"+listId+" li").each(function()
		{
			if($($(this).children()[0]).hasClass("list-filter-text") || search == "" || $(this).text().toLowerCase().indexOf(search)>=0)
				$(this).show();
			else
				$(this).hide();
		});
	});

	$('.custom-file-input').on('change',function(){
		$(this).parent().find(".custom-file-label").text(this.files[0].name);
	});

});
