@extends('layouts.master')
@section('title',$medication->name)
@section('content')
<!-- Basic information section -->
<h2>{{$medication->name}}
<p class="pull-right btn-group">
{!! link_to_route('medications.edit', 'Edit', $medication->id, array('class' => 'btn btn-small btn-primary')) !!}

{!! link_to_route('medications.index', 'Index', null, array('class' => 'btn btn-small btn-primary')) !!}
</p>
</h2>
<p><strong>Common Instruction: </strong>
@if($medication->instruction)
{{$medication->instruction}}
@else
none
@endif
</p>
<hr>
<!-- LU codes section -->
<h4>Lucodes</h4>
<p>{!! link_to_route('lucodes.create', 'Add new LU Code', ['medid' => $medication->id]) !!}</p>
<hr>
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
        <td>{{ $lucode->name }}</td>
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
<h4>Dosing schedules on different PPOs</h4>
<p>{!! link_to_route('ppos.index', 'Add new dosing schedule to PPOs') !!}</p>
<hr>
@if(!$items->count())
    <p>No data.</p>
@else
    <div class='form-inline'>
        <?php $index = 0;?>
        @foreach($items as $item)
            @include('ppo_items/partials/ppo_item_admin_view', compact('index'))
            <?php $index++; ?>
        @endforeach
    </div>
    {!! $items->render() !!}
@endif



@endsection