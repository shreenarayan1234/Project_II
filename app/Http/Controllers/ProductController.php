<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view('products.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        // $validatedData = $request->validate([
        //     'product_name' => 'required|string|max:255',
        //     'brand' => 'required|string|max:255',
        //     'alert_stock' => 'required|integer|min:0',
        //     'price' => 'required|numeric|min:0',
        //     'quantity' => 'required|integer|min:0',
        //     'description' => 'required|string|max:255'
        // ]);
    
        // Create a new product
        $product = new Product;
        $product->product_name = $request['product_name'];
        $product->brand = $request['brand'];
        $product->alert_stock = $request['alert_stock'];
        $product->price = $request['price'];
        $product->quantity = $request['quantity'];
        $product->description = $request['description'];
        $product->save();
    
        // Redirect back with a success message
        if ($product) {
            return redirect()->back()->with('success', 'Product Created Successfully');
        } else {
            return redirect()->back()->with('error', 'Product failed to be created');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->back()->with('success','Product Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success','Product Deleted Successfully!');
    }
}
