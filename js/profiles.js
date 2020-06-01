window.onload = function () {
    showProfiles();
}

function showProfiles(){
    document.getElementById('profiles-container').style.opacity=1;
    document.getElementById('profiles-container').style.transform="translate(-50%, -50%) scale(1, 1)";
    document.getElementById('edit-profiles').style.opacity=1;
    document.getElementById('title').style.opacity=1;
}