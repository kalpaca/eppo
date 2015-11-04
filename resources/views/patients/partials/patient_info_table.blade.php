@if($patient)
<table class="table table-bordered patient-info">
<tbody>
<tr>
    <td class="col-md-6">
    <strong>Patient: </strong>  {!! link_to_route('patients.show', $patient->name, $patient->id) !!}
    </td>
    <td class="col-md-6">
    <strong>Date of Birth: </strong>  {{$patient->dob}}
    </td>
</tr>
</tbody>
</table>
@endif