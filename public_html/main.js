document.getElementById("burgerOpen").addEventListener("click", function ()
{
    let burgerMenu = document.getElementById("burgerMenu");
    burgerMenu.style.display = "block";
});

document.getElementById("burgerClose").addEventListener("click", function ()
{
    let burgerMenu = document.getElementById("burgerMenu");
    burgerMenu.style.display = "none";
});

document.getElementById("bottomPage").addEventListener("click", function ()
{
    window.scrollTo(0, document.body.scrollHeight);
});