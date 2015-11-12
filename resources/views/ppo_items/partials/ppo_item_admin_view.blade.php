<div class="margin_bottom_10 clearfix ppo-item-admin-view">
    @include('ppo_items/partials/ppo_item_inputs')
    <div class="col-md-12">
    @if($item->is_active)
        <span>Active </span>
    @else
        <span>Deactivated </span>
    @endif
        <small>Schedule id </small>
        <span>{{ $item->id }}</span>
        <small>belongs to PPO #</small>
        <span>{{ $item->ppo_id }}</span> -
        <span>{!! link_to_route('ppos.show', $item->ppo->name, $item->ppo_id, array('class' => '')) !!}</span> -
        <span>{{ $item->ppoSection->name }}</span>
    </div>
    <div class="col-md-12 margin_bottom_10">
        <small>Created at</small>
        <span>{{ $item->created_at }}</span>
        <small>Updated at</small>
        <span>{{ $item->updated_at }}</span>

    </div>
</div>