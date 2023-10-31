<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $response = new Controller;
    }
    public function index()
    {
        $data = ProductColor::with('product')
            ->with('product.subCategory')
            ->with('product.subCategory.category')
            ->with('color')
            ->sortByAscending('products.product_name')
            ->get();
        return $this->response($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'image' => $request['image'],
            'product_name' => $request['product_name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'sub_category_id' => $request['sub_category_id']
        ]);

        $data = ProductColor::create([
            'product_id' => $product->id,
            'color_id' => $request['color_id']
        ]);

        return $this->response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ProductColor::with('product')->with('product.subCategory')
            ->with('product.subCategory.category')->with('color')
            ->where('product_id', $id)->first();
        return $this->response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $product->image = $request['image'];
        $product->product_name = $request['product_name'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        $product->sub_category_id = $request['sub_category_id'];

        $product_color = ProductColor::where('product_id', $id)->first();
        $product_color->color_id = $request['color_id'];

        $product->save();
        $product_color->save();

        return $this->response($product_color);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        ProductColor::where('product_id', $product->id)->delete();

        return $this->response(0);
    }
}
