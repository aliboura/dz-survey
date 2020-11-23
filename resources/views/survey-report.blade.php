@extends('layouts.admin1')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <survey-report survey_id={{$survey_id}}></survey-report>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
