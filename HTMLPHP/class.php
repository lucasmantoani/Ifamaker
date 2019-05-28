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
                echo '<li class="card" id_billet="'.$cards->id_billets . '">' . $cards->nom . '<br>' . $cards->descriptif.'</li>';
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
                echo ' <h2 contenteditable="true">' . $col->nom .'</h2> ';
                echo ' <ul class="sortable connectedSortable"> '; 
                echo  $columns->getCards($col->id_colonne);
                echo '</ul>';
                $columns->getFormulaire();
                echo '</div>';
            }
        }

        public function getFormulaire() // OK
        {
            require "./Modules/addCardForm.html";
        }

        public function getTableau() // OK
        {
            if (isset($_SESSION['id_utilisateur']))
            {
                $bdd = BDD();
                $resultTab = $bdd->prepare('SELECT * FROM tableau WHERE id_utilisateur =' . $_SESSION['id_utilisateur']);
                $resultTab->execute();
                $count = $resultTab->rowCount();
                echo '<h2>Tableaux :</h2>';
                echo '<ul>';
                $this->getProjet();
                for ($i=0; $i < $count ; $i++) 
                { 

                    $tab = $resultTab->fetch(PDO::FETCH_OBJ);
                    echo '<li> Nom : <a href="tableau.php?id=' . $tab->id_tableau . '">' . $tab->nom .'</a> </li>';
                }
                echo '</ul>';
                // Bouton pour créer un nouveau tableau, qui ferait appel a creationTableau
                require "./Modules/createTabForm.html";
                
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
                for ($i=0; $i < $count ; $i++) 
                { 
                    $project = $result->fetch(PDO::FETCH_OBJ);
                    echo $project->nom;

                    
                }
                // Appeler creationTableau() où id_projet = ?????????????????
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
                for ($i=0; $i < $count ; $i++) 
                { 
                    $project = $result->fetch(PDO::FETCH_OBJ);
                    echo '<option>' . $project->id_projet . ' ' . $project->nom . '</option>';
                }
                // Appeler creationTableau() où id_projet = ?????????????????
            }
        }

        public function creationTableau() // OK
        {
            $bdd = BDD();
            require "./Modules/deleteTabForm.html";
            if(isset($_POST['submitNewTab'])) 
            {
                
                $nom = htmlspecialchars($_POST['tabName']);
                $user = $_SESSION['id_utilisateur'];

                $requser = $bdd->prepare("INSERT INTO tableau(nom, id_projet, id_utilisateur) VALUES (?,?,?)");
                $requser->execute(array($nom, 1, $user));
                
                
            }
        }

        public function suppressionTableau() // OK
        {
            $bdd = BDD();
            if(isset($_POST['deleteButton'])) 
            {
                $nom = htmlspecialchars($_POST['tabName']);
                $requser = $bdd->prepare("DELETE FROM tableau WHERE nom = ? ");
                $requser->execute(array($nom));
                header('Location: ./home.php');

            }
            
                
            
        }

        public function creationColonne() // OK
        {
            $bdd = BDD();
            require "./Modules/createCol.html";
            if(isset($_POST['createCol']) != NULL) 
            {
                $nom = $_POST['newColName'];
                $creaTab = $bdd->prepare('INSERT INTO colonne (nom, id_tableau) VALUES (?,?)');
                $creaTab->execute(array($nom, $_GET['id'] ) );
                header('Location: tableau.php?id='. $_GET['id']);
            }
            
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

                if(!empty($_POST['pseudo']) AND !empty($_POST['address']) AND !empty($_POST['email']) AND !empty($_POST['motdepasse']) ) 
                    {
                        $pseudolength = strlen($pseudo);
                        if($pseudolength <= 255) 
                        {
                            if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
                            {
                                $reqmail = $bdd->prepare('SELECT * FROM utilisateur WHERE mail = ?') ;
                                $reqmail->execute(array($email));
                                $mailexist = $reqmail->rowCount();
                                if($mailexist == 0) 
                                    {
                                        if($password != NULL) 
                                            {
                                                $insertmbr = $bdd->prepare("INSERT INTO utilisateurs(nom, prenom, age, pseudo, password, mail) VALUES (?, ?, ?, ?, ?, ?)");
                                                $insertmbr->execute(array($nom, $prenom, $age, $pseudo, $password, $email));
                                                $erreur = "Votre compte a bien été créé !";
                                                echo $erreur;            
                                                
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
                        
                        ?>
                        <script>
                            document.location.href="home.php";
                        </script>
                        <?php
                        echo '<h2 class ="welcome">Bienvenue ' . $_SESSION['nom'].' '.$_SESSION['prenom'] . ', Vous êtes désormais connectés !</h2>';
                        
                    } else echo "Mauvais mail ou mot de passe !";
                
                } 
                else echo "Tous les champs doivent être complétés !";

            }
        }

        public function getUserData() // OK
        {
            $bdd = BDD();
            $result = $bdd->prepare('SELECT * FROM utilisateurs where id_utilisateur =' . $_SESSION['id_utilisateur']);
            $result->execute();
            $user = $result->fetch(PDO::FETCH_OBJ);

            echo '<div class="userInfo"><h4> Pseudo : ' . $user->pseudo . ' <h4>' . 
                 '<h4> Nom: ' . $user->nom . '<h4>' .
                 '<h4> Prénom : ' . $user->prenom . '<h4>' .
                 '<h4> Adresse mail : ' . $user->mail . '<h4>' .
                 '<h4> Age : ' . $user->age . ' ans.<h4>';
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
                header('Location: index.php');
            }
        }

        public function creationEquipe() {}

        public function suppressionEquipe() {}

    }
?>