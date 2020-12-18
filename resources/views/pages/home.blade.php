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
        @if($errors->any())
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger mt-5">
                            {{$errors->first()}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="company-name__container">
                    <h2>{{$header}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                    @if(isset($brands))
                        @include('partials.search.brands')
                    @endif

                    @if(isset($models))
                        @include('partials.search.models')
                    @endif

                    @if(isset($generations))
                        @include('partials.search.generations')
                    @endif

                    @if(isset($motortypes))
                        @include('partials.search.motortypes')
                    @endif
            </div>
        </div>
    </div>
@endsection
