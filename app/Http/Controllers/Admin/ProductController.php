<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $products = $this->product->with('category')->paginate(1);

        //return response()->json($products);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  Category::pluck('title','id');

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductFormRequest $request)
    {
        /*$category = Category::find($request->category_id);
        $product = $category->products()->create($request->all());
        */

        $product = $this->product->create($request->all());

        return redirect()->route('products.index')
            ->withSuccess('Produto Cadastrado');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->with('category')
            ->where('id', $id)
            ->first();

        if (!$product) {
            return redirect()->back();
        }

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::pluck('title','id');

        if (!$product = $this->product->find($id)) {
            return redirect()->back();
        }
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductFormRequest $request, $id)
    {
        $product = $this->product->find($id)->update($request->all());

        return redirect()->route('products.index')
            ->withSuccess('Produto atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$this->product->find($id)->delete();
        Product::where('id', $id)->delete();

        return redirect()->route('products.index')
            ->withSuccess('Produto excluido com sucesso');

    }

    public function search(Request $request)
    {

        /*$products = $this->product
            ->with([
                'category' => function ($query)use($request){
                    $query->where('id',$request->category);
                }
        ])*/
        $products = $this->product
        ->with('category')
            ->where(function ($query) use ($request) {
                if ($request->name) {
                    $filter = $request->name;
                    $query->where(function ($querySub) use ($filter) {
                        $querySub->where('name','LIKE',"%{$filter}%")
                            ->orWhere('description','LIKE',"%{$filter}%");
                    });
                }

                if ($request->price) {
                    $query->where('price', $request->price);
                }
                if ($request->category) {
                    $query->orWhere('category_id', $request->category);
                }
            })
            ->paginate(1);


        return view('admin.products.index', compact('products'));
    }
}
