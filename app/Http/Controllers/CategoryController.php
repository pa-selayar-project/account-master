<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Response, Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view('category/index', compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validateRequest("create");
        $insert = Category::create([
            "category_name" => $request->category_name
        ]);
        Response::json($insert);
        return Redirect::back()->with('status','Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest("update");
        $update = Category::whereId($id)->update([
            "category_name" => $request->category_name
        ]);
        Response::json($update);
        return Redirect::back()->with('status','Data berhasil diubah');
    }

    public function destroy(Category $category)
    {
        Account::destroy($category->id);
        return Redirect::back()->with('status','Data berhasil dihapus');
    }

    private function validateRequest($data)
    {
        // dd(request());
        $messages =[
            "required" => "Ada Field yang kosong",
            "unique" => "Data sudah ada dalam database"
        ];

        if($data == "create")
        {
            $rules = "required|unique:category_tb";
        }elseif ($data == "update") {
            $rules = "required";
        }

        return request()->validate(["category_name" => $rules], $messages);
    }
}
