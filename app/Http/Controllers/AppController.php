<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function main (){
        if(Auth::check()){
            $tasks = Auth::user()->getTask;
            $categories = Category::where("user_id",Auth::id())->get();
            return view('mainpage',compact('tasks','categories'));
        }
        else{
            return redirect()->route('welcome');
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
        ],[
            'category_id.required' => 'Lütfen kategori seçiniz!'
        ]);
        $tasks = new Tasks();
        $tasks->Title = $request->input('task');
        $tasks->Content = $request->input('description');
        $tasks->Status = $request->input('status');
        $tasks->Deadline = $request->input('deadline');
        $tasks->user_id = Auth::id();
        $tasks->category_id = $request->input('category_id');
        $tasks->save();
        $tasks = Auth::user()->getTask;
        $categories = Category::where("user_id",Auth::id())->get();
        return view('mainpage',compact('tasks','categories'));
    }
}
