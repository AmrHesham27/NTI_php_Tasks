<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Blog</a>
        </li>

        <?php
          $Writer = new Writer;
          if ($_GET['logout'] == 'y') $Writer->logout();
          
          if( $_SESSION[Session::$userId] ){
            echo "
            <li class='nav-item'>
              <a class='nav-link' href='addArticle.php'>Add Article</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='myArticles.php'>My Articles</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href=".htmlspecialchars($_SERVER['PHP_SELF'])."?logout=y>
                Logout
              </a>
            </li>
            ";
          }
          else {
            echo "
            <li class='nav-item'>
              <a class='nav-link' href='login.php'>Login</a>
            </li>
    
            <li class='nav-item'>
              <a class='nav-link' href='register.php'>Register</a>
            </li>
            ";
          }
        ?>
      </ul>
    </div>
  </div>
</nav>