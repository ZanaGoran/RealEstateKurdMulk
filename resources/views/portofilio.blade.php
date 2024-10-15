    <!-- resources/views/portofilio.blade.php-->
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>House Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/portofilio.css') }}">
    <!-- Bootstrap CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrQd9GmMJG8eZ5Aq/eJrNQ8u3lH5Z++sCD4yy3Qbs3a+nKPllXKkBOJ5npES5WgZRv3N8A5IJ9ow3LsTjw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
@include('navbar')


<div class="allin">
    <div class="property-container">
        <!-- Photo Slider -->
        <div class="property-images">
        <div
          id="propertyCarousel"
          class="carousel slide"
          data-bs-ride="carousel"
          data-bs-interval="5000"
        >
          <div class="carousel-inner">
            @foreach($property->photos as $index => $photo)
            <div class="carousel-item{{ $index === 0 ? ' active' : '' }}">
              <img src="{{ asset($photo) }}" alt="Property Photo" />
            </div>
            @endforeach
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#propertyCarousel"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#propertyCarousel"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

        <!-- Thumbnails -->
        <div class="property-thumbnails">
          @foreach($property->photos as $index => $photo)
          <div
            class="thumbnail-item"
            data-bs-target="#propertyCarousel"
            data-bs-slide-to="{{ $index }}"
          >
            <img
              src="{{ asset($photo) }}"
              class="img-thumbnail property-thumbnail"
              alt="Thumbnail {{ $index + 1 }}"
            />
          </div>
          @endforeach
        </div>
      </div>
      
      <div class="property-details">
        <div class="title-title-container">
          <div class="property-title">{{ $property->title }}</div>
          <div class="property-address">
            {{ $property->location }}
            <i class="fas fa-map-marker-alt" style="margin-right: 5px"></i>
          </div>
        </div>
        <div class="price-tag">${{ number_format($property->price) }}</div>

        <div class="other-property-info">
          <div class="property-detail-item">
            <span class="light-text">Property</span>
            <span
              >{{ ucfirst($property->type) }} <i class="fas fa-home"></i
            ></span>
          </div>
          <div class="property-detail-item">
            <span class="light-text">Type</span>
            <span
              >{{ ucfirst($property->type_of_rent) }}
              <i class="fas fa-calendar-alt"></i
            ></span>
          </div>
          <div class="property-detail-item">
            <span class="light-text">Bedrooms</span>
            <span>{{ $property->bedrooms }} <i class="fas fa-bed"></i></span>
          </div>
          <div class="property-detail-item">
            <span class="light-text">Bathrooms</span>
            <span>{{ $property->bathrooms }} <i class="fas fa-bath"></i></span>
          </div>
          <div class="property-detail-item">
            <span class="light-text">Area</span>
            <span
              >{{ $property->square_footage }} ft²
              <i class="fas fa-ruler-combined"></i
            ></span>
          </div>
          <div class="property-detail-item">
            <span class="light-text">Flooring</span>
            <span
              >{{ $property->flooring }} <i class="fas fa-th-large"></i
            ></span>
          </div>
        </div>

        <div class="property-description">
          <h5>Description</h5>
          <p>{{ $property->description }}</p>
        </div>
      </div>

         <!-- Agent Info Section -->
         <div class="agent-info">
        <div class="agent-name">Real Estate Agent</div>
        <img
          src="{{ asset('property_images/IMG_0697.JPG') }}"
          alt="Agent Photo"
          class="agent-photo"
        />
        <div class="agent-details">
          <div class="agent-name">Suhaib Ayad</div>
          <div class="agent-reviews">
            <i class="fas fa-star" style="color: gold"></i
            ><strong> 4.9/5</strong>
            <div class="agent-reviews-num">(123 Reviews)</div>
          </div>
          <div class="agent-properties">24 Properties</div>
          <div class="agent-cont">
           
            <div class="agent-phone"><strong>075*****-567</strong></div>
            <div class="contact-agent">
              <button class="show-num">Show Number</button>
            </div>
          </div>
          <div class="show-agent-properties">
            <button>Show Agent Properties</button>
          </div>
          <div class="show-agents">
            <i class="fas fa-search" style="margin-right: 5px"></i> find other
            agents
          </div>
        </div>
      </div>
    </div>

   <!-- Property Info -->
<div class="property-info">
    <!-- Container for map and contact form -->
    <div class="contact-us-container">
        <!-- Map Placeholder -->
        <div id="map" class="map-placeholder"></div>

        <!-- Contact Us Form -->
        <div class="contact-us-form">
            <h2>Contact Us</h2>
            <form action="/submit-contact" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="name">Phone Number:</label>
                    <input type="number" id="phone-number" name="phone-number" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>


    <!-- Report Form -->
    <div class="row">
        <div class="col-lg-12">
            <div class="report-form">
                <form method="post" action="{{ route('report.store') }}">
                    @csrf
                    <div>
                        <label for="report">Report:</label>
                        <textarea id="report" name="report"></textarea>
                    </div>
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <button type="submit">Submit Report</button>
                </form>
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            </div>
        </div>
    </div>
    </div>
   <!-- JavaScript for carousel and active thumbnail border -->
   <script>
      function initMap() {
        var location = { lat: 36.193179, lng: 43.970004 }; // Default coordinates

        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: location,
          mapTypeId: "satellite",
        });

        var marker = new google.maps.Marker({
          position: location,
          map: map,
        });
      }

      document.addEventListener("DOMContentLoaded", function () {
        const thumbnails = document.querySelectorAll(".thumbnail-item");
        const carouselItems = document.querySelectorAll(".carousel-item");

        thumbnails.forEach((thumbnail, index) => {
          thumbnail.addEventListener("click", () => {
            thumbnails.forEach((t) => t.classList.remove("active-thumbnail"));
            thumbnail.classList.add("active-thumbnail");
          });

          if (carouselItems[index].classList.contains("active")) {
            thumbnail.classList.add("active-thumbnail");
          }
        });

        var propertyCarousel = new bootstrap.Carousel(
          document.getElementById("propertyCarousel"),
          {
            interval: 4000,
            wrap: true,
          }
        );

        var carouselElement = document.getElementById("propertyCarousel");
        carouselElement.addEventListener("mouseenter", function () {
          propertyCarousel.pause();
        });
        carouselElement.addEventListener("mouseleave", function () {
          propertyCarousel.cycle();
        });

        carouselElement.addEventListener("slide.bs.carousel", function (e) {
          thumbnails.forEach((t) => t.classList.remove("active-thumbnail"));
          thumbnails[e.to].classList.add("active-thumbnail");
        });

        // Load the map
        initMap();
      });
    </script>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWAA1UqFQG8BzniCVqVZrvCzWHz72yoOA&callback=initMap&libraries=&v=weekly"
      async
      defer
    ></script>
  </body>
</html>