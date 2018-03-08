/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 $(document).ready(function(){
      $('.parallax').parallax();
    });
    
$(document).ready(function(){
    $('.collapsible').collapsible();
});
      
$(document).ready(function() {
        // configure the bootstrap datepicker
        $('.js-datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
(function($){
  $(function(){

    $('.button-collapse').sideNav();

  }); // end of document ready
})(jQuery); // end of jQuery name space

(function($){
  $(function(){

    $('.button-collapse-dropdown').sideNav();

  }); // end of document ready
})(jQuery); // end of jQuery name space

  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
  $('#textarea1').val('');
  $('#textarea1').trigger('autoresize'); 

 $(document).ready(function(){
    $('.materialboxed').materialbox();
  });
$(".dropdown-button").dropdown();
 $(document).ready(function(){
    $('ul.tabs').tabs();
  });
 $(document).ready(function(){
    $('ul.tabs').tabs('select_tab', 'tab_id');
  });  
 $(document).ready(function() {
    $('select').material_select();
  });
   $('select').material_select('destroy');
//  $(document).ready(function(){
//    $('#form_login').hide();
//  }); 
//  $('#login').click(function(){
//       $(this).css('color', 'black');
//       $('#form_login').css('maring', '0');
//       $('#form_login').css('padding', '0');
//       $('#form_login').css('width', '100%');
//       $('#form_login').show();
//  });
function autoSerch(data){
  $('input.autocomplete').autocomplete({
    data: data,
    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
    onAutocomplete: function(val) {
      // Callback function when value is autcompleted.
    },
    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
  });
}       
function autoRefresch(data){
  
}
function getRequested(url, callback) {
		$.get(url, function(data) {
			//data = $.parseJSON(data);
			callback(data);
		});
}
function notification(){
	/*$.ajax({
	    url: "/notificationInvit",
	    method: "post",
            data: {}
	    }).done(function(data){
                console.log(data);
		notificationButton = document.getElementById('notification');
                notificationButton.className = "material-icons red-text";
                //alert(notificationButton);		
	    });*/
        getRequested("/notificationInvit", function(data) {
                console.log("data");
                newInvitation(data);
	});
}
function newInvitation(data){
    console.log(data.length);
    InvitationBadge = document.getElementById('invitationBadge');
    $('#invitationBadge').html('<span id="invitationBadge" class="new badge" >'+data.length+'</span>Invitation');
    if(data.length !=0){
        notificationButton = document.getElementById('notification');
        notificationButton.className = "material-icons red-text text-lighten-2";
       
        //alert(notificationButton);
    }
}
function SetVu(){
        notificationButton = document.getElementById('notification');
        notificationButton.className = "material-icons red-white";
        getRequested("/setInvitationToVu", function(data) {});
}
// changer par un setinterval
setInterval(function(){
		notification();
	}, 9050);
        
function changeRole(id){
            statut = document.getElementById('statut').value;
            $.ajax({
                url : '/changeRole', // La ressource ciblée
                type : 'GET', // Le type de la requête HTTP.
                data : 'statut=' + statut +'&id='+ id
            });
}
function sendMessage(idSalon){
    getRequested("/sendMessage/"+idSalon, function(data) {
                console.log("data");
                $.ajax({
                url: "/sendMessage/"+idSalon,
                method: "post",
                data: {}
                }).done(function(data){
                    console.log(data);
                   
                    //alert(notificationButton);		
                });
                //newInvitation(data);
    });
}
var count = 0;
setInterval(function(){
         //idSalon = document.getElementById('idSalon').Value;
         idSalon = $('#idSalon').val();
         getRequested("/messageReceive/"+idSalon, function(data) {
                console.log("data :", data);
                console.log("count : ",count);
                if(count !== data.length ){
                    count = data.length;
                    $('#chatMessages').empty();
                    for(var i=0; i<data.length; i++){
                        if(data[i].role == 1){
                        $('#chatMessages').append(
                                '<li class="other"><div class="msg"><div class="user">'+data[i].user+' <span class="range admin">Admin</span></div><p>'+data[i].message+'</p><time>'+data[i].date+'</time> </div></li>'
                        );
                        }else{
                        $('#chatMessages').append(
                                '<li class="other"><div class="msg"><div class="user">'+data[i].user+'</div><p>'+data[i].message+'</p><time>'+data[i].date+'</time> </div></li>'
                        );
                }
                    }
                }
                //newInvitation(data);
	});
		
}, 4000);
