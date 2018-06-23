<?php

namespace App\Http\Controllers;

use App\CheckoutRequest;
use Illuminate\Http\Request;

class CheckoutRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkouts = CheckoutRequest::all();

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
    public function store($requestData)
    {
        $data = json_decode($requestData);
        $checkout = $data->IsMethod('put')? CheckoutRequest::findorfail($data->id) : new CheckoutRequest;
        $checkout->phoneNo = $data['phone'];
        $checkout->tiilNo = $data['tillNo'];
        $checkout->amount = $data['amount'];
        $checkout->transactionRef = $data['transactionRef']; 
        $checkout->transactionDesc = $data['transactionDesc']; 
        $checkout->merchantReqid = $data['merchantReqid'];
        $checkout->checkoutId = $data['checkoutId'];
        $checkout->responsecode = $data['responsecode'];
        $checkout->responseDesc = $data['responseDesc'];
        $checkout->customermsg = $data['customermsg'];
        $checkout->estate = $data['estate'];
        $checkout->user = $data['user'];

        if($checkout->save()){
            return response([
                'status'=>'success',
                'message'=>'checkout request saved',
            ],200);
        }else{
              return response([
                'status'=>'Failed',
                'message'=>'checkout request save failed',
            ],500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CheckoutRequest  $checkoutRequest
     * @return \Illuminate\Http\Response
     */
    public function show(CheckoutRequest $checkoutRequest)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CheckoutRequest  $checkoutRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckoutRequest $checkoutRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CheckoutRequest  $checkoutRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckoutRequest $checkoutRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CheckoutRequest  $checkoutRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckoutRequest $checkoutRequest)
    {
        $checkout = CheckoutRequest::findorfail($checkoutRequest);

        $checkout->delete();
    }
}
