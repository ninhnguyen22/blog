@extends('layouts.cv')

@section('content')
    <div class="container-fluid profile-box" style="width: auto;">
        <div class="row">
            <div class="col-md-12 rt-div">
                <div class="rit-cover">
                    <h2 class="rit-titl"> {{ $_data['_main']->title }}</h2>
                    <div class="about">
                        <i>{{ $_data['_main']->updated_at }}</i>
                        <hr>
                        <i>{{ $_data['_main']->preview }}</i>
                        <hr>
                        {!! Markdown::convertToHtml($_data['_main']->content) !!}
                        <div class="btn-ro row no-margin">
                            <ul class="btn-link">
                                <li>
                                    <a href="/"><i class="fas fa-paper-plane"></i> Home</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
