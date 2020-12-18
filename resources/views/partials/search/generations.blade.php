<div class="row">
    @foreach($generations as $generation)
        <div class="col-md-2">
            <div class="generations-container">
                <a href="{{route('chiptuning.details.index', [
                    'brand' => request('brand'), 'model' => request('model'), 'generation' => $generation->urlname
                    ])}}">
                    <button class="btn btn-primary">{{$generation->name}}</button>
                </a>
            </div>
        </div>
    @endforeach
</div>

