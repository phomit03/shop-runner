<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $_GRID_URL = "admin/order/list";

    public function list(Request $request){
        $paramProduct = $request->get("nameProduct");
        $paramTransaction = $request->get("idTransaction");
        $paramStatus = $request->get("statusOrder");
        $order = Order::FilterProduct($paramProduct)->with("getProduct")
            ->FilterTransaction($paramTransaction)->with("getTransaction")
            ->FilterStatus($paramStatus)
            ->simplePaginate(6);

        $productsList = Product::all();
        $transactionList = Transaction::all();
        return view("admin.pages.order.orderList",[
            'order' => $order,
            'productsList'=>$productsList,
            'transactionList'=>$transactionList
        ]);
    }

    public function form() {
        $productsList = Product::all();
        $transactionList = Transaction::all();
        return view("admin.pages.order.orderCreate",[
            'productsList'=>$productsList,
            'transactionList'=>$transactionList
        ]);
    }

    /*status ->add: khong can o select, mac dinh 1.
     edit: co o select, duoc phep sua
    quantity = 0 -> check required
    viet mot ham neu status 1 (true) thi tra ve list chu: "tao don thanh cong", nguoc lai 0 -> "that bai" */

    public function create(Request $request){
        $request->validate([
            'idOrder'=>'integer|unique:order',
            'idProduct'=>'required',
            'quantity'=>'required|integer',
            'idTransaction'=>'required',
        ],[
            'required'=>"Vui lòng nhập thông tin",
        ]);

        Order::create([
            "idProduct"=>$request->get("idProduct"),
            "quantity"=>$request->get("quantity"),
            "idTransaction"=>$request->get("idTransaction"),
            //"statusOrder"=>$request->get("statusOrder"),
        ]);
//        dd("done");
        return redirect()->to($this->_GRID_URL)->with("success","Update order successfully");
    }

    //Edit

    public function edit($id) {
        $productsList = Product::all();
        $transactionList = Transaction::all();
        $order = Order::find($id);
        return view('admin.pages.order.orderEdit',[
            'order' => $order,
            'productsList' => $productsList,
            'transactionList'=>$transactionList
        ]);
    }

    //update
    public function update(Request $request, Order $order) {
        $order->update([
            "idProduct"=>$request->get("idProduct"),
            "quantity"=>$request->get("quantity"),
            "idTransaction"=>$request->get("idTransaction"),
            "statusOrder"=>$request->get("statusOrder"),
        ]);

        return redirect()->to($this->_GRID_URL)->with("success","Update order successfully");
    }

    //delete
    public function delete(Order $order) {
        try {
            $order->delete();
            return redirect()->to($this->_GRID_URL)->with("success", "Delete order successfully");
        }catch (\Exception $e){
            return redirect()->to($this->_GRID_URL)->with("error", "Delete Failed");
        }
    }
}

