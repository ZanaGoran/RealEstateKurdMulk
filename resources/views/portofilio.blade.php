<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>House Details</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet" />

    <!-- Bootstrap CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* General styles */
        body {
            background: #f8f9fa;
            color: #333;
            font-family: "Open Sans", sans-serif;
            margin: 0;
            padding: 0;
        }

        a {
            color: #2dc997;
            text-decoration: none;
        }

        a:hover,
        a:active,
        a:focus {
            color: #2dca98;
            text-decoration: none;
        }

        /* Header styles */
        #header {
            height: 90px;
            background: rgba(52, 59, 64, 0.9);
            padding: 10px;
        }

        #header #logo h1 {
            font-size: 32px;
            color: #fff;
            margin: 0;
        }

        /* Navigation Menu styles */
        .navbar ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar a {
            color: #fff;
            font-size: 14px;
            padding: 10px 15px;
            text-transform: uppercase;
        }

        /* Breadcrumbs Section */
        .breadcrumbs {
            background-color: #eee;
            padding: 20px 0;
        }

        .breadcrumbs h2 {
            color: #333;
            margin: 0;
        }

        .breadcrumbs ol {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }

        .breadcrumbs li {
            display: inline;
            margin-right: 5px;
        }

        /* Portfolio Details Section */
        #portfolio-details {
            padding: 60px 0;
        }

        .portfolio-info h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .portfolio-info ul {
            list-style: none;
            padding: 0;
        }

        .portfolio-info li {
            margin-bottom: 10px;
        }

        .portfolio-description h2 {
            font-size: 24px;
            color: #333;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .portfolio-description p {
            color: #666;
            line-height: 1.6;
        }

        /* Footer Section */
        #footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        #footer .copyright {
            font-size: 14px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .navbar ul {
                flex-direction: column;
                align-items: center;
            }

            .navbar a {
                padding: 10px 0;
            }
        }

        /* Additional custom styles for the fixed photo box */
        .fixed-photo-box {
            width: 100%;
            height: 600px; /* Fixed height for the photo box */
            overflow: hidden;
        }

        .fixed-photo-box img {
            width: auto;
            height: 100%;
            display: block;
            margin: 0 auto;
        }
        form {
        margin-top: 20px;
        max-width: 400px;
        width: 100%;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #333;
    }

    textarea {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 15px;
        resize: vertical;
    }

    button {
        background-color: #2dc997;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Success message styles */
    .alert-success {
        background-color: #dff0d8;
        color: #3c763d;
        border: 1px solid #d6e9c6;
        border-radius: 4px;
        padding: 15px;
        margin-top: 15px;
    }
</style>
    </style>
</head>

<body class="black-navbar">
    <div id="header">
        <!-- Include your existing navbar -->
        @include('navbar')
    </div>
    <div class="container">
        <main id="main">
            <!-- Breadcrumbs Section -->
            <section class="breadcrumbs">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Portfolio Details</h2>
                        <ol>
                            <li><a href="{{ route('newindex') }}">Home</a></li>
                            <li>House Details</li>
                        </ol>
                    </div>
                </div>
            </section>
            <!-- Portfolio Details Section -->
            <section id="portfolio-details" class="portfolio-details">
                <div class="container">
                    <div class="row gy-4">
                        <!-- Property Details (Right Side) -->
                        <div class="col-lg-6">
                            <div class="portfolio-info">
                                <h3>House Information</h3>
                                <ul>
                                    <li><strong>Title: </strong>{{ $property->title }}</li>
                                    <li><strong>Location: </strong>{{ $property->location }}</li>
                                    <li><strong>Type: </strong>{{ ucfirst($property->type) }}</li>
                                    <li><strong>Type of Rent: </strong>{{ ucfirst($property->type_of_rent) }}</li>
                                    <li><strong>Bedrooms: </strong>{{ $property->bedrooms }}</li>
                                    <li><strong>Bathrooms: </strong>{{ $property->bathrooms }}</li>
                                    <li><strong>Square Footage: </strong>{{ $property->square_footage }}</li>
                                    <li><strong>Phone number: </strong>{{ $property->parking_spaces }}</li>
                                    <li><strong>Flooring: </strong>{{ $property->flooring }}</li>
                                    <li><strong>Price: </strong>${{ $property->price }}</li>
                                    
                                    <!-- Add other property details here -->
                                    <!-- ... Add more details as needed ... -->
                                </ul>
                            </div>
                            <div class="portfolio-description">
                                <h2>Details</h2>
                                <p>{{ $property->description }}</p>
                            </div>



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
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                        </div>
                        <!-- Photo Slider (Left Side) -->
                        <div class="col-lg-6">
                            <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000"> <!-- Adjusted interval to 5 seconds -->
                                <div class="carousel-inner">
                                    @foreach($property->photos as $index => $photo)
                                        <div class="carousel-item{{ $index === 0 ? ' active' : '' }}">
                                            <div class="fixed-photo-box"> <!-- Added a fixed box for photos -->
                                                <img src="{{ asset($photo) }}" class="d-block w-100" alt="Property Photo">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- Footer Section -->
    
    </div>

    <!-- Vendor JS Files -->

    <!-- Main JS File -->
   <!-- Main JS File -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var propertyCarousel = new bootstrap.Carousel(document.getElementById('propertyCarousel'), {
            interval: 5000 // Set interval to 5000 milliseconds (5 seconds)
        });
    });
</script>

</body>

</html>
