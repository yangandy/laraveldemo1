<?php




namespace App\Http\Controllers;

use App\Product;
use App\Service\ProductService;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

//    public function __construct(ProductService $productService)
//    {
//        $this->product = $productService;
//    }

    public function index(){
        $products = Product::where('shanchu',NULL)->get();
        return view('admin.product.products',['products' => $products]);
    }

    public function destroy($id){
        $product = Product::where('id',$id)->first();
        $product->shanchu = 1;
        $product->save();
        return redirect('/admin/product/products');
    }

    public function newProduct(){
        return view('admin.product.new');
    }


    public function add(Request $request)
    {

//        $this->product->add($request);
        $name = $request->input('name');
        $file = $request->file('file');



       // dd($path);
        $extension = $file->getClientOriginalExtension();
        $newFileName= $file->getFilename().'.'.$extension;




       // dd($savePath);
        $entry = new \App\File();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getFilename().'.'.$extension;
        $entry->save();
        //dd($entry);


        $product  = new Product();
        $product->file_id=$entry->id;

        $product->name =$request->input('name');
        $product->description =$request->input('description');
        $product->price =$request->input('price');
        $product->num = $request->input('num');
        $product->status = $request->input('status');
        $product->imageurl =$entry->filename;
        $product->save();
        $filename = $product->id;
        $savePath = "public/$filename/".$newFileName;
        //dd($savePath);
        // Storage::disk('uploads')->put($file->getFilename().'.'.$extension,  File::get($file));

        $bytes = Storage::put(
            $savePath,
            file_get_contents($file->getRealPath())
        );


        if($bytes) {
            return redirect('/admin/product/products');
        }
        else{
            Product::destroy($filename);
            return redirect('/admin/product/products');

        }
    }
    public  function  update(Request $request,$id){
        $product = Product::where('id',$id)->first();

        if ($request->isMethod('POST')) {

            $data =$request->input('product');
            $product->name = $request->input('name');

            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->num = $request->input('num');

            $product->status = $request->input('status');
            $product->imageurl = $request->input('imageurl');
//            dd($product);
//            exit;
            if ($product->save()) {
                return redirect('/admin/product/products');
            }
        }


        return view('admin.product.update', ['product' => $product
        ]);

    }
    public function  detail($id){

    }

}
