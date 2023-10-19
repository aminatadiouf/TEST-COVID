<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire_TEST_COVID</title>
</head>
<body>
<form action="" method="POST">
<fieldset>
    <legend>TEST COVID_19 </legend>
<babel>Nom :</label> <br><input type ="text" name="Nom" required >
</br>
<label>Prenom:</label> <br><input type ="text" name="Prenom" required >
</br>
<label>Poids:</label> <br> <input type="number" name="Poids" required >
</br>


               <br>Maux_de_tete</br>
 
         <label>OUI : </label><input type="radio" name="Maux_de_tete" value="OUI" required > 

         <label> NON :</label> <input type="radio" name="Maux_de_tete" value="NON" required > <br />
          <label>Température °C: </label> <br>
<input type="number" name="Temperature_°C" required >
</br>


<br>Diarrhee</br>

<label>OUI :</label> <input type="radio" name="Diarrhee"  value="OUI" required > 

<label>NON : </label><input type="radio" name="Diarrhee" value="NON" required ><br />
<br>TOUX</br>

FAIBLE: <input type="radio" name="TOUX" value="FAIBLE" >

<label>MOYEN:</label> <input type="radio" name="TOUX" value="MOYEN">
<label>ELEVE: </label> <input type="radio" name="TOUX" value="ELEVE"><br />
<br>Perte_Odorat </br>
<label>OUI :</label> <input type="radio" name="Perte_Odorat" value="OUI" > 

         <label> NON :</label> <input type="radio" name="Perte_Odorat" value="NON" ><br />
          <br>age </br>
          <label>2-10:</label> <input type="radio" name="age" value="2-10"><br />

          <label>10-30:</label> <input type="radio" name="age" value="10-30"><br />
         <label>45-100 :</label><input type="radio" name="age" value="45-100" ><br />
         <input type="reset" value="EFFACER" >
         <input type="submit" value="ENVOI" >

    <?php
 $score = 0;
    function Maux_de_tete() {
        global $score;
        if (isset($_POST["Maux_de_tete"]) && $_POST["Maux_de_tete"] == "OUI") {
           return "OUI";
            $score +=10;
        } else { return "NON";
            $score +=0;
        }
    }
    
        $pourcentagemauxdetête = Maux_de_tete();
        
   
    
    
    
         
        function calculerpourcentage_temperature() {
            global $score;
                if(isset ($_POST["Temperature_°C"])&& $_POST["Temperature_°C"]>37){
                    $score +=25;
                    return $_POST["Temperature_°C"];
                    
                   
                } else {
                   
                   $score +=0;
                }
                }
                $pourcentagetemperature = calculerpourcentage_temperature ();
                $tempTemperature = ""; // Variable pour stocker la température

if ($pourcentagetemperature !== "") {
    $tempTemperature = $pourcentagetemperature;
}
                
        function calculer_pourcentage_diarrhee() {
            global $score;
                if( isset($_POST["Diarrhee"])&& $_POST["Diarrhee"]=="OUI"){
                    $score +=10 ;
                    return "OUI" ;
                   
                } else{
                    $score +=0;
                    return "NON"; 
                     }
            }
                $pourcentagediarrhee = calculer_pourcentage_diarrhee ();
               
                
        function calculerPourcentageToux($choixToux) {
            global $score;
                    if ($choixToux === 'FAIBLE') {
                        $score +=2;
                        return "FAIBLE";
                      
                    } elseif ($choixToux === 'MOYEN') {
                        $score +=5;
                        return  "MOYEN";
                     
                    } elseif ($choixToux === 'ELEVE') {
                        $score +=25;
                        return  "ELEVE";
                      
                   
                }
                }
                $choixToux = isset($_POST['TOUX']) ? $_POST['TOUX'] : ''; // Obtenez le choix de la toux à partir du formulaire

                $pourcentageToux = calculerPourcentageToux($choixToux); // Appelez la fonction pour obtenir le pourcentage
              
        function Perte_Odorat(){
            global $score;
                     if(isset($_POST["Perte_Odorat" ])&& $_POST["Perte_Odorat" ]=="OUI"){
                      $score +=10;
                      return "OUI";
                        }else{ $score +=5;
                            return "NON";
                            }
                    };
                    $choixOdorat = Perte_Odorat();
                   
        function Age($choixAge) {
            global $score;
            
                switch ($choixAge) {
                    case '2-10':
                        $score +=5;
                      return '2-10'; 
                        // Pourcentage pour la tranche d'âge 2-10 ans
                    case '10-30':
                        $score +=10; 
                      return '10-30'; 
                      // Pourcentage pour la tranche d'âge 10-30 ans
                    case '45-100':
                        $score +=25; 
                      return '45-100'; 
                      // Pourcentage pour la tranche d'âge 45-100 ans
                    }
                    }
            if (isset($_POST["age"]) ) {
                $choixAge = isset($_POST["age"]) ? $_POST["age"] : '';
                
                if ($choixAge) {
                    $Age = Age($choixAge); // Utilisez le nom correct de la fonction
                  
                } 
            }else {
                    echo "Veuillez sélectionner une tranche d'âge valide.<br>";
            }
            
            
         function datefr($njour=0){
                $timestamp = time()+ $njour*24*3600;
                $semaine = array("dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi");
                $mois = array(1=>"janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "decembre");
                $chdate=$semaine[date('w', $timestamp)]." ".date('j', $timestamp)." ". $mois[date('n',$timestamp)];
                return $chdate;
            }
                 
          
                
         function calculerScoreTotal($pourcentagemauxdetête, $pourcentagetemperature, $pourcentagediarrhee, $pourcentageToux, $choixOdorat, $Age) {
                    $scoreTotal = 0;
                    // Ajoutez les scores de chaque fonction au score total
                    $scoreTotal += (int)$pourcentagemauxdetête;
                    $scoreTotal +=(int) $pourcentagetemperature;
                    $scoreTotal += (int)$pourcentagediarrhee;
                    $scoreTotal += (int)$pourcentageToux;
                    
                    $scoreTotal +=(int) $choixOdorat;
                    $scoreTotal +=(int) $Age;
                    if ($scoreTotal <= 20) {
                        return " $scoreTotal .Faible risque de COVID-19.";
                    } elseif ($scoreTotal <= 40) {
                        return  "$scoreTotal . Risque modéré de COVID-19. Consultez un professionnel de la santé si les symptômes persistent.";
                    } else {
                        return " $scoreTotal .Risque élevé de COVID-19. Consultez immédiatement un professionnel de la santé.";
                    }
                }
                $scoreTotal=calculerScoreTotal($pourcentagemauxdetête, $pourcentagetemperature, $pourcentagediarrhee, $pourcentageToux, $choixOdorat, $Age);
                $tempScore = ""; // Variable pour stocker le score

                if ($scoreTotal !== "") {
                              $tempScore = $scoreTotal;
                    }
                

                   //HISTORIQUE
                   session_start();
                   function afficherHistorique($nomFonction) {
                    if (isset($_SESSION[$nomFonction])) {
                        echo "<h3>Historique de $nomFonction :</h3>";
                        echo "<ul>";
                        foreach ($_SESSION[$nomFonction] as $resultat) {
                            echo "<li>$resultat</li>";
                        }
                        echo "</ul>";
                    }
                }
    
                
                   if ($_SERVER["REQUEST_METHOD"] == "POST")
            if (!isset($_SESSION['historique']) || !is_array($_SESSION['historique'])) {
                $_SESSION['historique'] = array();
            }
           
            
            
                  // Ajouter à l'historique
                        $_SESSION['historique'][] = array(
                            'Nom'=> ($_POST["Nom"]),
                            'Prenom' =>( $_POST["Prenom"]),
                            'Poids' =>( $_POST["Poids"]),
                            'Maux_de_tete' => $pourcentagemauxdetête,
                            'Temperature_°C' => $pourcentagetemperature  ,
                            'Diarrhee' => $pourcentagediarrhee,
                            'TOUX' => $pourcentageToux ,
                            'Perte_Odorat' => $choixOdorat,
                            'age' => $Age,
                            'score_Total' =>$tempScore,
                            'date' => datefr($njour=0)
                            );
                            echo "<h2>Historique Covid_19:</h2>";
                  if (isset($_SESSION['historique']) && is_array($_SESSION['historique'])) {
                                   echo "<table border='1'>";
                    echo "<tr><th>Nom</th><th>Prenom</th><th>Poids</th><th>Maux_de_tete</th><th>Temperature_°C</th><th>Diarrhee</th><th>TOUX</th><th>Perte_Odorat</th><th>age</th><th>score_Total</th><th>date</th></tr>";
    
                   foreach ($_SESSION['historique'] as $envoi) {
  
        echo "<tr>";
        echo "<td>" . (isset($envoi['Nom']) ? $envoi['Nom'] : "") . "</td>";
        echo "<td>" . (isset($envoi['Prenom']) ? $envoi['Prenom'] : "") . "</td>";
        echo "<td>" . (isset($envoi['Poids']) ? $envoi['Poids'] : "") . "</td>";
        echo "<td>" . (isset($envoi['Maux_de_tete']) ? $envoi['Maux_de_tete'] : "") . "</td>";
        echo "<td>" . (isset($envoi['Temperature_°C']) ? $envoi['Temperature_°C'] : "") . "</td>";
        echo "<td>" . (isset($envoi['Diarrhee']) ? $envoi['Diarrhee'] : "") . "</td>";
        echo "<td>" . (isset($envoi['TOUX']) ? $envoi['TOUX'] : "") . "</td>";
        echo "<td>" . (isset($envoi['Perte_Odorat']) ? $envoi['Perte_Odorat'] : "") . "</td>";
        echo "<td>" . (isset($envoi['age']) ? $envoi['age'] : "") . "</td>";
        echo "<td>" . (isset($envoi['score_Total']) ? $envoi['score_Total'] : "") . "</td>";
        echo "<td>" . (isset($envoi['date']) ? $envoi['date'] : "") . "</td>";
         
        echo "</tr>";
    }
          echo "</table>";
          }
  

                 


                         
                           
                  ?>
                </body>
                </html>