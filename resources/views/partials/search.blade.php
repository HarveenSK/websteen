<div class="search">
    <div class="form-container">
        <form id="chiptuningForm">
            <div class="form-group__container">
                <div class="form-group">
                    <select data-current="{{request('brand')}}" name="brand" class="form-control" id="brands">
                        <option value="none">Kies uw merk</option>
                    </select>
                </div>
                <div class="form-group">
                    <select data-current="{{request('model')}}" name="model" class="form-control" id="models">
                        <option value="none">Kies uw model</option>
                    </select>
                </div>
                <div class="form-group">
                    <select data-current="{{request('generation')}}" name="generation" class="form-control" id="generations">
                        <option value="none">Kies de generatie</option>
                    </select>
                </div>
                <div class="form-group">
                    <select data-current="{{request('motortype')}}" name="motortype" class="form-control" id="motortypes">
                        <option value="none">Kies de motortype</option>
                    </select>
                </div>
            </div>
            <div class="form-button__container">
                <input type="submit" class="btn btn-primary form-button " value="Info">
                <input type="submit" class="btn btn-danger form-button " value="Offerte">
            </div>
        </form>
    </div>
</div>
