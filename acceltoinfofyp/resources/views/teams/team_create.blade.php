@extends('admin.nav')
@section('content')
<form action = "/createTeam" method = "post">
	<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<label>Team Name</label>
<input type='text' name='name' />
<br>
<label>Team Principal</label>
<input type='text' name='team_principal' />
<br>
<label>Engine Supplier</label>
<input type='text' name='engine_supplier' />
<br>
<label>Constructors Championships</label>
<input type='text' name='constructors_championships' />
<br>
<label>Driver 1</label>
<input type='text' name='driver1' />
<br>
<label>Driver 2</label>
<input type='text' name='driver2' />
<br>
	<input type = 'submit' value = "Add Driver"/>
</form>
@endsection