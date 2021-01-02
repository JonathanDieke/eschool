@extends('layouts.app', ['script' => 'room'])


@section('content')

<div class="container-fluid">

    <div class="row">

        <x-form-component :titleCard="$titlecard" :models="$models" :dataform="$dataform" :select="$select" />

        {{-- <div class="card">
            <div class="card-header h4">Enregistrer une nouvelle salle</div>

            <div class="card-body">

                <form method="POST" action="{{ route('room.store') }}" >
                    @csrf
                    <div class="row">

                        <div class="col-sm-8">

                            <div class="form-group row">
                                <label for="code" class="col-sm-3 col-form-label">Code de la salle: </label>
                                <div class="col-sm-9">
                                    <input name="code" type="text" class="form-control" id="code">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="libel" class="col-sm-3 col-form-label">Libellé de la salle: </label>
                                <div class="col-sm-9">
                                    <input name="libel" type="text" class="form-control" id="libel">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="capacity" class="col-sm-3 col-form-label">Capacité de la salle: </label>
                                <div class="col-sm-9">
                                    <input name="capacity" type="number" min="20" max="40" class="form-control" id="capacity">
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-4">
                            @include('partials.__buttons')
                        </div>

                    </div>
                </form>

            </div>
        </div> --}}

        <div class="col-sm-7" id="table">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>
                        <div class='form-group form-check'>
                            <label class="form-check-label">#</label>
                        </div>
                    </th>
                    <th class="py-4">Code</th>
                    <th class="py-4">Libellé</th>
                    <th class="py-4">Capacité</th>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
