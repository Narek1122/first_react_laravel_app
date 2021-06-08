<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Http\Requests\AddProductReq;
use App\Models\User;

class ProductController extends Controller
{
    public function getAllProducts(){
        $n = Product::get();
        return response()->json([
            'status' => '200',
            'data' => $n
        ]);
    }

    public function addProduct(AddProductReq $request){
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        Product::create($validated);
       return response()->json([
           'status' => 200
       ]);
    }

    public function getMyProducts(){
        $prod = Auth::user();
        return response()->json([
            'status' => 200,
            'data' => $prod->products
        ]);
    }

    public function deleteMyProducts($id){
        $prod = Auth::user();
        $prod->products->find($id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }
}
