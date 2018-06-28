@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" enctype="multipart/form-data" action="{{ url('/profile') }}">
        <input type="hidden" name="idHidden" class="form-control usrName" id="usr" value="{{ Auth::user()->id }}">
        <div class="row" id="name-profile">
            <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 text-white">
                <img id="user-img" src="{{ isset($data)? asset('/storage/'.Auth::user()->name.'/'.$data) : asset('img/user-icon.png') }}" height='150' width='150' alt="Not Available">
            </div>
            <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 ">
                <h1 id="h1-name" class="text-white">{{ Auth::user()->name }}</h1>
            </div>
        
        </div>
        <div class="row justify-content-end" id="">        
            <button id="edit-profile" type="button" class="btn btn-danger">Editar</button>       
        </div>
        <div class="row" id="data">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="usr" class="text-white" >Nombre:</label>
                <input type="text" name="user-name" class="form-control usrName" id="usr" value="{{ Auth::user()->name }}" disabled>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="email" class="text-white">Email:</label>
                <input type="text" name="user-email" class="form-control usrMail" id="usr" value="{{ Auth::user()->email }}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="image" class="text-white">Subir imagen</label>
                <input type="file" name="image" class="form-control usrFile" id="usr" disabled>
            </div>
        </div>
        <br>
        <div class="row">
            {{csrf_field()}}
			{{method_field('PUT')}}
            <input id="changeProfile" type="submit" value="Guardar cambios" class="btn btn-primary btn-block" disabled>
        </div>
    </form>
</div>
@endsection