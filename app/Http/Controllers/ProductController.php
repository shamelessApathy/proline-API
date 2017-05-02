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
        // $query = $_POST['query'] ?? null;
        // $type = $_POST['type'] ?? null;
        // $factory = $_POST['factory'] ?? null;
        // checking if the factory is set, if so, form query based on factory
        if (!empty($factory) && !empty($query) && !empty($type))
        {
            $results = Product::where('factory', $factory)->where($type, 'like', "%$query%")->get();
        }
        else if ($factory !== null)
        {
            $results = Product::where('factory', $factory)->get();
        }
        else
        {
            $results = Product::where("$type",'like', "%$query%")->get();
        }

        return view('products.index')->with('products',$results);
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
       
        $amz->setASINs('B06VWHX2H7');
        $amz->FetchCategories();
        $amz->FetchMyPrice();
          echo "<pre>"; print_r($amz); echo "</pre>";

         $obj = new \AmazonProductList("PROLINE"); //store name matches the array key in the config file
         $obj->setIdType('ASIN');
        $obj->setProductIds('B06VWHX2H7'); //tells the object to automatically use tokens right away
        $obj->fetchProductList();
        $obj->GetProduct(); //this is what actually sends the request
        
        
         // $list_amz = $amz->fetchCompetitivePricing();
        echo "string";
        echo "<pre>"; print_r($obj); echo "</pre>";

        die();
        $data = Product::where('asin', $asin)->first();
        return view('products.show', ['product'=>$data]);
    }
    public function AmazonProductList($asin){
        echo $asin;
        $amz = new \AmazonProductList("PROLINE");
        $amz->setIdType('ASIN');
        $amz->setProductIds($asin);
        $amz->fetchProductList();
        $amz->getProduct();
        $data = $amz->getData();
        //echo "string";
        //echo "<pre>"; print_r($amz); echo "</pre>";

       // die();

        return view('products.show', ['product'=>$amz, 'data'=> $data]);
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

    public function GetProductServiceStatus(Request $request){
        $amz = new \AmazonServiceStatus("PROLINE"); //store name matches the array key in the 
        $amz->setService('Products');
        $amz->fetchServiceStatus(); 
        $list_amz = $amz->getStatus();  
        // Extracting Orders item sku  //
        // $list;
        $status =  $list_amz;
        $response="";
        $list="";
        $message="";
        $url="";
        if(!empty($status)){
            $message="Status : ".$status;
        }
        //return $amz->getList();
        // echo "<pre>"; print_r($list);
        // die();
        //$this->ExportOrders($request); 
        return view('products.amazon-products', ['message'=>$message,'response' => $response, 'list'=>$list]); 
    }

    public function GetMyPriceForSKU(Request $request){
        $amz = new \AmazonProductInfo("PROLINE"); //store name matches the array key in the config file
        $amz->setASINs('B06VWGWZ6N');
        $amz->fetchCategories();
          echo "<pre>"; print_r($amz); echo "</pre>"; die();
        $response="";
        $list="";
        $message="";
        $url="";
        if(!empty($status)){
            $message="Status : ".$status;
        }
        //return $amz->getList();
        // echo "<pre>"; print_r($list);
        // die();
        //$this->ExportOrders($request); 
        return view('products.amazon-products', ['message'=>$message,'response' => $response, 'list'=>$list]); 
    }
}
