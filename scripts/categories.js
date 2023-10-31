const productsModule = require('../backend/products');

productsModule.readProductsFromFile((err, products) => {
    if (err) {
        console.error('Đã xảy ra lỗi:', err);
    } else {
        console.log('Dữ liệu sản phẩm:', products);
    }
});

//slider
const swiper = new Swiper('.sliderbox', {

    loop: true,
    effect:'fade',
    autoHeight:true,
  
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
      clickable:true,
    },
  
  });
