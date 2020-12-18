<div class="row">
    @foreach($models as $model)
        <div class="col-md-2">
            <div class="models-container">
                    <a href="{{route('chiptuning.details.index', ['brand' => request('brand'), 'model' => $model->urlname])}}">
                      <button class="model btn btn-primary">{{$model->name}}</button>
                    </a>
            </div>
        </div>
    @endforeach
</div>
