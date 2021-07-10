<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

use DataTables;

// import models
use App\Models\Product;

use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
    // get all product
    public function getProductServerSide(){
        // $product = Product::all();
        // return response()->json($product);

        // $product = Product::all();
        $result = Product::select('*');

        return Datatables::of($result)
                ->addIndexColumn()
                ->addColumn('action', function($row){
       
                $btn = ' <button class="btn btn-info open-modal" value="'.$row->id.'">Edit
                            </button>';
                $btn = $btn. ' <button class="btn btn-danger delete-link" value="'.$row->id.'">Delete
                            </button>';
         
                    return $btn;
                })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    

    public function getProduct(){

        // $http = new \GuzzleHttp\Client();
        
        // $response = $http->get(env('API_URL').'api/product');
        // // $response = $http->request('GET', 'http://127.0.0.1:8000/api/product');
        // $result = json_decode((string)$response->getBody(), true);
        // // dd($result);
        // // return $result;
        // session()->put([
        //     'products' => $result

        // ]);

        return view('hehe', ['products'=>session('products')]);
    }

    // get each product
    public function getDetail($id){
        $productDetail = Product::find($id);
        return response()->json($productDetail);
    }



    // post image in jpg or png
     public function addProduct(Request $req){
        $rules = array(
            'title' => ['required', 'string', 'max:75'],
            'price' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => 'required|image|max: 2048'
        );


        $error = Validator::make($req->all(), $rules);
        if($error->fails()){
            return response()->json(['errors'=> $error->errors()->all()]);
        }
        else{

            if($req->file('image')->isValid()){

        $image = $req->file('image');
        $destinationPath = 'public';
        $name = time().'_'.$image->getClientOriginalName();
        $path = $image->storeAs($destinationPath, $name);
        }
        
        // $http = new \GuzzleHttp\Client();
        // // fetch data for api
        $title = $req->title;
        $price = $req->price;
        $description = $req->description;

        // $response = $http->post(env('API_URL').'api/post/product?',[
        //     'query' => [
        //         'title' => $title,
        //         'description' => $description,
        //         'price' => $price,
        //         'image' => $path
        //     ]

        // ]);

        // $result = json_decode((string)$response->getBody(), true);

        return response()->json(['success' => "product has been stored"]);
        }
    }

    // post a product
    public function postProduct(Request $req){
        // create validation
        $validator = Validator::make($req->all(),[
            'title'=>['required', 'string', 'max:75'],
            'price'=>['required', 'string'],
            'description'=>['required', 'string'],
            // 'image'=>['required', 'string']
        ]);

        if($validator->fails()){

            return response()->json([
            'message'=> $validator->errors(),
            // "title"=>$product->title,
            // 'price'=>$product->price,
            // 'description'=>$product->description,
            'status'=>"error"
            // 'image'=>$product->image
        ]);
            // return $this->responseError('Create Product Failed', 422, $validator->errors());
        }

        // dd($req->title);

        $product = new Product;
        $product->title = $req->title;
        $product->price = $req->price;
        $product->description = $req->description;
        // $product->image = $req->image;

        $product->save();
        return response()->json([
            'message'=> 'Product addedd successfully',
            "title"=>$product->title,
            'price'=>$product->price,
            'description'=>$product->description,
            'status'=>"success"
            // 'image'=>$product->image
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
            'price'=>['required', 'string'],
            'description'=>['required', 'string'],
            'image'=>['required', 'string']
        ]);

        if($validator->fails()){
            return $this->responseError('Update product failed', 422, $validator->errors());
        }

        $product = Product::find($req->id);
        $product->title = $req->title;
        $product->price = $req->price;
        $product->description = $req->description;
        $product->image = $req->image;

        $result = $product->save();
        if($result){
            $response = [
                'message' => 'Product updated successfully',
                'id' => $product->id,
                'title' => $product->title,
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
