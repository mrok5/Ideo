$(document).ready(function() {

    $("#display").click(function() {

        $.ajax({    //create an ajax request to display.php
            type: "GET",
            url: "test2.php",
            dataType: "json",   //expect html to be returned
            success: function(response){

               // $("#root").append("<li id="+response[0]+">"+);

                for(var i = 1;i<response[0].length;i++){
                    if(response[1][i-1] = response[1][i]-1) {
                        $("#"+response[2][i]).append("<ul><li id="+response[0][i]+">"+response[3][i]+"</li></ul>");
                    }else{
                        $("#responsecontainer").append("<li id="+response[0][i]+">"+response[3][i]+"</li>");
                    }
                }

                //alert(response);
            }

        });
    });
});