<?php

namespace App\Http\Controllers;

use App\Page;
use App\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class SurveyController extends Controller
{




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Survey::all();
    }

    function getListView () {
        $surveys=Survey::all();
        return view('survey-list',['surveys' => $surveys]);

    }
    function test () {
        $uid = Str::uuid()->toString();
        return $uid;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



           $survey = new Survey([
               'name' => $request->get('name'),
               'title' =>  $request->get('title'),
               'subtitle' =>  $request->get('subtitle'),
               'color' =>   $request->get('color'),
               'shape' =>  $request->get('shape'),
               'using_icons' =>  $request->get('using_icons'),
               'description' =>  $request->get('description'),
               //'uid' =>$uid,

               'active' =>  $request->get('active'),
               'has_notes' =>  $request->get('has_notes'),
               'total_notes' =>  $request->get('total_notes'),
               'with_auth' =>  $request->get('with_auth'),

   
           ]);
           $survey->saveOrFail();
           $id=$survey->id;


           $uid=md5(uniqid($id, true));


           $updateSurvey=Survey::find($id) ;
           $updateText="SURVEY_".$id;
   
           Survey::where('id', $id)->update(
               ['code'=>$updateText,'uid'=>$uid]);
   
           // POST route at /post-route
       if ($survey->has('pages')) {
   
           foreach ( $request->get('pages') as $answer) {
                   $response = new Page([
                      // 'username' => Auth::user()->name,
                      //'category' => $request->category,
                       //'year' => $request->year,
                       'survey_id' =>$id,
                       'name_fr' => $answer['name_fr'],
                       'name_ar' => $answer['name_ar'],
                   ]);
   
   
               $response->saveOrFail();
               $idResp=$response->id;
             //  $updateResp=Response::find($idResp) ;
               $updateTextResp="RESPONSE_".$idResp;
       
               Page::where('id', $idResp)->update(['code'=>$updateTextResp]);
   
               }
   
       }
          return 'success';
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */

    public function  simpleShow(Survey $survey){

        return ($survey);

    }

    public function show($survey)
    {
        //

        $pages =Page::where('survey_id', '=', $survey)->get(["id","name_fr"]);

        $multiplied = $pages->map(function ($item, $key) {
        
           $questionsDet=$item ->questions()-> orderBy('order', 'asc')->get();
        
           $questionsDet1 = $questionsDet->map(function ($item, $key) {
        
            return array ("question_id"=>$item->id,"question_code"=>$item->code , "question_order"=>$item->order,
                "type"=>$item->type,"question_name"=>$item->name_fr ,"responses"=> $item ->responses()->get(["code","name_fr"]));
        
           });
        
        
        
           return array ("page_id"=>$item->id,"page"=>$item->name_fr ,"questions"=> $questionsDet1);
        });
        
        //dd($multiplied);
        $out= array ("suervey_id" =>$survey,"pages" => ($multiplied->all() ));
        
         return json_encode($out);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {


        $survey->update(['name' => $request->name,
        'description' => $request->description,'color' => $request->color,
        'title' => $request->title,'subtitle' => $request->subtitle,
        'using_icons'=>$request->using_icons,
        'shape' => $request->shape ,

        'active' =>  $request->active,
        'has_notes' =>  $request->has_notes,
        'total_notes' =>  $request->total_notes,
        'with_auth' =>  $request->with_auth
        ]);

/********** */
if ($request->has('pages')) {

    //Response::destroy([1, 2, 3]);


       foreach ( $request->get('pages') as $answer) {

   
               $response = new Page([
                   'survey_id' =>$survey->id,
                   'name_ar' => $answer['name_ar'],
                   'name_fr' => $answer['name_fr'],
               ]);


           $response->saveOrFail();
           $idResp=$response->id;
         //  $updateResp=Response::find($idResp) ;
           $updateTextResp="RESPONSE_".$idResp;
   
           Page::where('id', $idResp)->update(['code'=>$updateTextResp]);

           }

   }
/********** */

      return "sucess";
  
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }

    public function edit($survey)
    {
        return view('survey-edit',['survey_id' => $survey]);

    }

    public function trello($survey)
    {
        return view('survey-trello',['survey_id' => $survey]);

    }

    public function config($survey)
    {
        return "config";
      //  return view('survey-edit',['survey_id' => $survey]);

    }
}
