@extends('layouts.app', ["script" => "rating", "title" => "Rating | "])

@section('content')

<div class="container">

    @include('partials.__guideMessage', ["goal" => "Pour afficher/modifier les notes des élèves d'une classe."])

    <div class="card">
        <div style="display:none" class="card-header h4">Enregistrer une évaluation</div>

        <div class="card-body">

            <div class="container">
                <div class="col-sm-12">
                    <form method="POST">
                    @csrf
                        <div class="row flex-center">

                            <div class="col-sm-12">

                                <div class="form-group row">
                                    <label for="register" class="col-sm-4 col-form-label text-md-right">Matricule du professeur : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="register" class="form-control" id="register">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="subject_code" class="col-sm-4 col-form-label text-md-right">Code de la matière : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="subject_code" class="form-control" id="subject_code">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="classroom_code" class="col-sm-4 col-form-label text-md-right">Code de la classe : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="classroom_code" class="form-control" id="classroom_code">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-block btn-outline-primary"  id="btn-rating"> <i class="fa fa-edit"></i> Noter</button>

                    </form>
                </div>

            </div>

        </div>
    </div>

</div>


@endsection
