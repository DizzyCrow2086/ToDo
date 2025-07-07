<!DOCTYPE html>
<html>
<head>
    <title>Список задач</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-pap...yourhash..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container">
    <h1>Список задач</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Создать новую задачу
    </a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Статус</th>
                <th>Время создания</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->completed ? 'Выполнено' : 'Не выполнено' }}</td>
                <td>{{ $task->updated_at }}</td>
                <td>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary" title="Редактировать">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="{{ route('tasks.toggleStatus', $task->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning" title="{{ $task->completed ? 'Сделать невыполненной' : 'Выполнить' }}">
                            @if($task->completed)
                                <i class="fas fa-undo"></i>
                            @else
                                <i class="fas fa-check"></i>
                            @endif
                        </button>
                    </form>

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" title="Удалить">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
