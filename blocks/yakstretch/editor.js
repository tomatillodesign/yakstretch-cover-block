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

	let urls = [];
	try {
		urls = JSON.parse(rotator.dataset.images || '[]');
	} catch (e) {
		console.error('[YakStretch] Failed to parse data-images:', e);
		return;
	}

	console.log('[YakStretch] Final image list:', urls);
	if (urls.length === 0) return;

	let bgDiv = inner.querySelector('.yakstretch-editor-bg');
	if (!bgDiv) {
		console.log('[YakStretch] Creating .yakstretch-editor-bg');
		bgDiv = document.createElement('div');
		bgDiv.className = 'yakstretch-editor-bg';
		bgDiv.style.position = 'absolute';
		bgDiv.style.inset = '0';
		bgDiv.style.zIndex = '0';
		bgDiv.style.pointerEvents = 'none';
		bgDiv.style.willChange = 'opacity';
		inner.prepend(bgDiv);
	}

	bgDiv.style.backgroundImage = `url("${urls[0]}")`;
	bgDiv.style.backgroundSize = 'cover';
	bgDiv.style.backgroundPosition = 'center';
	bgDiv.style.opacity = '1';
	
}


// Initial pass for already-rendered blocks
document.querySelectorAll('.wp-block-yak-yakstretch-cover').forEach(applyYakstretchPreviewBackground);

// MutationObserver to catch live updates
// --- Debounce utility ---
function debounce(fn, delay = 100) {
	let timeout;
	return (...args) => {
		clearTimeout(timeout);
		timeout = setTimeout(() => fn(...args), delay);
	};
}

// --- Debounced background applier ---
const debouncedApply = debounce((blockEl) => {
	if (blockEl) {
		applyYakstretchPreviewBackground(blockEl);
	}
}, 100);

// --- Observer setup ---
const observer = new MutationObserver(mutations => {
	console.log('[YakStretch] MutationObserver triggered');

	mutations.forEach(mutation => {
		// Handle newly added blocks
		mutation.addedNodes.forEach(node => {
			if (!(node instanceof HTMLElement)) return;

			const block = node.closest?.('.wp-block-yak-yakstretch-cover');
			if (block) {
				console.log('[YakStretch] New block added:', block);
				debouncedApply(block);
			}

			const embedded = node.querySelector?.('.wp-block-yak-yakstretch-cover');
			if (embedded) {
				console.log('[YakStretch] Embedded block found:', embedded);
				debouncedApply(embedded);
			}
		});

		// Handle attribute/child changes inside existing blocks (e.g., gallery updates)
		if (mutation.type === 'attributes' || mutation.type === 'childList' || mutation.type === 'characterData') {
			const block = mutation.target.closest?.('.wp-block-yak-yakstretch-cover');
			if (block) {
				console.log('[YakStretch] Internal update to block:', block);
				debouncedApply(block);
			}
		}
	});
});

observer.observe(document.body, {
	subtree: true,
	childList: true,
	attributes: true,
	characterData: true,
	attributeFilter: ['data-images'],
});
