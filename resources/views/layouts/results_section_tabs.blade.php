{{-- Provided variables
$sections 	=>	Array of "section_key" => "Section Display Name"
--}}
<ul class="tabs" data-tabs id="result-sections-tabs">
	@foreach ($sections as $key=>$value)
		@if ($loop->first)
			<li class="tabs-title is-active"><a href="#{{ $key }}_tab" aria-selected="true">{{ $value }}</a></li>
		@else
			<li class="tabs-title"><a href="#{{ $key }}_tab">{{ $value }}</a></li>
		@endif
	@endforeach
</ul>
<div class="tabs-content" data-tabs-content="result-sections-tabs">
	@foreach ($sections as $key=>$value)
		<div class="tabs-panel @if($loop->first) is-active @endif" id="{{ $key }}_tab">
			<div class="row align-center">
				<div class="column" id="{{ $key }}_content">
					@include("results.$key")
				</div>
			</div>
		</div>
	@endforeach
</div>