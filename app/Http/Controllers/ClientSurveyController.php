<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Question;
use App\Response;
use App\Result;

use App\Surveyreport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ClientSurveyController extends Controller
{
    //

    public function show(Request $request,$id)
    {

        
        $survey= Survey::find($id);
        if ( isset ($survey['active']) &&  $survey['active']==true ) {
        
       // return "ddd";
        return view('user-survey',['survey_id' => $id,'lang'=>'fr','color' =>$survey->color,'shape'=> $survey->shape,
        'surveytitle'=> $survey->title,'surveysubtitle'=>$survey->subtitle ]);
        }else 
        {
            return abort(404);

        }
    }

    public function formSubmitSurvey (Request $request) {

        $survey_total_note=Survey::find($request->get('survey_id'))->total_notes;
        //return $survey_note;
     //   return redirect()->route('thanks');

        //  return $fullNote;
       // $responseNote=Response::select('note')->where('code','RESPONSE_399')->first('note')->note;
       //return $responseNote;
        $totalScore=0;

      foreach ($request->get('formData') as $questionId => $answer) {

           $responseNote=Response::select('note')->where('code',$answer)
            ->where('hasNote',true)->first('note');
           if ($responseNote) {
           $responseNoteValue=$responseNote['note'];
           $totalScore=$totalScore+$responseNoteValue;
           }
        $response = new Result([
              //'session_id' => $session_id,
              'question_code' => $questionId,
              'response_code' => $answer,
              'survey_id'  =>$request->get('survey_id'),
              'user'  =>$request->get('user')

          ]);

          $response->saveOrFail();



      }

        $survey_report=new  Surveyreport([
            'survey_id' => $request->get('survey_id'),
            'note' => $totalScore,
            'total_note'=>$survey_total_note,
            'percentage'=>($totalScore/$survey_total_note)*100
        ]);
        $survey_report->saveOrFail();
    // return redirect()->route('thanks');

     return response()->json(['success'=>'yes','note'=>$totalScore]);


    }
}
