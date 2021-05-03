document.addEventListener( 'DOMContentLoaded', function() {
	const header = document.getElementById( 'masthead' );

	// const fixHeader = () => {
	// 	header.classList.add( 'fixed' );

	// 	const body = document.querySelector( 'body' );
	// 	body.style.paddingTop = header.offsetHeight + 'px';
	// }

	// if ( window.innerWidth > 992 ) {
	// 	fixHeader();
	// }

	const navControl = document.getElementById( 'nav-control' );
	navControl.addEventListener( 'click', function() {
		header.classList.contains( 'nav-mobile' ) ? header.classList.remove( 'nav-mobile' ) : header.classList.add( 'nav-mobile' )
	} )

	// Accordion
	const accordion = document.querySelector( '.accordions' );
	if ( accordion ) {
		let acc = accordion.getElementsByClassName( 'control' );
		let i;

		for ( i = 0; i < acc.length; i++ ) {
			acc[i].addEventListener("click", function() {
				this.classList.toggle( 'active' );

				const panel = this.nextElementSibling;
				if ( panel.style.maxHeight ) {
					panel.style.maxHeight = null;
				} else {
					panel.style.maxHeight = panel.scrollHeight + 'px';
				}
			});
		}
	}

	if ( document.querySelector( '.news-wrapper' ) ) {
		new Splide( '.news-wrapper', {
			type      : 'loop',
			gap       : '135px',
			pagination: false,
			padding   : {
				left: 0,
				right: '250px',
			},
			breakpoints: {
				991: {
					gap       : 0,
					padding   : {
						left: 0,
						right: 0,
					},
				},
			}
		} ).mount();
	}

	if ( document.querySelector( '.flags' ) ) {
		new Splide( '.flags', {
			gap       : '20px',
			pagination: false,
			perPage   : 12,
			arrows    : false,
			breakpoints: {
				991: {
					perPage: 6
				}
			}
		} ).mount();

		const flags = document.querySelectorAll( '.flags a' )
		const locations = document.querySelectorAll( '.flag-location' )
		
		flags.forEach( e => {
			// console.log(e.dataset.location)
			e.addEventListener( 'click', function() {
				flags.forEach( fl => {
					fl.classList.remove( 'active' )
				})

				locations.forEach( loc => {
					loc.classList.remove( 'active' )

					if ( loc.dataset.location === e.dataset.location ) {
						loc.classList.add( 'active' )
					}
				})

				e.classList.add( 'active' )
			} )
		} )
	}

	if ( document.querySelector( '.about-slider' ) ) {
		new Splide( '.about-slider', {
			type      : 'loop',
			pagination: true,

		} ).mount();
	}

	// Tabs
	const tab = ( links, panels ) => {
		links.forEach( l => {
			l.addEventListener( 'click', function() {
				links.forEach( el => {
					el.classList.remove( 'active' )
				} )

				l.classList.add( 'active' )

				panels.forEach( el => {
					if ( el.dataset.tab === l.dataset.tab ) {
						el.classList.add( 'active' )
					} else {
						el.classList.remove( 'active' )
					}
				} )
			} )
		} )
	}

	if ( document.querySelector( '.window-slider' ) ) {
		const windowSlider = document.querySelector( '.window-slider' );
		const splide = new Splide( windowSlider, {
			type      : 'loop',
			pagination: false,
			grid: {
				rows: 2,
				cols: 4,
				gap : {
					row: '30px',
					col: '30px',
				}
			},
			breakpoints: {
				991: {
					grid: {
						rows: 2,
						cols: 2,
					},
				},
			}
		} ).mount( window.splide.Extensions );

		const indicator = windowSlider.querySelector( '.indicators-index' );

		splide.on( 'moved', function( newIndex, oldIndex, destIndex ) {
			indicator.innerHTML = ++newIndex
		} );

		tab( document.querySelectorAll( '.hardware-window .tab-link' ), document.querySelectorAll( '.hardware-window .tab-panel' ) )
		tab( document.querySelectorAll( '.hardware-door .tab-link' ), document.querySelectorAll( '.hardware-door .tab-panel' ) )
	}

	if ( document.querySelector( '.door-slider' ) ) {
		const doorSlider = document.querySelector( '.door-slider' );
		const splide = new Splide( doorSlider, {
			type      : 'loop',
			pagination: false,
			grid: {
				rows: 2,
				cols: 3,
				gap : {
					row: '30px',
					col: '30px',
				}
			},
			breakpoints: {
				991: {
					grid: {
						rows: 2,
						cols: 2,
					},
				},
			}
		} ).mount( window.splide.Extensions );

		const indicator = doorSlider.querySelector( '.indicators-index' );

		splide.on( 'moved', function( newIndex, oldIndex, destIndex ) {
			indicator.innerHTML = ++newIndex
		} );

		tab( document.querySelectorAll( '.hardware-window .tab-link' ), document.querySelectorAll( '.hardware-window .tab-panel' ) )
	}

	if ( document.querySelector( '.project-slider' ) ) {
		const projectSlider = document.querySelector( '.project-slider' );
		const splide = new Splide( projectSlider, {
			type      : 'loop',
			pagination: false,
			autoplay  : true,
			interval  : 3000,
			arrows    : false,
			perPage   : 4,
			gap       : '30px',
			breakpoints: {
				991: {
					perPage   : 2,
				},
			}
		} ).mount();

		// const indicator = projectSlider.querySelector( '.indicators-index' );

		// splide.on( 'moved', function( newIndex, oldIndex, destIndex ) {
		// 	indicator.innerHTML = Math.floor(newIndex / 4) + 1
		// } );

		tab( document.querySelectorAll( '.hardware-window .tab-link' ), document.querySelectorAll( '.hardware-window .tab-panel' ) )
	}

	if ( document.querySelector( '.single-project-slider' ) ) {
		const projectSlider = document.querySelector( '.single-project-slider' );
		const splide = new Splide( projectSlider, {
			type      : 'loop',
			pagination: false,
		} ).mount();
	}

	// Partners
	const partners = document.querySelector( '#partners' );
	if ( partners ) {
		const choices = new Choices( partners );
		const select = document.querySelector( '.choices' );
		const searchIcon = `<img class="search-icon" src="${ php_data.IMG }/search.svg" />`;

		select.insertAdjacentHTML( 'beforeend', searchIcon );

		const partnerList = document.querySelectorAll( '.partner-detail' )
		
			// partnerList.forEach( p => {
			// 	console.log(p)
			// 	if ( p.dataset.detail === partners.value ) {
			// 		p.style.display = 'block'
			// 	} else {
			// 		p.style.display = 'none'
			// 	}
			// });
		partners.addEventListener( 'change', function() {
			partnerList.forEach( p => {
				if ( p.dataset.partner === partners.value ) {
					p.style.display = 'block'
				} else {
					p.style.display = 'none'
				}
			});
			
		} )
	}

	// Back to top
	const backToTop = document.querySelector( '#back-to-top' )
	if ( backToTop ) {
		backToTop.addEventListener( 'click', function() {
			window.scroll({top: 0, left: 0, behavior: 'smooth'});
		} )
	}

	// AJAX
	if ( document.querySelector( '.get-more' ) ) {
		const $ = jQuery;
		const getMore = document.querySelector( '.get-more' );
		let offset = 0;

		getMore.addEventListener( 'click', function() {
			$.post( {
				url: php_data.ajax_url,
				data: {
					'action': 'get_rotoi',
					'nonce' : php_data.nonce,
					'offset': offset+=3
				},
				success:function( data ) {
					$( '.rotoi-list' ).append( data )
				},
				error: function( err ){
					console.log( err );
				}
			} );  
		} )
	}

	// ANIMATION
	gsap.registerPlugin(ScrollTrigger);
	let speed = 100;

	if ( document.querySelector( '.home-banner' ) ) {
		let bannerScene = gsap.timeline();
		ScrollTrigger.create({
			animation: bannerScene,
			trigger: ".home-banner",
			start: "top top",
			end: "100% 100%",
			scrub: 3,
		});

		bannerScene.from( ".home-banner__why h2", { y: 1.2 * speed, scale: 0.9, ease: "power1.in" }, 0 )
				.from( ".home-banner__why p", { y: 1.5 * speed, ease: "power1.in" }, 0.02 )
				.from( ".scroll", { y: 1.3 * speed, ease: "power1.in" }, 0.03 )

		let introScene = gsap.timeline();
		ScrollTrigger.create({
			animation: introScene,
			trigger: ".home-intro",
			start: "top bottom",
			end: "100% 100%",
			scrub: 3,
		});

		introScene.from( ".home-intro .entry-image", { y: 2.4 * speed, ease: "power1.in" }, 0 )
				.from( ".intro-text", { y: 1.1 * speed, ease: "power1.in" }, 0 )
				.from( ".accordions", { y: 1.7 * speed, ease: "power1.in" }, 0.03 )
				.from( ".home-intro .roto-btn", { y: 1.4 * speed, ease: "power1.in" }, 0.03 )
	}

	if ( document.querySelector( '.about-banner' ) ) {
		let bannerScene = gsap.timeline();
		ScrollTrigger.create({
			animation: bannerScene,
			trigger: ".about-banner",
			start: "top top",
			end: "100% 100%",
			scrub: 3,
		});

		bannerScene.from( ".about-banner p:last-child", { y: 1.2 * speed, scale: 0.9, ease: "power1.in" }, 0 )

		let introScene = gsap.timeline();
		ScrollTrigger.create({
			animation: introScene,
			trigger: ".about-content",
			start: "top bottom",
			end: "100% 100%",
			scrub: 3,
		});

		introScene.from( ".about-content .col-left p", { y: 1.2 * speed, ease: "power1.in" }, 0 )
				.from( ".float-img", { y: 1.1 * speed, ease: "power1.in" }, 0.01 )
				.from( ".accordions", { y: 1.7 * speed, ease: "power1.in" }, 0.02 )
				.from( ".about-slider", { y: 1.4 * speed, ease: "power1.in" }, 0.03 )
	}


	new WOW().init();
});