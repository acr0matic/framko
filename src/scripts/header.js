const header = document.getElementById('header');

if (header) {
  let headerHeight = 0;

  const Background = () => {
    if (window.scrollY > 0) header.classList.add(StyleСlass.header.sticky)
    else header.classList.remove(StyleСlass.header.sticky)
  }

  const SetHeight = (target) => {
    headerHeight = target.offsetHeight;
    document.documentElement.style.setProperty('--header-height', headerHeight + 'px');
  }

  SetHeight(header);
  Background();

  window.addEventListener('resize', () => SetHeight(content));
  window.addEventListener('scroll', () => Background());

  // -------------------------------------------------------------------------------------------

  const mobile = document.querySelector('.mobile-menu');
  const overlay = document.querySelector('.overlay');
  const mobileNav = mobile.querySelectorAll('.nav__link');
  const mobileBurger = header.querySelector('.hamburger');

  mobileBurger.addEventListener('click', () => Menu());

  overlay.addEventListener('click', () => Menu());

  mobileNav.forEach(link => link.addEventListener('click', () => Menu()));

  function Menu() {
    mobile.classList.toggle(StyleСlass.mobile.open);
    mobileBurger.classList.toggle('is-active')

    if (isMobile) overlay.classList.toggle('overlay--visible')

  }
}