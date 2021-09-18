document.addEventListener('DOMContentLoaded', () => {
	const imgLightBox = document.querySelectorAll('.materialboxed');
	M.Materialbox.init(imgLightBox, {
		inDuration: 850,
		outDuration: 1000
	});
});

