<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('simple-response/{response}', 'ResponseController@show');

//Route::get('survey-pages/{survey}', 'PageController@surveyPages');



//Route::post('formSubmit','FileController@formSubmit');



//Route::apiResource('questions', 'QuestionController');
//Route::apiResource('surveys', 'SurveyController');






//Route::apiResource('pages', 'PageController');
//Route::post('fs','FileController@formSubmitSurvey');

//Route::get('pages', 'PageController@index');


