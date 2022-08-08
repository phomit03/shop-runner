<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $_GRID_URL = "/admin/customer/list";

    public function list(Request $request){
        $paramName = $request->get("nameCustomer");

        $customer = Customer::CustomerSearch($paramName)->simplePaginate(6);
        return view("admin.pages.customer.customerList",[
            "customer"=>$customer
        ]);
    }

    public function form(){
        return view("admin.pages.customer.customerCreate");
    }

    public function create(Request $request, Customer $customer){
        $request->validate([
            'idCustomer'=>'integer|unique:customer',
            'nameCustomer'=>'required|string',
            'phoneCustomer'=>'required|string',
            'emailCustomer'=>'required|string',
            'addressCustomer'=>'required|string'
        ],[
           'required'=>"Vui lòng nhập thông tin"
        ]);
        Customer::create(
            [
                "nameCustomer"=>$request->get("nameCustomer"),
                "phoneCustomer"=>$request->get("phoneCustomer"),
                "emailCustomer"=>$request->get("emailCustomer"),
                "addressCustomer"=>$request->get("addressCustomer")
            ]
        );
        return redirect()->to($this->_GRID_URL)->with("success","Create Customer success");
    }

    public function edit($idCustomer){
        $customer = Customer::find($idCustomer);

        return view("admin.pages.customer.customerEdit",[
           'customer'=>$customer
        ]);
    }

    public function update(Request $request,Customer $customer){
        $customer->update([
            "nameCustomer"=>$request->get("nameCustomer"),
            "phoneCustomer"=>$request->get("phoneCustomer"),
            "emailCustomer"=>$request->get("emailCustomer"),
            "addressCustomer"=>$request->get("addressCustomer")
        ]);
        return redirect()->to($this->_GRID_URL)->with("success","Update Customer success");
    }

    public function delete(Customer $customer){
        try {
            $customer->delete();
            return redirect()->to($this->_GRID_URL)->with("success","Delete customer success");
        }catch (\Exception $exception){
            return redirect()->to($this->_GRID_URL)->with("error","Delete fail");
        }
    }
}
