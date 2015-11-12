@include('ppos/partials/ppo_inputs_head')
@if(isset($isAdminView))
<p class="text-center"><a href="{{route('ppoitems.create',['ppoid'=>$ppo->id])}}">Add medication dosing schedule to this ppo</a></p>
@endif
@include('ppos/partials/ppo_inputs_rx')
@include('ppos/partials/ppo_inputs_tail')