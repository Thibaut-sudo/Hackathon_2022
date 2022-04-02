<?php
include ('../inc/db_MEETING_SLOT.inc.php');

use Meeting_slot\Meeting_slotdb;

?>
<html>
<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link href="../css/css.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    

</head>
<header>
    <a class="logo" href="index.php"><img src="../img/Deloitte-logo-750x375.png" alt="Accueil"></a>

    <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="nav bar">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbars02">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="mainPage.php">All offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  " aria-current="page" href="myOffers.php">My offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  " aria-current="page" href="selectable.php">My planning</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<body>
<div id="container">
    <!-- zone de connexion -->


    <?php
    if(!isset($_POST['submit'])){
    ?>
        <form id="middle" class = "inscription" action="" method="POST">
        <h1>Add my disponibilty</h1>

        <label>Date</label>
        <input id="date" name='date' type="date" value="2022-04-01"><br>


        <label>Time start</label><input id="start" name="start" type="time" ><br>
            <label for="phone">Time end</label><input id="stop" name="stop" type="time" ><br>


        <input type="submit" name="submit" value="Add">



    </form>
        <?php
    }else{

        // $mail = new Mail();
        // $m = "";
        // $mail::envoyerMail($emailToSend,$sujet,$content,$m);
        // if(strlen($m)>1){
        //     echo $m;
        // }else{
        //     echo "le message a bien été envoyé";
        // }

        $date=$_POST['date'];
        $start=$_POST['start'];
        $stop=$_POST['stop'];



        $dateStart = $date. " ". $start.':00';
        $dateStop = $date. " ". $stop.':00';


        $test = Meeting_slotdb::insertMeeting($dateStart,$dateStop);
         header('Location: selectable.php');

    }
    ?>
</div>
</body>
</html>
