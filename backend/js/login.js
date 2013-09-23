;var login = login || {};
login = { 

	connectToParse: function() {
			var applicationId = "cfZHQ6k3IoPCcQBmXmwmuO9tb0fpVxDZUmgCWBXd";
	 		var javaScriptKey = "2xfMrgnnxUUpib0CCu2tepB7IWCvs4D01f83bM2w";
	 		Parse.initialize(applicationId, javaScriptKey);
		},

	loginToParse: function(user,passw) {
		Parse.User.logIn(user, passw, {
		  success: function(user) {
		  	console.log(user);
		    window.location.href = 'admin.php?section=users'; 
		  },
		  error: function(user, error) {
		  	console.log(error);
		    alert("Invalid Login");
		  }
		});
	},
	init: function() {
		login.connectToParse();
		$("#loginButt").unbind();
		$("#loginButt").click(function(){
			var user = $("#input-username").val();
			var passw= $("#input-password").val();
			login.loginToParse(user,passw);
		});
	}
};
(function(win, doc, ns, undefined) {
   
        ns.init();

}(window, document, login));