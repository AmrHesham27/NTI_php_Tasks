<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
    <form action="controler.php" method='post' class="mx-auto my-5" style="width: 300px;">
        <div class="btn-3 mt-3">
            <label>GitHub URL</label>
            <input name="github_URL" class="form-control">
        </div>
        
        <div class="btn-3 mt-5">
            <button type='submit' name="submit" class="btn btn-primary">Add User</button>
        </div>
    </form>
</body>
</html>