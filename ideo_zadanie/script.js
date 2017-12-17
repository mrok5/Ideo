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

$(document).ready(function(){
    $("#submit").click(function(){
        var name = $("#name").val();
        var parent_id = $("#parent_id").val();
// Returns successful data submission message when the entered information is stored in database.
        var dataString = 'name='+ name + '&parent_id='+ parent_id;
        if(name==''||parent_id=='')
        {
            alert("Please Fill All Fields");
        }
        else
        {
// AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: "insert.php",
                data: dataString,
                cache: false,
                success: function(){
                    alert("success");
                }
            });
        }
        return false;
    });
});

$(document).ready(function(){
    $("#dsubmit").click(function(){
        var node_id = $("#node_id").val();
// Returns successful data submission message when the entered information is stored in database.
        var dataString = 'node_id='+ node_id;
        if(node_id=='')
        {
            alert("Please Fill All Fields");
        }
        else
        {
// AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: "delete.php",
                data: dataString,
                cache: false,
                success: function(){
                    alert("success");
                }
            });
        }
        return false;
    });
});


$(document).ready(function(){
    $("#edit").click(function(){
        var name = $("#edit_name").val();
        var node_id = $("#edit_node_id").val();
// Returns successful data submission message when the entered information is stored in database.
        var dataString = 'name='+ name + '&node_id='+ node_id;
        if(name==''||node_id=='')
        {
            alert("Please Fill All Fields");
        }
        else
        {
// AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: "update.php",
                data: dataString,
                cache: false,
                success: function(){
                    alert("success");
                }
            });
        }
        return false;
    });
});