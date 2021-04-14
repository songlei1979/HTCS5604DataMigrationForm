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
                    console.log(strengths)
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
                    console.log(cities)
                    var i = 0;
                    while i < cities.length{
                        city = cities[i]
                        $("#userCityInput").append("<option value='"+city.cityID+"'>city.name</option>")
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
                },
                error:function (err){
                    alert("something wrong");
                }
            });
        });
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
        <input type="text" id="userUsernameInput">
    </p>
    <p>
        password:
        <input type="password" id="userPasswordInput">
    </p>
    <p>
        strengths:

    </p>
    <p>
        <input type="submit" id="submitBtn">
    </p>
</form>


</body>
</html>
