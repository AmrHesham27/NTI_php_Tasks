<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="blog">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="addArticle">AddArticle</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<body>
    <h1 class="text-center"> Blog </h1>
    <div class="Container my-5">
        <?php
            foreach ($articles as $article) {
                echo "
                    <div class='card'>
                        <h3 class='text-center'>".$article->articleName."</h3>
                        <img width='300' src=" . asset('tmp/uploads'). "/" . $article->imagePath . ">
                        <p class='text'>".$article->content."</p>
                        <p class='text'>Writer : ".$article->userName."</p>
                    </div>
                ";
            };
        ?>
    </div>
</body>
</html>
