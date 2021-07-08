<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

// import models
use App\Models\Product;

use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
    // get all product
    public function getProduct(){
        $product = Product::all();
        return response()->json($product);
    }

    // get each product
    public function getDetail($id){
        $productDetail = Product::find($id);
        return response()->json($productDetail);
    }

    // post a product
    public function postProduct(Request $req){
        // create validation
        $validator = Validator::make($req->all(),[
            'title'=>['required', 'string', 'max:75'],
            'type'=>['required', 'string'],
            'condition'=>['required', 'string'],
            'price'=>['required', 'string'],
            'description'=>['required', 'string'],
            'image'=>['required', 'string']
        ]);

        if($validator->fails()){
            return $this->responseError('Create Product Failed', 422, $validator->errors());
        }

        $product = new Product;
        $product->title = $req->title;
        $product->type = $req->type;
        $product->condition = $req->condition;
        $product->price = $req->price;
        $product->description = $req->description;
        $product->image = $req->image;

        $product->save();
        return response()->json([
            'message'=> 'Product addedd successfully',
            "title"=>$product->title,
            'type'=>$product->type,
            'condition'=>$product->condition,
            'price'=>$product->price,
            'description'=>$product->description,
            'image'=>$product->image
        ]);
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        $result = $product->delete();
        if($result){
            return $this->responseOk('Product has been deleted');
        }
        else{
             return $this->responseError('Delete Product Failed', 422);
        }
    }

    public function updateProduct(Request $req, $id){
        $validator = Validator::make($req->all(),[
            'title'=>['required', 'string', 'max:75'],
            'type'=>['required', 'string'],
            'condition'=>['required', 'string'],
            'price'=>['required', 'string'],
            'description'=>['required', 'string'],
            'image'=>['required', 'string']
        ]);

        if($validator->fails()){
            return $this->responseError('Update product failed', 422, $validator->errors());
        }

        $product = Product::find($req->id);
        $product->title = $req->title;
        $product->type = $req->type;
        $product->condition = $req->condition;
        $product->price = $req->price;
        $product->description = $req->description;
        $product->image = $req->image;

        $result = $product->save();
        if($result){
            $response = [
                'message' => 'Product updated successfully',
                'id' => $product->id,
                'title' => $product->title,
                'type' => $product->type,
                'condition' => $product->condition,
                'price' => $product->price,
                'description' => $product->description,
                'image' => $product->image
            ];

            return $this->responseOk($response);
        }
        else{
            return $this->responseError('Update product failed');
        }

    }
}
