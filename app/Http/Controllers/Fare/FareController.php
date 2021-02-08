<?php

namespace App\Http\Controllers\Fare;

use App\Http\Controllers\Controller;
use App\Models\Fare;
use App\Models\Operator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class FareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $operator = Operator::findOrfail($request->operator_id);

        if ($operator->activeFareByValue($request->value)) {
            $errors = new MessageBag();
            $errors->add('fare_amount_active', 'Essa tarifa já esta ativa!');
            return redirect("operators/$request->operator_id/edit")->withErrors($errors);
        }

        $operator->fares()->create([
            'value' => $request->value,
            'active' => $request->status === 'false' ? false : true,
            'operator_id' => $request->operator_id
        ]);

        return view('operators.edit', [
            'operator' => $operator
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateStatus(Fare $fare)
    {
        if (!$fare->active) {
            if ($fare->operator->activeFareByValue($fare->value)) {
                $errors = new MessageBag();
                $errors->add('fare_amount_active', 'Essa tarifa já esta ativa!');
                return redirect("operators/$fare->operator_id/edit")->withErrors($errors);
            }
        }
        $fare->active = !$fare->active;
        $fare->save();
        return view('operators.edit', [
            'operator' => $fare->operator
        ]);
    }
}
