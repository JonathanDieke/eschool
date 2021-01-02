@extends('layouts.app', ['script' => 'category'])


@section('content')

<div class="container-fluid">

    <div class="row">

                <x-form-component :titleCard="$titleCard" :models="$models" :dataform="$dataform" :select="$select" />

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

@endsection
