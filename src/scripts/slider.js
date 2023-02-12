const sliderOffer = new Swiper('#slider-offer .swiper', {
  slidesPerView: 3,
  slidesPerGroup: 3,
  spaceBetween: 144,

  // autoplay: {
  //   delay: 5000,
  //   disableOnInteraction: false,
  // },

  navigation: {
    prevEl: '#slider-offer .swiper-button-prev',
    nextEl: '#slider-offer .swiper-button-next',
  },

  pagination: {
    el: '#slider-offer .swiper-pagination',
    clickable: true,
  },

  // effect: 'fade',
  // fadeEffect: {
  //   crossFade: true
  // },
});
