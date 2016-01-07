var baseUrl = '/minichat/views/scripts/';
var timer = setInterval(getMessages, 5000);

$(function() {
    $('#submitButton').click(function(){

        var message = encodeURIComponent( $('#messageId').val() );

        if(message !== ""){ // on vérifie que les variables ne sont pas vides
            //alert(message);
            id = $('#userId').val();
            pseudo = $('#pseudo').val();
            $.post(
                baseUrl + 'ajax_sendmessage.php',
               {message : message, // et on envoie nos données
                userId : id,
                pseudo : pseudo
               },function(data) {
                   $('#statusMessage').html(data).css('color','green');
            });
        }
        else {
            $('#chatContent').append("<p><font color='#F00'>Message vide</font></p>"); // on ajoute le message dans la zone prévue
        }
        return false;
    });
});

function getMessages()
{
    $.post(
        baseUrl + 'ajax_getmessages.php',
       {
           lastMessageId : lastMessageId
       },function(data) {
                $('#chatContent').append(data.resultat);
                lastMessageId = data.lastMessageId;
    },"json");
    
}