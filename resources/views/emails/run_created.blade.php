<p>
Your run: {{ $runName }} has been created. <br>
You can view this run here: <br>
<a href="{{ $runUrl }}">{{ $runUrl }}</a>
<br><br>
Thank you.
</p>
<img src="{{ $message->embed(base_path().'/public/img/smallLogo.png') }}">