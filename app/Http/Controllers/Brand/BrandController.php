<?php

namespace App\Http\Controllers\Brand;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Brand;
use Illuminate\Http\Request;
use Session;

class BrandController extends Controller
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
            $brand = Brand::where('nombre', 'LIKE', "%$keyword%")
				->orWhere('descripcion', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $brand = Brand::paginate($perPage);
        }

        return view('brand.brand.index', compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('brand.brand.create');
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
			'nombre' => 'min:5|required'
		]);
        $requestData = $request->all();
        
        Brand::create($requestData);

        Session::flash('flash_message', 'Brand added!');

        return redirect('brand');
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
        $brand = Brand::findOrFail($id);

        return view('brand.brand.show', compact('brand'));
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
        $brand = Brand::findOrFail($id);

        return view('brand.brand.edit', compact('brand'));
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
			'nombre' => 'min:5|required'
		]);
        $requestData = $request->all();
        
        $brand = Brand::findOrFail($id);
        $brand->update($requestData);

        Session::flash('flash_message', 'Brand updated!');

        return redirect('brand');
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
        Brand::destroy($id);

        Session::flash('flash_message', 'Brand deleted!');

        return redirect('brand');
    }
}
