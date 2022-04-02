<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../css/css.css" rel="stylesheet">
    <title>Deloitte</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.png">
</head>
<header>
    <?php
    include('../inc/header.inc.php');
    ?>
</header>
<main id="offre">
    <h1>Job offer</h1>
    <?
    // include("Mail.php") ;
    // use Hackathon\Mail;
    // ?>
    <?php

    include('../inc/db_JOB_OFFER.inc.php');

    use Job\Jobbb;


    include('../inc/db_CANDIDATE.inc.php');

    use Candidate\Candidatedb;


    $id = $_GET['id'];
    $job=Jobbb::getAllJobWithId($id);
    foreach ($job as $key) {
        echo "<h2>$key->title</h2>";
        echo "<a id='goTO' href=\"#middle\" >Apply now</a>";

        echo "<article>";
        echo "<p>$key->job_start</p>";
        echo "</article>";
        echo "<article>";
        echo "<p>Challenges</p>";
        echo "<p>$key->challenges</p>";
        echo "</article>";
        echo "<article>";
        echo "<p>Description</p>";
        echo "<p>$key->description</p>";
        echo "</article>";
        echo "<article>";
        echo "<p>Contract type</p>";
        echo "<p>$key->contract_type</p>";
        echo "</article>";

    }
    ?>
    <h2>Name</h2>

    <?php
    if(!isset($_POST['submit'])){
        ?>
        <h2>Start your application</h2>


        <form id="formInsc" class = "inscription" action="" method="POST">

            <h3>Your data</h3>
            <!--  <p> Pour toutes information complémentaires, n'hésitez pas à joindre le propriétaire du site via cette adresse :proprio@gmail.com </p><br> -->
            <label for="firstName">First name (*)</label><input id="firstName" name="firstName" type="text" required><br>
            <label for="name">Last name(*)</label><input id="name" name="name" type="text" required><br>
            <label for="email">Email adress(*)</label><input id="email" name="email" type="text" required><br>
            <label for="phone">Phone number(*)</label><input id="phone" name="phone" type="text" required><br>


            <label for="gender">Gender (*)</label>
            <select id="gender" name="raison">
                <option selected>Make your choice</option>
                <option>Female</option>
                <option>Male</option>
                <option>X</option>
                <option>Rather not say</option>
            </select> <br>

            <h3>Experience</h3>
            <label for="education">Education (*)</label>
            <select id="education" name="raison">
                <option selected>Make your choice</option>
                <option>Community college (MBO)</option>
                <option>Bachelor (HBO/WO)</option>
                <option>Master (WO)</option>
                <option>Post-Master</option>
            </select> <br>
            <label for="gradutationDate">(expected) graduation date</label>
            <input type="date" id="gradutationDate" value="2018-07-22" max="2022-04-01" >
            <h3>Upload your documents</h3>
            <p>Upload your files in Word, PDF or pptx format, them maximum size is 10MB</p>
            <label for="resume">Resume</label>
            <input id="resume" type="file" accept=".pdf, .doc, .docx, .pptx"><br>
            <label for="coverletter">Cover letter</label>
            <input id="coverletter" type="file" accept=".pdf, .doc, .docx, .pptx">

            <div>
                <input type="checkbox" id="consent" name="consent">
                <label id="consent" for="consent">I give Deloitte permission to keep my data for 1 year after completion of my application process. *</label>
            </div>
            <input type="submit" name="submit" value="Send">
            <p>* You can always request for your personal information to be deleted; read the <a href="https://careersatdeloitte.com/privacy">privacy statement</a> for more information.</p>
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
        $email=htmlentities($_POST['email']);
        $firstname=htmlentities($_POST['firstName']);
        $lastname=htmlentities($_POST['name']);
        $phone_number=htmlentities($_POST['phone']);

        $cvpath='test';

        $test = Candidatedb::insertCandidate($email,$firstname,$lastname,$phone_number,$cvpath);

    }
    ?>
</main>
</body>
</html>
