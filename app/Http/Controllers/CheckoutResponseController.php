<?php

namespace App\Http\Controllers;

use App\CheckoutResponse;
use Illuminate\Http\Request;

class CheckoutResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkout = CheckoutResponse::all();

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
        $checkout = $request->IsMethod('put')? CheckoutResponse::findorfail($request->id) : new CheckoutRequest;
        $checkout->phoneNo = $request->input('phone');
        $checkout->merchantReqid = $request->input('merchantReqid');
        $checkout->checkoutId = $request->input('checkoutId');
        $checkout->resultcode = $request->input('resultcode');
        $checkout->resultDesc = $request->input('resultDesc');
        $checkout->amount = $request->input('amount');
        $checkout->mpesaRecieptNo = $request->input('mpesaRecieptNo');
        $checkout->transactiondate = $request->input('transactiondate');
        
        $checkout->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CheckoutResponse  $checkoutResponse
     * @return \Illuminate\Http\Response
     */
    public function show(CheckoutResponse $checkoutResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CheckoutResponse  $checkoutResponse
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckoutResponse $checkoutResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CheckoutResponse  $checkoutResponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckoutResponse $checkoutResponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CheckoutResponse  $checkoutResponse
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckoutResponse $checkoutResponse)
    {
        $chckout = CheckoutResponse::findorfail($checkoutResponse);
        $checkout->delete();
    }
}
