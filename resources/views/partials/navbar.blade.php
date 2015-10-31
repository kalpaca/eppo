<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ asset('/') }}">ePPO</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="{{ asset('/') }}">Home</a></li>
        <li><a href="{{ asset('/about') }}">About</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('ppos.index') }}">PPOs</a></li>
            <li><a href="{{ route('ppoitems.index') }}">PPO Items</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ route('diagnoses.index') }}">Diagnoses</a></li>
            <li><a href="{{ route('regimens.index') }}">Regimens</a></li>
            <li><a href="{{ route('medications.index') }}">Medications</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">Misc.</li>
            <li><a href="{{ route('lucodes.index') }}">LU Codes</a></li>
            <li><a href="{{ route('doseunits.index') }}">Dose Units</a></li>
            <li><a href="{{ route('doseroutes.index') }}">Dose Routes</a></li>
            <li><a href="{{ route('dosecalculationtypes.index') }}">Dose Calculation Types</a></li>
            <li><a href="{{ route('dosemodificationreasons.index') }}">Dose Modification Reasons</a></li>
            <li><a href="{{ route('mitteunits.index') }}">Mitte Units</a></li>
            <li><a href="{{ route('diagnosisprimarycategories.index') }}">Diagnosis Primary Categories</a></li>
            <li><a href="{{ route('diagnosissecondarycategories.index') }}">Diagnosis Secondary Categories</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Login</a></li>
        <li><a href="#">Sign up</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>