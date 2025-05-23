function yakstretchInit(container) {
	const rotator = container.querySelector('.yakstretch-image-rotator');
	if (!rotator) return;

	const imageUrls = JSON.parse(rotator.dataset.images || '[]');
	if (imageUrls.length < 1) return;

	const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	if (prefersReducedMotion) {
		const bg = document.createElement('div');
		bg.className = 'yakstretch-bg';
		bg.style.position = 'absolute';
		bg.style.top = 0;
		bg.style.left = 0;
		bg.style.right = 0;
		bg.style.bottom = 0;
		bg.style.backgroundImage = `url('${imageUrls[0]}')`;
		bg.style.backgroundSize = 'cover';
		bg.style.backgroundPosition = 'center';
		bg.style.opacity = '1';
		bg.style.transition = 'none';

		rotator.appendChild(bg);
		return;
	}	

	const delay = parseInt(rotator.dataset.delay, 10) || 6000;
	const fade = parseInt(rotator.dataset.fade, 10) || 1000;
	const randomize = rotator.dataset.randomize === '1';

	const queue = randomize ? [...imageUrls].sort(() => Math.random() - 0.5) : [...imageUrls];
	let index = 0;

	const img1 = document.createElement('div');
	const img2 = document.createElement('div');
	[img1, img2].forEach(el => {
		el.className = 'yakstretch-bg';
		el.style.position = 'absolute';
		el.style.top = 0;
		el.style.left = 0;
		el.style.right = 0;
		el.style.bottom = 0;
		el.style.willChange = 'opacity';
		el.style.backgroundSize = 'cover';
		el.style.backgroundPosition = 'center';
		el.style.transition = `opacity ${fade}ms ease`;
		el.style.zIndex = -1;
		el.style.opacity = 0;
		rotator.appendChild(el);
	});

	let current = img1;
	let next = img2;

	current.style.backgroundImage = `url("${queue[0]}")`;
	current.style.opacity = 1;

	const rotate = () => {
		index = (index + 1) % queue.length;
		const nextUrl = queue[index];

		const preload = new Image();
		preload.src = nextUrl;
		preload.onload = () => {
			next.style.backgroundImage = `url("${nextUrl}")`;
			next.style.opacity = 1;
			current.style.opacity = 0;
			[current, next] = [next, current];
			setTimeout(rotate, delay);
		};
	};

	setTimeout(() => {
		if (queue.length > 1) rotate();
	}, delay);
}


// YakStretch waits for AVIF to allow/init, or runs standalone
if (window.tomatilloAvifYakDelay) {
	window.addEventListener('tomatilloAvifReady', () => {
		console.log('[YAKSTRETCH] Starting init. First rotator image:', document.querySelector('.yakstretch-image-rotator')?.dataset.images);
		document.querySelectorAll('[data-yakstretch="1"]').forEach(yakstretchInit);
	}, { once: true });
} else {
	document.addEventListener('DOMContentLoaded', () => {
		console.log('[YAKSTRETCH] Starting init. First rotator image:', document.querySelector('.yakstretch-image-rotator')?.dataset.images);
		document.querySelectorAll('[data-yakstretch="1"]').forEach(yakstretchInit);
	});
}

