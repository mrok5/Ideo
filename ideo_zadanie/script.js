$(document).ready(function () {

    $("#display").click(function () {

        $.ajax({
            type: "GET",
            url: "test2.php",
            dataType: "json",
            success: function (response) {

                $("#root").append("<li id='1'>Góry <ul id='responsecontainer' >");


                for (var i = 1; i < response[0].length; i++) {
                    if (response[1][i - 1] = response[1][i] - 1) {
                        $("#" + response[2][i]).append("<ul><li id=" + response[0][i] + ">" + response[3][i] + "</li></ul>");
                    } else {
                        console.log("test");
                        $("#responsecontainer").append("<li id=" + response[0][i] + ">" + response[3][i] + "</li>");
                    }
                }

                //alert(response);
            }

        });
    });

});