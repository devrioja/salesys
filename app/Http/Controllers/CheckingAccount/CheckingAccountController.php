<?php

namespace App\Http\Controllers\CheckingAccount;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\CheckingAccount;
use Illuminate\Http\Request;
use Session;

class CheckingAccountController extends Controller
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
            $checkingaccount = CheckingAccount::where('fecha_alta', 'LIKE', "%$keyword%")
				->orWhere('fecha_vencimiento', 'LIKE', "%$keyword%")
				->orWhere('customer_id', 'LIKE', "%$keyword%")
				->orWhere('balance', 'LIKE', "%$keyword%")
				->orWhere('descripcion', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $checkingaccount = CheckingAccount::paginate($perPage);
        }
        print_r($checkingaccount->customer->nombre);

        //return view('checkingaccount.checking-account.index', compact('checkingaccount'));
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
        return view('checkingaccount.checking-account.create',compact('customers'));
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
			'balance' => 'required'
		]);
        $requestData = $request->all();
        $requestData['fecha_alta'] = date("Y-m-d", strtotime($requestData['fecha_alta']));
        $requestData['fecha_vencimiento'] = date("Y-m-d", strtotime($requestData['fecha_vencimiento']));

        CheckingAccount::create($requestData);

        Session::flash('flash_message', 'CheckingAccount added!');

        return redirect('checking-account');
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
        $checkingaccount = CheckingAccount::findOrFail($id);

        return view('checkingaccount.checking-account.show', compact('checkingaccount'));
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
        $checkingaccount = CheckingAccount::findOrFail($id);

        return view('checkingaccount.checking-account.edit', compact('checkingaccount'));
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
			'balance' => 'required'
		]);
        $requestData = $request->all();
        
        $checkingaccount = CheckingAccount::findOrFail($id);
        $checkingaccount->update($requestData);

        Session::flash('flash_message', 'CheckingAccount updated!');

        return redirect('checking-account');
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
        CheckingAccount::destroy($id);

        Session::flash('flash_message', 'CheckingAccount deleted!');

        return redirect('checking-account');
    }
}
