<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Language;
use App\Models\Region;
use Illuminate\Support\Facades\App;

class ProductController extends Controller
{
    /**
     * @param $title, $language, $region
     * @return View
     */
    public function show($title, $language, $region)
    {
        $product = Product::whereHas('languageProduct', function($query) use ($title) {
            return $query->where('title', $title);
        })->with('productRegion')->first();
        
        if($product == null) {
            return abort(404);
        }

        $data = $this->setProductDetails($product, $language, $region);
       
        return view('products.show', compact('data'));
    }

    /**
     * @param Product Model, Language, Region
     * @return array $product
     */
    protected function setProductDetails($product, $language, $region)
    {
        // Language
        $selectedLanguage = Language::where('title', $language)->first();

        if($selectedLanguage == null) {
            return abort(404);
        }

        $languageRow = $product->languageProduct()->where('language_id', $selectedLanguage->id)->first();
        
        // Region 
        $selectedRegion = Region::where('title', $region)->first();    
        
        if($selectedRegion == null) {
            return abort(404);
        }
        
        $regionRow = $product->productRegion()->where('region_id', $selectedRegion->id)->first();

        $data['product'] = $product;
        $data['product']['productTitle'] = $languageRow->title;
        $data['product']['price'] = $regionRow->price;
        $data['product']['quantity'] = $regionRow->quantity;
        $data['product']['currency'] = $regionRow->currency;

        // Set/Update session details
        session(['locale' => $language, 'region' => $region]);
        
        return $data;
    }
}
