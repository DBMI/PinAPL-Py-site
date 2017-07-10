<p>
Your run: {{ $runName }} has finished. <br>
You can view the results here: <br>
<a href="{{ $runUrl }}">{{ $runUrl }}</a>
<br>
Your results will be stored for 5 days, then deleted. To preserve your run, you can download the results by pressing the "Download Results Archive" button.
<br>
Thank you.
</p>
<img height="200px" src="{{ $message->embed(base_path().'/public/img/logo_with_name.png') }}">