<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CheckoutResponse;

class AdminController extends Controller
{
    public function index(){
        $trans = \App\MpesaResponse::All();
        
        return view('admin.home')->with('transactions', $trans);
    }

    public function showlandlords(){
        $landlords = \App\Landlord::All();

        return view('admin.landlords')->with('landlords', $landlords);
    }

    //activate landlord account
    public function activate($id){
        $landlord = \App\Landlord::findorfail($id);

        $landlord->status = 1;
        $landlord->save();
        return redirect('admin/landlords');
    }

    //Deactivate landlord account
    public function deactivate($id){
        $landlord = \App\Landlord::findorfail($id);

        $landlord->status = null;
        $landlord->save();
        return redirect('admin/landlords');
    }

    public function showestates(){
        $estates = \App\Estate::All();

        return view('admin.estates')->with('estates', $estates);
    }

     //activate estate 
    public function activate_estate($id){
        $estate = \App\Estate::findorfail($id);

        $estate->status = 1;
        $estate->save();
        return redirect('admin/estates');
    }
    //activate estate 
    public function deactivate_estate($id){
        $estate = \App\Estate::findorfail($id);

        $estate->status = null;
        $estate->save();
        return redirect('admin/estates');
    }

}
