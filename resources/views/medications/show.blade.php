@extends('layouts.master')
@section('title',$medication->name)
@section('content')
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
<h4>Dosing schedules on different PPOs</h4>
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