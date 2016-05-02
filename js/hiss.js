function setColorThemeMeta(color){
    document.querySelector('meta[name="theme-color"]').removeAttribute("content");
    document.querySelector('meta[name="theme-color"]').setAttribute("content", color);
}