<?php

namespace App;

use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'type',
        'minimum_quantity',
        'maximum_quantity'
    ];

    public function productsCompaniesRelation()
    {
        return $this->belongsToMany(Company::class,'products_companies','products_id','company_id')->withPivot('products_id','company_id');
    }

    public function productOutputRelation()
    {
        return $this->hasMany(ProductOutput::class,'product_id_output','id');
    }

    public function productEntryRelation()
    {
        return $this->hasMany(ProductEntry::class,'product_id_entry','id');
    }

    public function productStockRelation()
    {
        return $this->hasOne(ProductStock::class,'product_id_stock','id');
    }

    public function getStockInformationProduct($id)
    {
        $product = $this->find($id);

        $productInformation = new \stdClass();

        $productInformation->output = $product->productOutputRelation()->first()->quantity;
        $productInformation->date_departure = $product->productOutputRelation()->first()->created_at;
        $productInformation->entry = $product->productEntryRelation()->first()->quantity;
        $productInformation->entry_date = $product->productEntryRelation()->first()->created_at;
        $productInformation->stock = $product->productStockRelation()->first()->quantity_current;
        $productInformation->entry_stock_date = $product->productStockRelation()->first()->updated_at;

        return $productInformation;
    }

    public function getStockInformationAll()
    {
        $productStock = ProductStock::all();

        $productHasStock = [];

        foreach ($productStock as $stock){
            $products = $this->find($stock->product_id_stock);

            $productHasStock[] = [
                'id' => $stock->productRelation()->first()->id,
                'nameProduct' => $stock->productRelation()->first()->name,
                'type' => $stock->productRelation()->first()->type,
                'minimum_quantity' => $stock->productRelation()->first()->minimum_quantity,
                'current_quantity' => $stock->quantity_current,
                'last_entry' => ($products->productEntryRelation()->first() != null || $products->productEntryRelation()->first() != "" ? date('d/m/Y H:i:s',strtotime($products->productEntryRelation()->first()->updated_at)) : null),
                'last_output' => ($products->productOutputRelation()->first() != null || $products->productOutputRelation()->first() != "" ? date('d/m/Y H:i:s',strtotime($products->productOutputRelation()->first()->created_at)) : null),

                ];
        }
        return $productHasStock;
    }

    public function getCompaniesAviable($idProduct)
    {
        $product = $this->find($idProduct);

        $companiesProduct = $product->productsCompaniesRelation()->get();

        $companies = Company::all();

        $companiesAviable = null;
        $companiesNotAviable = new ArrayCollection([]);
        foreach ($companiesProduct as $productCompany){
            $companiesNotAviable->add($productCompany->pivot->company_id);
        }

        foreach ($companies as $company){
            if(!$companiesNotAviable->contains($company->id)){
                $companiesAviable[] = new ArrayCollection(['id' => $company->id, 'name' => $company->fantasy_name]);
            }
        }

        return $companiesAviable;
    }

    public function setMinimumQuantityAttribute($value)
    {
        $this->attributes['minimum_quantity'] = floatval(converStringToDouble($value));
    }

    public function setMaximumQuantityAttribute($value)
    {
        $this->attributes['maximum_quantity'] = floatval(converStringToDouble($value));
    }
}
