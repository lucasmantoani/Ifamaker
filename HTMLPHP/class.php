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
        public function getCards($id_colonne)
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

        public function getColonne()
        {
            $bdd = BDD();

            $resultCol = $bdd->prepare('SELECT * FROM colonne where id_tableau =' . $_GET['id']);
            $resultCol->execute();
            $columns = new tableau;
            $count = $resultCol->rowCount();
            for ($i=0; $i < $count ; $i++) 
            { 
                $col = $resultCol->fetch(PDO::FETCH_OBJ);

                echo ' <div class="container" id_colonne="' . $col->id_colonne . '" > ';
                echo ' <h2 contenteditable="true">' . $col->nom .'</h2> ';
                echo ' <ul class="sortable connectedSortable"> '; 
                echo  $columns->getCards($col->id_colonne);
                echo '</ul>';
                echo '</div>';
            }
        }

        public function getTableau()
        {
            if (isset($_SESSION['id_utilisateur']))
            {
                $bdd = BDD();
                $resultTab = $bdd->prepare('SELECT * FROM tableau WHERE id_utilisateur =' . $_SESSION['id_utilisateur']);
                $resultTab->execute();
                $count = $resultTab->rowCount();
                echo '<h2>Tableaux :</h2>';
                echo '<ul>';
                for ($i=0; $i < $count ; $i++) 
                { 
                    $tab = $resultTab->fetch(PDO::FETCH_OBJ);
                    echo '<li> <a href="tableau.php?id=' . $tab->id_tableau . '">' . $tab->nom . '</a></li>';
                }
                echo '</ul>';
                // Bouton pour créer un nouveau tableau, qui ferait appel a creationTableau
                echo 
                '
                <form class="form" role="form" id="loginForm" novalidate="" method="POST">
                <div class="form-group">
                    <input w-25 type="text" class="form-control" name="tabName" id="password" required="" autocomplete="new-password">
                    <div class="invalid-feedback">Please enter a password</div>
                </div>
                <button type="submit" name="submitNewTab" class="btn btn-lg btn-success" id="btnLogin">Créer</button>
            </form>
                 ';
                
            }
            
        }

        public function getForm()
        {
           echo '
           <div class="link-div">
           <input type="text" id="new_text" value="" />
           <input
             type="button"
             name="btnAddNew"
             value="Ajouter"
             class="add-button"/>
         </div>';
        }

        public function creationTableau() 
        {
            $bdd = BDD();

            if(isset($_POST['submitNewTab'])) 
            {
                
                $nom = $_POST['tabName'];
                //$requser = $bdd->prepare("INSERT INTO tableau( nom, id_projet, id_utilisateur) VALUES ([value-1],[value-2],[value-3],[value-4])");
                //$requser->execute;
                
            }
        }

        public function suppressionTableau() {}

        public function creationColonne() 
        {
            // Vérifier si l'user clique sur le bouton
            $bdd = BDD();
            $nom = $_POST['nom'];
            $creaTab = $bdd->prepare('INSERT INTO colonne (nom, id_tableau) VALUES (?,?)');
            $creaTab->execute(array($nom, $_GET['id'] ) );

        }

        //public function supressionColonne() {}
        
    }

    class User 
    {
        public function inscription() 
        {
            $bdd = BDD();
            if(isset($_POST['submit1']))
            {
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $age = htmlspecialchars($_POST['age']);
                $password = sha1($_POST['motdepasse']);
                $address = htmlspecialchars($_POST['address']);
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

        public function Connection() 
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
                    $_SESSION['age'] = $userinfo['age']; ?>
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

        public function getUserData() 
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

        public function userHomePage()
        {
            if (isset($_SESSION['id_utilisateur']))
            {

              echo '<a href="deconnexion.php" class="btn btn-danger" role="button">Déconnexion</a><br><br>';
              // renvoie vers une page qui lance un script de déconnexion et envoie vers l'accueil .
              echo
              '<div class="container4">';
              $user = new User(); 
              echo '</div>';
              echo '<div class="container4">';
              $user->getUserData();
              echo '</div>';
            }
            else 
            {
              echo "<p style='text-align : center; color: white;'>Vous n'êtes pas identifié(e), vous pouvez le faire <a href='page_connexion.php'>ici !</a> </p>";
            }
        }

        public function creationEquipe() {}

        public function suppressionEquipe() {}

    }


?>