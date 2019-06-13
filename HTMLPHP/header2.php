<?php ini_set('display_errors', 1);
    require_once 'class.php';
    $tableau = new Tableau();
 ?>
<link rel="stylesheet" href="CSS/main.css">
  <nav class="navbar navbar-expand-md navbar-dark">

        <div class="collapse navbar-collapse" id="navbarNavDropdown" > 
          <ul class="navbar-nav">
            <li class="nav-item active">
              <?php $tableau->creationColonne(); ?>
            </li>
            <li class="nav-item active">
              <?php $tableau->suppressionColonne(); ?>
            </li>
            <li class="nav-item">
            <?php include "testmodal.html"; ?>
            </li>

          </ul>
        </div>
      </nav>
