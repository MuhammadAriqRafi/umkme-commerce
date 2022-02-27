<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get()->load('images');
        $title = 'Howdy! ' . auth()->user()->name;

        return view('products.index', compact('products', 'title'));
    }

    public function create()
    {
        // Data
        $title = 'Tambah Product';
        return view('products.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:products',
            // 'image' => 'image|file|max:1024'
            'desc' => 'required',
            'harga' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        if (!$validator->passes()) return response()->json([
            'status' => 0,
            'error' => $validator->errors()->toArray()
        ]);
        else {
            $product = Product::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'desc' => $request->desc,
                'harga' => $request->harga,
                'stock' => $request->stock,
            ]);

            if ($product->wasRecentlyCreated === true) return response()->json([
                'status' => 1,
                'msg' => 'Product berhasil ditambahkan',
                'data' => $product
            ]);
            else return response()->json([
                'status' => 500,
                'msg' => 'Product gagal ditambahkan'
            ]);
        }

        // $request->validate([
        //     'image' => 'image|file|max:1024'
        // ]);

        // $product = Product::create([
        //     'title' => $request->title,
        //     'slug' => Str::slug($request->title),
        //     'desc' => $request->desc,
        //     'harga' => $request->harga,
        //     'stock' => $request->stock
        // ]);

        // if ($request->file('image')) {
        //     Image::create([
        //         'product_id' => $product->id,
        //         'name' => $request->file('image')->store('assets')
        //     ]);
        // }

        // return back()->with('success', 'Product berhasil ditambahkan');
    }

    public function show(Product $product)
    {
        // Data
        $title = 'Detail Product';

        return view('products.show', compact('product', 'title'));
    }

    public function edit(Product $product)
    {
        // Data
        $title = 'Edit Product';

        return view('products.edit', compact('product', 'title'));
    }

    public function update(Request $request, Product $product)
    {
        $product = Product::findOrFail($product->id);

        $product->title = $request->title;
        $product->desc = $request->desc;
        $product->harga = $request->harga;
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product berhasil di update');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product berhasil dihapus');
    }

    // API Controller
    public function getProduct(Request $request)
    {
        if ($request->count && $request->take) return Product::latest()->skip($request->count)->take($request->take)->get()->makeHidden(['created_at', 'updated_at']);
        else return Product::all()->makeHidden(['created_at', 'updated_at']);
    }
}
