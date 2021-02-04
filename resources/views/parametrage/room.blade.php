@extends('layouts.app', ['script' => 'room', "title" => "Room | "])


@section('content')

<div class="container-fluid">

    <div class="row">

        <x-form-component :titleCard="$titlecard" :models="$models" :dataform="$dataform" :select="$select" />

        <div class="col-lg-7 col-12" id="table">
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
