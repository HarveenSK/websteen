<div class="row company-logo__container">
    @foreach($brands as $brand)
        <div class="col-md-2">
            <div class="logo">
                <a href="{{route('chiptuning.details.index', ['brand' => $brand->urlname])}}">
                    <img src="{{$brand->logo->thumb}}" alt="{{$brand->name}} logo">
                </a>
            </div>
        </div>
    @endforeach
</div>
