@extends('layouts.default')
@extends('layouts.table')


@section("title")
<h1>{{Lang::get("general.States")}}</h1>
@stop

@section("sub-title")
{{Lang::get("general.TypeVehicles")}}
@stop

@section('breadcrumbs', Breadcrumbs::render('typevehicle'))

@section('actions')
{!!Form::actions(array('new' => route("typevehicle.create")))!!}
@stop

@section('table')
@if (count($typevehicles) > 0)
<table class='table table-striped table-bordered table-hover'>
    <thead>
        <tr>
            <th>{{Lang::get("general.id")}}</th>
            <th>{{Lang::get("general.name")}}</th>     
            <th>{{Lang::get("general.Actions")}}</th>
        </tr>
    </thead>
    @foreach($typevehicles as $typevehicle) 
        <tr>
            <td><a href="{{route('typevehicle.edit', $typevehicle->id)}}">{{$typevehicle->id}}</a></td>
            <td><a href="{{route('typevehicle.edit', $typevehicle->id)}}">{{$typevehicle->name}}</a></td>
            <td>
                {!!Form::delete(route('typevehicle.destroy',$typevehicle->id))!!}
            </td>
        </tr>
    @endforeach
</table>


@else
<div class="alert alert-info">
    {{Lang::get("general.norecordsfound")}}
</div>
@endif
                           
@stop

@section("script")

@stop