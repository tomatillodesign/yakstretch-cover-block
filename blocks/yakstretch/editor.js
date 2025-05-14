function applyYakstretchPreviewBackground(blockEl) {
	console.log('[YakStretch] Applying background to block:', blockEl);

	const inner = blockEl.querySelector('.yakstretch-cover-block');
	if (!inner) {
		console.warn('[YakStretch] .yakstretch-cover-block not found');
		return;
	}

	const rotator = blockEl.querySelector('.yakstretch-image-rotator');
	if (!rotator) {
		console.warn('[YakStretch] .yakstretch-image-rotator not found');
		return;
	}

	if (!rotator.dataset.images) {
		console.warn('[YakStretch] data-images missing');
		return;
	}

	try {
		const urls = JSON.parse(rotator.dataset.images);
		console.log('[YakStretch] Found images:', urls);

		if (urls.length > 0) {
			let bgDiv = inner.querySelector('.yakstretch-editor-bg');
            if (!bgDiv) {
                console.log('[YakStretch] Creating .yakstretch-editor-bg');
                bgDiv = document.createElement('div');
                bgDiv.className = 'yakstretch-editor-bg';
                el.style.willChange = 'opacity';
                bgDiv.style.position = 'absolute';
                bgDiv.style.inset = '0';
                bgDiv.style.zIndex = '0';
                bgDiv.style.pointerEvents = 'none';
                inner.prepend(bgDiv);
            }

            bgDiv.style.backgroundImage = `url("${urls[0]}")`;
            bgDiv.style.backgroundSize = 'cover';
            bgDiv.style.backgroundPosition = 'center';

		}
	} catch (e) {
		console.error('[YakStretch] Failed to parse data-images:', e);
	}
}

// Initial pass for already-rendered blocks
document.querySelectorAll('.wp-block-yak-yakstretch-cover').forEach(applyYakstretchPreviewBackground);

// MutationObserver to catch live updates
const observer = new MutationObserver(mutations => {
	console.log('[YakStretch] MutationObserver triggered');

	mutations.forEach(mutation => {
		mutation.addedNodes.forEach(node => {
			if (!(node instanceof HTMLElement)) return;

			// Is this a new .yakstretch-cover-block being rendered?
			const block = node.closest?.('.wp-block-yak-yakstretch-cover');
			if (block) {
				console.log('[YakStretch] Block updated via mutation:', block);
				applyYakstretchPreviewBackground(block);
			}

			// Or does this node *contain* a new rotator?
			const embedded = node.querySelector?.('.wp-block-yak-yakstretch-cover');
			if (embedded) {
				console.log('[YakStretch] Embedded block found in node:', embedded);
				applyYakstretchPreviewBackground(embedded);
			}
		});
	});
});

observer.observe(document.body, {
	subtree: true,
	childList: true,
});
