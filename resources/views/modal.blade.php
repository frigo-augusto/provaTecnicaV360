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