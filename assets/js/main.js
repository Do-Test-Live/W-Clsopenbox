document.addEventListener( 'DOMContentLoaded', function () {

    /*new Splide('#splide', {
        type: 'loop',
        perPage: 2,
        focus: 'center',
        autoplay: true,
        arrows:false,
        rewind : true,
        interval: 8000,
        flickMaxPages: 2,
        updateOnMove: true,
        pagination: true,
        padding: '10%',
        throttle: 300,
        breakpoints: {
            1440: {
                perPage: 1,
                padding: '30%'
            }
        }
    }).mount();*/

    let splide = new Splide( '#splide-1', {
        type   : 'loop',
        perPage: 2,
        perMove: 1,
        arrows:false,
        gap:'10px'
    } );

    splide.mount();

    let splide2 = new Splide( '#splide-2', {
        type   : 'loop',
        perPage: 2,
        perMove: 1,
        pagination: false,
        arrows:false,
        gap:'10px'
    } );

    splide2.mount();
});
