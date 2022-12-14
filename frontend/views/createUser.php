<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo-Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="../src/js/submit.js" defer></script>
    <link rel="stylesheet" href="../style/bootstrap-5.2.3-dist/custom-css/custom.css">
</head>
<body>
    <header class="d-flex justify-content-center align-items-center mt-3 mb-5 p-4">
        <div class="d-flex justify-content-center align-items-center ms-4">
            <img class="img-logo me-2" src="../src/logo.png" alt="Logo">
            <h1 class="text-info">ToDoList</h1>
        </div>
        <div>

        </div>
    </header>
 
    <main class="d-flex flex-row justify-content-center align-items-center ">
        <div>
            <form method="POST" action="../../backend/user/create.php" id="my-form" class="d-flex flex-column">
                <label for="">Nome:</label><input type="text" name="name" id="name">
                <label for="">Email:</label><input type="text" name="email" id="email">
                <label for="">Senha:</label><input type="text" name="password" id="password">

                <input type="submit" class="btn btn-info mt-2" value="Criar" >
                <a class="btn btn-info mt-2" href="login.html">Já pussuo cadastro</a>

            </form>
        </div>
    

    </main>
      <footer>

      </footer>
</body>
</html>