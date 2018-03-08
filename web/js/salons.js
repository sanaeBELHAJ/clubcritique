$(document).ready(function(){
	if(document.getElementById("posts") != null){
		var posts = document.getElementById("posts");
		posts.scrollTop = posts.scrollHeight;
	}
	
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
    
    $(".selectAction").on("change", function(){
		var idSalon = $(this).parent().find('[name=idSalon]').val();
		$("#idSalon").val(idSalon);
		if($(this).val() == "Rejoindre"){
			$("#joinSalon").click();
			popupRejoindre(idSalon);
		}
		else if($(this).val() == "Thème"){
			
		}
		else if($(this).val() == "Voir"){
			historiqueSalon(idSalon);
		}
	});
    
    $(document).on("click", "#ajouterSalon", function(){
		var titre = $("#nomNewSalon").val();
		var description = $("#descriptionNewSalon").val();
		var dateDebut = $("#dateDebutNewSalon").val();
		var dateFin = $("#dateFinNewSalon").val();
		var article = $("#idArticleNewSalon").val();
		ajouterSalon(titre, description, dateDebut, dateFin, article);
	});
    
    $(".join").click(function(){		
	  $("#joinSalon").click();
	  var idSalon = $(this).parent().parent().find('[name=idSalon]').val();
	  $("#idSalon").val(idSalon);
	  popupRejoindre(idSalon);
	});
	
	$(".historiqueSalon").click(function(){
	  var idSalon = $(this).parent().parent().find('[name=idSalon]').val();
	  $("#idSalon").val(idSalon);
	  historiqueSalon(idSalon);
	});		
	
	$(".closeWindowRateAbook").click(function(){ // remet les action par défaut
		$(".action select").val("selected");
	});
	
	$(".star").click(function(){
		var nbEtoilesMax = 4;
	   
		var idStar = $(this).attr('id').split('_')[1];
	   
		// enlève étoiles jaunes
		for(var i = 1; i <= nbEtoilesMax; i++){
			$('#star_'+i).attr('src', '/images/star_white.png');
			$('#star_'+i).removeClass('starNotSelected');
			$('#star_'+i).removeClass('starSelected');
			$('#star_'+i).addClass('starNotSelected');
		}
	   
		// ajoute étoile jaune
		for(var i = 1; i <= idStar; i++){
			$('#star_'+i).attr('src', '/images/star_yellow.png');
			$('#star_'+i).removeClass('starNotSelected');
			$('#star_'+i).removeClass('starSelected');
			$('#star_'+i).addClass('starSelected');           
		}
		
		$('#noteChosen').val(idStar);
		$("#rejoindreSalon").css("visibility", "visible");
	});
	
	$(".addToContacts").on("click", function(){
		var idContact = $(this).attr("id").split("_")[1];
		addtoContacts(idContact, $(this));		
	});
	
	$("#invitContacts").on("click", function(){
		var idSalon = $("#idSalon").val();
		popupInvitContacts(idSalon);	
	});
	
	$('#rejoindreSalon').click(function(){		
		var idSalon = $('#idSalon').val();
		var noteChosen = $('#noteChosen').val();
		getIdSalonPossible(idSalon, noteChosen);
	});
	
	$("#send").click(function(){
		var idSalon = $("#idSalon").val();
		var msg = $("#msg").val().trim();
		sendMessage(idSalon, msg);
	});
	
	$(document).on("click", ".banFromSalon", function(){
		var idSalon = $("#idSalon").val();
		var idMembreParticipant = $(this).parent().parent().parent().find(".idMembreParticipant").val();
		wantBanFromSalon(idSalon, idMembreParticipant);
	});
	
	$(document).on("click", ".alertAbuse", function(){
		var idSalon = $("#idSalon").val();
		var idMembreParticipant = $(this).parent().find(".idMembreMessage").val();
		wantBanFromSalon(idSalon, idMembreParticipant);
	});
	
	$(document).on("click", ".goodMember", function(){
		var idSalon = $("#idSalon").val();
		var idMembreParticipant = $(this).parent().parent().parent().find(".idMembreParticipant").val();
		goodMembre(idSalon, idMembreParticipant);
	});
	
	$(document).on("click", ".badMember", function(){
		var idSalon = $("#idSalon").val();
		var idMembreParticipant = $(this).parent().parent().parent().find(".idMembreParticipant").val();
		badMembre(idSalon, idMembreParticipant);
	});
	
	$(document).on("click", ".banFromSalonDirectly", function(){
		var idSalon = $("#idSalon").val();
		var idMembreParticipant = $(this).parent().parent().parent().find(".idMembreParticipant").val();
		banFromSalon(idSalon, idMembreParticipant);
	});
	
	// changer par un setinterval
	/*(function(){
		var idSalon = $("#idSalon").val();
		var lastIdMsg = $("#lastIdMsg").val();
		receiveLastMessages(idSalon, lastIdMsg);
		
		// récupère les idMessage
		
		var listIdMessages = "";
		
		for(var i = 0; i<$(".idMessage").length; i++){
			listIdMessages += $(".idMessage").eq(i).val()+",";
		}				
		
		// supprime dernière virgule
		
		var listIdMessages_ = "";
		
		if(listIdMessages.lastIndexOf(",") == listIdMessages.length - 1 && listIdMessages.length != 0){
			for(var i = 0; i<listIdMessages.length - 1; i++){
				listIdMessages_ += listIdMessages[i];
			}
		}
				
		enleverMessagesSupprimes(listIdMessages_);
	}, 4000);	*/	
	
	$(document).on("click", ".deleteMessage", function(){
		var idMessage = $(this).parent().find(".idMessage").val();
		deleteMessage(idMessage);
	});
	
	var datatable = $('.listing');
	receiveListSalons();
		
		/*$datatable.find("tbody").on("click", "td:nth-child(n+1)", function () {
			var clog = dtable.row($(this).parent("tr")).data();
			$("#id_ref").val(clog.id_ref+"_"+clog.nom_ref); // ajoute id_ref et nom ref à l'input du formulaire
			
			afficherFenetreEvaluations();				
		});*/
  });
  
  function receiveListSalons(){
		var datatable = $('.listing');
		var dtable = datatable.DataTable({
			"language": {
				"sProcessing": "Traitement en cours...",
				"sSearch": "<span style='font-size: 20px'>Rechercher&nbsp;:&nbsp</span>",
				"sLengthMenu": "",
				"sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
				"sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
				"sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
				"sInfoPostFix": "",
				"sLoadingRecords": "Chargement en cours...",
				"sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
				"sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
				"oPaginate": {
					"sFirst": "Premier",
					"sPrevious": "Pr&eacute;c&eacute;dent",
					"sNext": "Suivant",
					"sLast": "Dernier"
				},
				"oAria": {
					"sSortAscending": ": activer pour trier la colonne par ordre croissant",
					"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
				}
			}
		});
		dateFr();
	}
  
  function dateFr(){
	  var englishDate;
	  var split_date;
	  for(var i = 0; i<$("abbr").length; i++){
		 englishDate = $("abbr").eq(i).html();
		 split_date = englishDate.split("/");
		 $("abbr").eq(i).html(split_date[2].trim()+'/'+split_date[1].trim()+'/'+split_date[0].trim());
	  }
  }
  
  function htmlEntities(str){
	  return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  }
