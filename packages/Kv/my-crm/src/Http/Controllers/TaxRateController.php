<?php

namespace Kv\MyCrm\Http\Controllers;

use Kv\MyCrm\Http\Requests\StoreTaxRateRequest;
use Kv\MyCrm\Http\Requests\UpdateTaxRateRequest;
use Kv\MyCrm\Models\TaxRate;

class TaxRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (TaxRate::all()->count() < 30) {
            $taxRates = TaxRate::latest()->get();
        } else {
            $taxRates = TaxRate::latest()->paginate(30);
        }

        return view('my-crm::tax-rates.index', [
            'taxRates' => $taxRates,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('my-crm::tax-rates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaxRateRequest $request)
    {
        $taxRate = TaxRate::create([
            'name' => $request->name,
            'rate' => $request->rate,
            'description' => $request->description,
            'default' => (($request->default == 'on') ? 1 : 0),
            'tax_type' => $request->tax_type
        ]);

        if($request->default == 'on') {
            TaxRate::where('id', '!=', $taxRate->id)->update(['default' => 0]);
        }

        flash(ucfirst(trans('my-crm::lang.tax_rate_stored')))->success()->important();

        return redirect(route('laravel-crm.tax-rates.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TaxRate $taxRate)
    {
        return view('my-crm::tax-rates.show', [
            'taxRate' => $taxRate,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TaxRate $taxRate)
    {
        return view('my-crm::tax-rates.edit', [
            'taxRate' => $taxRate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaxRateRequest $request, TaxRate $taxRate)
    {
        $taxRate->update([
            'name' => $request->name,
            'rate' => $request->rate,
            'description' => $request->description,
            'default' => (($request->default == 'on') ? 1 : 0),
            'tax_type' => $request->tax_type
        ]);

        if($request->default == 'on') {
            TaxRate::where('id', '!=', $taxRate->id)->update(['default' => 0]);
        }

        flash(ucfirst(trans('my-crm::lang.tax_rate_updated')))->success()->important();

        return redirect(route('laravel-crm.tax-rates.show', $taxRate));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxRate $taxRate)
    {
        $taxRate->delete();

        flash(ucfirst(trans('my-crm::lang.tax_rate_deleted')))->success()->important();

        return redirect(route('laravel-crm.tax-rates.index'));
    }
}
