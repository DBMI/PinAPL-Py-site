@foreach (config('parameters.parameter_groups') as $group => $parameters)
	@continue($group == "Required" || $group == "Library Parameters")
	#if counts provided continue
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