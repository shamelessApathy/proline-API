<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  public function category()
  {
  	return $this->belongs_to('App\Category');
  }
  protected  $fillable = ['sku', 'inventory', 'category_id', 'name', 'image_path', 'spec_sheet_path', 'optional_attributes'];
}
