function applyYakstretchPreviewBackground(blockEl) {
	console.log('[YakStretch] Applying background to block:', blockEl);

	const inner = blockEl.querySelector('.yakstretch-cover-block');
	if (!inner) {
		console.warn('[YakStretch] .yakstretch-cover-block not found in block');
		return;
	}

	const rotator = blockEl.querySelector('.yakstretch-image-rotator');
	if (!rotator) {
		console.warn('[YakStretch] .yakstretch-image-rotator not found');
		return;
	}

	if (!rotator.dataset.images) {
		console.warn('[YakStretch] data-images attribute is missing');
		return;
	}

	console.log('[YakStretch] data-images:', rotator.dataset.images);

	try {
		const urls = JSON.parse(rotator.dataset.images);
		console.log('[YakStretch] Parsed image URLs:', urls);

		if (urls.length > 0) {
			console.log('[YakStretch] Setting background-image on .yakstretch-cover-block');
			const bgDiv = inner.querySelector('.yakstretch-editor-bg');
            if (bgDiv) {
                bgDiv.style.backgroundImage = `url("${urls[0]}")`;
                bgDiv.style.backgroundSize = 'cover';
                bgDiv.style.backgroundPosition = 'center';
            }

		} else {
			console.warn('[YakStretch] No URLs in image array');
		}
	} catch (e) {
		console.error('[YakStretch] Failed to parse image JSON:', e);
	}
}

// DOM observer to detect when blocks are added
const observer = new MutationObserver(mutations => {
	console.log('[YakStretch] MutationObserver triggered');
	mutations.forEach(mutation => {
		mutation.addedNodes.forEach(node => {
			if (
				node.nodeType === 1 &&
				node.classList.contains('wp-block-yak-yakstretch-cover')
			) {
				console.log('[YakStretch] Detected yakstretch block via mutation:', node);
				applyYakstretchPreviewBackground(node);
			}
		});
	});
});

console.log('[YakStretch] Starting MutationObserver...');
observer.observe(document.body, {
	childList: true,
	subtree: true,
});

// Manual fallback in case block is already present on load
console.log('[YakStretch] Running fallback check for existing blocks...');
document.querySelectorAll('.wp-block-yak-yakstretch-cover').forEach(block => {
	console.log('[YakStretch] Found existing block on load:', block);
	applyYakstretchPreviewBackground(block);
});
