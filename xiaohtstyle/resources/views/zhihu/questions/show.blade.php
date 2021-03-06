@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$question->title}}
                        @foreach($question->topics as $topic)
                            <span class="topic">{{ $topic->name }}</span>
                        @endforeach
                    </div>

                    <div class="panel-body">
                        {!! $question->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
