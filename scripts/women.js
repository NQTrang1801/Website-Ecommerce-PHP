//sorter
const sorter = document.querySelector('.sort-list');
if(sorter){
    const sortLi = sorter.querySelectorAll('li');
    sorter.querySelector('.opt-trigger').addEventListener('click',function(){
        sorter.querySelector('ul').classList.toggle('show');
    } );
    sortLi.forEach((item) => item.addEventListener('click',function() {
        sortLi.forEach((li)=>li != this ? li.classList.remove('active'): null);

        this.classList.add('active');
        sorter.querySelector('.opt-trigger span.value').textContent=this.textContent;
        sorter.querySelector('ul').classList.toggle('show')
    }))
}

//tabbed
const trigger = document.querySelectorAll('.tabbed-trigger'),
    content = document.querySelectorAll('.tabbed > div');
trigger.forEach((btn)=>{
    btn.addEventListener('click', function(){
        let dataTarget= this.dataset.id,
        body =document.querySelector(`#${dataTarget}`);

        trigger.forEach((b)=>b.parentNode.classList.remove('active'));
        trigger.forEach((s)=>s.classList.remove('active'));
        this.parentNode.classList.add('active');
        body.classList.add('active');
    })
})



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

  //carousel
  const carousel = new Swiper('.carouselbox', {

    spaceBetween:30,
    slidersPerView: 'auto',
    centeredSlides: true,

  
    // If we need pagination
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    // breakpoints: {
    //     483: {
    //         slidersPerView: 2,
    //         slidersPerGroup: 1,
    //         centeredSlides: false,
    //     },
    //     700: {
    //         slidersPerView: 3,
    //         slidersPerGroup: 3,
    //         centeredSlides: false,
    //     },
    //     992: {
    //         slidersPerView: 4,
    //         slidersPerGroup: 4,
    //         centeredSlides: false,
    //     },
    //     1051: {
    //         slidersPerView: 5,
    //         slidersPerGroup: 5,
    //         centeredSlides: false,
    //     }
    // }
  
  });