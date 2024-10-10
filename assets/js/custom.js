// Custom JS for Theme
jQuery(document).ready(function() {
    
    jQuery('.header-slider-wrapper').owlCarousel({
		items: 1,
		autoplay: true,
        loop: true
	});

	jQuery('[data-vbg]').youtube_background({
		'mobile':true,
		'fit-box':true
	});

    const toggleNavMenu = item => {
        item.classList.toggle('is-visible');
    }

    const toggleTabIndex = element => {
        if (!element.hasAttribute('tabindex')) {
            return element.setAttribute('tabindex', '0');
        } 
        element.removeAttribute('tabindex');
        
    };
    
    const mobileNav = () => {
        const body = document.querySelector('body');
        const navBtn = document.querySelector('.mobile-nav-btn');
        const mobileNav = document.querySelector('.panel');

        if (!navBtn || !mobileNav) {
            return;
        }

        const navClose = mobileNav.querySelector('#close-menu');
        const goToBottom = mobileNav.querySelector('.go-to-bottom');
        const goToTop = mobileNav.querySelector('.go-to-top');
        const dropdowns = mobileNav.querySelectorAll('span');

        navBtn.addEventListener('click', function () {
            mobileNav.classList.add('expanded');
            navBtn.setAttribute('aria-expanded', true);
            mobileNav.setAttribute('aria-hidden', false);
            body.classList.add('no-scroll');
            navClose.focus();
            dropdowns.forEach(dropdown => toggleTabIndex(dropdown));
        });

        document.addEventListener('click',function (e) {
            if (!mobileNav.contains(e.target) && !navBtn.contains(e.target) && mobileNav.classList.contains('expanded')) {
                mobileNav.classList.remove('expanded');
                navBtn.setAttribute('aria-expanded', false);
                mobileNav.setAttribute('aria-hidden', true);
                body.classList.remove('no-scroll');
                dropdowns.forEach(dropdown => toggleTabIndex(dropdown));
                navBtn.focus();
            }
        });

        navClose.addEventListener('click', () => {
            mobileNav.classList.remove('expanded');
            navBtn.setAttribute('aria-expanded', false);
            mobileNav.setAttribute('aria-hidden', true);
            body.classList.remove('no-scroll');
            navBtn.focus();
            dropdowns.forEach(dropdown => toggleTabIndex(dropdown));
        });

        goToBottom.addEventListener('focus', () => {
            document.querySelector('ul#menu-mobile li:last-child > a').focus();
        });

        goToTop.addEventListener('focus', () => {
            navClose.focus();
        });

        // Accessing sub-menus
        if (dropdowns.length !== 0) {
            dropdowns.forEach(dropdown => {
                const subMenu = dropdown.nextElementSibling;
                dropdown.addEventListener('click', () => {
                    toggleNavMenu(subMenu);
                });
                dropdown.addEventListener('keydown', (e) => {
                    if (['Space', 'Enter'].includes(e.code)) {
                        e.preventDefault();
                        toggleNavMenu(subMenu);
                    }
                });
            });
        }
    }
    mobileNav();

    //Fade In/Out for Go to Top Button
    const topBtn = document.querySelector( '#itre-back-to-top' );

    if ( topBtn !== null ) {

        let count = 0
        window.onscroll = () => {
            if ( window.scrollY > 300 ) {
                fadeIn( topBtn )
            } else {
                fadeOut( topBtn )
            }
        }

        const fadeIn = element => {

            if ( count > 0 ) {
                return
            }
            var opacity = 0.1
            element.style.display = "flex"

            var timer = setInterval( function() {

                if ( opacity >= 1 ) {
                    clearInterval( timer )
                }

                element.style.opacity = opacity;
                element.style.filter = 'alpha(opacity=' + opacity * 100 + ")";
                opacity += opacity * 0.1;
            })
            count++
        }


        const fadeOut = element => {

            if ( count < 1 ) {
                return
            }

            let opacity = 1
            setTimeout( () => { element.style.display = "none" }, 200)
            let timer = setInterval( function() {

                if ( opacity <= 0.001 ) {
                    clearInterval(timer)
                }

                element.style.opacity = opacity;
                element.style.filter = 'alpha(opacity=' - opacity * 100 + ")";
                opacity -= opacity * 0.1;
            })
            count--;
        }

        topBtn.addEventListener('click', function(e) {
          e.preventDefault();
          jQuery('html').animate({scrollTop:0}, 300, 'linear');
        });
    }

    // Lightbox feature for Gallery block
    const Lightbox = () => {
        const selector = document.querySelector('.is-style-lightbox a');
        
        if (!selector) {
            return;
        }
        
        const lightbox = GLightbox({
            selector: '.is-style-lightbox a',
            touchNavigation: true,
            keyboardNavigation: true,
            width: "auto",
            height: "auto",
            draggable: false,
        });
    }

    // Gallery - Slider Style
    const gallerySlider = () => {
        const sliders = document.querySelectorAll('.is-style-slider');
        if (sliders.length === 0) {
            return;
        }

        sliders.forEach(slider => {

            // Manipulate the Gallery Wrapper div to make it compatible with Swiper slider
            const sliderContent = slider.innerHTML;
            const contentWrapper = document.createElement('div');
            contentWrapper.classList.add('swiper-wrapper', 'is-style-lightbox');
            contentWrapper.innerHTML = sliderContent;

            if (!contentWrapper.innerHTML) {
                return;
            }

            [...contentWrapper.children].forEach(item => {
                item.classList.add('swiper-slide');
            });
            
            let slides = [...slider.classList].filter(item => item.includes('columns')).toString().split('-')[1];
            slides = slides === 'default' ? 3 : parseInt(slides)
            slider.innerHTML = '';
            slider.appendChild(contentWrapper);
        
            const swiper = new Swiper (
                '.is-style-slider', {
                    slidesPerView: slides,
                    slideClass: 'wp-block-image',
                    spaceBetween: 2,
                    loop: true
                }
            );
        });
    }

    gallerySlider();
    Lightbox();
});
