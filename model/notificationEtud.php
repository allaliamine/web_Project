<?php
require_once "../config/conn.php";

class notificationEtud{
    public function getNotificationRapportByNiveau($idNiveau) {
        global $conn;
        $req = $conn->prepare('SELECT date, Titre,annonce.IdAnnonce FROM annonce 
                                JOIN annonce_niveau 
                                ON annonce.Idannonce = annonce_niveau.Idannonce
                                WHERE IdNiveau = ?');
        $req->execute(array($idNiveau));
        $res = $req->fetchAll();
        return $res;
    }
    public function lireNotification($idAnnonce) {
        global $conn;
        $req = $conn->prepare('SELECT * FROM annonce WHERE IdAnnonce = ?');
        $req->execute(array($idAnnonce));
        $res = $req->fetch();
        return $res;
    }
    
    public function getFiliereName($idFiliere){
        global $conn;
        $req = $conn->prepare('SELECT Nom from Filiere WHERE IdFiliere = ?');
        $req->execute(array($idFiliere));
        $res = $req->fetch();
        return $res;

    }
   
    public function getLevelName($idNiveau){

        global $conn;
        $req = $conn->prepare('SELECT Nom from Niveau WHERE IdNiveau = ?');
        $req->execute(array($idNiveau));
        $res = $req->fetch();
        return $res;
    }

    public function getAllNotification(){
       
        global $conn;
        $req = $conn->prepare('SELECT * from annonce order by date ');
        $req->execute();
        $res = $req->fetchAll();
        return $res;


    }
    public function showDetailActualite($idAnnonce){
        global $conn;
        $req = $conn->prepare('SELECT date,Titre,annonce.IdAnnonce,filiere.Nom as nomFiliere, Niveau.Nom as NomNiveau from filiere,niveau,annonce,annonce_niveau
         where annonce.IdAnnonce= annonce_niveau.IdAnnonce and annonce_niveau.IdNiveau=niveau.IdNiveau
         and niveau.IdFiliere= filiere.IdFiliere and Annonce.IdAnnonce= ?');
         $req->execute(array($idAnnonce));
        $res = $req->fetchAll();
        return $res;
    }

    public function isActualitePublic($idAnnonce){
        global $conn;
        $req = $conn->prepare('SELECT IdNiveau as cible from annonce_niveau where IdAnnonce= ?');
        $req->execute(array($idAnnonce));
        $res = $req->fetch();
        return $res;
    }



}