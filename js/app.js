window.addEventListener("load", () => {

    const menuBtnHeader = document.querySelector('.header-burger-icon');
    const menuNavHeader = document.querySelector('.header-nav');

    menuBtnHeader.addEventListener('click', () => {
        menuBtnHeader.classList.toggle('is-active');
        menuNavHeader.classList.toggle('is-active');
    });

    // const dropBtn = document.querySelector('.dropdown-menu');
    // const dropdown = document.querySelector('.dropdown-menu ul');

    // dropBtn.addEventListener('click', () => {
    //     dropdown.classList.toggle('is-active');
    // });
});