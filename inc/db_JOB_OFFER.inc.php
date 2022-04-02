<?php


namespace Job;

require_once '../inc/db_link.inc.php';

use DB\DBLink;
use http\Exception;
use PDO;


setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
class Job
{
public $title ;
public $job_start ;
public $challenges ;
public $description;
}
class Jobbb{

  const TABLE_NAME = 'JOB_OFFER';




    public function getAllJob()
    {
      $result = array();

      $bdd = null;
      try {
          $bdd = DBLink::connect2db(MYDB, $message);
          $result = $bdd->query("SELECT * FROM " . self::TABLE_NAME . "", PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Job\Job");
      } catch (Exception $e) {
          $message .= $e->getMessage() . '<br>';
      }
      DBLink::disconnect($bdd);
      return $result;
    }
    public function getAllJobPublic()
    {
        $result = array();

        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $result = $bdd->query("SELECT * FROM " . self::TABLE_NAME . " where status = 'Published' ", PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Job\Job");
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }
    public function getAllJobHR()
    {
        $result = array();

        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $result = $bdd->query("SELECT * FROM " . self::TABLE_NAME . " where status = 'Published'or status='Draft' ", PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Job\Job");
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    public function getAllJobWithId($id)
    {
      $result = array();

      $bdd = null;
      try {
          $bdd = DBLink::connect2db(MYDB, $message);
          $result = $bdd->query("SELECT * FROM " . self::TABLE_NAME . " where id_job_offer = '$id' ", PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Job\Job");
      } catch (Exception $e) {
          $message .= $e->getMessage() . '<br>';
      }
      DBLink::disconnect($bdd);
      return $result;
    }

    public function insertJobOffer($title,$description,$challenges,$skills,$startDate,$idUser,$ContractType,$Duration,$Status)
    {



        $noError = false;
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("INSERT INTO `JOB_OFFER`(`title`, `desciption`, `challenges`,`skills`,`job_start`,`contract_type`,`status`,`fk_users`) VALUES (:title,:description,:challenges,:skills,:cv,:startDate,:Status,:idUser");

            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':challenges', $challenges);
            $stmt->bindValue(':skills', $skills);
            $stmt->bindValue(':startDate', $startDate);
            $stmt->bindValue(':idUser', $idUser);
            $stmt->bindValue(':ContractType', $ContractType);
            $stmt->bindValue(':Duration', $Duration);
            $stmt->bindValue(':Status', $Status);


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
    public function getAllJobCount()
    {


        $bdd = null;

        $bdd = DBLink::connect2db(MYDB, $message);
        $reponse = $bdd->query("SELECT count(*) AS count FROM JOB_OFFER where  status = 'Published'");



        while ($donnees = $reponse->fetch())

        {

            $value= $donnees['count'];

        }

        $reponse->closeCursor();
        return $value;
    }





}

?>
