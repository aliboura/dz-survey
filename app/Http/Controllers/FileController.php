<?php

namespace App\Http\Controllers;

use App\Question;
use App\Response;
use App\Result;
use App\Survey;

use App\Surveyreport;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Session ;


class FileController extends Controller
{
    const COMPLETED_SURVEY_SESSION_KEY = 'completed_survey';



    public function formSubmit(Request $request)
    {

        $fileName = time().'.'.$request->file->getClientOriginalExtension();
        $file_ext= $request->file->getClientOriginalExtension();
              //  $request->file->move(public_path('upload'), $fileName);
         $path=$request->file->store('file');

        return response()->json(['success'=>'You have successfully upload file. ' . $path .' extension'  . $file_ext]);
    }

    public function formSubmitSurvey (Request $request) {

        $survey_total_note=Survey::find(1)->total_notes;
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

    public function displayForm (Request $request) {

        $request->session()->put('id', 'value');

    }




}
