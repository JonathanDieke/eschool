@inject('date', 'Carbon\Carbon')

@extends('layouts.app', ['script' => 'rating', "title" => "Course | "])

@section('content')


<div class="container">

    @if (! session()->has('registered'))
        @include('partials.__guideMessage', ["goal" => "Pour enregistrer une séance de cours."])
    @endif


    <div class="my-2 d-flex flex-row-reverse bd-highlight">
        <a class="btn btn-outline-primary text-primary" href="{{ route('course.create') }}">Rechercher un cours</a>
    </div>

    <div class="card">

        <div style="display:none" class="card-header h4">
            <i class="fa fa-book-open"></i> Enregistrer une séance de cours
        </div>

        <div class="card-body">

            <div class="col-sm-12">

                <form method="post" action="{{ route('course.store') }}" id="save-form-teacher">
                    @csrf
                    <div class="row flex-center position-ref">

                        <div class="col-sm-12">

                            <div class="form-group row">
                                <label for="register" class="col-sm-4 col-form-label text-md-right">Matricule du professeur : </label>
                                <div class="col-sm-6">
                                    <input name="register" type="text" class="form-control" id="register">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subject_code" class="col-sm-4 col-form-label text-md-right">Code de la matière : </label>
                                <div class="col-sm-6">
                                    <input name="subject_code" type="text" class="form-control" id="subject_code">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="classroom_code" class="col-sm-4 col-form-label text-md-right">Code de la classe : </label>
                                <div class="col-sm-6">
                                    <input name="classroom_code" type="text" class="form-control" id="classroom_code">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date" class="col-sm-4 col-form-label text-md-right">Date du cours : </label>
                                <div class="col-sm-6">
                                    <input name="date" type="date" value="{{ $date::now()->format("Y-m-d") }}" class="form-control" id="date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="missing" class="col-sm-4 col-form-label text-md-right">Nombre d'absents : </label>
                                <div class="col-sm-6">
                                    <input name="missing" type="number" min="0" value="0" class="form-control" id="missing">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-block btn-outline-primary"> <i class="fa fa-save"></i> Enregistrer</button>

                </form>

            </div>

        </div>
    </div>
</div>
@endsection
