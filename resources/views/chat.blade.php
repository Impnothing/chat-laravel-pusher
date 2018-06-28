@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tweets</div>

                <div class="panel-body">
                    <chat-tweets :tweets="tweets"></chat-tweets>
                </div>
                <div class="panel-footer">
                    <chat-form
                        v-on:tweetsent="addTweet"
                        :user="{{ Auth::user() }}"
                    ></chat-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection