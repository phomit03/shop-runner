<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    private $_GRID_URL = "admin/catalogs/list";

    public function list(Request $request){
        $paramName = $request->get("nameCatalog");

        $catalog = Catalog::CatalogSearch($paramName)->simplePaginate(6);

        return view("admin.pages.catalogs.catalogList",[
           "catalog"=>$catalog
        ]);
    }

    public function form(){
        return view("admin.pages.catalogs.catalogCreate");
    }

    public function create(Request $request,Catalog $catalog){
        $request->validate([
            'idCatalog'=>'integer|unique:catalog',
            'nameCatalog'=>'required|string',
        ],[
           'required'=>"Vui lòng nhập thông tin"
        ]);
        Catalog::create(
            [
                "nameCatalog"=>$request->get("nameCatalog"),
                "idAdvanced"=>$request->get("idAdvanced")
            ]
        );
        return redirect()->to($this->_GRID_URL)->with("success","Create Catalog success");
    }
    public function edit($idCatalog){
        $catalog = Catalog::find($idCatalog);

        return view("admin.pages.catalogs.catalogEdit",[
            'catalog'=>$catalog
        ]);
    }

    public function update(Request $request,Catalog $catalog){
        $catalog->update([
            "nameCatalog"=>$request->get("nameCatalog"),
            "idAdvanced"=>$request->get("idAdvanced")
        ]);
        return redirect()->to($this->_GRID_URL)->with("success","Update Catalog success");
    }

    public function delete(Catalog $catalog){
        try {
            $catalog->delete();
            return redirect()->to($this->_GRID_URL)->with("success","Delete catalog success");
        }catch (\Exception $exception){
            return redirect()->to($this->_GRID_URL)->with("error","Delete fail");
        }
    }
}
