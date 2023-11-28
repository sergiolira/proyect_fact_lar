<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Todo;
use App\Models\Category;

class TodosController extends Controller
{
    /**
     * index para mostrar todos los todos
     * store para guardar un todo
     * update para actualizar un todo
     * detroy para eliminar un todo 
     * edit para mostrar el formulario de edicion   
     */

     public function store(Request $request) {
        //Validamos
        $request->validate([
            'title' => 'required|min:3',
        
        ]);

        //Obetnemos valores y guardamos 
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();
        
        return redirect()->route('todos')->with('success', 'Tarea creado correctamente');
     }      

    public function index() {
        $todos = Todo::all();
        $categories = Category::all();
        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);  

    }

    public function show($id) {
        $todo = Todo::find($id);
        $categories = Category::all();
        return view('todos.show', ['todo' => $todo, 'categories' => $categories]);    
    }


    public function update(Request $request, $id) {
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();
        //Para ver en consola
        //dd($request);
        
        //return view('todos.index', ['success' => 'Tarea actualizada ']);   
        return redirect()->route('todos')->with('success', 'Tarea actualizada'); 
    }

    public function destroy($id) {
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todos')->with('success', 'Tarea eliminada');
    }

    

}
