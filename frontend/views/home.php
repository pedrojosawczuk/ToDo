<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo-Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/bootstrap-5.2.3-dist/custom-css/custom.css">
</head>
<body>
    <header class="d-flex justify-content-between align-items-center mt-3 mb-5 p-4">
        <div class="d-flex justify-content-center align-items-center ms-4">
            <img class="img-logo me-2" src="../src/logo.png" alt="Logo">
            <h1 class="text-info">ToDoList</h1>
        </div>
        <div>

        </div>
        <div class="me-4">
            <button class="btn btn-success " href="createTask.html">Criar Tarefa</button>
            <button class="btn btn-danger" href="login.html">Sair</button>
        </div>
    </header>
 
    <main class="d-flex flex-row justify-content-around align-items-center ">
        <div class="d-flex flex-column justify-content-center">
            <h3>Sua lista de afazeres:</h3>
            <div class="d-flex mt-2">
                <div class="d-flex flex-row justify-content-between card p-4" style="width: 18rem;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Tarefa
                        </label>
                      </div>
                      <a href="">Ver detalher-></a>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-center">
            <h3>Tarefas feitas:</h3>
            <div class="d-flex mt-2">
                <div class="d-flex flex-row justify-content-between card p-4" style="width: 18rem;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Tarefa
                        </label>
                      </div>
                      <a href="">Ver detalher-></a>
                </div>
            </div>
        </div>
        

    </main>
      <footer>

      </footer>
</body>
</html>