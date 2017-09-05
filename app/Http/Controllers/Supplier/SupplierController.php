<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Supplier;
use Illuminate\Http\Request;
use Session;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $supplier = Supplier::where('nombre', 'LIKE', "%$keyword%")
				->orWhere('direccion', 'LIKE', "%$keyword%")
				->orWhere('telefono', 'LIKE', "%$keyword%")
				->orWhere('correo', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $supplier = Supplier::paginate($perPage);
        }

        return view('supplier.supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('supplier.supplier.create');
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
			'nombre' => 'min:3|required',
			'telefono' => 'required',
			'correo' => 'email|required'
		]);
        $requestData = $request->all();
        
        Supplier::create($requestData);

        Session::flash('flash_message', 'Supplier added!');

        return redirect('supplier');
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
        $supplier = Supplier::findOrFail($id);

        return view('supplier.supplier.show', compact('supplier'));
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
        $supplier = Supplier::findOrFail($id);

        return view('supplier.supplier.edit', compact('supplier'));
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
			'nombre' => 'min:3|required',
			'telefono' => 'required',
			'correo' => 'email|required'
		]);
        $requestData = $request->all();
        
        $supplier = Supplier::findOrFail($id);
        $supplier->update($requestData);

        Session::flash('flash_message', 'Supplier updated!');

        return redirect('supplier');
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
        Supplier::destroy($id);

        Session::flash('flash_message', 'Supplier deleted!');

        return redirect('supplier');
    }
}
