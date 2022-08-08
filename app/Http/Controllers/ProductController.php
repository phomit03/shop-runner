<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    private $_GRID_URL = "admin/products/list";

    public function list(Request $request){
        $paramSearch = $request->get("nameProduct");
        $paramCatalog = $request->get("idCatalog");
        $product = Product::SearchName($paramSearch)
            ->FilterCatalog($paramCatalog)->with("getCatalog")
            ->simplePaginate(6);

        $catalogList = Catalog::all();

        return view("admin.pages.products.productsList",[
            "product" => $product,
            "catalogList"=>$catalogList
        ]);
    }

    public function form() {
        $catalogList = Catalog::all();
        return view("admin.pages.products.productsCreate",[
            'catalogList' =>$catalogList
        ]);
    }

    public function create(Request $request){
        $request->validate([
            'idProduct'=>'integer|unique:product',
            'nameProduct'=>'required|string',
            'priceProduct'=>'required|integer',
        ],[
            'required'=>"Vui lòng nhập thông tin",
        ]);

        $imageProduct = null;
        if ($request->hasFile("imageProduct")){
            $file = $request->file("imageProduct");
            $path = "uploads/";
            $fileName = time().rand(0,9).$file->getClientOriginalName();
            $file->move($path,$fileName);
            $imageProduct = $path.$fileName;
        }

        $imageList = null;
        if ($request->hasFile("imageList")){
            $file = $request->file("imageList");
            $path = "uploads/";
            $fileName = time().rand(0,9).$file->getClientOriginalName();
            $file->move($path,$fileName);
            $imageList = $path.$fileName;
        }

        $price_total =  $request->get('discountProduct')  ==  0 ?
            $request->get('priceProduct')
            :
            $request->get('priceProduct') - ( $request->get('priceProduct') * ($request->get('discountProduct')/100) );

        Product::create([
            "nameProduct"=>$request->get("nameProduct"),
            "priceProduct"=>$request->get("priceProduct"),
            "contentProduct"=>$request->get("contentProduct"),
            "discountProduct"=>$request->get("discountProduct"),
            "price_total"=>$price_total,
            "imageProduct"=>$imageProduct,
            "imageList"=>$imageList,
            "idCatalog"=>$request->get("idCatalog"),
        ]);
//        dd("done");
        return redirect()->to($this->_GRID_URL)->with("success","Update product successfully");
    }

    //Edit

    public function edit($id) {
        $catalogList = Catalog::all();
        $product = Product::find($id);
        return view('admin.pages.products.productsEdit',[
            'product' => $product,
            'catalogList' => $catalogList
        ]);
    }

    //update
    public function update(Request $request, Product $product) {
        $imageProduct = $product->imageProduct;
        if ($request->hasFile('imageProduct')){
            $file = $request->file('imageProduct');
            $path = "uploads/";
            $fileName = time().rand(0,9).$file->getClientOriginalName();    //tránh upload 2 ảnh cùng tên
            $file->move($path,$fileName);
            $imageProduct = $path.$fileName;   //link file
        }

        $imageList = $product->imageList;
        if ($request->hasFile('imageList')){
            $file = $request->file('imageList');
            $path = "uploads/";
            $fileName = time().rand(0,9).$file->getClientOriginalName();    //tránh upload 2 ảnh cùng tên
            $file->move($path,$fileName);
            $imageList = $path.$fileName;   //link file
        }

        $price_total =  $request->get('discountProduct')  ==  0 ?
            $request->get('priceProduct')
            :
            $request->get('priceProduct') - ( $request->get('priceProduct') * ($request->get('discountProduct')/100) );

        $product->update([
            "nameProduct"=>$request->get("nameProduct"),
            "priceProduct"=>$request->get("priceProduct"),
            "contentProduct"=>$request->get("contentProduct"),
            "discountProduct"=>$request->get("discountProduct"),
            "price_total"=>$price_total,
            "imageProduct"=>$imageProduct,
            "imageList"=>$imageList,
            "idCatalog"=>$request->get("idCatalog"),
        ]);
//        dd($product);

        return redirect()->to($this->_GRID_URL)->with("success","Update product successfully");
    }

    //delete
    public function delete(Product $product) {
        try {
            $product->delete();
            return redirect()->to($this->_GRID_URL)->with("success", "Delete product successfully");
        }catch (\Exception $e){
            return redirect()->to($this->_GRID_URL)->with("error", "Delete Failed");
        }
    }
}
