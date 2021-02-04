@extends('layouts.app', ['script' => 'classroom', "title" => "Create | "])


@section('content')
    <div class="container-fluid">

        <div class="row">

            <x-form-component :titleCard="$titlecard" :models="$models" :dataform="$dataform" :select="$select" />

            <div class="col-lg-7 col-12 " id="table">
                <div class="">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>
                                    <div class='form-group form-check'>
                                        <input type='checkbox' class='form-check-input'>
                                        <label class='form-check-label'>#</label>
                                    </div>
                                </th>
                                <th class="py-4">Salle</th>
                                <th class="py-4">Code</th>
                                <th class="py-4">Libelle</th>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>
            </div>

        </div>
    </div>

@endsection

