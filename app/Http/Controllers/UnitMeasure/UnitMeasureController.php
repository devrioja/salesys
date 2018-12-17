<?php

namespace App\Http\Controllers\UnitMeasure;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\UnitMeasure;
use Illuminate\Http\Request;
use Session;

class UnitMeasureController extends Controller
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
            $unitmeasure = UnitMeasure::where('nombre', 'LIKE', "%$keyword%")
				->orWhere('descripcion', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $unitmeasure = UnitMeasure::paginate($perPage);
        }

        return view('unitmeasure.unit-measure.index', compact('unitmeasure'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('unitmeasure.unit-measure.create');
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
			'nombre' => 'min:2|required'
		]);
        $requestData = $request->all();
        
        UnitMeasure::create($requestData);

        Session::flash('flash_message', 'UnitMeasure added!');

        return redirect('unit-measure');
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
        $unitmeasure = UnitMeasure::findOrFail($id);

        return view('unitmeasure.unit-measure.show', compact('unitmeasure'));
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
        $unitmeasure = UnitMeasure::findOrFail($id);

        return view('unitmeasure.unit-measure.edit', compact('unitmeasure'));
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
			'nombre' => 'min:2|required'
		]);
        $requestData = $request->all();
        
        $unitmeasure = UnitMeasure::findOrFail($id);
        $unitmeasure->update($requestData);

        Session::flash('flash_message', 'UnitMeasure updated!');

        return redirect('unit-measure');
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
        UnitMeasure::destroy($id);

        Session::flash('flash_message', 'UnitMeasure deleted!');

        return redirect('unit-measure');
    }
}
