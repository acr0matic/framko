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

const sliderPrice = new Swiper('#slider-price .swiper', {
  slidesPerView: 2.75,
  spaceBetween: 24,
  grabCursor: true,
  centeredSlides: true,

  scrollbar: {
    el: '#slider-price .swiper-scrollbar',
    draggable: true,
    snapOnRelease: true,
  },

  on: {
    afterInit(instance) {
      instance.slideTo(2);
    },
  },

  breakpoints: {
    1400: {
      slidesPerView: 3
    },
  }
});
