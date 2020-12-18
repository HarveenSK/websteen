@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('partials.header')
            </div>
        </div>
        <div class="row search-row">
            <div class="col-md-12">
                @include('partials.search')
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="row details-container">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h2>Merk</h2>
                            </div>
                            <div class="card-body">
                                Naam: {{$detail->meta->make->name}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h2>Model</h2>
                            </div>
                            <div class="card-body">
                                Model: {{ $detail->meta->model->name }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h2>Generatie</h2>
                            </div>
                            <div class="card-body">
                                Naam: {{ $detail->meta->generation->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="row details-container">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>Motor</h2>
                            </div>
                            <div class="card-body">
                                <span>Naam: {{ $detail->data->name }}</span><br>
                                <span>Brandstof: {{ $detail->data->fuel_type }}</span><br>
                                <span>Standaard vermogen: {{ $detail->data->power->standard }}</span><br>
                                <span>Vermogen na tuning: {{ $detail->data->power->stage_1 }}</span><br>
                                <span>Standaard koppel: {{ $detail->data->torque->standard }}</span><br>
                                <span>Koppel na tuning: {{ $detail->data->torque->stage_1 }}</span><br>
                                <span>Cylinder inhoud: {{ $detail->data->cylinder_capacity }}</span><br>
                                <span>Motor nummer: {{ $detail->data->engine_code }}</span><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
