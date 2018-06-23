<?php

namespace App\Http\Controllers;

use App\Estate;
use App\Landlord;
use Illuminate\Http\Request;
use App\Http\Resources\Estate as EstateResource;
use Illuminate\Support\Facades\Auth;
class EstateController extends Controller
{  
    protected $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function($request, $next){
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
        
        $estates = Estate::all();
        
        return view('estates')->with('estates', $estates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('landlord.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        //get file 
        
            $imageName = $request->input('name').'.'.$request->file('image')->getClientOriginalExtension();
        
        //get landlord id
        $landlord = Landlord::where('user', '=', $this->user->id)->first();
      
        $estate = new Estate;

        $estate->name = $request->input('name');
        $estate->town= $request->input('town');
        $estate->county = $request->input('county');
        $estate->area = $request->input('area');
        $estate->more_info = $request->input('more_info');
        $estate->landlord = $landlord->id;
        $estate->totalrooms = $request->input('totalrooms');
        $estate->availablerooms = $request->input('vaccant');
        $estate->type = $request->input('type');
        $estate->price = $request->input('price');
        // $estate->period = $request->input('period');
        // $estate->likes = $request->input('likes');
        // $estate->dislikes = $request->input('dislikes');
        $estate->image = $imageName;

        $estate->save();

        $image = $request->file('image');
        $destinationPath = storage_path().'/app/public/estates';

        $image->move($destinationPath, $imageName);

        
        // $this->show($estate->id);

        return view('estate.estatedetails')->with('estate', $estate)
                                            ->with('landlord', $landlord);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estate  $estate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $landlord = Landlord::where('user', '=', $this->user->id)->first();
        $estate = Estate::where('id', $id)->get();
        //  dd($estate[0]);
        
        return view('estate.estatedetails')->with('estate', $estate[0])
                                            ->with('landlord', $landlord);

    }

    //show estate details to customer

    public function showDetails($id)
    {
       
        $estate = Estate::where('id','=', $id)->get();
         $landlord = Landlord::where('id', '=', $estate[0]->landlord)->first();
        
        
        return view('estate.viewestate')->with('estate', $estate[0])
                                            ->with('landlord', $landlord);

    }

    //edit estate details

    public function edit($id)
    {       
        $estate = Estate::where('id', $id)->get();
        return view('estate.edit')->with('estate_old', $estate[0]);

    }

    //update
    public function update(Request $request){
        // return redirect('/home');
        $imageName = $request->input('name').'.'.$request->file('image')->getClientOriginalExtension();

        $estate =  Estate::findorfail($request->id);

        // dd($estate);

        $estate->name = $request->input('name');
        $estate->county = $request->input('county');
        $estate->town = $request->input('town');
        $estate->area = $request->input('area');
        $estate->more_info = $request->input('more_info');
        $estate->landlord = $landlord->id;
        $estate->totalrooms = $request->input('totalrooms');
        $estate->availablerooms = $request->input('vaccant');
        $estate->type = $request->input('type');
        $estate->price = $request->input('price');
        // $estate->period = $request->input('period');
        // $estate->likes = $request->input('likes');
        // $estate->dislikes = $request->input('dislikes');
        $estate->image = $imageName;

        $estate->save();

        $image = $request->file('image');
        $destinationPath = storage_path().'/app/public/estates';

        $image->move($destinationPath, $imageName);

        // return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estate  $estate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estate = Estate::findorfail($id);

        if($estate->delete()){
            return response([
                "status"=>"Success",
                "message"=>"Estate deleted",
                "data"=>new EstateResource($estate)
            ],200);
        }
    }
    
    //search estate
    public function search(Request $request){
        $estates = Estate::where('county', $request->county)->where('type', $request->type)->get();

        return view('estates')->with('estates', $estates);
    }

//show upadate vaccant rooms view
    public function showvaccant($id){
        $estate = Estate::findorfail($id);

        return view('landlord.vaccant')->with('value', $estate);
    }

    //update vaccant rooms
    public function updatevaccant(Request $request){
        
            $estate = Estate::findorfail($request->estate);

            $_available = $estate->availablerooms;

            $new_vaccant = $_available+$request->rooms;

            $estate->availablerooms = $new_vaccant;

            if($estate->save()){
                return redirect()->route('my-estates');
            }

    }

}
