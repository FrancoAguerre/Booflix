function showToast(text) {
    toast.innerHTML = text;
    toast.style.opacity = '1';
    setTimeout(hideToast, 5000);
}

function hideToast() {
    toast.style.opacity = '0';
    toast.style.pointerEvents = 'none';
}