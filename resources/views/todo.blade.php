<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Prova Técnica V360</title>
      
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
                

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <style>
            #main-section{
                max-width: 300px;
            }

            #todo-header{
                margin-left: auto;
                margin-right: 50;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand m-2" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class= "m-5">
            <section id="main-section" class="d-flex flex-column">
                Todo
                <div id="todo-header" class= "mb-3">
                    <button class="btn btn-primary mr-5" data-toggle="modal" data-target="#newTodoModal">+</button>
                </div>
                <div id="todo-container" class="d-flex ">
                  <div id="todo-1">

                  </div>
                </div>
            </section>
        </main>

        <!-- Modal Todo -->
        <div class="modal fade" id="newTodoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Criar novo todo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{route('todo.new')}}" id="todo-form">
                  <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                  <div class="form-group row">
                    <label for="todo-title" class="mt-1">Título</label>
                    <input id="todo-title" name="title" type="text" placeholder="Tarefa 1">
                  </div>
                  <div class="form-group row">
                    <label for="todo-description" class="mt-1">Descrição</label>
                    <textarea id="todo-description" name="description" type="text" placeholder="Descrição da tarefa"></textarea>
                  </div>
                  <label for="todo-tasks">Tarefas</label><br>
                  <label for="todo-difficulty" class="mt-1">Dificuldade</label><br>
                  <select name="todo-difficulty" id="todo-difficulty">
                    <option value="0">Fácil</option>
                    <option value="1" selected>Médio</option>
                    <option value="2">Difícil</option>
                  </select>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="todo-form" class="btn btn-primary">Salvar</button>
              </div>
            </div>
          </div>
        </div>
        
    </body>
    <script>
        $("#todo-form").submit(function(e) {
          e.preventDefault();
          buildNewTodo();
        });

        function buildNewTodo(){
          $("#todo-container").append(
            "lorem ipsum dolor"
          );
        }
    </script>
</html>
