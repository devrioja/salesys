<?php

namespace App\Http\Controllers\Deposit;

use App\DeliveryNote;
use App\Http\Requests;
use App\Article;
use App\Http\Controllers\Controller;
use App\Deposit;
use Illuminate\Http\Request;
use Session;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $deposit = Deposit::where('nombre', 'LIKE', "%$keyword%")
				->orWhere('direccion', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $deposit = Deposit::paginate($perPage);
        }

        return view('deposit.deposit.index', compact('deposit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('deposit.deposit.create');
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
			'direccion' => 'required'
		]);
        $requestData = $request->all();
        
        Deposit::create($requestData);

        Session::flash('flash_message', 'Deposit added!');

        return redirect('deposit');
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
        $deposit = Deposit::findOrFail($id);

        return view('deposit.deposit.show', compact('deposit'));
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
        $deposit = Deposit::findOrFail($id);

        return view('deposit.deposit.edit', compact('deposit'));
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
			'direccion' => 'required'
		]);
        $requestData = $request->all();
        
        $deposit = Deposit::findOrFail($id);
        $deposit->update($requestData);

        Session::flash('flash_message', 'Deposit updated!');

        return redirect('deposit');
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
        Deposit::destroy($id);

        Session::flash('flash_message', 'Deposit deleted!');

        return redirect('deposit');
    }


    public static function updateStockDeposit($articles, $quantities, Deposit $deposit)
    {
        for ($i = 0; $i < sizeof($articles); $i++) {

            if($model=$deposit->articles()->find($articles[$i])){

                $model=$deposit->articles()->findOrFail($articles[$i]);
                $deposit->articles()->updateExistingPivot($articles[$i], array('stock' => $quantities[$i] + $model->pivot->stock));
            }
            else{
                $deposit->articles()->attach($articles[$i], array('stock' => $quantities[$i]));
            }

        }

    }

    public static function updateArticlesDeliveryNoteOnDeposit(DeliveryNote $deliveryNote){
        $deposit = Deposit::find($deliveryNote->deposit_id);
        
        foreach ($deliveryNote->articles as $article){
                $articleDeposit = $deposit->article()->find($article->id);
                $deposit-$article()->updateExistingPivot($article->id,array('stock' =>($articleDeposit->pivot->stock - $article->cantidad_ingresada)));
        }


    }

    
}
