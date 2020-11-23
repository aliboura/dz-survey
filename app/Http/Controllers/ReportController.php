<?php

namespace App\Http\Controllers;

use App\Response;
use App\Page;
use App\Question;

use App\Result;
use App\Survey;
use App\Surveyreport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //

    function getBySurvey($survey) {

        $pages= Page::where('survey_id', '=', $survey)->get('id') ;
        //  return $page->questions();

        $questions= Question::whereIn('page_id', $pages)
            ->whereIn('type',array('SELECT','RADIO'))
            ->where('withNote',true)
            ->get();

     //     return $questions;


        $multiplied = $questions->map(function ($item, $key) {

           // $questionsDet=$item ->questions()-> orderBy('order', 'asc')->get();

            $questionsDet=DB::table('results')
                ->join('responses', 'results.response_code', '=', 'responses.code')
                ->select('results.response_code','responses.note','responses.text_fr','responses.text_ar',  DB::raw('count(*) as nbr'))
              //  ->where([ ['results.question_code','=',$item->code] ,['responses.hasNote','=',true] ] )
                ->where('results.question_code',$item->code)

                ->groupBy('results.response_code','responses.text_fr','responses.text_ar','responses.note')
                ->get();

            $questionsDet1=DB::table('results')
                ->select(  DB::raw('count(*) as nbr'))
                ->where('results.question_code',$item->code)
                ->groupBy('results.question_code')
                ->get();






            return array ("question_id"=>$item->id,"question_code"=>$item->code,
                "question_name_fr"=>$item->name_fr,
                "question_name_ar"=>$item->name_ar,
                "question_total_result"=>$questionsDet1[0]->nbr,

                "results"=>$questionsDet->all());
        });

//dd($multiplied);
        $out= array ("survey_id" =>$survey,"questions" => ($multiplied->all() ));

        return json_encode($out);



}


    function getByNote($survey) {

        $pages= Page::where('survey_id', '=', $survey)->get('id') ;

        $questions= Question::whereIn('page_id', $pages)
            ->whereIn('type',array('SELECT','RADIO'))
            ->get('code');



            // $questionsDet=$item ->questions()-> orderBy('order', 'asc')->get();

            $questionsDet=DB::table('results')
                ->join('responses', 'results.response_code', '=', 'responses.code')
                ->select('responses.note',  DB::raw('count(*) as nbr'))
                ->whereIn('results.question_code',$questions)
                ->where('responses.hasNote',true)

                ->groupBy('responses.note')
                ->get();

        $questionsDetAll=DB::table('results')
            ->join('responses', 'results.response_code', '=', 'responses.code')
            ->select(  DB::raw('count(*) as nbr'))
            ->whereIn('results.question_code',$questions)
            ->where('responses.hasNote',true)

            ->first();



//dd($multiplied);

      //  return json_encode($questionsDetAll->nbr);

        $out= array ("total" =>$questionsDetAll->nbr,"report_by_note" => ($questionsDet->all() ));

        return json_encode($out);



    }



    public function  getByFinalNote ($survey,$value1,$value2) {

    //  return "f";
      $op =array ('sup'=>'>','inf'=>'<','equal'=>'=');

        $questionsDet=DB::table('surveyreports')
            ->select(  DB::raw('count(*) as nbr'))
            ->where('surveyreports.survey_id',$survey)
            ->where('percentage','>=',$value1)
            ->where('percentage','<',$value2)

            //->having('nbr',$operator,$value)
          //  ->groupBy('surveyreports.percentage')
            ->first();

        $questionsAll=DB::table('surveyreports')
            ->select(  DB::raw('count(*) as nbr'))
            ->where('surveyreports.survey_id',$survey)
            //->having('nbr',$operator,$value)
            //  ->groupBy('surveyreports.percentage')
            ->first();

     //  return $questionsAll;


       // return json_encode($questionsAll);

        $out= array ("total" =>$questionsAll->nbr,"report_all" => ($questionsDet));

        return json_encode($out);
    }



  public function getSimpleReport($survey) {

  }


    public function show($survey)
    {
        return view('survey-report',['survey_id' => $survey]);

    }

    public function showAll($survey)
    {
        return view('survey-report-all',['survey_id' => $survey]);

    }
    public function showResult($survey)
    {
        return view('survey-report-result',['survey_id' => $survey]);

    }

}
