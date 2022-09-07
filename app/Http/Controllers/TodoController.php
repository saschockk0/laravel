<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $todos = Todo::all();
        return view('todo', ['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('todos.index')->withErrors($validator);
        }

        Todo::create([
            'title' => $request->get('title')
        ]);

        return redirect()->route('todos.index')->with('success', 'Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $todo = Todo::where('id', $id)->first();
        return view('edit-todo', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Валидация, название по-прежнему обязательно
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        //Если валидация неуспешна, прекратить выполнение функции и вернуть ошибку
        if ($validator->fails()) {
            return redirect()->route('todos.edit', ['todo' => $id])->withErrors($validator);
        }

        //Получить задачу по ID
        $todo = Todo::where('id', $id)->first();
        //Заменить название на то, которое пришло из формы
        $todo->title = $request->get('title');
        //Заменить статус на тот, что пришел из формы
        $todo->is_completed = $request->get('is_completed');
        //Сохранить изменения
        $todo->save();

        //Перейти к начальной странице и передать ей статус успеха с текстом "Updated Todo"
        return redirect()->route('todos.index')->with('success', 'Updated Todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::where('id', $id)->delete();
        return redirect()->route('todos.index')->with('success', 'Deleted Todo');
    }
}
