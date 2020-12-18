const url = 'http://case-harveen.vm/api/';
const homePage = 'http://case-harveen.vm/chiptuning/';
const document = $(document);
const body = $("body");

const brandsId = "#brands";
const modelsId = "#models";
const generationsId = "#generations";
const motortypesId = "#motortypes";

const brandsList = $(brandsId);
const modelsList = $(modelsId);
const generationsList = $(generationsId);
const motorsList = $(motortypesId);

const modelsListText = "Kies uw model";
const generationsListText = "Kies uw generatie";
const motorsListText = "Kies uw motortype";

const form = "#chiptuningForm";

let brand;
let model;
let generation;
let motortype;

function makePromise(addition) {
    return $.ajax({
        url: url + addition,
        type: 'get',
        dataType: 'application/json',
        async: false
    });
}

function getBrands() {

    let promise = makePromise('brands');
    return JSON.parse(promise.responseText);
}

function setBrands(list) {
    let selected = (list.length === 1);
    $.each(list, (index, brand) => {
        brandsList.append(new Option(brand.name, brand.urlname, false, selected));
        if(selected === true) {
            getAndSetModels(brand.urlname);
        }
    });
}

function getModels(slag) {

    let promise = makePromise(`models/${slag}`);
    return JSON.parse(promise.responseText)
}

function setModels(list) {
    resetOptions(modelsList, modelsListText);
    resetOptions(generationsList, generationsListText);
    resetOptions(motorsList, motorsListText);
    let selected = (list.length === 1);
    $.each(list, (index, model) => {
        modelsList.append(new Option(model.name, model.urlname, false, selected));
        if(selected === true) {
            getAndSetGenerations(model.urlname);
        }
    });
}

function getGenerations(slag) {
    let promise = makePromise(`generations/${brand}/${slag}`);
    return JSON.parse(promise.responseText);
}

function setGenerations(list) {
    resetOptions(generationsList, generationsListText);
    resetOptions(motorsList, motorsListText);
    let selected = (list.length === 1);
    $.each(list, (index, generation) => {
        generationsList.append(new Option(generation.name, generation.urlname, false, selected));
        if(selected === true) {
            getAndSetMotortypes(generation.urlname)
        }
    });
}

function getMotortypes(slag) {

    let promise = makePromise(`motortypes/${brand}/${model}/${slag}`);
    return JSON.parse(promise.responseText);
}

function setMotortypes(list) {
    resetOptions(motorsList, motorsListText);
    let selected = (list.length === 1);
    $.each(list, (index, motor) => {
        motorsList.append(new Option(motor.name, motor.urlname, false, selected));
    });
}

function getAndSetBrands() {
    let brands = getBrands();
    setBrands(brands.data);
}

function getAndSetModels(slag) {
    let models = getModels(slag);
    setModels(models.data);
}

function getAndSetGenerations(slag) {
    let generations = getGenerations(slag);
    setGenerations(generations.data);
}

function getAndSetMotortypes(slag) {
    let motortypes = getMotortypes(slag);
    setMotortypes(motortypes.data);
}

function resetOptions(list, text) {
    list.empty().append('<option value="none">'+text+'</option>');
}

function setUrlSelected() {
    let currentVal = brandsList.attr('data-current');

    if(currentVal.length > 0) {
        brandsList.val(currentVal).change();
        brandsList.attr('data-current', '');
    }

    currentVal = modelsList.attr('data-current');
    if(currentVal.length > 0) {
        modelsList.val(currentVal).change();
        modelsList.attr('data-current', '');
    }

    currentVal = generationsList.attr('data-current');
    if(currentVal.length > 0) {
        generationsList.val(currentVal).change();
        generationsList.attr('data-current', '');
    }

    currentVal = motorsList.attr('data-current');
    if(currentVal.length > 0) {
        motorsList.val(currentVal).change();
        motorsList.attr('data-current', '');
    }
}

document.ready(() => {
    getAndSetBrands();
    setUrlSelected();
});

body.on("change", brandsId, (e) => {

    let slag = e.target.value;
    brand = slag;

    if(slag === 'none') {
        resetOptions(motorsList, motorsListText);
        resetOptions(modelsList, modelsListText);
        resetOptions(generationsList, generationsListText);
    } else {
        getAndSetModels(slag);
    }
});

body.on("change", modelsId, (e) => {

    let slag = e.target.value;
    model = slag;

    if(slag === 'none') {
        resetOptions(generationsList, generationsListText);
        resetOptions(motorsList, motorsListText);
    } else {
        getAndSetGenerations(slag);
    }
});

body.on("change", generationsId, (e) => {

    let slag = e.target.value;
    generation = slag;

    if(slag === 'none') {
        resetOptions(motorsList, motorsListText);
    } else {
        getAndSetMotortypes(slag);
    }
});

body.on('submit', form, (e) => {

    e.preventDefault();

    brand = brandsList.val();
    model = modelsList.val();
    generation = generationsList.val();
    motortype = motorsList.val();

    let url = homePage;
    if(brand !== 'none'){
        url += `${brand}`;
    }
    if(model !== 'none'){
        url += `/${model}`;
    }
    if(generation !== 'none'){
        url += `/${generation}`;
    }
    if(motortype !== 'none'){
        url += `/${motortype}`;
    }

    window.location.href = url;

});
