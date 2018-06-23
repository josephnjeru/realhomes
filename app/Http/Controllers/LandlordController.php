<?php

namespace App\Http\Controllers;

use App\Landlord;
use App\Estate;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\Landlord as LResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Estate as EResource;
class LandlordController extends Controller
{
    protected $user;
    public function __construct(){
         $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $landlords = Landlord::all();
        return LResource::collection($landlords);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('landlord.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
           
        
        $landlord = $request->IsMethod('put')?findorfail($request->id) : new Landlord;

        $landlord->name = $request->input('name');
        $landlord->email = $this->user->email;
        $landlord->phone = $request->input('phone');
        $landlord->county = $request->input('county');
        $landlord->town = $request->input('town');
        $landlord->area = $request->input('area');
        $landlord->username = $this->user->name;
        $landlord->nationalID = $request->input('idnumber');
        $landlord->user = $this->user->id;
        $landlord->photo = "placeholder";

        if($landlord->save()){                   
            return redirect()->route('home');
        }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Landlord  $landlord
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $landlord = Landlord::findorfail($id);
        return  new LResource($id);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Landlord  $landlord
     * @return \Illuminate\Http\Response
     */
    public function destroy(Landlord $landlord)
    {
        $landlord = Landlord::findorfail($id);

        if($landlord->delete()){
            return response([
                'status'=>'success',
                'message'=>'Account deleted',
                'data'=> new LResource($estate)
            ],200);
        }
    }

    //get single landlord's estates
    public function getEstates(){
        $landlord = Landlord::where('user', $this->user->id)->first();
        
        $estates = Estate::where('landlord', $landlord->id)->get();
        // dd($estates);
          return view('landlord.myestates')->with('estates', $estates);
    }
    //Deactivate landlord account
    public function deactivate($id){
        $landlord = \App\Landlord::findorfail($id);

        $landlord->status = null;
        $landlord->save();
        return redirect()->route('my-estates');
    }
}
