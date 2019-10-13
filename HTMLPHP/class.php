<?php 
session_start();
ini_set('display_errors', 1);

    function BDD() // Fonction qui crée la connection à la Base de données
    {
        $server = "localhost";
        $dbname = "ifamaker";
        $user = "lucas";
        $password = "37Rn4En";
        $conn =  new PDO("mysql:host=$server;dbname=$dbname", $user, $password);
        return $conn;
    }
    class Tableau 
    {
        public function getCards($id_colonne) // OK
        {
            $bdd = BDD();
            $result = $bdd->prepare('SELECT * FROM billets where id_colonne =' . $id_colonne );
            $result->execute();
            $count = $result->rowCount();
            for ($i=0; $i < $count ; $i++) 
            { 
                $cards = $result->fetch(PDO::FETCH_OBJ);
                echo '<li class="card" id_billet="'  .$cards->id_billets . '">
                <span class="deleteCard">X</span> Titre : ' . $cards->nom . '<br>
                    Description : ' . $cards->descriptif . '<br> 
                    priorité : ' . $cards->priorité . 
                '</li>';
            }
        }

        public function getColonne() // OK
        {
            $bdd = BDD();

            $resultCol = $bdd->prepare('SELECT * FROM colonne where id_tableau =' . $_GET['id']);
            $resultCol->execute();
            $columns = new tableau;
            $count = $resultCol->rowCount();
            for ($i=1; $i < $count+1 ; $i++) 
            { 
                $col = $resultCol->fetch(PDO::FETCH_OBJ);

                echo ' <div class="container" id_colonne="' . $col->id_colonne . '" id_position="' . $i . '" > ';
                echo '<div class="colHeader"> <h2 contenteditable="true">' . $col->nom .'</h2> <span class="deleteCol">X</span> </div>';
                echo ' <ul class="sortable connectedSortable"> '; 
                echo  $columns->getCards($col->id_colonne);
                echo '</ul>';
                //$columns->getFormulaire();
                echo '</div>';

            }
        }

        public function getFormulaire() // OK
        {
            require "./Modules/addCardForm.html";
        }

        public function getTableau($id) // OK
        {
            if (isset($_SESSION['id_utilisateur']))
            {
                $bdd = BDD();
                $resultTab = $bdd->prepare('SELECT * FROM tableau WHERE id_projet =' . $id);
                $resultTab->execute();
                $count = $resultTab->rowCount();
                echo '<ul>';
                for ($i=0; $i < $count ; $i++) 
                { 
                    $tab = $resultTab->fetch(PDO::FETCH_OBJ);
                    echo '<li class="tab"> <b><a href="tableau.php?id=' . $tab->id_tableau . '">' . $tab->nom .'</a></b> </li>';
                }
                echo '</ul>';
            }
        }

        public function getTableauForProject($id) // OK, pour page Gestion Projets
        {
            if (isset($_SESSION['id_utilisateur']))
            {
                $bdd = BDD();
                $resultTab = $bdd->prepare('SELECT * FROM tableau WHERE id_projet = ? AND id_utilisateur = ?');
                $resultTab->execute(array($id, $_SESSION['id_utilisateur']));
                $count = $resultTab->rowCount();
                echo '<ul>';
                for ($i=0; $i < $count ; $i++) 
                { 
                    $tab = $resultTab->fetch(PDO::FETCH_OBJ);
                    echo 
                    '<li class="tab">
                        <b> <a href="tableau.php?id=' . $tab->id_tableau . '" id="'. $tab->id_tableau  .'">' . $tab->nom .'</a> <i class="fas fa-edit 2x"  id="' . $tab->id_tableau . '"> </i>  <i class="fas fa-trash-alt" id="' . $tab->id_tableau . '"></i></b>
                    </li>';
                }
                echo '</ul>';

                
            }
            
        }
        
        public function getProjet() // EN COURS
        {
            if (isset($_SESSION['id_utilisateur']))
            {
                $bdd = BDD();
                $result = $bdd->prepare("SELECT * FROM projet_utilisateur INNER JOIN projet on projet_utilisateur.id_projet = projet.id_projet WHERE id_utilisateur =" . $_SESSION['id_utilisateur']);
                $result->execute();
                $count = $result->rowCount();

                   while ($project = $result->fetch(PDO::FETCH_OBJ)) 
                   {
                       $id_projet= $project->id_projet;
                    echo '<h3 id="'. $project->id_projet .'"> - ' . $project->nom . ' </h3> <a href="page_gestion_projet.php?id= ' . $id_projet . '"> <i class="fas fa-edit 2x"></i> </a> <br>';
                    $this->getTableau($project->id_projet);
                   } 
            }  
        }

        public function getProjets() // OK, faite pour afficher toute la liste des projets
        {
            if (isset($_SESSION['id_utilisateur']))
            {
                $bdd = BDD();
                $result = $bdd->prepare("SELECT * FROM projet_utilisateur INNER JOIN projet on projet_utilisateur.id_projet = projet.id_projet WHERE id_utilisateur =" . $_SESSION['id_utilisateur']);
                $result->execute();
                $count = $result->rowCount();
                for ($i=1; $i < $count+1 ; $i++) 
                { 
                    $project = $result->fetch(PDO::FETCH_OBJ);
                    echo '<option value='. $project->id_projet  .'>' . $project->id_projet . ' ' . $project->nom . '</option>';
                }
                
            }
        }

        public function creationBillet() // OK
        { 
            $bdd = BDD();

            // Requête à la base de données pour récupérer la première colonne du tableau.
            $resultCol = $bdd->prepare('SELECT * FROM colonne where id_tableau =' . $_GET['id']);
            $resultCol->execute();
            $col = $resultCol->fetch(PDO::FETCH_OBJ);
            //
            
            if(isset($_POST["boutonCreation"])) 
            {
                if($_POST['titre'] != NULL && $_POST['description'] != NULL && $_POST['priorité'] != NULL) 
                {
                    $titre = $_POST['titre'];
                    $description = $_POST['description'];
                    $priorite = $_POST['priorité'];
                    $colonne = $col->id_colonne;

                    $requser = $bdd->prepare("INSERT INTO billets(nom, descriptif, id_colonne, priorité) VALUES (?,?,?,?)");
                    $requser->execute(array($titre, $description, $colonne, $priorite));
                    
                }
                else if($_POST['titre'] == NULL OR $_POST['description'] == NULL OR $_POST['priorité'] != NULL) 
                {
                    echo "<script>alert('Veuillez remplir tout les champs requis pour créer un billet !')</script>";
                }
                else echo "<script>alert('Erreur lors de la création')</script>";
            }
            
        }

        public function suppressionTableau() // OK
        {
            $bdd = BDD();
            if(isset($_POST['deleteButton'])) 
            {
                $nom = htmlspecialchars($_POST['deleteTab']);
                $requser = $bdd->prepare("DELETE FROM tableau WHERE nom = ? ");
                $requser->execute(array($nom));
                header('Location: page_gestion_projet.php?id='. $_GET['id']);

            }
            
                
            
        }

        public function creationColonne() // OK 
        {
            $bdd = BDD();
            require "./Modules/createCol.html";
            if(isset($_POST['createCol'])) 
            {
                if($_POST['newColName']!= null && $_POST['newColName']!= "")  
                {
                    $nom = $_POST['newColName'];
                    $creaTab = $bdd->prepare('INSERT INTO colonne (nom, id_tableau) VALUES (?,?)');
                    $creaTab->execute(array($nom, $_GET['id'] ) );
                    header('Location: tableau.php?id='. $_GET['id']);
                }
                else echo "<script> alert('Veuillez donner un nom au tableau');</script>";
            }
            
            
        }
        public function suppressionColonne() // OK 
        {
            $bdd = BDD();
            require "./Modules/deleteCol.html";
            if(isset($_POST['deleteCol']) != NULL) 
            {
                $nom = $_POST['newColName'];
                $suppTab = $bdd->prepare('DELETE FROM colonne where nom = ? AND id_tableau = ?');
                $suppTab->execute(array($nom, $_GET['id']));

                header('Location: tableau.php?id='. $_GET['id']);
            }
            
        }

        public function creationProjet()
        {   
            $bdd = BDD();

            if(isset($_POST['boutonCreationProjet'])) 
            {
                $nom = htmlspecialchars($_POST['titre']);
                $id_utilisateur = $_SESSION['id_utilisateur'];

                if($nom != null) 
                {

                    $requser = $bdd->prepare("INSERT INTO projet(nom) VALUES (?)");
                    $requser->execute(array($nom));
                    
                    $id = $bdd->lastInsertId();


                    $requser3 = $bdd->prepare("INSERT INTO projet_utilisateur (id_projet, id_utilisateur) VALUES (?,?)");
                    $requser3->execute(array($id, $id_utilisateur));
                }
                

            }
        }

        public function getNomProjet()
        {
            $bdd = BDD();
            $result = $bdd->prepare('SELECT * FROM projet where id_projet =' . $_GET['id']);
            $result->execute();
            $user = $result->fetch(PDO::FETCH_OBJ);
            return $user->nom;
        }

        public function getIdProjet()
        {
            $bdd = BDD();
            $result = $bdd->prepare('SELECT * FROM projet where id_projet =' . $_GET['id']);
            $result->execute();
            $user = $result->fetch(PDO::FETCH_OBJ);
            return $user->id_projet;
        }

        public function lol()
        {
            echo 'lol';
        }
    }

    class User 
    {
        public function inscription() // OK
        {
            $bdd = BDD();
            if(isset($_POST['submit1']))
            {
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $age = htmlspecialchars($_POST['age']);
                $password = sha1($_POST['motdepasse']);
                $email = htmlspecialchars($_POST['email']);
                $date_inscription = date("Y-m-d");

                if(!empty($_POST['pseudo']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['motdepasse']) ) 
                    {
                        $pseudolength = strlen($pseudo);
                        if($pseudolength <= 255) 
                        { 
                            if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
                            { 
                                $reqmail = $bdd->prepare('SELECT * FROM utilisateurs WHERE mail = ?') ;
                                $reqmail->execute(array($email));
                                $mailexist = $reqmail->rowCount();
                                
                                if($mailexist == 0) 
                                    { 
                                        if($password != NULL) 
                                            {
                                                $insertmbr = $bdd->prepare("INSERT INTO utilisateurs(nom, prenom, age, date_inscription, pseudo, password, mail) VALUES (?, ?, ?, ?, ?, ?, ?)");
                                                $insertmbr->execute(array($nom, $prenom, $age, $date_inscription, $pseudo, $password, $email));
                                                $this->mailInscription($email);
                                                echo "<script> document.location.href='page_connexion.php'; </script>";    
                                                
                                            }
                                        else $erreur = "Il faut insérer un mot de passe !";
                                    } 
                                else $erreur = "Adresse email déjà utilisée !";
                            } 
                            else $erreur = "Votre adresse email n'est pas valide !";
                        } 
                    } 
                        else $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
                } 
                    else $erreur = "Tous les champs doivent être complétés !";
        }

        public function Connection() // OK
        {
            $bdd = BDD();

            if(isset($_POST['submit1'])) 
            {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $mdpconnect = sha1($_POST['password']);
                if(!empty($pseudo) AND !empty($mdpconnect)) 
                {
                    $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE pseudo = '". $pseudo ."' AND password = '". $mdpconnect . "'");
                    $requser->execute(array($pseudo, $mdpconnect));
                    $userexist = $requser->rowCount();
                    if($userexist > 0) 
                    {
                        $userinfo = $requser->fetch();
                        $_SESSION['id_utilisateur'] = $userinfo['id_utilisateur'];
                        $_SESSION['nom'] = $userinfo['nom']; 
                        $_SESSION['prenom'] = $userinfo['prenom']; 
                        $_SESSION['pseudo'] = $userinfo['pseudo']; 
                        $_SESSION['mail'] = $userinfo['mail'];
                        $_SESSION['age'] = $userinfo['age']; 
                        $_SESSION['date_inscription'] = $userinfo['date_inscription'];
                        $_SESSION['password'] = $userinfo['password']; 
                        // Ici appel fonction mail
                        ?>
                        <script>
                            document.location.href="home2.php";
                        </script>
                        <?php
                        echo '<h2 class ="welcome">Bienvenue ' . $_SESSION['nom'].' '.$_SESSION['prenom'] . ', Vous êtes désormais connectés !</h2>';
                        
                    } else echo "Mauvais mail ou mot de passe !";
                
                } 
                else echo "Tous les champs doivent être complétés !";

            }
        }

        public function getUserSurname() // OK
        {
            $bdd = BDD();
            $result = $bdd->prepare('SELECT * FROM utilisateurs where id_utilisateur =' . $_SESSION['id_utilisateur']);
            $result->execute();
            $user = $result->fetch(PDO::FETCH_OBJ);
            return $user->prenom;
        }

        public function getUserAge() // OK
        {
            $bdd = BDD();
            $result = $bdd->prepare('SELECT * FROM utilisateurs where id_utilisateur =' . $_SESSION['id_utilisateur']);
            $result->execute();
            $user = $result->fetch(PDO::FETCH_OBJ);
            return $user->age;
        }

        public function getUserSignupDate() // OK
        {
            $bdd = BDD();
            $result = $bdd->prepare('SELECT * FROM utilisateurs where id_utilisateur =' . $_SESSION['id_utilisateur']);
            $result->execute();
            $user = $result->fetch(PDO::FETCH_OBJ);
            return $user->date_inscription;
        }

        public function getUsername() // OK
        {
            $bdd = BDD();
            $result = $bdd->prepare('SELECT * FROM utilisateurs where id_utilisateur =' . $_SESSION['id_utilisateur']);
            $result->execute();
            $user = $result->fetch(PDO::FETCH_OBJ);
            return $user->nom;
        }

        public function getUserEmail() // OK
        {
            $bdd = BDD();
            $result = $bdd->prepare('SELECT * FROM utilisateurs where id_utilisateur =' . $_SESSION['id_utilisateur']);
            $result->execute();
            $user = $result->fetch(PDO::FETCH_OBJ);
            return $user->mail;
        }

        public function getUserPseudo() // OK
        {
            $bdd = BDD();
            $result = $bdd->prepare('SELECT * FROM utilisateurs where id_utilisateur =' . $_SESSION['id_utilisateur']);
            $result->execute();
            $user = $result->fetch(PDO::FETCH_OBJ);
            return $user->pseudo;
        }

        public function userHomePage() // OK
        {
            if (isset($_SESSION['id_utilisateur']))
            {
              echo
              '<div class="container4">';
              $user = new User(); 
              echo '</div>';
              echo '<div class="container4">';
              $user->getUserData();
              echo '</div>';
              require "./Modules/deconnection.html";
              // renvoie vers une page qui lance un script de déconnexion et envoie vers l'accueil .
            }
            else 
            {
              require "./Modules/notConnectedAlert.html";
            }
        }

        public function displayUserPage() // OK, Gestion de la page utilisateur
        {
            if (isset($_SESSION['id_utilisateur']))
            {
                include "home.php";
            }
            else 
            {
                header('Location: page_connexion.php');
            }
        }

        public function userModification()  // fonction pour le formulaire de modification des informations de l'utilisateur
        {
            $bdd = BDD();

            if(isset($_POST['submitModification'])) // Si l'utilisateur appuie sur le bouton submit
            {

                $requser = $bdd->prepare("UPDATE utilisateurs SET prenom = ? WHERE utilisateurs.id_utilisateur = ?" );
                $requser->execute(array($_POST['prenom'], $_SESSION['id_utilisateur']));
            
                $requser = $bdd->prepare("UPDATE utilisateurs SET nom = ? WHERE utilisateurs.id_utilisateur = ?" );
                $requser->execute(array($_POST['nom'], $_SESSION['id_utilisateur']));
            
                $requser = $bdd->prepare("UPDATE utilisateurs SET mail = ? WHERE utilisateurs.id_utilisateur = ?" );
                $requser->execute(array($_POST['mail'], $_SESSION['id_utilisateur']));
            
                $requser = $bdd->prepare("UPDATE utilisateurs SET pseudo = ? WHERE utilisateurs.id_utilisateur = ?" );
                $requser->execute(array($_POST['pseudo'], $_SESSION['id_utilisateur']));
            
                if (isset($_POST['password']) != NULL )
                {
                    if($_POST['password'] == $_POST['password2'])
                    {
                        $requser = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE utilisateurs.id_utilisateur = ?" );
                        $requser->execute(array(sha1($_POST['password']), $_SESSION['id_utilisateur']));
                    } else echo "Mot de passe non identiques"; 
                } else echo "Le mot de passe ne peut pas être nul !";

            }
            else if (isset($_POST['stopModification'])) // Si l'utilisateur appuie sur le bouton cancel
            {
                var_dump($_POST);
                header('Location: home.php');
            }

        }

        public function mailInscription($email)
        {
            $bdd = BDD();

            $to_email = $emal;
            $subject = "Ifa Maker - Inscription réussie";
            $message = "Ceci est un mail généré automatiquement, vous confirmant que vous êtes bien inscrit à Ifa Maker.
            Vous pouvez vous connecter avec le mail et le mot de passe que vous avez renseignés lors de l'inscription. ";
            $headers = "From: noreply@ifa.fr";
        
            mail($to_email, $subject, $message, $headers);

        }
        public function creationEquipe() {}

        public function suppressionEquipe() {}

    }
?>