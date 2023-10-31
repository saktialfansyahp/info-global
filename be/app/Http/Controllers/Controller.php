<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response($data)
    {
        return response()->json([
            'message' => 'success',
            'data' => $data
        ], 200);
    }
    public function sortAsc(Request $request ,$by){
        $searchTerm = $request->query('search');
        if($by == 'Name'){
            $data = ProductColor::with('product')
                ->with('product.subCategory')
                ->with('product.subCategory.category')
                ->with('color')
                ->where(function ($query) use ($searchTerm) {
                    $query->whereHas('product', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(product_name) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory.category', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('color', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(color) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(sub_category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
                })
                ->sortByAscending('products.product_name')
                ->get();

            return $this->response($data);
        } else if($by == 'Color'){
            $data = ProductColor::with('product')
                ->with('product.subCategory')
                ->with('product.subCategory.category')
                ->with('color')
                ->where(function ($query) use ($searchTerm) {
                    $query->whereHas('product', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(product_name) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory.category', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('color', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(color) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(sub_category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
                })
                ->sortByAscending('colors.color')
                ->get();

            return $this->response($data);
        } else if($by == 'Sub Category'){
            $data = ProductColor::with('product')
                ->with('product.subCategory')
                ->with('product.subCategory.category')
                ->with('color')
                ->where(function ($query) use ($searchTerm) {
                    $query->whereHas('product', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(product_name) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory.category', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('color', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(color) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(sub_category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
                })
                ->sortByAscending('subcategories.sub_category')
                ->get();

            return $this->response($data);
        } else if($by == 'Price'){
            $data = ProductColor::with('product')
                ->with('product.subCategory')
                ->with('product.subCategory.category')
                ->with('color')
                ->where(function ($query) use ($searchTerm) {
                    $query->whereHas('product', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(product_name) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory.category', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('color', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(color) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(sub_category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
                })
                ->sortByAscending('products.price')
                ->get();

            return $this->response($data);
        } else if($by == 'Category'){
            $data = ProductColor::with('product')
                ->with('product.subCategory')
                ->with('product.subCategory.category')
                ->with('color')
                ->where(function ($query) use ($searchTerm) {
                    $query->whereHas('product', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(product_name) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory.category', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('color', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(color) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(sub_category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
                })
                ->sortByAscending('categories.category')
                ->get();

            return $this->response($data);
        }
    }
    public function sortDesc(Request $request,$by){
        $searchTerm = $request->query('search');
        if($by == 'Name'){
            $data = ProductColor::with('product')
                ->with('product.subCategory')
                ->with('product.subCategory.category')
                ->with('color')
                ->where(function ($query) use ($searchTerm) {
                    $query->whereHas('product', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(product_name) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory.category', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('color', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(color) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(sub_category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
                })
                ->sortByDescending('products.product_name')
                ->get();

            return $this->response($data);
        } else if($by == 'Color'){
            $data = ProductColor::with('product')
                ->with('product.subCategory')
                ->with('product.subCategory.category')
                ->with('color')
                ->where(function ($query) use ($searchTerm) {
                    $query->whereHas('product', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(product_name) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory.category', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('color', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(color) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(sub_category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
                })
                ->sortByDescending('colors.color')
                ->get();

            return $this->response($data);
        } else if($by == 'Sub Category'){
            $data = ProductColor::with('product')
                ->with('product.subCategory')
                ->with('product.subCategory.category')
                ->with('color')
                ->where(function ($query) use ($searchTerm) {
                    $query->whereHas('product', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(product_name) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory.category', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('color', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(color) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(sub_category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
                })
                ->sortByDescending('subcategories.sub_category')
                ->get();

            return $this->response($data);
        } else if($by == 'Price'){
            $data = ProductColor::with('product')
                ->with('product.subCategory')
                ->with('product.subCategory.category')
                ->with('color')
                ->where(function ($query) use ($searchTerm) {
                    $query->whereHas('product', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(product_name) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory.category', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('color', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(color) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(sub_category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
                })
                ->sortByDescending('products.price')
                ->get();

            return $this->response($data);
        } else if($by == 'Category'){
            $data = ProductColor::with('product')
                ->with('product.subCategory')
                ->with('product.subCategory.category')
                ->with('color')
                ->where(function ($query) use ($searchTerm) {
                    $query->whereHas('product', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(product_name) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory.category', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('color', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(color) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhereHas('product.subCategory', function ($subquery) use ($searchTerm) {
                        $subquery->whereRaw('LOWER(sub_category) LIKE ?', ['%' . $searchTerm . '%']);
                    })
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
                })
                ->sortByDescending('categories.category')
                ->get();

            return $this->response($data);
        }
    }
    public function sortAscColor(Request $request){
        $searchTerm = $request->query('search');
        $data = Color::where(function ($query) use ($searchTerm) {
            $query->whereRaw('LOWER(color) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            })
            ->orderBy('color', 'asc')
            ->get();

        return $this->response($data);
    }
    public function sortDescColor(Request $request){
        $searchTerm = $request->query('search');
        $data = Color::where(function ($query) use ($searchTerm) {
            $query->whereRaw('LOWER(color) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            })
            ->orderBy('color', 'desc')
            ->get();

        return $this->response($data);
    }
    public function sortAscCategory(Request $request, $by){
        $searchTerm = $request->query('search');
        $order = strtolower($by);
        $data = Category::where(function ($query) use ($searchTerm) {
            $query->whereRaw('LOWER(category) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                ->whereRaw('LOWER(description) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
                })
            ->orderBy($order, 'asc')
            ->get();

        return $this->response($data);
    }
    public function sortDescCategory(Request $request, $by){
        $searchTerm = $request->query('search');
        $order = strtolower($by);
        $data = Category::where(function ($query) use ($searchTerm) {
            $query->whereRaw('LOWER(category) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
                })
            ->orderBy($order, 'desc')
            ->get();

        return $this->response($data);
    }
    public function sortAscSubcategory(Request $request, $by) {
        $searchTerm = $request->query('search');
        $order = strtolower($by);

        if($order == 'sub_category'){
            $order = 'subcategories.sub_category';
        } else if($order == 'description'){
            $order = 'subcategories.description';
        } else if($order == 'category'){
            $order = 'categories.category';
        }

        $data = Subcategory::with('category')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id') // Join dengan tabel categories
            ->where(function ($query) use ($searchTerm) {
                $query->whereRaw('LOWER(subcategories.sub_category) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereRaw('LOWER(subcategories.description) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereRaw('LOWER(categories.category) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            })
            ->orderBy($order, 'asc')
            ->get();

        return $this->response($data);
    }
    public function sortDescSubcategory(Request $request, $by) {
        $searchTerm = $request->query('search');
        $order = strtolower($by);

        if($order == 'sub_category'){
            $order = 'subcategories.sub_category';
        } else if($order == 'description'){
            $order = 'subcategories.description';
        } else if($order == 'category'){
            $order = 'categories.category';
        }

        $data = Subcategory::with('category')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id') // Join dengan tabel categories
            ->where(function ($query) use ($searchTerm) {
                $query->whereRaw('LOWER(subcategories.sub_category) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereRaw('LOWER(subcategories.description) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereRaw('LOWER(categories.category) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            })
            ->orderBy($order, 'desc')
            ->get();

        return $this->response($data);
    }
}
