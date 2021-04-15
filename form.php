<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $userID = $_GET["userID"];
    ?>
    <meta charset="UTF-8">
    <title>Data Migration Form</title>
    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function (){
            //get strength
            $.ajax({
                type: "GET",
                contentType: "application/json",
                dataType: "json",
                url: "https://htcs5604datamigrationapi.herokuapp.com/allStrengths",
                success: function(strengths){
                    console.log(strengths);
                    var i = 0;
                    while (i<strengths.length){
                        strength = strengths[i]
                        $("#userStrengthInput").append("" +
                            "<input type='checkbox' id='strengthTick"+strength.strengthID+"' name='strength' value="+strength.strengthID+">\n" +
                            "<label>"+strength.name+"</label><br>")
                        i = i + 1;
                    }
                },
                error:function (err){
                    alert("something wrong");
                }
            });
            //get cities
            $.ajax({
                type: "GET",
                contentType: "application/json",
                dataType: "json",
                url: "https://htcs5604datamigrationapi.herokuapp.com/allCities",
                success: function(cities){
                    console.log(cities);
                    var i = 0;
                    while (i < cities.length) {
                        city = cities[i]
                        $("#userCityInput").append("<option value='"+city.cityID+"'>"+city.name+"</option>")
                        i = i + 1;
                    }

                },
                error:function (err){
                    alert("something wrong");
                }
            });
            //get user
            $.ajax({
                type: "GET",
                contentType: "application/json",
                dataType: "json",
                url: "https://htcs5604datamigrationapi.herokuapp.com/user/"+<?php echo $userID?>,
                success: function(user){
                    console.log(user)
                    $("#userIDInput").val(user.userID);
                    $("#userFNInput").val(user.firstName);
                    $("#userLNInput").val(user.lastName);
                    $("#userAddressInput").val(user.address);
                    $("#userCityInput").val(user.cityID);
                    var i = 0;
                    while (i < user.strengths.length){
                        var s = user.strengths[i];
                        var box = "#strengthTick"+s
                        console.log(box);
                        $(box).attr('checked','checked');
                        i = i + 1;
                    }
                },
                error:function (err){
                    alert("something wrong");
                }
            });
            //post to user
            $("#submitBtn").click(function (){
                if (isTicked()){
                    strengths = [];
                    var i = 0;
                    while (i < $("#userStrengthInput input:checkbox").length){
                        var box = "#strengthTick"+(i+1);
                        if ($(box).is(':checked')){
                            strengths.push($(box).val());
                        }
                        i = i + 1;
                    }
                    console.log(strengths)
                    $.ajax({
                        type: "POST",
                        contentType: "application/json",
                        dataType: "json",
                        url: "https://htcs5604datamigrationapi.herokuapp.com/user/"+<?php echo $userID?>,
                        data: JSON.stringify({
                            userID: <?php echo $userID?>,
                            firstname: $("#userFNInput").val(),
                            lastname: $("#userLNInput").val(),
                            address: $("#userAddressInput").val(),
                            cityID: $("#userCityInput").val(),
                            username: $("#userUsernameInput").val(),
                            password: $("#userPasswordInput").val(),
                            strength:strengths
                            }),
                        success: function(message){
                            // alert("success");
                            alert(message);
                        },
                        error:function (err){
                            alert("something wrong");
                        }
                    });
                }else {
                    alert("please tick your strengths");
                }
            });

        });

        function isTicked(){
            if ($("#userStrengthInput input:checkbox:checked").length > 0)
            {
                return true;
            }
            return false;
        }
    </script>
</head>
<body>
<form>
    <p>
        userID:
        <input type="number" id="userIDInput" readonly>
    </p>
    <p>
        firstname:
        <input type="text" id="userFNInput">
    </p>
    <p>
        lastname:
        <input type="text" id="userLNInput">
    </p>
    <p>
        address:
        <input type="text" id="userAddressInput">
    </p>
    <p>
        city:
        <select id = "userCityInput">

        </select>
    </p>
    <p>
        username:
        <input type="text" id="userUsernameInput" required="required">
    </p>
    <p>
        password:
        <input type="password" id="userPasswordInput" required="required">
    </p>
    <p>
        strengths:
        <div id="userStrengthInput">

    </div>
    </p>
    <p>
        <input type="submit" id="submitBtn">
    </p>
</form>


</body>
</html>
