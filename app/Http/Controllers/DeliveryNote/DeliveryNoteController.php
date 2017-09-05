<?php

namespace App\Http\Controllers\DeliveryNote;

use App\Article;
use App\Deposit;
use App\Http\Controllers\Deposit\DepositController;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\DeliveryNote;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Session;

class DeliveryNoteController extends Controller
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
            $deliverynote = DeliveryNote::where('fecha', 'LIKE', "%$keyword%")
                ->orWhere('supplier_id', 'LIKE', "%$keyword%")
                ->orWhere('descripcion', 'LIKE', "%$keyword%")
                ->orWhere('numero_remito', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $deliverynote = DeliveryNote::paginate($perPage);
        }

        return view('deliverynote.deliverynote.index', compact('deliverynote'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $suppliers = DB::table('suppliers')->pluck('nombre', 'id');
        $deposits = DB::table('deposits')->pluck('nombre', 'id');
        return view('deliverynote.deliverynote.create', compact('suppliers', 'deposits'));
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $articles = $request->input('articles');
        $cantidades = $request->input('cantidad');
        $deposit = Deposit::find($request->input('deposit_id'));
        $newDate = date("Y-m-d", strtotime($request->input('fecha')));

        $requestData = array('fecha' => $newDate,
            'descripcion' => $request->input('descripcion'),
            'supplier_id' => $request->input('supplier_id'),
            'deposit_id' => $request->input('deposit_id'),
            'numero_remito' => $request->input('numero_remito'));

        $deliveryNote = DeliveryNote::create($requestData);
        $this->insertArticles($articles, $cantidades, $deliveryNote);
        //$this->updateStockDeposit($articles, $cantidades, $deposit);
        DepositController::updateStockDeposit($articles, $cantidades, $deposit);

        Session::flash('flash_message', 'DeliveryNote added!');

        return redirect('deliverynote');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $deliverynote = DeliveryNote::findOrFail($id);

        return view('deliverynote.deliverynote.show', compact('deliverynote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $deliverynote = DeliveryNote::findOrFail($id);
        $suppliers = DB::table('suppliers')->pluck('nombre', 'id');
        $deposits = DB::table('deposits')->pluck('nombre', 'id');

        return view('deliverynote.deliverynote.edit', compact('deliverynote', 'suppliers', 'deposits'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $deliveryNoteOld = DeliveryNote::find($id);
        $depositUpdated = $request->input('deposit_id');
        $articles = $request->input('articles');
        $cantidades = $request->input('cantidad');
        $newDate = date("Y-m-d", strtotime($request->input('fecha')));

        $requestData = array('fecha' => $newDate,
            'descripcion' => $request->input('descripcion'),
            'supplier_id' => $request->input('supplier_id'),
            'deposit_id' => $request->input('deposit_id'),
            'numero_remito' => $request->input('numero_remito'));

        if ($this->checkUpdateDeposit(DeliveryNote::findOrFail($id), $request->input('deposit_id'), $articles, $cantidades)) {
            DepositController::updateStockDeposit($articles, $cantidades, $deposit = Deposit::find($request->input('deposit_id')));
        }

        $deliverynote = DeliveryNote::findOrFail($id);
        $deliverynote->update($requestData);

        Session::flash('flash_message', 'DeliveryNote updated!');

        return redirect('deliverynote');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        DeliveryNote::destroy($id);

        Session::flash('flash_message', 'DeliveryNote deleted!');

        return redirect('deliverynote');
    }


    public function insertArticles($articles, $cantidades, DeliveryNote $deliveryNote)
    {
        $insertId = $deliveryNote->id;

        for ($i = 0; $i < sizeof($articles); $i++) {
            $deliveryNote->articles()->attach($articles[$i], array('cantidad_ingresada' => $cantidades[$i],

                'delivery_note_id' => $insertId));
        }
    }

    public function checkUpdateDeposit(DeliveryNote $deliveryNoteOld, $deposit_id_updated, $articles, $quantities)
    {

        if ($deliveryNoteOld->deposit_id != $deposit_id_updated) {

            DepositController::updateArticlesDeliveryNoteOnDeposit($deliveryNoteOld);

            $deliveryNoteOld->articles()->detach();

            return true;
        } else {
            $this->updateArticlesDeliveryNote($deliveryNoteOld, $articles, $quantities);
            DepositController::updateArticlesDeliveryNoteOnDeposit($deliveryNoteOld);

        }

    }

    public function updateArticlesDeliveryNote(DeliveryNote $deliveryNoteOld, $articles, $quantities)
    {
        for ($i = 0; $i < sizeof($articles); $i++) {
                    if($model=$deliveryNoteOld->articles()->find($articles[$i])){
                        $deliveryNoteOld->articles()->sync([$articles[$i] => ['cantidad_ingresada' => $quantities[$i]]]);
                        
                    }
                    else{
                        $deliveryNoteOld->articles()->attach($articles[$i], array('cantidad_ingresada' => $quantities[$i], 'delivery_note_id' => $deliveryNoteOld->id));
                    }


                }

        }



}