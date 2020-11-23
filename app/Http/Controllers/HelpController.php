<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HelpController extends Controller
{
  
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function thanks(Request $request)
    {
        
       // Cookie::make('survey_done', 'ok', 10);
       // return view('thanks')->withCookie(cookie('survey_done', 'ok', 10));
       // return response(view('thanks'))->withCookie(cookie('survey_done', 'ok', 120));

        $response = new \Illuminate\Http\Response(view('thanks'));
       // $response->withCookie(cookie('survey_done', "oki", 10));
        return $response;


    }
}
