<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\userContactInfo;
class userContactInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function index($status,$awb)
    {
        return view('userContact',\compact('awb','status'));
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
    public function store(Request $request, $status, $awb)
    {
        $this->validate($request,[
            'contactPhoneNumber' => 'required|unique:userInfoContact',
            'contactEmail' => '',
            'contactTimingFrom' => 'required',
            'contactTimingTo' => 'required'
        ]);

        $userContactSaveNow = new userContactInfo([
            'awb' => $awb,
            'contactPhoneNumber' => $request->get('contactPhoneNumber'),
            'contactEmail' => $request->get('contactEmail'),
            'contactTimingFrom' => $request->get('contactTimingFrom'),
            'contactTimingTo' => $request->get('contactTimingTo')]
        );

       $userContactSaveNow->save();
       return redirect()->route('statusEdit', ['status' => 4, 'awb' => $awb]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
