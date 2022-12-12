@extends('templates.app')
@section('content')
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
  @include('modal')
@endsection

@section('script')
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
              <div>` + 
              getTodoDifficulty(response) +
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
            <input type="checkbox" taskId="` + response.id + `" class="task-checkbox">`+
            response.title +
          `</div>
          <div>
            <button class="btn btn-primary m-4 delete-task-button" taskId=`+ response.id +`>Excluir</button>
          </div>
        </div>`
        );
    }

    $(document).on("click", ".new-task-button", function(e){
      nextTodoId = $(this).attr('todoId');
    });

    function clearTaskFields(){
      $("#todo-id").val("");
      $("#task-title").val("");
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

    $(document).on("click", ".todo-checkbox", function (e){
      var id = $(this).attr("todoId")
      $.ajax({
        data: {
            id: id
        },
        type: 'POST',
        url: "{{route('todo.completed.change')}}"
      })
    });

    $(document).on("click", ".task-checkbox", function(e){
      var id = $(this).attr("taskId");
      $.ajax({
        data: {
            id: id
        },
        type: 'POST',
        url: "{{route('task.completed.change')}}"
      });
    });

    $(document).on("click", ".delete-todo-button", function(e){
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

    $(document).on("click", ".delete-task-button", function(e){
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
@endsection
