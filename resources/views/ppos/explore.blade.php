@extends('layouts.form')
@section('title','PPO explorer')
@section('formTitle','PPO explorer')
@section('formContent')
<div class="col-md-12 pri-cat">
	<h4 id="pri-cat-heading">Select Primary Categories: </h4>		
	<div class="btn-group btn-group-sm pri-cat-btn-group" role="group">					
		<button type='button' class='btn btn-sm btn-default pri-cat-btn all' data-filter="all">All</button>		
		{{-- Make button-group for primary categories --}}
		@foreach ( $primaryCats as $cat) 
			<button type='button' class='btn btn-sm btn-default pri-cat-btn' data-filter="pri-cat-{{ $cat->id }}">
			{{$cat->name}}</button>
		@endforeach		  	
	</div>
</div>
<div class="col-md-12 sec-cat">
	<h4 class="hidden" id="sec-cat-heading">Select Secondary Category (Optional):</h4>
		{{--Make a combined secondary-categories-button-group for all primary categories--}}  
		<div class='btn-group btn-group-sm sec-cat-btn-group hidden' role='group' id='all-group'>
		@foreach ( $primaryCats as $primCat) 							
			@foreach ( $primCat->secondaryCats as $secCat) 
				<button type='button' class='btn btn-sm btn-default sec-cat-btn' data-filter="sec-cat-{{ $secCat->id }}">
				{{$secCat->name}}</button>
			@endforeach
		@endforeach	
		</div>
	{{--Make separate secondary-categories-button-groups for every primary categories--}}  
	@foreach ( $primaryCats as $primCat) 	
		<div class='btn-group btn-group-sm sec-cat-btn-group hidden' role='group' id="pri-cat-{{ $primCat->id }}-group">
		@foreach ( $primCat->secondaryCats as $secCat) 
			<button type='button' class='btn btn-sm btn-default sec-cat-btn' data-filter="sec-cat-{{ $secCat->id }}">
			{{$secCat->name}}</button>
		@endforeach
		</div>
	@endforeach		
</div>			
<div class="col-md-12 ppo-lead-container">	
	<h4 class="hidden" id="ppo-lead">
	<span id="number-of-available"></span> regimen form(s) available under 
	<span id="current-cat"></span>. Click one form to open it:
	</h4>
</div>	
<!-- PPO LIST CONTAINER  --> 
<div id="ppo-container" class="clearfix col-md-12">	
@foreach ( $ppos as $ppo)
	@foreach( $ppo->diagnoses as $diagnosis) 
	<?php
	$primCatId = 'pri-cat-'.$secondaryCats[$diagnosis->diagnosis_secondary_category_id];
	$secCatId = 'sec-cat-'.$diagnosis->diagnosis_secondary_category_id;
	$url = route('prescriptions.create', ['id' => $ppo->id]);
	?>
	<!-- PPO item start -->
	<a href="{{ $url }}" class="list-group-item ppo {{$primCatId}} {{$secCatId}}" data-groups="{{$primCatId}},{{$secCatId}}">
		<h5>{{$ppo->regimen->name}}</h5>
		<small> for {{$diagnosis->name}}</small>
	</a>
	<!-- PPO item end -->
	@endforeach
@endforeach
</div>
@endsection