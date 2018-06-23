<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\AfricasTalking\AfricasTalkingGateway;

class SmsController extends Controller
{
    public function index($_data){
        $data=  json_decode($_data);

        //notify customer
        $this->send($data->customerPhone, $data->customerMsg);
        
        //notify landlord
        // $this->send($data->landlordPhone, $data->landlordMsg);

    }
    public function send($phone, $msg){
        // require_once(app_path() . '\library\africastalking\AfricasTalkingGateway.php');

            // Specify your authentication credentials
            $username   = "realhomes";
            $apikey     = "6a90b69fe9c1d1dd7195116ed3f96fc8f22a33130906f91d8b07345ef49b1e18 ";
            // Specify the numbers that you want to send to in a comma-separated list
            // Please ensure you include the country code (+254 for Kenya in this case)
            $recipients = $phone;
            // And of course we want our recipients to know what we really do
            $message    = $msg;
            // Create a new instance of our awesome gateway class
            $gateway    = new \App\AfricasTalking\AfricasTalkingGateway($username, $apikey);
            /*************************************************************************************
            NOTE: If connecting to the sandbox:
            1. Use "sandbox" as the username
            2. Use the apiKey generated from your sandbox application
                https://account.africastalking.com/apps/sandbox/settings/key
            3. Add the "sandbox" flag to the constructor
            $gateway  = new AfricasTalkingGateway($username, $apiKey, "sandbox");
            **************************************************************************************/
            // Any gateway error will be captured by our custom Exception class below, 
            // so wrap the call in a try-catch block
            try 
            { 
            // Thats it, hit send and we'll take care of the rest. 
            $results = $gateway->sendMessage($recipients, $message);    
            
            foreach($results as $result) {
                // status is either "Success" or "error message"
                echo " Number: " .$result->number;
                echo " Status: " .$result->status;
                // echo " StatusCode: " .$result->statusCode;
                echo " MessageId: " .$result->messageId;
                echo " Cost: "   .$result->cost."\n";
            }
            }
            catch ( AfricasTalkingGatewayException $e )
            {
            echo "Encountered an error while sending: ".$e->getMessage();
            }
            return;
            // DONE!!! 
        }
}
