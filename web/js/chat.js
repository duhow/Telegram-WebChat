var Chat = {
	defaultPic: "https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&f=y",
	ajax: null,

	addMessage: function (text, from, userpic){
		var align = (from == 1 ? "right" : "left");
		var photo = this.defaultPic;
		if(userpic){ photo = userpic; }

		var code = '<div class="media">';
		if(align == "left"){ code += '<div class="media-left"><a href="#"><img class="media-object" src="'+ photo +'"></a></div>'; }
		code += '<div class="media-body text-'+ align +'"><p>' + text + '</p></div>';
		if(align == "right"){ code += '<div class="media-right"><a href="#"><img class="media-object" src="'+ photo +'"></a></div>'; }
		code += '</div>';

		$("main").append(code);
	},

	addMessageTemp: function (text){
		var photo = this.defaultPic;

		var code = '<div class="media temp">'
			+ '<div class="media-body text-'+ align +'"><p class="text-muted">' + text + '</p></div>'
			+ '<div class="media-right"><a href="#"><img class="media-object" src="'+ photo +'"></a></div>'
		+ '</div>';

		$("main").append(code);
	},

	sendMessage: function (txt, sess){
		$.ajax({
			url: this.ajax + "/send",
			data: {session: sess, text: txt},
			method: "POST"
		});
	}
}
