<div class="row">
    @foreach($motortypes as $motortype)
        <div class="col-md-2">
            <div class="motortypes-container">
                <div class="motortype">
                    <a href="{{route('chiptuning.details.index', [
                        'brand' => request('brand'), 'model' => request('model'), 'generation' => request('generation'),
                        'motortype' => $motortype->urlname
                        ])}}
                        ">
                        <button class="btn btn-primary">{{$motortype->name}}</button>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

