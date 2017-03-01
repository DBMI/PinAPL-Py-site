class LogTailer {
	constructor (url, container, stopPhrase=null, timeout=5000, callback=null) {
		this.url = url;
		this.container = container;
		this.stopPhrase = stopPhrase;
		this.timeout = timeout;
		this.callback = callback;

		this.stop = false;
		this.nextLine = 0;
	}

	/**
	 * Calls it self after a time out, and appends new content to container
	 * @return {[type]} [description]
	 */
	function tailLog () {
		// If the stop signal has been sent
		if (stop) {return;}
		$.get(
			url, 
			{nextLine:nextLine},
			function(data) {
			  $(this.container).append(ansispan(data));
			  window.scrollTo(0,document.body.scrollHeight);
			  // If window.focused pause say 2 seconds
			  // If window not focused pause say 10 seconds
			  // If looking at a different tab, stop, make listener for when switched back to this tab
			  if (data.indexOf(stopPhrase) > -1) {
			    return;
			  } else {
			    setTimeout(tailLog, timeout);
			  };
			}
		);
	}

	function stopTail () {
		this.tail = false;
	}
	function startTail(startLine=0) {
		this.nextLine = startLine;
		tailLog();
	}
	function setNextLine(line){
		this.nextLine = line;
	}

	// Function for coloring ansi output
	var ansispan = function (str) {
	  Object.keys(ansispan.foregroundColors).forEach(function (ansi) {
	    var span = '<span style="color: ' + ansispan.foregroundColors[ansi] + '">';

	    //
	    // `\033[Xm` == `\033[0;Xm` sets foreground color to `X`.
	    //

	    str = str.replace(
	      new RegExp('\033\\[' + ansi + 'm', 'g'),
	      span
	    ).replace(
	      new RegExp('\033\\[0;' + ansi + 'm', 'g'),
	      span
	    );
	  });
	  //
	  // `\033[1m` enables bold font, `\033[22m` disables it
	  //
	  str = str.replace(/\033\[1m/g, '<b>').replace(/\033\[22m/g, '</b>');

	  //
	  // `\033[3m` enables italics font, `\033[23m` disables it
	  //
	  str = str.replace(/\033\[3m/g, '<i>').replace(/\033\[23m/g, '</i>');

	  str = str.replace(/\033\[m/g, '</span>');
	  str = str.replace(/\033\[0m/g, '</span>');
	  return str.replace(/\033\[39m/g, '</span>');
	};

	ansispan.foregroundColors = {
	  '30': 'black',
	  '31': 'red',
	  '32': 'green',
	  '33': 'yellow',
	  '34': 'blue',
	  '35': 'purple',
	  '36': 'cyan',
	  '37': 'white'
	};
}