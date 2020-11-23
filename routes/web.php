<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/adm', function () {
    return view('auth.login');
});


Route::get('/', function () {
    return view('auth.login');
});
//Auth::routes();
Auth::routes(['register' => false]);


//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home', 'SurveyController@getListView')->name('home');



/*********client******/
//Route::get('client-survey/{id}/show', 'ClientSurveyController@show');

//after  submit results
//Route::post('fs','FileController@formSubmitSurvey');
//Route::post('fs','FileController@formSubmitSurvey');
Route::post('submit','ClientSurveyController@formSubmitSurvey');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
        Route::get('client-survey/{id}/show', 'ClientSurveyController@show');
        Route::get('pages/{survey}', 'PageController@getSurveyQuestionsForUser');

        Route::get('/index', function () {
        return view('index-page',['lang' => 'fr']);
    });


    });

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/

/*********admin ******/
Route::group(['middleware' =>'auth'],function() {
    Route::get('/survey/{id}/edit', 'SurveyController@edit')->name('survey.manage.edit');

    Route::get('/survey/{id}/trello', 'SurveyController@trello')->name('survey.manage.trello');
    
    Route::get('/survey/{id}/report', 'ReportController@show')->name('survey.manage.report');
    Route::get('/survey/{id}/report-all', 'ReportController@show')->name('survey.manage.report-all');
    Route::get('/survey/{id}/report-result', 'ReportController@show')->name('survey.manage.report-result');
    
    
    
    
    Route::get('/survey/{id}/config', 'SurveyController@config')->name('survey.manage.config');
    
    Route::get('/surveys', 'SurveyController@getListView')->name('surveys.manage.list');
    Route::get('/home', 'SurveyController@getListView')->name('surveys.manage.list');

  
    /* apis admin  */
    Route::get('/ad-api/surveys', 'SurveyController@index');
    /* end api admins */

    //Route::apiResource('surveys', 'SurveyController');
   //Route::post('/surveys', 'SurveyController@store')->name('surveys.manage.add.survey');

   Route::get('ad-api/pages/{survey}', 'PageController@getSurveyQuestions');
   Route::get('ad-api/questions/delete/{question}', 'QuestionController@destroy');
   Route::post('ad-api/questions', 'QuestionController@store');
   Route::post('ad-api/questions/{question}', 'QuestionController@update');


   Route::get('ad-api/simple-pages/{page}', 'PageController@show');
   Route::get('ad-api/pages/delete/{page}', 'PageController@destroy');
   Route::post('ad-api/pages/update/{page}', 'PageController@update');
   Route::post('ad-api/pages', 'PageController@store');


   Route::post('ad-api/surveys', 'SurveyController@store');
   Route::get('ad-api/surveys/simple/{survey}','SurveyController@simpleShow')->name('surveys.simpleshow');
   Route::post('ad-api/surveys/{survey}', 'SurveyController@update');


   Route::get('ad-api/survey-reports/{id}', 'ReportController@getBySurvey');
   Route::get('ad-api/survey-reports/note/{id}', 'ReportController@getByNote');
   Route::get('ad-api/survey-reports/all/{id}/{operator}/{value}', 'ReportController@getByFinalNote');

   Route::get('ad-api/survey-pages/{survey}', 'PageController@surveyPages');
   Route::post('ad-api/questions/modif-page/{question}/{page}', 'QuestionController@modifPage');


   Route::get('ad-api/question/{id}/edit', 'QuestionController@getQuestion')->name('question.manage.edit');
  
  
   Route::get('ad-api/simple-response/{response}', 'ResponseController@show');
   Route::get('ad-api/response/delete/{response}', 'ResponseController@destroy');
   Route::post('ad-api/response/update/{response}', 'ResponseController@update');

    // ad-api/questions/delete/
 //  Route::apiResource('questions', 'QuestionController');
    
});


/********************************* */
Route::get('{path}',"HomeController@index")->where('path','[-a-z0-9_\s]+');