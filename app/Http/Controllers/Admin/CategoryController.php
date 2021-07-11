<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')->get();

        return view('admin.categories.index',compact($categories,'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategoryFormRequest $request)
    {
        DB::table('categories')->insert([
            'title'         => $request->title,
            'url'           => $request->url,
            'description'   => $request->description,
        ]);

        return redirect()->route('categories.index')->
            with('sucess','Cadastro realizadocom sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if(!$category){
            return redirect()->back();
        }

        return view('admin.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if(!$category){
            return redirect()->back();
        }

        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('categories')
            ->where('id',$id)
            ->update([
                'title'         => $request->title,
                'url'           => $request->url,
                'description'   => $request->description
            ]);
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('categories')->where('id',$id)->delete();

        return redirect()->route('categories.index');
    }
    public function search(Request $request)
    {
        $data = $request->all();
        /*$categories = DB::table('categories')
            ->where('title',$search)
            ->orWhere('url',$search)
            ->orWhere('description','LIKE',"%{$search}%")
            ->get();
        */

        $categories = DB::table('categories')
            ->where(function ($query) use ($data){
                if (isset($data['title'])){
                    $query->where('title',$data['title']);
                }
            if(isset($data['url'])){
                $query->orWhere('url',$data['url']);
            }
                if(isset($data['description'])){
                    $desc = $data['description'];
                    $query->Where('description','LIKE',"%{$desc}%");
                }
           })
            ->get();

        return view('admin.categories.index',compact('categories'));
    }
}
