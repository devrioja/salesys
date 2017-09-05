<?php

namespace App\Http\Controllers\Sale;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Monolog\Handler\SamplingHandlerTest;
use Session;

class SaleController extends Controller
{
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
            $sale = Sale::where('fecha', 'LIKE', "%$keyword%")
				->orWhere('customer_id', 'LIKE', "%$keyword%")
				->orWhere('costoTotal', 'LIKE', "%$keyword%")
				->orWhere('descripcion', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $sale = Sale::paginate($perPage);
        }

        return view('sale.sale.index', compact('sale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $customers = DB::table('customers')
                     ->select(DB::raw('CONCAT (apellido,", ",nombre) as nombrec,id'))
                     ->get()
                     ->pluck('nombrec','id');
/*
        $articles =DB::table('articles')
            ->select(DB::raw('CONCAT (apellido,", ",nombre) as nombrec,id'))
            ->get()
            ->pluck('nombrec','id');;
*/
       //print_r($customers);
        return view('sale.sale.create',compact('customers'));
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
        
        $requestData = $request->all();
        
        Sale::create($requestData);

        Session::flash('flash_message', 'Sale added!');

        return redirect('sale');
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
        $sale = Sale::findOrFail($id);

        return view('sale.sale.show', compact('sale'));
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
        $sale = Sale::findOrFail($id);

        return view('sale.sale.edit', compact('sale'));
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
        
        $requestData = $request->all();
        
        $sale = Sale::findOrFail($id);
        $sale->update($requestData);

        Session::flash('flash_message', 'Sale updated!');

        return redirect('sale');
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
        Sale::destroy($id);

        Session::flash('flash_message', 'Sale deleted!');

        return redirect('sale');
    }



    
}
