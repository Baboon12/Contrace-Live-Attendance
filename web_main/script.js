const navslide = ()=>{
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.navlinks');
    const link = document.querySelectorAll('.navlinks li');

    burger.addEventListener('click',()=>{
        nav.classList.toggle('nav-active');

        link.forEach((links,index) => {
            if(links.style.animation)
                links.style.animation = "";
            else 
                links.style.animation = `navlink 0.5s ease forwards ${index/7 + 1}s`;
        });
        burger.classList.toggle('toggle');
    });  
}

navslide();