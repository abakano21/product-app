<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    /** 
     * @return Model LanguageProduct title
     */
    public function languageProduct()
    {
        return $this->hasMany(LanguageProduct::class);
    }

    /** 
     * @return Model LanguageRegion price, currency, quantity
     */
    public function productRegion()
    {
        return $this->hasMany(ProductRegion::class);
    }
    
    /** 
     * @return Route Product's full path
     */
    public function path($language = null, $region = null)
    {
        if($language == null) {
            $language = 'en';
        }

        if($region == null) {
            $region = 'ae';
        }

        $selectedLanguage = Language::where('title', $language)->first();
        $selectedRegion = Region::where('title', $region)->first();
        if($selectedLanguage == null) {
            return abort(404);
        }
        
        if($selectedRegion == null) {
            return abort(404);
        }
        $languageRow = $this->languageProduct()->where('language_id', $selectedLanguage->id)->first();
        $regionRow = $this->productRegion()->where('region_id', $selectedRegion->id)->first();

        return route('products.show', [$languageRow->title, $language, $region]);
    }

}
