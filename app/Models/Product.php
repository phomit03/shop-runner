<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'idProduct';
    protected $keyType = 'integer';
    protected $fillable = [
        'nameProduct',
        'priceProduct',
        'contentProduct',
        'discountProduct',
        'imageProduct',
        'imageList',
        'price_total',
        'idCatalog',
        'created_at',
        'updated_at'
    ];

    public function getCatalog() {
        return $this->belongsTo(Catalog::class, "idCatalog","idCatalog");
    }

    //search sẽ xử lí việc lọc, nếu phải lọc nhiều cái
    public function scopeSearchName($query, $search=''){  //name giá trị mặc định ban đầu
        if ($search != null && $search != ''){
            return $query-> where("nameProduct","like",'%'.$search."%");
        }
        return $query;
    }

    public function scopeFilterCatalog($query,$idCatalog=''){
        if($idCatalog != null && $idCatalog != '') {
            return $query->where("idCatalog",$idCatalog);
        }
        return $query;
    }

    public function imgProduct() {
        if ($this->imageProduct) {
            return $this->imageProduct;
        }
        return 'uploads/product-default.png';
    }

    public function imgList() {
        if ($this->imageList) {
            return $this->imageList;
        }
        return 'uploads/listimg_default.png';
    }

    public function percentDisplay(){
        if (!($this->discountProduct == 0)){
            return $this->discountProduct . " %";
        }
    }

}
