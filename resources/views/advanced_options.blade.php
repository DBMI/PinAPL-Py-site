@foreach (config('pinapl_config.parameter_groups') as $group => $parameters)
	@continue($group == "Required" || $group == "Library Parameters")
	<fieldset>
		<legend>{{ $group }}</legend>
		<div class="row">
			@foreach ($parameters as $paramName => $parameter)
				@include('layouts.input',["name" => $paramName, "parameter"=>$parameter])
			@endforeach
		</div>
	</fieldset>
@endforeach