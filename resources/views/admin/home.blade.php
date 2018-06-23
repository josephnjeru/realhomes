@extends('admin.admin')

@section('content')

<div class="container">
    <div class="card">
        <h2 class="text-center">Transaction Records</h2>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Merchant RequestId</th>
                    <th>Mpesa Reciept No</th>
                    <th>Checkout Id</th>
                    <th>Phone No</th>
                    <th>Amount</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $key=>$value)
                <tr>
                    <td>{{$value->merchantReqid}}</td>
                    <td>{{$value->mpesaRecieptNo}}</td>
                    <td>{{$value->checkoutId}}</td>
                    <td>{{$value->phoneNo}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->resultDesc}}</td>
                </tr>
                @endforeach

                <tr></tr>
            </tbody>
        </table>
        <div>
</di>

@endsection

