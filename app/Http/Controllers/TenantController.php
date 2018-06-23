<?php

namespace App\Http\Controllers;

use App\Tenant;
use Illuminate\Http\Request;
use App\Http\Resources\Tenant as TResource;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //t will mean tenants
        $t = Tenant::all();

        return TResource::collection($t);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $t = $request->IsMethod('put')?findorfail($request->id) : new Tenant;

        $t->name = $request->input('name');
        $t->email = $request->input('email');
        $t->phone = $request->input('phone');
        $t->photo = $request->input('photo');
        $t->user = $request->input('user');

        if($t->save()){
            return response([
                'status'=>'Success',
                'message'=>'Tenant saved to the system.',
                'data'=>new LResource($t)
            ],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $t = Tenant::findorfail($id);

        return new TRosource($t);
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        $t = Tenant::findorfail($id);

        if($t->delete()){
            return response([
                'status'=>'success',
                'message'=>'Account deleted',
                'data'=> new LResource($t)
            ],200);
        }
    }
}
