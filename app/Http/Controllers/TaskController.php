<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Отобразить список всех задач
    public function index()
    {
        $tasks = Task::all();  
        return view('tasks.index', compact('tasks')); 
    }

    // Отобразить форму создания новой задачи
    public function create()
    {
        return view('tasks.create'); 
    }

    // Сохранить созданную задачу
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255', 
        ]);

        Task::create([
            'title' => $request->input('title'),
            'completed' => false,
        ]); // Создать новую задачу с данными из запроса

        return redirect()->route('tasks.index')
            ->with('success', 'Задача успешно создана!'); 
    }

    // Отображение формы редактирования задачи
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task')); 
    }

    // Сохранения изменений
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255', 
        ]);

        $task->update([
            'title' => $request->input('title'),
            'completed' => $request->input('completed', false),
        ]); // Обновить задачу с данными из запроса

        return redirect()->route('tasks.index')
            ->with('success', 'Задача успешно обновлена!'); 
    }

    // Удаление задачи
    public function destroy(Task $task)
    {
        $task->delete(); // Удалить задачу из базы данных

        return redirect()->route('tasks.index')
            ->with('success', 'Задача успешно удалена!'); 
    }

    // Смена статуса задачи
    public function toggleStatus(Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();
        return redirect()->route('tasks.index')->with('success', 'Статус задачи изменён!');
    }
}
