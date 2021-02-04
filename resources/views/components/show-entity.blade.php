<div class="container d-flex justify-content-center col-sm-10">

    <div class="card " style="width: 18rem;">
        <img src="{{ asset('storage')."/".$model["avatar"] }}" class="card-img-top" alt="{{ 'pricture profile' }}" styel="height:150px; width:150px">
        {{--  <img src="{{ asset("$model['avatar']") '}}" class="card-img-top" alt="{{ 'pricture profile' }}" styel="height:150px; width:150px">  --}}

        <div class="card-body">
            <ul class="list-group list-group-flush">
                @for ($i = 0, $len = $model->count(); $i < $len; $i++)
                    @if ($i === 0 )
                        <div class="card-body">
                            <h5 class="card-title">
                                <li class="list-group-item text-center">{{ $model->values()[$i] }} </li>
                            </h5>
                        </div>
                    @elseif($i === ($len-1) )
                    @else
                        <li class="list-group-item"> {{ $model->keys()[$i] }}  <span class="text-muted"> {{ $model->values()[$i] }}</span></li>
                    @endif
                @endfor
            </ul>
        </div>

        <div class="card-footer">
            <button class="btn btn-outline-success btn-block" id="print-one"> <i class="fa fa-print"></i> Imprimer </button>
        </div>
    </div>
</div>
