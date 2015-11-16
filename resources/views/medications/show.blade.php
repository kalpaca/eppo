@extends('layouts.panel')
@section('title',$medication->name)

@section('panelHeading',$medication->name)
@section('panelBody')
{!! link_to_route('medications.edit', 'Click to edit common information', $medication->id, array('class' => 'btn btn-xs btn-primary')) !!}
<!-- Basic information section -->
<h3>Common Instruction</h3>
@if($medication->instruction)
<p>{{$medication->instruction}}</p>
@else
<p>none</p>
@endif
@if($medication->is_eap)
<p>This medication has EAP approval input.</p>
@endif
@if($medication->is_rev_aid)
<p>This medication has RevAid enrollment input.</p>
@endif
<hr>
<!-- LU codes section -->
<h3>Lucodes</h3>
<p>{!! link_to_route('lucodes.create', 'Add new LU Code', ['medid' => $medication->id]) !!}</p>

@if(!$lucodes->count())
<p>No data.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Description</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lucodes as $lucode)
        <tr>
        <td>{{ $lucode->id }}</td>
        <td>{{ $lucode->code }}</td>
        <td>{{ $lucode->description }}</td>
        <td>{{ $lucode->created_at }}</td>
        <td>{{ $lucode->updated_at }}</td>
        <td>
        {!! link_to_route('lucodes.edit', 'Update', $lucode->id, array('class' => 'btn btn-info')) !!}
        </td>
        <td>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('lucodes.destroy', $lucode->id))) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
<hr>
<!-- Dosing schedules section -->
<h3>Dosing schedules on different PPOs</h3>
<p>{!! link_to_route('ppos.index', 'Add new dosing schedule to PPOs') !!}</p>

@if(!$items->count())
    <p>No data.</p>
@else
    <div class='form-inline'>
        <?php $index = 0;?>
        @foreach($items as $item)
            @include('ppo_items/partials/ppo_item_admin_view', compact('index'))
            <?php $index++; ?>
            <hr>
        @endforeach
    </div>
    {!! $items->render() !!}
@endif



@endsection