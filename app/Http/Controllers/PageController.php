<?php

namespace App\Http\Controllers;

use App\Page;
use App\Survey;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       return  Page::all();
    }


    public function surveyPages(Survey $survey) {
      //  return $survey->pages();
        $pages =Page::where('survey_id', '=', $survey->id)->get(["id","name_fr"]);
       // return $pages;

        $multiplied = $pages->map(function ($item, $key) {

            $questionsDet=$item ->questions()-> orderBy('order', 'asc')->get();





          return array ("page_id"=>$item->id,"page"=>$item->name_fr ,"questions"=> $questionsDet);
         });

         //dd($multiplied);
         $out= array ("suervey_id" =>$survey,"pages" => ($multiplied->all() ));

          return json_encode($out);

    }



   public function jsonHandler (Request $request) {
     $attendees= ($request)->get('attendees');
  //   dd($attendees)
    // foreach ($item in $attendees)
    // endforeach
   }

    public function getSurveyPages($survey) {
      //  Page::fin

      $page= Page::where('survey_id', '=', $survey)->get() ;
    //  return $page->questions();

    }

    public function getSurveyQuestions($survey) {
        //  Page::fin
        $srvIcons=Survey::find($survey)->using_icons;

        $pages =Page::where('survey_id', '=', $survey)->orderBy('order', 'asc')->get(["id","name_fr","name_ar","icone"]);


$multiplied = $pages->map(function ($item, $key) {

   $questionsDet=$item ->questions()-> orderBy('order', 'asc')->get();

   $questionsDet1 = $questionsDet->map(function ($item, $key) {

    return array ("question_id"=>$item->id,"question_code"=>$item->code , "question_order"=>$item->order,
        "type"=>$item->type,"question_name"=>$item->name_fr,"question_text"=>$item->text_fr
        ,"responses"=> $item ->responses()->get(["id","code","name_fr","text_fr"]));

   });



   return array ("page_id"=>$item->id,"page_icone"=>$item->icone,"page"=>$item->name_fr ,"questions"=> $questionsDet1);
});

//dd($multiplied);
$out= array ("suervey_id" =>$survey,"using_icons"=>$srvIcons,"pages" => ($multiplied->all() ));

 return json_encode($out);

      }


      public function getSurveyQuestionsForUser($survey) {
        //  Page::fin
       // $s=Survey::find($survey);
       // return empty($s);
        if(empty(Survey::find($survey))) return "err";
        $active=Survey::find($survey)->active;
        if (empty($active)) return "err";


        $lang=LaravelLocalization::getCurrentLocale();
        $srvIcons=Survey::find($survey)->using_icons;
        $srvTotalNote=Survey::find($survey)->total_notes;

        $pages =Page::where('survey_id', '=', $survey)->orderBy('order', 'asc')->get(["id","name_".$lang." as name","icone"]);


$multiplied = $pages->map(function ($item, $key) {
  $lang=LaravelLocalization::getCurrentLocale();

   $questionsDet=$item ->questions()-> orderBy('order', 'asc')
   ->get(["id","name_".$lang." as question_name","text_".$lang." as question_text","type","code","order","page_id","rules"]);

   $questionsDet1 = $questionsDet->map(function ($item, $key) {
    $lang=LaravelLocalization::getCurrentLocale();

    return array ("question_id"=>$item->id,"question_code"=>$item->code , "question_order"=>$item->order,
        "type"=>$item->type,"question_name"=>$item->question_name , "question_text"=>$item->question_text,
        "responses"=> $item ->responses()-> orderBy('order', 'asc')->get(["id","code","name_".$lang." as name","text_".$lang." as text","order","question_id"]));

   });



   return array ("page_id"=>$item->id,"page_icone"=>$item->icone,"page"=>$item->name ,"questions"=> $questionsDet1);
});

//dd($multiplied);
$out= array ("suervey_id" =>$survey,"total_notes"=>$srvTotalNote,"using_icons"=>$srvIcons,"pages" => ($multiplied->all() ));

 return json_encode($out);

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
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
        return $page;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //


        $page->update(['name_fr' => $request->name_fr,
        'name_ar' => $request->name_ar,
        'description_fr' => $request->description_fr,
        'description_ar' => $request->description_ar,
        'icone' => $request->icone
        ]);

        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
      $page->delete();
      return "suceess";
    }
}
