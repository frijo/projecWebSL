@extends('layouts.layout')

@section('cabecera')
    @parent
@stop

@section('cuerpo')
	@parent

	{{ HTML::ul($errors->all() )}}
@if (Session::has('message'))
	<div >{{ Session::get('message') }}</div>
@endif
<div>
	{{ Form::open(array('url'=>'upload','method' => 'post','files' => true ))}}

		<br>
			{{ Form::label('uploadAudio', 'Select Song') }}
			{{ Form::file('audio') }}
			</br>
			{{ Form::label('File', 'Convert To') }}
			{{ Form::select('extTo', array('mp3' => 'MP3', 'wav' => 'WAV'), 'MP3')}}
			</br>
			{{ Form::submit('Star format convertion') }}

	{{ Form::close()}}
	
</div>
	
@stop