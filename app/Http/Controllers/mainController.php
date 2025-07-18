<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;

class mainController extends Controller
{
    public function mainPage()
    {
        $groups = Group::Where('parent_id', '0')->get();

        if (request()->has('groupId')) {
            $group = Group::findOrFail(request()->groupId);
            $processedGroups = [];
            $processedGroups = childId($group, $processedGroups);
            $products = Product::whereIn('id_group', $processedGroups);
        } else {
            $products = Product::query();
        }
        if (request()->sort == 'price_asc') {
            $products->join('prices', 'prices.id_product', '=', 'products.id')
                     ->select('products.*', 'prices.price as product_price')
                     ->orderBy('product_price');
        }elseif(request()->sort == 'price_desc'){
            $products->join('prices', 'prices.id_product', '=', 'products.id')
                     ->select('products.*', 'prices.price as product_price')
                     ->orderBy('product_price', 'desc');
        }elseif(request()->sort == 'name_asc'){
            $products->orderBy('name');
        }elseif(request()->sort == 'name_desc'){
            $products->orderBy('name', 'desc');
        }

        $products = $products->paginate(request()->per_page)->appends(request()->query());;

        return view('main', compact('groups', 'products'));
    }

    public function ProductPage($id)
    {
        $product = Product::findOrFail($id);

        return view('product', compact('product'));
    }
}
