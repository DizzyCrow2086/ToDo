<!DOCTYPE html>
<html>
<head>
    <title>Редактировать задачу</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Редактировать задачу</h1>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Название:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
        </div>
        <div class="form-group">
            <label for="completed">Выполнено:</label>
            <select class="form-control" id="completed" name="completed">
                <option value="0" {{ !$task->completed ? 'selected' : '' }}>Не выполнено</option>
                <option value="1" {{ $task->completed ? 'selected' : '' }}>Выполнено</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
</div>
</body>
</html> 