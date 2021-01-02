@extends('layouts.app', ["script" => "course"])

@section('content')

@csrf
<div class="container">

    @include("partials.__guideMessage", ["goal" => "Pour rechercher une séance de cours"])

    <form class="form-inline offset-sm-1 offset-2 my-5">

        <label class="sr-only" for="register">Matricule du professeur</label>
        <input type="text" class="form-control mb-2 mr-sm-2" id="register" name="register" placeholder="Matricule...">

        <label class="sr-only" for="subject_code">Code la matière</label>
        <input type="text" class="form-control mb-2 mr-sm-2" id="subject_code" name="subject_code" placeholder="Matière...">

        <label class="sr-only" for="classroom_code">Code la classe</label>
        <input type="text" class="form-control mb-2 mr-sm-2" id="classroom_code" name="classroom_code" placeholder="Classe...">

        <button type="submit" class="ml-3 btn btn-primary mb-2 search-course">Soumettre</button>
    </form>

    <table class="my-5 table table-striped text-center">
        <thead>
            <td>Date</td>
            <td>Professeur</td>
            <td>Matière</td>
            <td>Classe</td>
            <td>Absents</td>
            <td>Actions</td>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>
@endsection
