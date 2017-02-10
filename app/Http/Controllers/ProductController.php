<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = DB::table('products')->get();
        return view('/products/index')->with('products', $all);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sku = $_POST['sku'];
        $inventory = $_POST['inventory'];
        $name = $_POST['name'];
        $image_path = $_POST['image_path'];
        $spec_sheet_path = $_POST['spec_sheet_path'];
        $category = (int) $_POST['category'];
        if (isset($_POST['optional_attributes']))
        {
            $optional_attributes = 1;
        }
        else
        {
            $optional_attributes = 0;
        }
        $product = \App\Product::create(['sku'=>$sku,'inventory'=>$inventory, 'name' => $name, 'image_path'=>$image_path, 'spec_sheet_path'=>$spec_sheet_path, 'category_id' => $category]);
        return redirect('/home')->with('success', "You've saved the product!");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['product'] = \App\Product::find($id);
        return view('/products/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=null)
    {
        $inventory = $_POST['inventory'];
        $sku = $_POST['sku'];
        $update = DB::table('products')->where('sku','=',$sku)->update(['inventory' =>$inventory]);
        if ($update)
        {
            return redirect('/products')->with('success', "$sku updated successfully!");
        }
        else
        {
            echo 'problem';
        }

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
