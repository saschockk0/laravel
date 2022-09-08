<?php

namespace App\Http\Controllers;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return view('team', ['teams' => $teams]);
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
            return redirect()->route('teams.index')->withErrors($validator);
        }

        Team::create([
            'title' => $request->get('title')
        ]);

        return redirect()->route('teams.index')->with('success', 'Inserted');
    }

    // public function addTask(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'task' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('teams.index')->withErrors($validator);
    //     }

    //     Team::create([
    //         'task' => $request->get('task')
    //     ]);

    //     return redirect()->route('teams.index')->with('success', 'Inserted');
    // }

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
        //
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
            return redirect()->route('teams.edit', ['team' => $id])->withErrors($validator);
        }

        //Получить задачу по ID
        $team = Team::where('id', $id)->first();
        //Заменить название на то, которое пришло из формы
        $team->title = $request->get('title');
        //Заменить статус на тот, что пришел из формы
        $team->is_completed = $request->get('is_completed');
        //Сохранить изменения
        $team->save();

        //Перейти к начальной странице и передать ей статус успеха с текстом "Updated team"
        return redirect()->route('teams.index')->with('success', 'Updated team');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
