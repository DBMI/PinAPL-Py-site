{{-- Provided variables
$sections 	=>	Array of "section_key" => "Section Display Name"
$selfName
--}}
<ul class="tabs" data-tabs id="{{ $selfName }}-sections-tabs">
	@foreach ($sections as $key=>$value)
		@if ($loop->first)
			<li class="tabs-title is-active"><a href="#{{ $key }}_tab" aria-selected="true">{{ $value }}</a></li>
		@else
			<li class="tabs-title"><a href="#{{ $key }}_tab">{{ $value }}</a></li>
		@endif
	@endforeach
</ul>
<div class="tabs-content" data-tabs-content="{{ $selfName }}-sections-tabs">
	@foreach ($sections as $key=>$value)
		<div class="tabs-panel @if($loop->first) is-active @endif" id="{{ $key }}_tab">
			@include("results.$key")
		</div>
	@endforeach
</div>