<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query =  Product::query();
        $products = $query->paginate(5);
        $baskets = Basket::query();
        $user = $request->user();
        return view('product', compact('products', 'baskets', 'user'));
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
//    public function basketStore(int $id, Product $product )
//    {
//        $product->
//        return back()->with('info', 'Le film a bien été mis dans la corbeille.');
//    }

    /**
     * Display the specified resource.
     */
    public function show(int $productId) : View
    {
        $product = Product::where('id', '=', $productId)->get()->first();
        return view('show', compact('product'));
    }


    public function showBasket(Request $basketProduct) : View
    {
        $query =  Product::query();
        $products = $query->paginate(5);
        $user = $basketProduct->user();
        $Basketproducts = Basket::where('user_id', '=', $user->id)->get();
        return view('basket', compact('Basketproducts', 'user', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
