@foreach (config('pinapl_config.parameter_groups') as $group => $parameters)
	@continue($group == "Required" || $group == "Library Parameters")
	<fieldset>
		<legend>{{ $group }}</legend>
		<div class="row">
			@foreach ($parameters as $paramName => $parameter)
				@if (!($parameter['hidden'] ?? false))
					@include('layouts.input',["name" => $paramName, "parameter"=>$parameter])
				@endif
			@endforeach
		</div>
	</fieldset>
@endforeach