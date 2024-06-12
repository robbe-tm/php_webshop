let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    profile.classList.remove('active');
}
document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');
    navbar.classList.remove('active');
}
window.onscroll = () =>{
    profile.classList.remove('active');
    navbar.classList.remove('active');
}

document.querySelectorAll('.navlink').forEach
(link => {
    if(link.href === window.location.href){
        link.setAttribute('aria-current', 'page')
    }
})
if(window.location.hash=="/Project_bodi/shop.php")
    {
        //add a # if it doesn't exist
        newurl = document.URL+"#";
        location = "#";

        //Refresh page
        location.reload(true);

    }