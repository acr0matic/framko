const sliderOffer = new Swiper('#slider-offer .swiper', {
  slidesPerView: 1.25,
  spaceBetween: 32,

  navigation: {
    prevEl: '#slider-offer .swiper-button-prev',
    nextEl: '#slider-offer .swiper-button-next',
  },

  pagination: {
    el: '#slider-offer .swiper-pagination',
    clickable: true,
  },

  breakpoints: {
    540: {
      slidesPerView: 1.75,
    },

    768: {
      slidesPerView: 2,
      spaceBetween: 32,
    },

    991: {
      slidesPerView: 3,
      slidesPerGroup: 3,
    },

    1120: {
      slidesPerView: 3,
      slidesPerGroup: 3,
      spaceBetween: 96,
    },

    1600: {
      slidesPerView: 3,
      slidesPerGroup: 3,
      spaceBetween: 144,
    },
  }
});

const sliderPrice = new Swiper('#slider-price .swiper', {
  slidesPerView: 1,
  spaceBetween: 24,

  grabCursor: true,
  autoHeight: true,

  mousewheel: {
    forceToAxis: true,
  },

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
    768: {
      slidesPerView: 1.75,
      centeredSlides: true,
    },

    991: {
      slidesPerView: 2.5,
      centeredSlides: true,

      autoHeight: false,
    },

    1120: {
      slidesPerView: 3
    },
  }
});
