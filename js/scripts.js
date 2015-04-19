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
});
