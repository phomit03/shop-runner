<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $_GRID_URL = "admin/transactions/list";

    public function list(Request $request){
        $paramCustomer = $request->get("idCustomer");
        $paramStatus = $request->get("statusTransaction");
        $amount = $request->get("amount");

        $transaction = Transaction::FilterCustomer($paramCustomer)->with("getCustomer")
            ->FilterStatus($paramStatus)
            ->simplePaginate(6);

        $customerList = Customer::all();

        return view("admin.pages.transactions.transactionList",[
            "transaction"=>$transaction,
            "customerList"=>$customerList,
        ]);
    }

    public function form() {
        $customerList = Customer::all();
        return view("admin.pages.transactions.transactionCreate",[
            'customerList'=>$customerList,
        ]);
    }

    public function create(Request $request){
        $request->validate([
            'idTransaction'=>'integer|unique:order',
            'idCustomer'=>'required',
            'payment'=>'required',
        ],[
            'required'=>"Vui lòng nhập thông tin",
        ]);

        $invoice = (isset($request->invoice)) ? 1 : 0;

        Transaction::create([
            "idCustomer"=>$request->get("idCustomer"),
            "payment"=>$request->get("payment"),
            "note"=>$request->get("note"),
            "invoice"=>$invoice,
        ]);

        return redirect()->to($this->_GRID_URL)->with("success","Update product successfully");
    }

    //Edit
    public function edit($id) {
        $customerList = Customer::all();
        $transaction = Transaction::find($id);
        return view('admin.pages.transactions.transactionEdit',[
            'transaction' =>$transaction,
            'customerList' => $customerList
        ]);
    }

    //update

    public function update(Request $request, Transaction $transaction) {
        $invoice = (isset($request->invoice)) ? 1 : 0;

        $transaction->update([
            "idCustomer"=>$request->get("idCustomer"),
            "payment"=>$request->get("payment"),
            "note"=>$request->get("note"),
            "invoice"=>$invoice,
            "statusTransaction"=>$request->get("statusTransaction"),
        ]);
        return redirect()->to($this->_GRID_URL)->with("success","Update transaction successfully");
    }

    //delete
    public function delete(Transaction $transaction) {
        try {
            $transaction->delete();
            return redirect()->to($this->_GRID_URL)->with("success", "Delete transaction successfully");
        }catch (\Exception $e){
            return redirect()->to($this->_GRID_URL)->with("error", "Delete Failed");
        }
    }

}
