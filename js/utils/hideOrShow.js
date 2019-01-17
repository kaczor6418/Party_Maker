export function hideOrShow(nodeElement) {
    if(nodeElement.classList.contains('hidden')) {
        nodeElement.classList.replace('hidden', 'visible');
    } else {
        nodeElement.classList.replace('visible', 'hidden');
    }
}