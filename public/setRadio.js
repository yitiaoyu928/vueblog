(function(window,document) {
window.addEventListener('resize',throttle(setRadio));
setRadio();
function setRadio() {
	const INNERWIDTH = window.innerWidth || 
	document.documentElement.clientWidth ||
	document.documentElement.getBoundingClientRect().width;
	let font_size = Number.parseInt((INNERWIDTH/375)*20);
	if(font_size<20) {
		font_size = 20;
	}
	if(font_size>40) {
		font_size = 40;
	}
	document.getElementsByTagName('html')[0].style.fontSize = font_size+'px';
}
function throttle(fn,timer = 500) {
	let time = null;
	return function(...args) {
		let _this = this;
		if(time) {
			return;
		}
		time = setTimeout(function() {
			fn.apply(_this,args)
			clearTimeout(time);
			time = null;
		},timer);
	};
}
})(window,document);
