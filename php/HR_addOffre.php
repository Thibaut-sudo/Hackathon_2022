<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../css/css.css" rel="stylesheet">
    <title>Add an offre</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.png">
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
                    <li class="nav-item">
                        <a class="nav-link  " aria-current="page" href="FormulaireAddDispo.php">My disponibility</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>
<body>
<main id="offre">
    <h1>Add an offer</h1>


    <?php
    if(!isset($_POST['submit'])){
        ?>

        <form id="middle" class = "inscription" action="" method="POST">

            <!--  <p> Pour toutes information complémentaires, n'hésitez pas à joindre le propriétaire du site via cette adresse :proprio@gmail.com </p><br> -->
            <label for="Title">Title(*)</label><input id="Title" name="Title" type="text" required  autofocus><br>
            <label for="Description">What is the description of the offer ?</label><textarea id="Description" name="Description" rows="3" cols="40"  placeholder="What is the description of the offer ?"></textarea>    <br>
            <label for="Challenges">What are the challenges ?</label><textarea id="Challenges" name="Challenges" rows="3" cols="40"  placeholder="What are the challenges ?"></textarea>    <br>
            <label for="Skills">Which skills are required ?</label><textarea id="Skills" rows="3" cols="40" name="Skills" type="text" placeholder="Which skills are required ?"  ></textarea><br>
            <label for="StartDate">When does the contract start ?</label> <input id="StartDate" name="StartDate" type="date" value="2017-06-01"><br>

            <label for="ContractType">Contract type</label>
            <select id="ContractType" name="ContractType">
                <option selected>Make your choice</option>
                <option>CDI</option>
                <option>CDD</option>
                <option>Internship</option>
            </select> <br>

            <label for="Duration">Duration of the meeting</label>
            <select id="Duration" name="Duration">
                <option selected>Make your choice</option>
                <option value="30">30min</option>
                <option value="60">1h</option>
                <option value="90">1h30</option>
                <option value="120">2h</option>
                <option value="150">2h30</option>
                <option value="180">3h</option>
            </select> <br>

            <label for="Status">Status</label>
            <select id="Status" name="Status">
                <option selected>Draft</option>
                <option>Published</option>
                <option>Unpublished</option>
            </select> <br>
            <input type="submit" name="submit" value="Save">
        </form>
        <?php
    }else{
        $emailToSend = htmlentities($_POST['email']);
        $sujet = "Offre Deloitte";// htmlentities($_POST['Sujet']);
        $content ="Vous avez postulé pour une offre";
        // $mail = new Mail();
        // $m = "";
        // $mail::envoyerMail($emailToSend,$sujet,$content,$m);
        // if(strlen($m)>1){
        //     echo $m;
        // }else{
        //     echo "le message a bien été envoyé";
        // }
        echo "le message a bien été envoyé";

        $title=htmlentities($_POST['Title']);
        $description=htmlentities($_POST['Description']);
        $challenges=htmlentities($_POST['Challenges']);
        $skills=htmlentities($_POST['Skills']);
        $startDate=htmlentities($_POST['StartDate']);
        $ContractType=htmlentities($_POST['ContractType']);
        session_start();
        $idUser = $_SESSION['idUsers'];
        $Duration=htmlentities($_POST['Duration']);
        $Status= htmlentities($_POST['Status']);


        $test = Candidatedb::insertJobOffer($title,$description,$challenges,$skills,$startDate,$idUser,$ContractType,$Duration,$Status);

    }
    ?>
</main>
</body>
</html>
