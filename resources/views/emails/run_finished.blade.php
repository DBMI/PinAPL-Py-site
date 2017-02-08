<p>
Your run: {{ $runName }} has finished. <br>
You can view the results here: <br>
<a href="{{ $runUrl }}">{{ $runUrl }}</a>
<br><br>
Thank you.
</p>
<img src="{{ $message->embed(base_path().'/public/img/smallLogo.png') }}">