<?php

namespace App\Http\Controllers;

use App\Page;
use App\Question;
use App\Response;
use App\Survey;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return   Question::all();
    }

    public function getQuestion($id) {

        $question=Question::find($id);
        $responses =Response::where('question_id', '=', $id)->get();

       //dd ($responses);
        $out= array ("id" =>$question->id,
        "name_fr" =>$question->name_fr,
        "name_ar" =>$question->name_ar,
        "text_fr" =>$question->text_fr,
        "text_ar" =>$question->text_ar,
        "type" =>$question->type,
        "page_id" =>$question->page_id,
        "rules" =>$question->rules,
        "order" =>$question->order,
        "withNote" =>$question->withNote,

        "responses"=>$responses);
        
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
        
       // $survey_id=Page::select('survey_id')->where('id',$request->get('page_id'));
       $survey_obj=Page::select('survey_id')->where('id', '=', $request->get('page_id'))->first();

     $survey_id=  $survey_obj['survey_id'];
     //return $survey_id;
        $question = new Question([
            'page_id' => $request->get('page_id'),
            'name_fr' =>  $request->get('name_fr'),
            'name_ar' =>  $request->get('name_ar'),
            'order' =>   $request->get('order'),
            'text_fr' =>  $request->get('text_fr'),
            'text_ar' =>  $request->get('text_ar'),
            'type' =>  $request->get('type'),
            'withNote' =>$request->get('withNote'),
            'rules' =>$request->get('rules')


        ]);
        $question->saveOrFail();
        $id=$question->id;
        //$question->update(['code' => 'QUESTION_'.$question->id]);
        //$question->saveOrFail();

        $updateQuestion=Question::find($id) ;
        $updateText="QUESTION_".$id;

        Question::where('id', $id)->update(['code'=>$updateText]);

        // POST route at /post-route
    if ($request->has('responses')) {

     // dd(  $request->get('responses'));
   
/*
        foreach ($request->get('reponses') as $k=>$v) {
            $response = new Response([
                'text_fr' => $k['reponse_fr'],
                'text_ar' => $k['reponse_ar']
            ]);
  */
            foreach ( $request->get('responses') as $answer) {
                $response = new Response([
                   // 'username' => Auth::user()->name,
                   //'category' => $request->category,
                    //'year' => $request->year,
                    'question_id' =>$id,
                    'text_ar' => $answer['response_ar'],
                    'text_fr' => $answer['reponse_fr'],
                ]);


            $response->saveOrFail();
            $idResp=$response->id;
          //  $updateResp=Response::find($idResp) ;
            $updateTextResp="RESPONSE_".$idResp;
    
            Response::where('id', $idResp)->update(['code'=>$updateTextResp]);

            }

    }
       return 'success';
      //  return redirect()->route('survey.manage', ['id' => $survey_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return $question;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
     

        $question->update(['name_fr' => $request->name_fr,
        'name_ar' => $request->name_ar,'text_fr' => $request->text_fr,
        'text_ar' => $request->text_ar,'type' => $request->type,
        'withNote' =>$request->withNote,'rules' =>$request->rules,
        'order' =>$request->order

        ]);
     
        if ($request->has('responses')) {

            //Response::destroy([1, 2, 3]);

            Response::where('question_id', $question->id)->delete();

               foreach ( $request->get('responses') as $answer) {


                       $response = new Response([
                           'question_id' =>$question->id,
                           'text_ar' => $answer['text_ar'],
                           'text_fr' => $answer['text_fr']
                       ]);
       
       
                   $response->saveOrFail();
                   $idResp=$response->id;
                 //  $updateResp=Response::find($idResp) ;
                   $updateTextResp="RESPONSE_".$idResp;
           
                   Response::where('id', $idResp)->update(['code'=>$updateTextResp]);
       
                   }
       
           }
     
     
     
        return $question;



    //  return redirect()->route('survey.manage', ['id' => $survey_id]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
       
        $question->delete();

    }

    public function modifPage(Request $request, Question $question,$page) {

      $question->update([
          'page_id'=>$page
      ]);
        return "success";
    }
    
}
