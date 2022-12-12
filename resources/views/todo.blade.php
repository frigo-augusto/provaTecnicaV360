<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <title>Prova Técnica V360</title>
      
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

        <style>
          
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand m-2" href="#">Gerenciador de tarefas</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home<span class="sr-only"></span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class= "m-5 border d-flex flex-column border-primary w-50">
          <div id="todo-header" class= "d-flex flex-row justify-content-between" >
            <div class="m-3">
              Lista de Afazeres
            </div>
            <div class="m-3">
              <button class="btn btn-primary mr-5" data-toggle="modal" data-target="#newTodoModal">+</button>
            </div>
          </div>
          <section id="todo-container" class="d-flex flex-column w-100 mt-3">
              @foreach ($todos as $todo)
                <div id="todo-{{@$todo->id}}-container" class="m-3 border border-primary">
                  <div>
                    <div class= "d-flex flex-row justify-content-between m-2">
                      <div class="d=flex flex-row">
                        <input type="checkbox" @php if ($todo->completed){echo "checked";} @endphp todoId="{{@$todo->id}}" class="todo-checkbox">
                        {{$todo->title}}
                        <div>
                          {{$todo->description}}
                        </div>
                        <div>
                          @switch($todo->difficulty)
                              @case(0)
                                @php echo "Fácil"; @endphp
                                @break
                              @case(1)
                                @php echo "Médio"; @endphp
                                @break
                              @case(2)
                                @php echo "Difícil"; @endphp
                                @break
                          @endswitch
                        </div>
                      </div>
                      <div>
                        <button class="btn btn-primary delete-todo-button" todoId="{{$todo->id}}">Excluir</button>
                        <button class="btn btn-primary new-task-button" todoId="{{$todo->id}}" data-toggle="modal" data-target="#newTaskModal">+</button>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column border border-success m-3" id="task-todo-{{@$todo->id}}-container">
                      @foreach ($todo->tasks as $task)
                        <div class="d-flex flex-row justify-content-between" id="task-{{@$task->id}}-container">
                          <div>
                            <input type="checkbox" @php if ($task->completed){echo "checked";} @endphp taskId={{@$task->id}} class="task-checkbox">
                            {{$task->title}}
                          </div>
                          <div>
                            <button class="btn btn-primary m-4 delete-task-button" taskId="{{$task->id}}">Excluir</button>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              @endforeach
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
                <form method="POST" action="{{route('todo.new')}}" id="create-todo-form">
                  <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                  <div class="form-group row">
                    <label for="todo-title" class="mt-1">Título</label>
                    <input id="todo-title" name="title" type="text" placeholder="Tarefa 1">
                  </div>
                  <div class="form-group row">
                    <label for="todo-description" class="mt-1">Descrição</label>
                    <textarea id="todo-description" name="description" type="text" placeholder="Descrição da tarefa"></textarea>
                  </div>
                  <label for="todo-difficulty" class="mt-1">Dificuldade</label><br>
                  <select name="difficulty" id="todo-difficulty">
                    <option value="0">Fácil</option>
                    <option value="1">Médio</option>
                    <option value="2">Difícil</option>
                  </select>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="create-todo-form" class="btn btn-primary">Salvar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Task -->
        <div class="modal fade" id="newTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Criar nova task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{route('task.new')}}" id="create-task-form">
                  <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                  <div class="form-group row">
                    <input type="hidden" id="todo_id" name="todo_id">
                    <label for="todo-title" class="mt-1">Título</label>
                    <input id="todo-title" name="title" type="text" placeholder="Tarefa 1">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="create-task-form" class="btn btn-primary">Salvar</button>
              </div>
            </div>
          </div>
        </div>
        
    </body>
    <script>
      let nextTodoId = null;
      let nextTaskId = null;

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      

        function clearTodoFields(){
          $("#todo-difficulty").val("0");
          $("#todo-title").val("");
          $("#todo-description").val("");
        }

        $('#create-todo-form').submit(async function(e) {
          e.preventDefault();
          funcResponse = await $.ajax({
              data: $(this).serialize(),
              type: $(this).attr('method'), 
              url: $(this).attr('action'), 
              success: function(response) { 
                  console.log(response.id);
              }
          });
          buildNewTodo(funcResponse);
          clearTodoFields();
        });

        function getTodoDifficulty(response){
          switch(response.difficulty){
            case "0":
              return "Fácil";
              break;
            case "1":
              return "Médio";
              break;
            case "2":
              return "Difícil";
              break;
          }
        }

        function buildNewTodo(response){
          $("#todo-container").append(
            `<div id="todo-` + response.id + `-container" class="m-3 border border-primary">
                  <div>
                    <div class= "d-flex flex-row justify-content-between m-2">
                      <div class="d=flex flex-row">
                        <input type="checkbox" todoId="` + response.id +`" class="todo-checkbox">` +
                        response.title +
                        `<div>` +
                          response.description +
                        `</div>
                        <div>` + getTodoDifficulty(response) +
                        `</div>
                      </div>
                      <div>
                        <button class="btn btn-primary delete-todo-button" todoId="`+ response.id + `">Excluir</button>
                        <button class="btn btn-primary new-task-button" todoId="`+ response.id + `" data-toggle="modal" data-target="#newTaskModal">+</button>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column border border-success m-3" id="task-todo-` + response.id + `-container">
                    </div>
                  </div>
                </div>`
          );
        }

        function buildNewTask(response){
          $("#task-todo-" + nextTodoId + "-container").append(
            `<div class="d-flex flex-row justify-content-between" id="task-` + response.id + `-container">
              <div>
                <input type="checkbox" taskId=` + response.id + `class="task-checkbox">`+
                response.title +
              `</div>
              <div>
                <button class="btn btn-primary m-4" taskId=`+ response.id +`>Excluir</button>
              </div>
            </div>`
          );
          console.log("aaaaaaaaa");
        }

        $(".new-task-button").on("click", function(e){
          nextTodoId = $(this).attr('todoId');
        });

        function clearTaskFields(){
          $("#todo-id").val("");
          $("#todo-title").val("");
        }

        $("#create-task-form").submit(async function(e){
          e.preventDefault();
          $("#todo_id").val(nextTodoId);
          response = await $.ajax({
              data: $(this).serialize(),
              type: $(this).attr('method'), 
              url: $(this).attr('action'), 
          });
          buildNewTask(response);
          clearTaskFields();
        });

        $(".todo-checkbox").on("click", function (e){
          var id = $(this).attr("todoId")
          $.ajax({
            data: {
              id: id
            },
            type: 'POST',
            url: "{{route('todo.completed.change')}}"
          })
        });

        $(".task-checkbox").on("click", function(e){
          var id = $(this).attr("taskId");
          $.ajax({
            data: {
              id: id
            },
            type: 'POST',
            url: "{{route('task.completed.change')}}"
          })
        });

        $(".delete-todo-button").on("click", function(e){
          var id = $(this).attr("todoId");
          $.ajax({
            data: {
              id: id
            },
            type: 'DELETE',
            url: "{{route('todo.delete')}}"
          });
          $("#todo-" + id + "-container").remove();
        });

        $(".delete-task-button").on("click", function(e){
          var id = $(this).attr("taskId");
          $.ajax({
            data: {
              id: id
            },
            type: 'DELETE',
            url: "{{route('task.delete')}}"
          });
          $("#task-" + id + "-container").remove();
        });
        
    </script>
</html>
