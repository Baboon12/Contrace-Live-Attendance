const sign_in_btn = document.querySelector('#sign_in');
const sign_up_btn = document.querySelector('#sign_up');
const container = document.querySelector('#container');

sign_up_btn.addEventListener('click',()=>{
    container.classList.add('right-panel-active');
});

sign_in_btn.addEventListener('click',()=>{
    container.classList.remove('right-panel-active');
}); 