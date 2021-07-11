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
       
                $btn = ' <button class="btn btn-info open-modal edit" data-id="'.$row->id.'" >Edit
                            </button>';
                // dd($btn);
                $btn .= ' <button class="btn btn-danger delete-link delete" data-id="'.$row->id.'" >Delete
                            </button>';
         
                    return $btn;
                })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    

    public function getProduct(){

        return view('Product', ['products'=>session('products')]);
    }

    

    // post a product
    public function postProduct(Request $req){

        
        // create validation
        $validator = Validator::make($req->all(),[
            'title'=>['required', 'string', 'max:75'],
            'price'=>['required', 'string'],
            'description'=>['required', 'string'],
            // 'image'=>['required', 'string']
            'image'=>'required|image|max:2048'
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


        $image = $req->file('image');
        
        $destinationPath = 'public';
        $name = time().'_'.$image->getClientOriginalName();
        // dd($name);
        $path = $image->storeAs($destinationPath, $name);
        

     
        $product = new Product;
        $product->title = $req->title;
        $product->price = $req->price;
        $product->description = $req->description;
        $product->image = $name;

        $product->save();
        return response()->json([
            'message'=> 'Product added successfully',
            "title"=>$product->title,
            'price'=>$product->price,
            'description'=>$product->description,
            'status'=>"success",
            'image'=>$product->image
        ]);
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        $result = $product->delete();
        if($result){
            return response()->json([
            'message' => 'Product deleted successfully',
                // 'id' => $product->id,
                // 'title' => $product->title,
                // 'price' => $product->price,
                // 'description' => $product->description,
                'status'=> 'success',

            ]);
        }
        
    }


    public function updateProductServerSide($id){
        if(request()->ajax()){
            $asdnaskjdn = Product::find($id);
            return response()->json($asdnaskjdn);
        }
    }

    public function updateProduct(Request $req){

        $validator = Validator::make($req->all(),[
            'title'=>['required', 'string', 'max:75'],
            'price'=>['required', 'string'],
            'description'=>['required', 'string'],
            
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
            // return $this->responseError('Update product failed', 422, $validator->errors());
        }


        $image = $req->file('image');


        
        // dd($cekExt);
        

        if($image != null){

        $cekExt = $image->getClientOriginalExtension();
        // dd($cekExt);
        // dd($cekExt);


        if($cekExt != "png" && $cekExt != "jpg" && $cekExt != "jpeg" && $cekExt != "svg" ){
            return response()->json([
            'message'=> "Image is not an image",
            'status'=>"error"
        ]);    
        }

            $destinationPath = 'public';
            $name = time().'_'.$image->getClientOriginalName();
        // dd($name);
            $path = $image->storeAs($destinationPath, $name);
        }
        
        

        $product = Product::find($req->hidden_id);
        $product->title = $req->title;
        $product->price = $req->price;
        $product->description = $req->description;
        if($image != null){
        $product->image = $name;
        }


        $product->save();
        return response()->json([
                'message' => 'Product updated successfully',
                'id' => $product->id,
                'title' => $product->title,
                'price' => $product->price,
                'description' => $product->description,
                'status'=> 'success',
                'image' => $product->image
            ]);

    }
}
