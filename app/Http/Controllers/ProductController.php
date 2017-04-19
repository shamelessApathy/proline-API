<?php

namespace App\Http\Controllers;
//use Auth;
use DB;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
    *
    * Construct Function
    * Passes all requests for this controller through Auth middleware to make sure user is logged in
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
    * Search Products Function
    * @param search query and type of search
    * @return list of products matching query
    */
    public function search()
    {
        echo "we're here!<br>";
        var_dump($_POST);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Product::all();
        return view('products.index')->with('products', $all);
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
        $data['product'] = Product::find($id);
        return view('products.show', $data);
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

    public function AmazonProductInfo($asin){
        echo $asin;
         $amz = new \AmazonProductInfo("PROLINE"); //store name matches the array key in the config file
         echo "<pre>"; print_r($amz); echo "</pre>";
        $list_amz = $amz->setASINs('B06VWHX2H7');
        
         // $list_amz = $amz->fetchCompetitivePricing();
        echo "string";
        echo "<pre>"; print_r($list_amz); echo "</pre>";

        die();
        $data = Product::where('asin', $asin)->first();
        return view('products.show', ['product'=>$data]);
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
