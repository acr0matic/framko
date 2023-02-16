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
    910: {
      slidesPerView: 3,
      slidesPerGroup: 3,
      spaceBetween: 64,
    },

    1300: {
      spaceBetween: 144
    },
  }

  // effect: 'fade',
  // fadeEffect: {
  //   crossFade: true
  // },

  // autoplay: {
  //   delay: 5000,
  //   disableOnInteraction: false,
  // },

});

const sliderPrice = new Swiper('#slider-price .swiper', {
  slidesPerView: 1,
  spaceBetween: 24,

  grabCursor: true,
  autoHeight: true,

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
    910: {
      slidesPerView: 2.75,
      centeredSlides: true,
      autoHeight: false,
    },

    1300: {
      slidesPerView: 3
    },
  }
});
