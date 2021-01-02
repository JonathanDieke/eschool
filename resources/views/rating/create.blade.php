@extends('layouts.app')

@section('content')

<div class="">

    <div class="container jumbotron jumbotron-fluid">
        <div class="container">
            <div class="container row">
                <div class="col-sm-5">
                    <h2> <u class="font-weight-bold"> PROFESSEUR : </u> </h2>
                    <p><span class="font-weight-bold"> Nom et prenoms : </span>  {{ $teacher->fullname }}</p>
                    <p><span class="font-weight-bold"> Matricule : </span>  {{ $teacher->register }}</p>
                </div>
                <div class="col-sm-4">
                    <h2> <u class="font-weight-bold"> CLASSE : </u> </h2>
                    <p><span class="font-weight-bold"> Code : </span>  {{ $classroom->code }}</p>
                    <p><span class="font-weight-bold"> Libellé : </span>  {{ $classroom->libel }}</p>
                </div>
                <div class="col-sm-3">
                    <h2> <u class="font-weight-bold"> Matière : </u> </h2>
                    <p><span class="font-weight-bold"> Code : </span>  {{ $subject->code }}</p>
                    <p><span class="font-weight-bold"> Libellé : </span>  {{ $subject->libel }}</p>
                </div>
            </div>
        </div>
    </div>

    @if ($classroom->student->count() > 0)

        <div class="container-fluid mb-3">
            <button class="btn btn-outline-secondary" id="print-one"><i class="fa fa-print"></i> Imprimer</button>
        </div>

        <form action="{{ route('rating.store') }}" method="post" class="container-fluid">
            @csrf

            <div class="col-sm-12">

                <table class="table table-striped  text-center">
                    <thead>
                        <th>
                            <div class='form-group form-check'>
                                <label class="form-check-label" >#</label>
                            </div>
                        </th>
                        <th class="py-4">Matricule</th>
                        <th class="py-4">Nom et prénom</th>
                        <th class="py-4">Interrogation 1</th>
                        <th class="py-4">Interrogation 2</th>
                        <th class="py-4">Interrogation 3</th>
                        <th class="py-4">Devoir</th>
                        <th class="py-4">Examen</th>
                    </thead>
                    <tbody>
                        <input type="hidden" name="subject_code" value="{{ $subject->code }}">
                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                        @foreach ($classroom->student as $student)
                            <input type="hidden" name="student[]" value="{{ $student->id }}">
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->register }}</td>
                                <td>{{ $student->fullname }}</td>
                                <td>
                                    <input type="number" name="qz1[]" class="form-control-sm" min="0" max="20" value="{{ $student->getRate($subject->code, $teacher->id)->qz1 ?? '0' }}">
                                </td>
                                <td>
                                    <input type="number" name="qz2[]" class="form-control-sm" min="0" max="20" value="{{ $student->getRate($subject->code, $teacher->id)->qz2 ?? '0'}}">
                                </td>
                                <td>
                                    <input type="number" name="qz3[]" class="form-control-sm" min="0" max="20" value="{{ $student->getRate($subject->code, $teacher->id)->qz3 ?? '0'}}">
                                </td>
                                <td>
                                    <input type="number" name="assignment[]" class="form-control-sm" min="0" max="20" value="{{ $student->getRate($subject->code, $teacher->id)->assignment ?? '0'}}">
                                </td>
                                <td>
                                    <input type="number" name="examen[]" class="form-control-sm" min="0" max="20" value="{{ $student->getRate($subject->code, $teacher->id)->examen ?? '0'}}">
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <button class="btn btn-outline-success btn-block my-4 container"> <i class="fa fa-save"></i> Sauvegarder</button>

            </div>

        </form>

    @else

        <div class="alert alert-dark col-sm-6 container text-center" role="alert">
            <h2> Pas de données à afficher</h2>

        </div>

    @endif



</div>

@endsection
