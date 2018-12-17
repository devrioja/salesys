<?php

namespace App\Http\Controllers\Article;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Article;
use Illuminate\Http\Request;
use Session;

class ArticleController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $article = Article::where('nombre', 'LIKE', "%$keyword%")
				->orWhere('descripcion', 'LIKE', "%$keyword%")
				->orWhere('category_id', 'LIKE', "%$keyword%")
				->orWhere('brand_id', 'LIKE', "%$keyword%")
				->orWhere('stockMin', 'LIKE', "%$keyword%")
				->orWhere('stockMax', 'LIKE', "%$keyword%")
				->orWhere('precio', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $article = Article::paginate($perPage);
        }

        return view('articles.article.index', compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
            $categories = DB::table('categories')->pluck('nombre','id');
            $brands     = DB::table('brands')->pluck('nombre','id');
            $unit_measures     = DB::table('unit_measures')->pluck('nombre','id');


        return view('articles.article.create',compact('categories','brands','unit_measures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'nombre' => 'min:5|required',
			'stockMin' => 'required',
			'precio' => 'required'
		]);
        $requestData = $request->all();
        
        Article::create($requestData);

        Session::flash('flash_message', 'Article added!');

        return redirect('article');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories        = DB::table('categories')->pluck('nombre','id');
        $brands            = DB::table('brands')->pluck('nombre','id');
        $unit_measures     = DB::table('unit_measures')->pluck('nombre','id');

        return view('articles.article.edit', compact('article','categories','brands','unit_measures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $this->validate($request, [
			'nombre' => 'min:5|required',
			'stockMin' => 'required',
			'precio' => 'required'
		]);
        $requestData = $request->all();
        
        $article = Article::findOrFail($id);
        $article->update($requestData);

        Session::flash('flash_message', 'Article updated!');

        return redirect('article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Article::destroy($id);

        Session::flash('flash_message', 'Article deleted!');

        return redirect('article');
    }

}
