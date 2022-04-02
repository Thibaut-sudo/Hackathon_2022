<?php


namespace Candidate;

require_once '../inc/db_link.inc.php';

use DB\DBLink;
use http\Exception;
use PDO;


setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
class Candidate
{

}
class Candidatedb{

    const TABLE_NAME = 'CANDIDATE';




    public function getAllCandidate()
    {
        $result = array();

        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $result = $bdd->query("SELECT * FROM " . self::TABLE_NAME . "", PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Candidate\Candidate");
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    public function getAllCandidateWithId($id)
    {
        $result = array();

        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $result = $bdd->query("SELECT * FROM " . self::TABLE_NAME . " where id_job_offer = '$id' ", PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Candidate\Candidate");
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    public function insertCandidate($email,$firstname,$lastname,$phone_number,$cv)
    {



        $noError = false;
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("INSERT INTO `CANDIDATE`(`email`, `firstname`, `lastname`,`phone_number`,`cv`) VALUES (:email,:firstname,:lastname,:phone_number,:cv)");

            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':firstname', $firstname);
            $stmt->bindValue(':lastname', $lastname);
            $stmt->bindValue(':phone_number', $phone_number);
            $stmt->bindValue(':cv', $cv);


            if ($stmt->execute()) {
                $message .= "";
                $noError = true;

            } else {
                $message .= 'Une erreur système est survenue.<br>
                    Veuillez essayer à nouveau plus tard ou contactez l\'administrateur du site.
                    (Code erreur: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $noError;
    }
    public static function UpdateCandidate ($id){

        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("UPDATE  " . self::TABLE_NAME . " SET statut=1 where id_candidate = :id");

            $stmt->bindValue(':id',$id, PDO::PARAM_STR);

            $stmt->execute();




        } catch (Exception $e) {
            $message .= $e->getMessage() . 'erreur';
        }
        DBLink::disconnect($bdd);





    }





}

?>
