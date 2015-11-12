@extends('layouts.master')
@section('title','PPO Items')
@section('content')
<h2>PPO Items</h2>

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