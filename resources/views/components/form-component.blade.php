<div class="col-sm-5" id="container">

    <div class="card">
        <div style="display:none" class="card-header h4 titleCard">{{ $titleCard }}</div>

        <div class="card-body">

            <div class="container">
                <form method="POST" id="save-form" @if(Route::is('student.create')) action="{{  route('student.store') }}" @endif enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-sm-8" id="inputs">
                            @csrf 
                            @foreach ($dataform as $data)
                                @if ($loop->first && $select)
                                    <div class="form-group row">
                                        <label for="{{ $data["for"] }}" class="col-sm-5 col-6 col-form-label">{{ $data["label"] }}</label>
                                        <div class="col-sm-7 input">
                                            <select name="{{ $data["for"] }}" class="form-control" id="{{ $data["for"] }}">
                                                @foreach ($models as $model)
                                                    <option value="{{ $model->id }}">
                                                        {{ $model->libel }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group row">
                                        <label for="{{ $data["for"] }}" class="col-sm-5 col-6 col-form-label"> {{ $data["label"] }} </label>
                                        <div class="col-sm-7 input">
                                            <input name="{{ $data["for"] }}" type="{{ $data["type"] }}" class="form-control" id="{{ $data["for"] }}">
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if (Route::is('student.create') || Route::is('teacher.create'))
                                <div class="form-group row">
                                    <label for="avatar" class="col-sm-5 col-6 col-form-label"> Photo : </label>
                                    <div class="col-sm-7 input">
                                        <input name="avatar" type="file" class="form-control" id="avatar">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <x-form-buttons/>

                            <div>
                                <ul class="list-group list-group-flush errors mt-4">
                                </ul>
                            </div>

                        </div>

                    </div>

                </form>
            </div>

        </div>

        <div>
            <form id="delete-form"></form>
        </div>
    </div>

</div>
