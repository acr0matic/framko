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
  const mobileOverlay = document.querySelector('.mobile-menu__overlay');

  const mobileBurger = header.querySelector('.hamburger');

  mobileBurger.addEventListener('click', () => Menu());
  mobileOverlay.addEventListener('click', () => Menu());

  function Menu() {
    mobile.classList.toggle(StyleСlass.mobile.open);
    mobileBurger.classList.toggle('is-active')
  }
}