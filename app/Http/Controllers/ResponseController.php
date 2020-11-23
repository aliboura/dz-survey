<?php

namespace App\Http\Controllers;

use App\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    //

 /**
     * Display the specified resource.
     *
     * @param  \App\Page  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        
        return $response;
    }

    public function destroy(Response $response)
    {
       
        $response->delete();

    }

    public function update(Request $request, Response $response)
    {
        //

     //   'is_true'   'hasNote',,'note','complete_note','order']
        $response->update(['text_fr' => $request->text_fr,
        'text_ar' => $request->text_ar,
        'is_true' => $request->is_true,
        'hasNote' => $request->hasNote,
        'note' => $request->note,
        'complete_note' => $request->complete_note,
        'order' => $request->order,

        ]);

        return "success";
    }

}
