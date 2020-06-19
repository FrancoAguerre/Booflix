
var _bodyMinHeight=720;
var _newsTimer;
var _currentNews = 1;
var _oldNews = 1;
var _totalNewsCount;

function currentPage(){
    var path = window.location.pathname.split("/");
    return path[path.length - 1].split('.')[0];
}

function isOverflown(ctrl) {
    return ctrl.scrollWidth > ctrl.clientWidth;
}

function checkSearchResults(){
    var searchType;
    try {
        searchType = window.location.href.split("&")[1].toLowerCase();
    } catch (exception) {
        searchType = "type=1";
    }

    if (searchType == "type=1"){
        var list = document.getElementById("lists").children[0];
        if (list.innerText=="") 
            document.getElementById("no-results").classList.remove("hidden");
    } else 
        checkListsContent(true, true);
}

function checkListsContent(checkUnderflow = false, showMessage = false){
    var children = document.getElementById("lists").children;
    for (var i = 1; i <= children.length; i++) {
        var list = document.getElementById("v-list-" + i);
        if (checkUnderflow && list.children.length < 1) {
            for (j = 0; j < 4; j++){
                children[i-1].children[0].remove();
            }
			if (showMessage && children[0].innerText=="")
                document.getElementById("no-results").classList.remove("hidden");
        } else 
        
        if (list!= null && isOverflown(list))
            document.getElementById('v-scroll-right-' + i).classList.remove('hidden');
    }
} 

function initializeNews(){
        _totalNewsCount = document.getElementById('news-container').childElementCount;
        resetNewsTimer();
}

function setFooterPosition(){
    if(document.body.scrollHeight > document.body.clientHeight){
        if (_bodyMinHeight<document.body.clientHeight)
            document.getElementById("for-footer").classList.remove("for-footer");
    }else  
        document.getElementById("for-footer").classList.add("for-footer");
}


function setOptionsSize(){
    if(document.body.clientWidth<1272){
        // menucito
    }
}

function removeLastCriticSplitter(){
    var critics = document.getElementById('critics-container').children;
    if (critics[critics.length-1].className=="critic-splitter")
        critics[critics.length-1].remove();
}

function checkUriHash(){
    switch (window.location.hash) {
        case "#critics":
            document.getElementById("critics").classList.remove("hidden");
            break;
        case "#goodbye":
            if (this.currentPage()=="welcome")
                showToast("Eliminaste tu cuenta. ¡Esperamos que vuelvas pronto!");
            break;
    }
}

window.onload = function () {
    if (this.currentPage()=="index" || this.currentPage()==""){
        initializeNews();
        checkListsContent(true, false);
        setOptionsSize();
    }
    else if (this.currentPage()=="welcome"|| this.currentPage()=="genres"|| this.currentPage()=="authors"|| this.currentPage()=="book"){
        setOptionsSize();
        checkListsContent(true, false);
        if (this.currentPage()=="book") {
            removeLastCriticSplitter();
        }
        checkUriHash();
    } else if (this.currentPage()=="search"){
        setOptionsSize();
        checkSearchResults();
    }else if(this.currentPage()=="favorites"|| this.currentPage()=="history"){
        setOptionsSize();
    }

    setFooterPosition();
}

window.onresize = function() {
    if (this.currentPage()=="index" || this.currentPage()=="" || this.currentPage()=="genres"|| this.currentPage()=="authors"|| this.currentPage()=="book" || this.currentPage()=="search"){
        checkListsContent();
        setOptionsSize();
    } else if(this.currentPage()=="favorites"|| this.currentPage()=="history"){
        setOptionsSize();
    }
    setFooterPosition();
}

function resetNewsTimer(){
    clearTimeout(_newsTimer);
    _newsTimer = setTimeout(function(){
        var id = _currentNews;
        if (id>=_totalNewsCount) id = 0;
        selectNews(id + 1);
    },15000);
}

function vScrollRight(id){
    document.getElementById('v-list-' + id).scrollBy(window.innerWidth, 0);
}

function vScrollLeft(id){
    document.getElementById('v-list-' + id).scrollBy(-window.innerWidth, 0);
}

function vListScrolled(id){
    var list = document.getElementById('v-list-' + id);
    if (list.scrollLeft==0) {
        document.getElementById('v-scroll-left-' + id).classList.add('hidden');
        if (isOverflown(list))
            document.getElementById('v-scroll-right-' + id).classList.remove('hidden');

    }
    else if (window.innerWidth + list.scrollLeft >= list.scrollWidth){
        document.getElementById('v-scroll-right-' + id).classList.add('hidden');
    } else {
        if (isOverflown(list)){
            document.getElementById('v-scroll-left-' + id).classList.remove('hidden');
            document.getElementById('v-scroll-right-' + id).classList.remove('hidden');
        }
    }
}

function validateSearchBox(){
        return document.getElementById("search-box").value !="";
}

function selectNews(id){
    _oldNews = _currentNews;
    _currentNews = id;

    resetNewsTimer();

    var newsOld = document.getElementById('news-' + _oldNews);
    var news = document.getElementById('news-' + id);
    var newsSelectorOld = document.getElementById('news-selector-' + _oldNews);
    var newsSelector = document.getElementById('news-selector-' + id);

    newsOld.classList.add('hidden');
    newsSelectorOld.classList.remove('news-selector-active');
    news.classList.remove('hidden');
    newsSelector.classList.add('news-selector-active');
}

function toggleFavs(bookId){
    ctrl = document.getElementById("add-to-favs");
    addStr = "Agregar a Favoritos";
    delStr = "Quitar de Favoritos";
    
    uri = "add-fav";
    if (ctrl.innerText == delStr){
        ctrl.innerText=addStr;
        uri = "del-fav";
    }
    else {
        ctrl.innerText=delStr;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", uri + ".php?id=" + bookId , true);
    xmlhttp.send();
}

function report(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200){
            if (this.response == 1) {
                document.getElementById("report-"+id).remove();
                showToast("Reseña reportada.");
            } else {
                showToast("Algo salió mal, volvé a intentarlo.");
            }
        }
    };
    uri = "critics/report.php?id=";
    xmlhttp.open("GET", uri + id, true);
    xmlhttp.send();
}

function fillReviewStars(val){
    for(i = 1; i<=val;i++){
    //alert("new-review-star-"+i);
        document.getElementById("new-review-star-"+i).classList.add("new-review-star-selected");
    }
    for(i = val+1; i<=5;i++){
        document.getElementById("new-review-star-"+i).classList.remove("new-review-star-selected");
    }

    document.getElementById("new-review-calif").value=val;
    document.getElementById("critic-submit").classList.remove("disabled");
}

function checkNewReviewComment(){
    if (document.getElementById("new-review-comment").value!="")
        document.getElementById("critic-submit").classList.remove("disabled");
    else if (document.getElementById("new-review-calif").value==0)
        document.getElementById("critic-submit").classList.add("disabled");
}