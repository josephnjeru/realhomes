<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\Auth;
use App\CheckoutRequest;
use App\MpesaResponse;
use App\Estate;
use App\Jobs\sendCustomerSms;
use App\Jobs\sendLandlordSms;


class PaymentController extends Controller
{
        public function __constructor(){
            $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
            });
        }

    public function processPay(){
        
        $postData=file_get_contents("php://input");
        // $response = json_decode($postData, true);

        return $this->storeCheckoutRes($postData);

        //  Storage::put('response.txt', $postData);
    }

    
    public function authenticate(){
            $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            $credentials = base64_encode('wZJRuzhtTBqRYlNWhJsdpobJMSYWdF2x:2qDQ00gJT0RGdPUA');
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $curl_response = curl_exec($curl);

            dd($curl_response);
    }

    public function getCharge($estate){
        $est = Estate::findorfail($estate);
        $charge = $est->price;
        return $charge;
    }
    
    public function pay(Request $request){
        
            $access_token = '6r0KNAemMGKkR2vpRf5LSkXX6J23';

            $url = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
            $amount = $this->getCharge($request->estate);;
            $partya = $request->phoneNo;
            $partyb = '174379';
            $callback = "http://83c682f2.ngrok.io/api/process-payment";
            $transdef = "Please Pay " . $amount . " to RealHomes.";
            $def = "test";
            $transtype = "CustomerPayBillOnline";
            $makaof = "RealHomes.";

            // $date = new DateTime();
            $Timestamp = '20180617190200';

            
            $Consumer_Key = "wZJRuzhtTBqRYlNWhJsdpobJMSYWdF2x";
            $Consumer_Secret =	"2qDQ00gJT0RGdPUA";
            $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
            //ShortcodePasskeyTimestamp
            $password = base64_encode($partyb.$passkey.$Timestamp);

            //start generating random number
            $x = 4; // Amount of digits
            $min = pow(10,$x);
            $max = pow(10,$x+1)-1;
            $value = rand($min, $max);
            
            //end generating random number

            // $shortcode2 = 174379;

            //Initiate cURL.
            $ch = curl_init($url);

            //The JSON data.

            $jsonData = array(
                "BusinessShortCode" => $partyb,
                "Password" => $password,
                "Timestamp" => $Timestamp,
                "TransactionType" => $transtype,
                "Amount" => $amount,
                "PartyA" => $partya,
                "PartyB" => $partyb,
                "PhoneNumber" => $partya,
                "CallBackURL" => $callback,
                "AccountReference" => $value,
                "TransactionDesc" => $makaof
                );

                //  dd($jsonData);
                //Encode the array into JSON.
            $jsonDataEncoded = json_encode($jsonData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //Tell cURL that we want to send a POST request.
            curl_setopt($ch, CURLOPT_POST, 1);
            //curl_setopt($curl, CURLOPT_POST, true);
            //Attach our encoded JSON string to the POST fields.
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
            //Set the content type to application/json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization:Bearer '.$access_token));

            //Execute the request
            $result = curl_exec($ch);

            // dd($result);

            // Closing
            curl_close($ch);

           
           $response = json_decode($result, true);
        //    dd($response);
            //post data to the database
            $requestData = [
                'phoneNo'=>$partya,
                'tillNo'=>$partyb,
                'amount'=>$amount,
                'transactionRef'=>$value,
                'merchantReqid'=>$response["MerchantRequestID"],
                'checkoutId'=>$response["CheckoutRequestID"],
                'responsecode'=>$response["ResponseCode"],
                'responseDesc'=>$response["ResponseDescription"],
                'customermsg'=>$response["ResponseDescription"],
                'transactionDesc'=>$makaof,
                'estate'=>$request->estate ,
                'user'=>Auth::user()->id,
            ];

            // dd($requestData);
            // return redirect()->action('CheckoutRequestController@store', ['data'=>json_encode($requestData)]);
            
                $this->storeCheckoutReq(json_encode($requestData));
                return redirect()->route('home');
    }

    public function storeCheckoutReq($requestData){
            $data = json_decode($requestData, true);
            
            $checkout = new CheckoutRequest;
            $checkout->phoneNo = $data['phoneNo'];
            $checkout->tillNo = $data['tillNo'];
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

            return redirect('home');

    }

     public function storeCheckoutRes($postData){
        $data = json_decode($postData, true);
        
        $amount = "";
        $mpesareceiptnumber ="";
        $transtype = '';
        $transactiondate = '';
        $phonenumber = '';


        $merchantReqid = $data["Body"]["stkCallback"]["MerchantRequestID"];
        $checkoutId = $data["Body"]["stkCallback"]["CheckoutRequestID"];
        $resultcode = $data["Body"]["stkCallback"]["ResultCode"];
        $resultDesc = $data["Body"]["stkCallback"]["ResultDesc"];

        if($resultcode == 0){
            
        $amount = $data["Body"]["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"];
        $mpesareceiptnumber = $data["Body"]["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"];
        $transtype = $data["Body"]["stkCallback"]["CallbackMetadata"]["Item"][2]["Name"];
        $transactiondate = $data["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"];
        $phonenumber = $data["Body"]["stkCallback"]["CallbackMetadata"]["Item"][4]["Value"];
        }

        if($resultcode == 0){
            $checkout = new MpesaResponse;
            $checkout->status = 1;
            $checkout->phoneNo = $phonenumber;
            $checkout->merchantReqid = $merchantReqid;
            $checkout->checkoutId = $checkoutId;
            $checkout->resultcode = $resultcode;
            $checkout->resultDesc = $resultDesc;
            $checkout->amount = $amount;
            $checkout->mpesaRecieptNo = $mpesareceiptnumber;
            $checkout->transactiondate = $transactiondate;
            $checkout->checkout_fk = $checkoutId;
            
            if($checkout->save()){
                    $this->notify($checkoutId);
                   return response([
                        'status'=>'Success',
                        'message'=>'checkout request save ',
                    ],200);    
                    
                }else{
                    return response([
                        'status'=>'Failed',
                        'message'=>'checkout request save failed',
                    ],500);
                }
        }else{
            return response([
                    'status'=>'success',
                    'message'=> "Failed",
                ],500);
                }
    }

    //notify customer and landlord about the booking
    public function notify($checkout){
            $transaction = MpesaResponse::where('checkoutId', $checkout)
                                            ->where('resultCode', 0)->first();

            $customer_phone = '+'.$transaction->phoneNo;
            $amount = $transaction->amount;

            //ref code and estate;
            $x = CheckoutRequest::where('checkoutId', $checkout)->first();

            $code = $x->transactionRef;
            $estateId = $x->estate;

            $estate = Estate::findorfail($estateId);

            $landlord = \App\Landlord::where('id', $estate->landlord)->first();
            $landlord_name = $landlord->name;
            $landlord_phone = $landlord->phone; 

            $customerMsg  = 'Your booking request at Realhomes was successiful for '.$estate->name.
                            '. Confirmation code is '.$code. ' Landlord contacts '. $landlord_phone. ' ('.$landlord_name. ')';

            $landlordMsg  = 'A booking request at Realhomes was successiful processed for '.$estate->name. ' Ksh '.$amount.' was paid.'.
                            '. Confirmation code is '.$code. ' Customer contacts '. $customer_phone;

            sendCustomerSms::dispatch($customer_phone, $customerMsg);
            sendLandlordSms::dispatch($landlord_phone, $landlordMsg);
            
            
    }


    
}