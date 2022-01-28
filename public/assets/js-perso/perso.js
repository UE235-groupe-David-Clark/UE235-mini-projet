$(document).ready(function() {

	// on set deux heures
	var time1 = new Date("January 28, 2022 8:00:00");
    var time2 = new Date("January 28, 2022 18:00:00");

    // on récupère la date
    var date = new Date();

    // variables modif mode jour/nuit
    var $body = $("body");
    var $table = $("table");
    var $a = $("a");

    // si l'heure est comprise entre 8 et 17
	if (date.getHours() >= time1.getHours() && date.getHours() <= time2.getHours()) {
		
			// on passe l'id du body en body-day
			$body.attr("id", "body-day");

			// on change la couleur du texte
			$table.css({"color":"black"});
			$a.css({"color":"blue"});

	}
	// si l'heure n'est pas comprise entre 8 et 17
	else if (date.getHours() <= time1.getHours() && date.getHours() >= time2.getHours()) {
		
			// on passe l'id du body en body-night
			$body.attr("id", "body-night");

			// on change la couleur du texte
			$table.css({"color":"white"});
			$a.css({"color":"#3e7bc7"});

	};

	// appui sur le bouton "Jour"
	$("#mode-jour").click(function(){

		// si le body a un id
        if ($body.attr("id")) {

        	// on enlève l'id body-night du body
			$body.removeAttr("id", "body-night");

			// on passe l'id du body en body-day
			$body.attr("id", "body-day");

			// on change la couleur du texte
			$table.css({"color":"black"});
			$a.css({"color":"blue"});
		}

		else {

			// on passe l'id du body en body-day
			$body.attr("id", "body-day");

			// on change la couleur du texte
			$table.css({"color":"black"});
			$a.css({"color":"blue"});
		}
    });

	// appui sur le bouton "Nuit"
    $("#mode-nuit").click(function(){

		// si le body a un id
        if ($body.attr("id")) {

        	// on enlève l'id body-night du body
			$body.removeAttr("id", "body-day");

			// on passe l'id du body en body-day
			$body.attr("id", "body-night");

			// on change la couleur du texte
			$table.css({"color":"white"});
			$a.css({"color":"#3e7bc7"});
		}

		else {

			// on passe l'id du body en body-day
			$body.attr("id", "body-night");

			// on change la couleur du texte
			$table.css({"color":"white"});
			$a.css({"color":"#3e7bc7"});
		}
    });

});