@extends('layouts.app', ['script'=>'teacher'])

@section('content')
<div class="container-fluid">
    <h2 class="text-center text-bold py-4">Enseignants et Catégories</h2>

    <div id="tabs">

        <ul>
            <li><a href="#tabs-1">Enseignants</a></li>
            <li><a href="#tabs-2">Catégories</a></li>
        </ul>

        <div id="tabs-1">
            <div class="row">

                <div class="col-sm-5" id="container-teacher">

                    <div class="card">

                        <div style="display:none" class="card-header h4" id="titleCardTeacher">
                            Enregistrer un nouveau professeur
                        </div>

                        <div class="card-body">
                            <form method="post" action="{{ route('teacher.store') }}" id="save-form-teacher" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-sm-8">

                                        <div class="form-group row">
                                            <label for="register" class="col-sm-3 col-form-label">Matricule : </label>
                                            <div class="col-sm-9">
                                                <input name="register" type="text" class="form-control" id="register">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="category_id" class="col-sm-3 col-form-label">Catégorie : </label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="category_id" id="category_id">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->libel }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="subject_id" class="col-sm-3 col-form-label">Matière enseignée : </label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="subject_id" id="subject_id">
                                                    @foreach ($subjects as $s)
                                                        <option value="{{ $s->id}}">{{ $s->libel }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="fullname" class="col-sm-3 col-form-label">Nom et Prénom: </label>
                                            <div class="col-sm-9">
                                                <input name="fullname" type="text" class="form-control" id="fullname">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-sm-3 col-form-label">E-mail : </label>
                                            <div class="col-sm-9">
                                                <input name="email" type="email" class="form-control" id="email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="birthday" class="col-sm-3 col-form-label">Date de naissance : </label>
                                            <div class="col-sm-9">
                                                <input name="birthday" type="date" class="form-control" id="birthday">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="birthplace" class="col-sm-3 col-form-label">Lieu de naissance : </label>
                                            <div class="col-sm-9">
                                                <input name="birthplace" type="text" class="form-control" id="birthplace">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="avatar" class="col-sm-3 col-form-label"> Photo : </label>
                                            <div class="col-sm-9 input">
                                                <input name="avatar" type="file" class="form-control" id="avatar">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        @include('partials.__buttons')

                                        <div>
                                            <ul class="list-group list-group-flush errors mt-4" id="errors-teacher">
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>

                </div>

                <div class="col-sm-7" id="col-sm-7-teacher">
                    <table class="table table-striped table-bordered text-center" id="table-teacher">
                        <thead>
                            <th>id</th>
                            <th>Matricule</th>
                            <th>Categorie</th>
                            <th>Matière</th>
                            <th>Nom et prenom</th>
                            <th>E-mail</th>
                        </thead>

                        <tbody id="tbodyTeacher">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div id="tabs-2">
            <div class="row">

                <x-form-component :titleCard="$titleCard" :models="$models" :dataform="$dataform" :select="$select" />

                    {{-- <div class="card">
                        <div class="card-header h4">Enregistrer une nouvelle catégorie</div>

                        <div class="card-body">

                            <div>
                                <form method="POST" action="{{ route('category.store') }}" id="form-category">
                                    @csrf
                                    <div class="row">

                                        <div class="col-sm-8">

                                            <div class="form-group row">
                                                <label for="code" class="col-sm-3 col-form-label">Code de la catégorie: </label>
                                                <div class="col-sm-9">
                                                    <input name="code" type="text" class="form-control" id="code">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="libel" class="col-sm-3 col-form-label">Libellé de la catégorie </label>
                                                <div class="col-sm-9">
                                                    <input name="libel" type="text" class="form-control" id="libel">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-sm-4">
                                            @include('partials.__buttons')
                                        </div>

                                    </div>
                                </form>

                            </div>

                        </div>
                    </div> --}}

                <div class="col-sm-7" id="table">
                    <table class="table table-striped table-bordered text-center" id="table-category">
                        <thead>
                            <th>
                                <div class='form-group form-check'>
                                    <input type='checkbox' class='form-check-input '>
                                    <label class="form-check-label" >#</label>
                                </div>
                            </th>
                            <th class="py-4">Code</th>
                            <th class="py-4">Libellé</th>
                        </thead>

                        <tbody id="tbodyCategory">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
