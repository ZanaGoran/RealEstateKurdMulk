

<!DOCTYPE html>
<html lang="en">
  <head>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Real Estate Listings</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
  

    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />
 
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">

    
    <link
      href="../vendor2/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="../vendo2r/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link
      href="../vendor2/glightbox/css/glightbox.min.css"  rel="stylesheet"
    />

    <link rel="stylesheet" type="text/css" href="{{ asset('../vendor2/swiper/swiper-bundle.min.css') }}">
 

    <!-- t Main CSS File -->
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/newstyle.css') }}">
    
    <!-- =======================================================
  * t Name: Regna
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * t URL: https://bootstrapmade.com/regna-bootstrap-onepage-t/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  </head>

  <body>


 

  
    <!-- ======= Header ======= -->
    @include('navbar')
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    @php
    $backgroundImageUrl = asset('images/design-house-modern-villa-with-open-plan-living-private-bedroom-wing-large-terrace-with-privacy.jpg');
@endphp

<section style="background-image: url('{{ $backgroundImageUrl }}');" id="hero">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
        <h1>Kurdistan Real Estate</h1>
        <h2>
            A great platform to buy, sell and rent your properties without any agent or commissions.
        </h2>
    </div>
</section>
    <!-- End Hero Section -->

    <main id="main">
      <!-- ======= About Section ======= -->
      <section id="about">
        <div class="container" data-aos="fade-up">
          <!-- End Facts Section -->

          <!-- ======= Services Section ======= -->

          <!-- End Services Section -->

          <!-- ======= Call To Action Section ======= -->
          @php
    $SECbackgroundImageUrl2 = asset('../images/AdobeStock_565645717.jpeg');
@endphp
          <section id="register-index">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cover-box" style="background-image: url('{{ $SECbackgroundImageUrl2 }}');">
                    <div class="content">
                        <h3 class="cta-title">find your dream home</h3>
                        <p class="cta-text">
                       "Finding the perfect home can be a daunting task. The search button streamlines this process by allowing users to filter properties based on their specific criteria, such as location, price range"
                        @auth
                            <a class="cta-btn align-middle" href="list">SEARCH</a>
                        @else
                            <a class="cta-btn align-middle" href="{{ route('list') }}">SEARCH</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


          @php
    $SECbackgroundImageUrl = asset('../images/house.jpg');
@endphp

<section id="register-index">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cover-box" style="background-image: url('{{ $SECbackgroundImageUrl }}');">
                    <div class="content">
                        <h3 class="cta-title">Register Your Home</h3>
                        <p class="cta-text">
                            "Unlock the potential of your property and let its charm shine through. Upload your house here and embark on a journey to find the perfect buyer who will cherish it as much as you have. Together, let's turn your house into someone's dream home."
                        </p>
                        @auth
                            <a class="cta-btn align-middle" href="upload">Upload Your Home</a>
                        @else
                            <a class="cta-btn align-middle" href="{{ route('login') }}">Register Your Home</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

          <!-- End Call To Action Section -->

          <!-- search section -->

          
{{-- 
          /*
          <div class="onlylist-search-sort-container">
    <input type="text" class="onlylist-search-input" placeholder="Search..." id="onlylist-search-input" />
    <button class="onlylist-search-button" onclick="performSearch()">Search</button>
    <button id="onlylist-sort-by-date-button">SORT BY DATE</button>
    <button id="onlylist-sort-by-price-button">CHEAPEST PRICE</button>
</div>

<div class="onlylist-container">
    <ul>
        @foreach($properties as $property)
            <li class="onlylist-item-container">
                <a href="{{ isset($property) ? route('property.portfolio', ['id' => $property->id]) : '#' }}" class="onlylist-details-link" title="More Details">
                    @if (!empty($property->photos) && is_array($property->photos))
                        <!-- Display the first photo as the thumbnail -->
                        @if (!empty($property->photos[0]))
                            <img src="{{ asset($property->photos[0]) }}" class="img-fluid" alt="" />
                        @else
                            <p>No photo available</p>
                        @endif
                    @else
                        <p>No photo available</p>
                    @endif

                    <div class="onlylist-detail-of-home">
                        <div class="onlylist-title">{{ $property->title }}</div>
                        <div class="onlylist-item-price">{{ $property->price }}</div>
                        <div class="onlylist-item-date">{{ $property->created_at->format('d/m/Y') }}</div>
                    </div>
                    <!-- Updated the route name to onlylist-property.portofilio -->
                </a>
            </li>
        @endforeach
    </ul>
</div>

*/ --}}

<div class="about-centered-content">
    <div class="about-container">
        <h1>About Us</h1>
        <div class="about-info">
        <p>Welcome to our website!</p>
            <p>We are a group of passionate students who came together to create something beautiful.</p>
            <p>Our project started as a simple idea and grew into something much more. It's a testament to our dedication, creativity, and teamwork.</p>
            <p>Through hard work and collaboration, we've built a platform that we're proud of. This project has been a journey of learning and growth for all of us.</p>
            <p>Thank you for visiting and being a part of our story.</p>
            <p>Created by Ahmad Nyaz, Zana Goran, and Taha Ahmed.</p>
            <p><strong>Address:</strong> Erbil, Kurdistan, Iraq</p>
            <p><strong>Website Creation Date:</strong> April 3, 2024</p> 
            
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    let container = $('.onlylist-container');
    const itemsPerRow = 4;
    const rowsToShow = 2;
    const itemsToShow = itemsPerRow * rowsToShow;

    function initializeIsotope() {
        container.isotope({
            itemSelector: '.onlylist-item-container',
            getSortData: {
                date: function (item) {
                    const dateStr = $(item).find('.onlylist-item-date').text()
                    const dateParts = dateStr.split('/')
                    const year = parseInt(dateParts[2])
                    const month = parseInt(dateParts[1]) - 1
                    const day = parseInt(dateParts[0])
                    return new Date(year, month, day)
                },
                number: function (item) {
                    const priceStr = $(item).find('.onlylist-item-price').text()
                    const price = parseFloat(priceStr.replace('$', ''))
                    return price
                }
            }
        });

        // Limit the initial items to show
        container.isotope({ filter: ':lt(' + itemsToShow + ')' });
    }

    function sortBYdate() {
        container.isotope({ sortBy: 'date', sortAscending: false })
    }

    function sortBYprice() {
        container.isotope({ sortBy: 'number', sortAscending: true })
    }

    function performSearch() {
        let searchTerm = $('#onlylist-search-input').val().toLowerCase();
        container.isotope({
            filter: function () {
                let propertyTitle = $(this).find('.onlylist-title').text().toLowerCase();
                return propertyTitle.includes(searchTerm);
            }
        });
    }

    initializeIsotope();

    // Update the click event handler
    $('.onlylist-details-link').click(function (event) {
        // Stop the click event from propagating up to the parent li
        event.stopPropagation();

        let propertyId = $(this).attr('href').split('/').pop();

        // Redirect to the portfolio page with the property ID
        window.location.href = '{{ url("onlylist-portfolio") }}/' + propertyId;
    });

    $('#onlylist-sort-by-date-button').click(sortBYdate);
    $('#onlylist-sort-by-price-button').click(sortBYprice);

    $('#onlylist-search-input').on('input', performSearch);

    $(window).on('load', function () {
        container.isotope('layout')
    });
});


</script>



        <!-- end of search section -->

        <!-- 
    - #SERVICE
  -->
      </section>

      <!-- ======= Portfolio Section ======= -->
    


   
      <!-- End Portfolio Section -->

      <!-- ======= Team Section ======= -->

      <!-- End Team Section -->

     
      <!-- End Contact Section -->
      
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
   

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- t Main JS File -->
    <script>/**
* t Name: Regna
* Updated: Sep 18 2023 with Bootstrap v5.3.2
* t URL: https://bootstrapmade.com/regna-bootstrap-onepage-t/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
;(function () {
  'use strict'

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    if (!header.classList.contains('header-scrolled')) {
      offset -= 20
    }

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function (e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function (e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function (e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)

  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  })

  /**
   * Porfolio isotope and filter
   */

  window.addEventListener('load', () => {
    let portfolioContainer = document.querySelector('.portfolio-container')
    if (portfolioContainer) {
      let portfolioIsotope = new Isotope(portfolioContainer, {
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows',
        getSortData: {
          date: '.item-date', // Update this to match your HTML structure
        }
      })

      let portfolioFilters = document.querySelectorAll('#portfolio-flters li')

      portfolioFilters.forEach(function (filter) {
        filter.addEventListener('click', function (e) {
          e.preventDefault()
          portfolioFilters.forEach(function (el) {
            el.classList.remove('filter-active')
          })
          this.classList.add('filter-active')

          portfolioIsotope.arrange({
            filter: this.getAttribute('data-filter')
          })
          portfolioIsotope.on('arrangeComplete', function () {
            AOS.refresh()
          })
        })
      })

      let sortButton = document.querySelector('#portfolio-flters li[data-sort-by]')
      if (sortButton) {
        sortButton.addEventListener('click', function (e) {
          e.preventDefault()
          portfolioFilters.forEach(function (el) {
            el.classList.remove('item-date')
          })
          this.classList.add('item-date')

          portfolioIsotope.arrange({
            sortBy: this.getAttribute('data-sort-by')
          })
          portfolioIsotope.on('arrangeComplete', function () {
            AOS.refresh()
          })
        })
      }
    }
  })

  /**
   * Initiate portfolio lightbox 
   */
  const portfolioLightbox = GLightbox({
    selector: '.portfolio-lightbox'
  })

  /**
   * Portfolio details slider
   */
  new Swiper('.portfolio-details-slider', {
    speed: 300,
    loop: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    }
  })

  /**
   * Animation on scroll
   */
  window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    })
  })

  /**
   * Initiate Pure Counter 
   */
  new PureCounter()
})()
</script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
