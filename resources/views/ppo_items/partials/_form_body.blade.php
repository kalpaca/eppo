<?php
$isActive = isset($item->is_active) ? $item->is_active : true;
$isMitteInput = isset($item->is_mitte_reason) ? $item->is_mitte_reason : true;
$isRepeatInput = isset($item->is_repeat_input) ? $item->is_repeat_input : true;
$defaultSelection = [''=>'Please Select'];
$medications = $defaultSelection + $medications->toArray();
$ppos = $defaultSelection + $ppos->toArray();
?>
<div class="form-group col-md-6">
    {!! Form::hidden('is_active', false) !!}
    {!! Form::checkbox('is_active', null, $isActive) !!}
    {!! Form::label('is_active','Active for ppo ', ['class' => 'control-label']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('medication_id','Medication: ',['class' => 'control-label']) !!}
    {!! Form::select('medication_id',$medications, null, ['class'=>'form-control']) !!}
    <img id="loading" src="{{ asset('img/icon_loading.gif') }}" alt="Updating ..." />
</div>

<div class="form-group col-md-6">
    {!! Form::label('ppo_id','PPO: ',['class' => 'control-label']) !!}
    {!! Form::select('ppo_id', $ppos, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('ppo_section_id','PPO section: ',['class' => 'control-label']) !!}
    {!! Form::select('ppo_section_id',$ppoSections, null, ['class'=>'form-control']) !!}
</div>
<div class="col-md-12">
<hr>
</div>
<div class="col-md-6">

<div class="form-group clearfix">
    {!! Form::label('dose_calculation_type_id','Dose Calculation Type: ',['class' => 'control-label']) !!}
    {!! Form::select('dose_calculation_type_id',$doseCalculationTypes, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group width_100_percent">
    {!! Form::label('dose_base','Dose Base (for % or BSA): ',['class' => 'control-label']) !!}
    {!! Form::text('dose_base', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group width_100_percent">
    {!! Form::label('fixed_dose_result','Dose Result for report (if fixed): ',['class' => 'control-label']) !!}
    {!! Form::text('fixed_dose_result', null, ['class'=>'form-control']) !!}
    <p>*This attribute is only used for back end report; not for prescription display.</p>
</div>

<div class="form-group width_100_percent">
    {!! Form::label('dose_unit_id','Dose Unit: ',['class' => 'control-label']) !!}
    {!! Form::select('dose_unit_id',$doseUnits, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group width_100_percent hidden">
    {!! Form::label('dose_route_id','Dose Route: ',['class' => 'control-label']) !!}
    {!! Form::select('dose_route_id',$doseRoutes, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group width_100_percent">
    {!! Form::label('instruction','Fixed Instruction: ',['class' => 'control-label width_100_percent']) !!}
    {!! Form::textarea('instruction', null, ['class'=>'form-control width_100_percent', 'rows'=>"3"]) !!}
</div>
</div>

<div class="form-group col-md-6">
    {!! Form::hidden('is_instruction_input', false) !!}
    {!! Form::checkbox('is_instruction_input', null) !!}
    {!! Form::label('is_instruction_input','Show MD additional input ', ['class' => 'control-label']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::hidden('is_start_date', false) !!}
    {!! Form::checkbox('is_start_date', null) !!}
    {!! Form::label('is_start_date','Show start date input ', ['class' => 'control-label']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::hidden('is_frequency_input', false) !!}
    {!! Form::checkbox('is_frequency_input', null) !!}
    {!! Form::label('is_frequency_input','Show frequency input ', ['class' => 'control-label']) !!}
</div>


<div class="form-group col-md-6">
    {!! Form::hidden('is_duration_input', false) !!}
    {!! Form::checkbox('is_duration_input', null) !!}
    {!! Form::label('is_duration_input','Show duration input ', ['class' => 'control-label']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::hidden('is_mitte_input', false) !!}
    {!! Form::checkbox('is_mitte_input', null, $isMitteInput) !!}
    {!! Form::label('is_mitte_input','Show mitte input ', ['class' => 'control-label']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::hidden('is_repeat_input', false) !!}
    {!! Form::checkbox('is_repeat_input', null, $isRepeatInput) !!}
    {!! Form::label('is_repeat_input','Show repeat input ', ['class' => 'control-label']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('mitte_unit_id','Mitte Unit: ',['class' => 'control-label']) !!}
    {!! Form::select('mitte_unit_id', $mitteUnits, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group col-md-12">
    {!! Form::label('lucodes[]','Use "Ctrl" key to select mutiple LU Codes (if applicable): ',['class' => 'control-label']) !!}
    {!! Form::select('lucodes[]', $lucodes, $lucodesSelected, ['class'=>'form-control width_100_percent','multiple'=>'multiple','id'=>'lucodes']) !!}
</div>

<div class="col-md-12">
{!! Form::submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
</div>

<script>
yepnope([{
  load: '{{ asset('bower_components/jquery/dist/jquery.min.js')}}',
  complete: function () {

    $loadingDiv = $("#loading");

    //$templateDiv = $("#template");

    $lucodeDiv = $("#lucodes");

    $loadingDiv.hide();


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        beforeSend:function(){
            // show gif here, eg:
            $loadingDiv.show();
        },
        complete:function(){
            // hide gif here, eg:
            $loadingDiv.hide();
        }
    });
    //on drug selection change
    $('#medication_id').change(function(){
        var medId = $('#medication_id').val();
        var url = '/lucodes/ajaxListByMed/' ;
        //var url2 = '/ppoitems/ajaxGetListByMed/'+medId ;

        //get lucodes for new drug selection
        var lucodeRequest = $.ajax({
            type: 'POST',
            url: url,
            data: 'medid='+medId,
            dataType: 'json',

        })

        .done(function(data){
            //console.log(data.data);
            $lucodeDiv.empty();
            $.each(data, function( index, detail ) {
              $lucodeDiv.append("<option value='" +index+ "'>" +detail+ "</option>");
            });
        })

        .fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
        });
/*
        //get new ppo item templates for new drug selection
        var templateRequest = $.ajax({
            type: 'POST',
            url: url2,
            data: '',
            dataType: 'json',

        })

        .done(function(data){
            //console.log(data.data);
            $templateDiv.empty().append("<option value>(choose template)</option>");
            for (var j = 0; j < data.data.length; j++){
                var item = data.data[j];
                //console.log(item.PrescriptionForm.name + "--");
                $templateDiv.append("<option value='" +item.FormSpecificDrug.id+ "'>" +item.Drug.name+' '+item.FormSpecificDrug.dose_base_value+' for '+item.PrescriptionForm.name+ "</option>");
            }
        })

        .fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
        });
*/
    })
    //on template selection change
    /*
    $templateDiv.change(function(){
        var id = $templateDiv.val();
        window.location = '/ppoitems/add/templateId:'+id ;
    })
    $('#universal-tpl').click(function(){
        $('#instruction').html('po');
        $("#dose_unit").val(2);
        $("#dose_calculation_type").val(3);
        $("#is_frequency_input").prop('checked',true);
        $("#is_days_input").prop('checked',true);
        $("#mitte_unit").val("days");
    })*/
}
}]);
</script>