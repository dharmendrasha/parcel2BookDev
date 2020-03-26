<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\parcelBookStepsModel;
class parcelBookStepsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new($steps,$awb)
    {
        //confirm the awb is correct or not
        $awbNum = DB::table('parcelBook')->where('awbNumber', $awb)->get();
        //printf($awb);
        $totalSteps = 7;
        $nextStep = $steps+1;

         if($awbNum['0']->awbNumber){
             $theStepSave = new parcelBookStepsModel([
                 'userId' => $awbNum['0']->id,
                 'awbNumber' => $awbNum['0']->awbNumber,
                 'totalSteps' => $totalSteps,
                 'stepsComplete' => $steps,
                 'nextStep' => $nextStep
             ]);
             $theStepSave->save();

             flash(__('message.parcelSuccess',['awb' => $awb]))->success();

             return redirect()->route('basicPlan',['awb' => $awb]);
        }else{
           flash(__('message.parcelError'))->error();
           return redirect()->route('index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function edit($steps,$awb)
    {
        DB::update('update userSteps set stepsComplete = ? where awbNumber = ?', [$steps,$awb]);

        //flash(__('message.parcelSuccess', ['awb' => $awb]))->success();
        //return redirect()->route('index');
        //redirect the user to the differrent routes
        $nextStep = $steps+1;
        switch ($nextStep) {
            case '3':
                flash(__('message.parcelSuccess', ['awb' => $awb]))->success();
                return redirect()->route('userInfo', ['awb' => $awb]);
                break;
            case '4':
                flash(__('message.parcelSuccess',['awb'=>$awb]))->success();
                return redirect()->route('userContact', ['status' => $nextStep, 'awb' => $awb]);
            break;
            case '5':
                flash(__('message.parcelSuccess', ['awb' => $awb]))->success();
                return redirect()->route('extraRegistration',['awb' => $awb]);
            break;
            case '6':
                flash(__('message.allStepsHasBeenCompleted'))->success();
                return redirect()->route('home');
            break;

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($steps,$awb,$selectedOffer)
    {
        $awbNum = DB::table('parcelBook')->where('awbNumber', $awb)->get();
        //printf($awb);
        $totalSteps = 7;
        $nextStep = $steps+1;
        //echo $nextStep;
        //put the data into the table 'userprofile'
        DB::insert('insert into userProfile (userid, awb, selectedOfferId) values (?, ?, ?)', [$awbNum[0]->id, $awb, $selectedOffer]);

        DB::update('update userSteps set stepsComplete = ? where awbNumber = ?', [$steps,$awb]);

        //flash(__('message.parcelSuccess', ['awb' => $awb]))->success();
        //return redirect()->route('index');
        //redirect the user to the differrent routes
        $nextStep = $steps+1;
        switch ($nextStep) {
            case '3':
                flash(__('message.parcelSuccess', ['awb' => $awb]))->success();
                return redirect()->route('userInfo', ['awb' => $awb]);
                break;
            case '4':
                flash(__('message.parcelSuccess',['awb'=>$awb]))->success();
                return redirect()->route('index');
        }
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

    public function track(){
        if(isset($_POST['awbNumber'])){
            $awbNumb = $_POST['awbNumber'];
            //check the awb number is correct or not
            $checkAwb = DB::select('select * from parcelBook where awbNumber = ?', [$awbNumb]);
            //check the awb number
            $countRecord = count($checkAwb);
            if($countRecord === 1){
               //confirm the status is all the important steps has been cleared
                $checkTheStatus = DB::select('select * from usersteps where awbNumber = ?', [$awbNumb]);
                $status = $checkTheStatus[0];
                if($status->totalSteps > $status->stepsComplete){
                   $nextStep = $status->stepsComplete+1;

                   switch ($nextStep) {

                    case '1':
                    flash(__('message.incompleteStep',['awb' => $awbNumb]))->success();
                    flash('this is fromparcelBookStepsController@track')-error();
                    return view('welcome',['awb' => $awbNumb, 'status' => $nextStep]);
                    break;
                    case '2':
                    flash(__('message.incompleteStep',['awb' => $awbNumb]))->success();
                    flash('this is fromparcelBookStepsController@track')-error();
                    return view('choosePlan',['awb' => $awbNumb, 'status' => $nextStep]);
                    break;
                    case '3':
                        flash(__('message.incompleteStep',['awb' => $awbNumb]))->success();
                        flash('this is fromparcelBookStepsController@track')-error();
                        return view('userInfo',['awb' => $awbNumb, 'status' => $nextStep]);
                        break;
                    case '4':
                        flash(__('message.incompleteStep',['awb' => $awbNumb]))->success();
                        flash('this is fromparcelBookStepsController@track')-error();
                        return view('userContact',['awb' => $awbNumb, 'status' => $nextStep]);
                        break;
                    case '5':
                        flash(__('message.incompleteStep',['awb' => $awbNumb]))->success();
                        flash('this is fromparcelBookStepsController@track')-error();
                        return view('welcome',['awb' => $awbNumb, 'status' => $nextStep]);
                        break;
                    case '6':
                        flash(__('message.incompleteStep',['awb' => $awbNumb]))->success();
                        flash('this is fromparcelBookStepsController@track')-error();
                        return view('welcome',['awb' => $awbNumb, 'status' => $nextStep]);
                        break;
                    case '7':
                        flash(__('message.incompleteStep',['awb' => $awbNumb]))->success();
                        flash('this is fromparcelBookStepsController@track')-error();
                        return view('welcome',['awb' => $awbNumb, 'status' => $nextStep]);
                        break;
                    default:
                    flash(__('message.incompleteStep',['awb' => $awbNumb]))->success();
                    flash('this is fromparcelBookStepsController@track')-error();
                    return view('welcome',['awb' => $awbNumb, 'status' => $nextStep]);
                    break;
                   }

                }
            }else{
               flash(__('message.parcelError'))->error();
               return redirect()->route('index');
            }
        }
    }
}
