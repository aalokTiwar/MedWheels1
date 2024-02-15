const header = document.querySelector('header');
function fixedNavbar(){
    header.classList.toggle('scrolled',window.pageYOffset > 0)
}
fixedNavbar();
window.addEventListener('scroll', fixedNavbar)

let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn-profile');

menu.addEventListener('click',function(){
    let nav = document.querySelector('.navbar');
    nav.classList.toggle('active');
})

userBtn.addEventListener('click',function(){
    console.log('User button clicked!');
    // let userBox = document.querySelector('.user-box');
    // userBox.classList.toggle('active');
    let userBox = document.querySelector('.user-box-details');
    userBox.classList.toggle('active');
})

let closeBtn = document.querySelector('#close-form');

closeBtn.addEventListener('click',()=>{
    document.querySelector('.update-container').style.display='none'
})