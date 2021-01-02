@extends('layouts.app', ['script' => 'student', "title" => "Student | "])

@section('content')


<div class="container-fluid">

    {{-- <student-component></student-component> --}}

    <div class="row">

        <x-form-component :titleCard="$titlecard" :models="$models" :dataform="$dataform" :select="$select" />

        <div class="col-sm-7" id="table">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead>
                    <th>
                        <div class='form-group form-check'>
                            <label class="form-check-label" >#</label>
                        </div>
                    </th>
                    <th class="py-4">Matricule</th>
                    <th class="py-4">Classe</th>
                    <th class="py-4">Nom et prénom</th>
                    <th class="py-4">Date de naissance</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>

</div>


@endsection
