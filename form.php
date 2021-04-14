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
                },
                error:function (err){
                    alert("something wrong");
                }
            });
        });
    </script>
</head>
<body>



</body>
</html>
