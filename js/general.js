
var _bodyMinHeight=720;
var _newsTimer;
var _currentNews = 1;
var _oldNews = 1;
var _totalNewsCount;

function currentPage(){
    path = window.location.pathname.split("/");
    return path[path.length - 1].split('.')[0];
}

function isOverflown(ctrl) {
    return ctrl.scrollWidth > ctrl.clientWidth;
}

function checkListsOverflow(){
    var children = document.getElementById("lists").children;
    for (var i = 1; i <= children.length; i++) {
        var list = document.getElementById("v-list-" + i);
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

function setSearchResultsWidth(){
    if(document.body.clientWidth<1152){
        document.getElementById("search-results").style.width="784px";
    } else {
        document.getElementById("search-results").style.width="1152px";
    }
}

function setOptionsSize(){
    if(document.body.clientWidth<1272){
        alert("asd");
    }
}

window.onload = function () {
    if (this.currentPage()=="index" || this.currentPage()==""){
        initializeNews();
        checkListsOverflow();
        setOptionsSize();
    }
    else if (this.currentPage()=="welcome"|| this.currentPage()=="genres"|| this.currentPage()=="authors"|| this.currentPage()=="book"){
        checkListsOverflow();
        setOptionsSize();
    }
    else if (this.currentPage()=="search"){
        setSearchResultsWidth();
        setOptionsSize();
    } else if(this.currentPage()=="favorites"|| this.currentPage()=="history"){
        setOptionsSize();
    }

    setFooterPosition();
}

window.onresize = function() {
    if (this.currentPage()=="index" || this.currentPage()=="" || this.currentPage()=="genres"|| this.currentPage()=="authors"|| this.currentPage()=="book"){
        checkListsOverflow();
        setOptionsSize();
    } else if (this.currentPage()=="search") {
        setSearchResultsWidth();
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