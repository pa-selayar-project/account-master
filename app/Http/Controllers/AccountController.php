<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use Illuminate\Http\Request;
use Response, Redirect;

class AccountController extends Controller
{
    public function index()
    {
        $data = Account::with('category')->get();
        $select = Category::all(); 
        return view('user/index', compact('data','select'));
    }

    public function store(Request $request)
    {
        $this->validateRequest("create");
        $insert = Account::create([
            "app_name" => $request->app_name,
            "app_pass" => $request->app_pass,
            "app_link" => $request->app_link,
            "app_logo" => "#",
            "category_id" => $request->category_id
        ]);
        Response::json($insert);
        return Redirect::back()->with('status','Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest("update");
        $update = Account::whereId($id)->update([
            "app_name" => $request->app_name,
            "app_pass" => $request->app_pass,
            "app_link" => $request->app_link,
            "app_logo" => "#",
            "category_id" => $request->category_id
        ]);
        Response::json($update);
        return Redirect::back()->with('status','Data berhasil diubah');
    }

    public function destroy($id)
    {
        Account::destroy($id);
        return Redirect::back()->with('status','Data berhasil dihapus');
    }

    private function validateRequest($data)
    {
        $messages =[
            "required" => "Ada Field yang kosong",
            "unique" => "Data sudah ada dalam database"
        ];

        if($data == "create")
        {
            $rules = "required|unique:account_tb";
        }elseif ($data == "update") {
            $rules = "required";
        }

        return request()->validate([
                "app_name" => $rules,
                "app_pass" => "required",
                "app_link" => "required",
                "app_logo" => "nullable",
                "category_id" => "integer"
                ], $messages);
    }

    public function get_data($id)
    {
        $data = Account::findOrFail($id);
        return $data;
    }
}
