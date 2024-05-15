<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function categories(){
        if(Auth::check()){
            $categories = Category::where("user_id",Auth::id())->withTrashed()->get();
            return view("panel.categories.categories",compact('categories'));
        }
        else{
            return redirect()->route('welcome');
        }

    }

    public function create(){
        if(Auth::check()){
            return view("panel.categories.create");
        }
        else{
            return redirect()->route('welcome');
        }
    }

    public function add(Request $request){

        $cat = new Category();
        $cat->Name = $request->input('category_name');
        $cat->Is_Active = $request->input('status');
        $cat->user_id = Auth::id();
        $cat->save();

        return redirect()->route('categories')->with(["success" => "Kategori Başarıyla Oluşturuldu!"]);

    }

    public function update($id){

        $category = Category::find($id);
        if($category != null){
            return view("panel.categories.update",compact('category'));
        }
        else{
            return redirect()->route("categories")->withErrors(["errors" => "Bir hata oluştu."]);
        }
    }

    public function remake(Request $request){

        $request->validate([
            "category_name"=>"min:2",
            "status" => "min:0|max:1"
        ]);
        $category = Category::find($request->input('id'));
        if($category != null){
            $category->Name = $request->input('category_name');
            $category->Is_Active = $request->input('status');
            $category->save();

            return redirect()->route('categories')->with(["success" => "Kategori Başarıyla Güncellendi!"]);
        }else{
            return back()->withErrors(["errors" => "Kategori güncellenemedi. Tekrar deneyin!"]);
        }


    }

    public function delete($id){

        $category = Category::find($id);
        if($category != null){
            $category->delete();
            return redirect()->route('categories')->with(["success" => "Kategori başarıyla silindi!"]);
        }
        else{
            return redirect()->route('categories')->withErrors(["errors" => "Kategori zaten silinmiş."]);
        }

    }

}
