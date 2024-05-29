<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/list-style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    
    <title>Sorting List</title>
    <style>
        body {
            background-color: #555555;
            font-family: "Open Sans", sans-serif;
            margin: 0;
            padding: 0;
            background: radial-gradient(ellipse at bottom, #0d1d31 0%, #416a6e 100%);
        }
        .container {
            margin: 2%;
            width: 100%;
            max-width: 2200px;
        }
        .container ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
        }
        .item-container {
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
            margin-right: 10px;
            margin-left: 5px;
            border: none;
            border-radius: 4px;
            background-color: #f9f9f9;
            width: calc(26% - 50px);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            transition: all ease-in-out 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .background-image-container {
            position: relative;
            width: 100%;
            padding-top: 75%;
            overflow: hidden;
        }
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: transform 0.3s, opacity 0.3s;
            opacity: 0;
        }
        .background-image.active {
            opacity: 1;
        }
        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            font-size: 20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background 0.3s;
            z-index: 2;
        }
        .arrow:hover {
            background: rgba(0, 0, 0, 0.7);
        }
        .arrow.prev {
            left: 10px;
        }
        .arrow.next {
            right: 10px;
        }
        .item-home-type, .item-type-of-home, .item-price, .item-date {
            position: absolute;
            padding: 5px 10px;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.8);
            color: darkcyan;
            font-size: 0.9em;
            font-weight: bold;
            z-index: 1;
        }
        .item-home-type {
            top: 10px;
            left: 10px;
        }
        .item-type-of-home {
            top: 10px;
            right: 10px;
        }
        .item-price {
            bottom: 10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.8);
            color: darkcyan;
        }
        .item-date {
            bottom: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.8);
            color: darkcyan;
        }
        .item-container:hover {
            box-shadow: 0 0 40px #2dc997;
        }
        .item-container:hover .background-image {
            transform: scale(1.1);
        }
        .item-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }
        .item-container a {
            text-decoration: none;
            color: #555555;
            display: block;
            width: 100%;
        }
        .detail-of-home {
            width: 100%;
            padding: 5px 10px;
            background: lightgray;
            color: darkcyan;
            text-align: left;
            border-radius: 0 0 4px 4px;
            transition: all ease-in-out 0.3s;
            box-sizing: border-box;
            position: relative;
        }
        .detail-of-home .title {
            font-size: 1em;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .detail-of-home .item-location {
            font-size: 0.9em;
            color: darkcyan;
            margin-bottom: 5px;
        }
        .detail-of-home .item-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .detail-of-home .item-info span {
            display: flex;
            align-items: center;
            margin-right: 10px;
        }
        .detail-of-home .item-info span i {
            margin-right: 5px;
        }
        .sort-buttons {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .sort-buttons button {
            border: none;
            cursor: pointer;
            padding: 12px 18px;
            font-size: 14px;
            font-weight: 500;
            transition: all ease-in-out 0.3s;
            border-radius: 4px;
        }
        #sort-by-date-button {
            color: #fff;
            background: #2dc997;
        }
        #sort-by-date-button:hover {
            background: #27ae80;
        }
        #sort-by-price-button {
            background-color: #ebebeb;
            color: #525252;
        }
        #sort-by-price-button:hover {
            background-color: #2dc997;
            color: #fff;
        }
        .search-sort-container {
            padding: 25px;
            background-color: #416a6e;
            text-align: center;
        }
        .search-sort-container .search-input,
        .search-sort-container .search-button,
        .search-sort-container #sort-by-date-button,
        .search-sort-container #sort-by-price-button {
            border: none;
            cursor: pointer;
            padding: 12px 18px;
            font-size: 14px;
            font-weight: 500;
            transition: all ease-in-out 0.3s;
            border-radius: 4px;
            margin: 0 5px;
        }
        .search-sort-container .search-input {
            width: 200px;
        }
        .search-sort-container .search-button,
        .search-sort-container #sort-by-price-button {
            background-color: #ebebeb;
            color: #525252;
        }
        .search-sort-container .search-button:hover,
        .search-sort-container #sort-by-price-button:hover {
            background-color: #2dc997;
            color: #fff;
        }
        .search-sort-container #sort-by-date-button {
            background: #2dc997;
            color: #fff;
        }
        .search-sort-container #sort-by-date-button:hover {
            background: #27ae80;
        }
        .filter-dropdown {
            border: none;
            padding: 10px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            background-color: #ebebeb;
            color: #525252;
            margin: 0 10px;
        }
        .filter-dropdown:hover {
            background-color: #2dc997;
            color: #fff;
        }
        .dropdown-container {
            margin-top: 20px;
            text-align: center;
        }
        .item-container:hover .background-image {
            transform: scale(1.1);
        }
        .item-container:hover .detail-of-home {
            transform: scale(1);
        }
    </style>
</head>
<body>
    @include('navbar')
    <div class="search-sort-container">
        <input type="text" class="search-input" placeholder="Search..." id="search-input" />
        <button class="search-button" onclick="performSearch()">Search</button>
        <button id="sort-by-date-button">SORT BY DATE</button>
        <button id="sort-by-price-button">CHEAPEST PRICE</button>
        <select id="home-type-dropdown" class="filter-dropdown">
            <option value="">All Home Types</option>
            <option value="house">House</option>
            <option value="building">Building</option>
            <option value="apartment">Apartment</option>
            <option value="property">Property</option>
        </select>
        <select id="type-of-home-dropdown" class="filter-dropdown">
            <option value="">All Types</option>
            <option value="sell">Sell</option>
            <option value="rent">Rent</option>
        </select>
    </div>
    <div class="container">
        <ul>
            @foreach($properties as $property)
                <li>
                    <div class="item-container">
                        <div class="background-image-container">
                            @php
                                $photos = is_array($property->photos) ? $property->photos : [$property->photos];
                            @endphp
                            @foreach($photos as $index => $photo)
                                <div class="background-image{{ $index == 0 ? ' active' : '' }}" style="background-image: url('{{ asset($photo) }}');"></div>
                            @endforeach
                            <div class="arrow prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="arrow next"><i class="fas fa-chevron-right"></i></div>
                            <div class="item-price">{{ $property->price }} $</div>
                            <div class="item-date"><i class="fas fa-calendar-alt"></i> {{ $property->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="item-home-type">{{ $property->type }}</div>
                        <div class="item-type-of-home">{{ $property->type_of_rent }}</div>
                        <a href="{{ route('property.portfolio', ['id' => $property->id]) }}" class="details-link" title="More Details">
                            <div class="detail-of-home">
                                <div class="title">{{ $property->title }}</div>
                                <div class="item-location"><i class="fas fa-map-marker-alt"></i> {{ $property->location }}</div>
                                <div class="item-info">
                                    <span><i class="fas fa-bed"></i> {{ $property->bedrooms }}</span>
                                    <span><i class="fas fa-bath"></i> {{ $property->bathrooms }}</span>
                                    <span><i class="fas fa-ruler-combined"></i> {{ $property->square_footage }} m</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <script>
 $(document).ready(function () {
    let container = $('.container');

    // Function to initialize Isotope
    function initializeIsotope() {
        container.isotope({
            itemSelector: '.item-container', // Selector for individual items
            getSortData: {
                // Custom sorting options
                date: function (item) {
                    const dateStr = $(item).find('.item-date').text();
                    const dateParts = dateStr.split('/');
                    const year = parseInt(dateParts[2]);
                    const month = parseInt(dateParts[1]) - 1;
                    const day = parseInt(dateParts[0]);
                    return new Date(year, month, day);
                },
                number: function (item) {
                    const priceStr = $(item).find('.item-price').text();
                    const price = parseFloat(priceStr.replace('$', ''));
                    return price;
                }
            }
        });
        container.isotope({ sortBy: 'date', sortAscending: false }); // Initial sorting
    }

    // Function to sort by date
    function sortByDate() {
        container.isotope({ sortBy: 'date', sortAscending: false });
    }

    // Function to sort by price
    function sortByPrice() {
        container.isotope({ sortBy: 'number', sortAscending: true });
    }

    // Function to perform search/filtering
    function performSearch() {
        let searchTerm = $('#search-input').val().toLowerCase();
        container.isotope({
            filter: function () {
                let propertyTitle = $(this).find('.title').text().toLowerCase();
                let homeType = $('#home-type-dropdown').val();
                let typeOfHome = $('#type-of-home-dropdown').val();
                let propertyHomeType = $(this).find('.item-home-type').text().toLowerCase();
                let propertyTypeOfHome = $(this).find('.item-type-of-home').text().toLowerCase();
                let matchesSearch = propertyTitle.includes(searchTerm);
                let matchesHomeType = homeType === "" || propertyHomeType === homeType.toLowerCase();
                let matchesTypeOfHome = typeOfHome === "" || propertyTypeOfHome === typeOfHome.toLowerCase();
                return matchesSearch && matchesHomeType && matchesTypeOfHome;
            }
        });
    }

    // Function to get query parameter from URL
    function getQueryParameter(name) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Initialize Isotope
    initializeIsotope();

    // Perform search if search query is present in URL
    let searchQuery = getQueryParameter('q');
    if (searchQuery) {
        $('#search-input').val(searchQuery);
        performSearch();
    }

    // Click event handlers for sorting buttons
    $('#sort-by-date-button').click(sortByDate);
    $('#sort-by-price-button').click(sortByPrice);

    // Event listeners for search/filtering
    $('#search-input').on('input', performSearch);
    $('#home-type-dropdown').change(performSearch);
    $('#type-of-home-dropdown').change(performSearch);

    // Click event handler for details link
    $('.details-link').click(function (event) {
        let propertyId = $(this).attr('href').split('/').pop();
        window.location.href = '{{ url("portfolio") }}/' + propertyId;
    });

    // Button styling based on click
    let DateBTN = $('#sort-by-date-button');
    let PriceBTN = $('#sort-by-price-button');

    PriceBTN.on('click', function () {
        DateBTN.css({ backgroundColor: '#ebebeb', color: '#666666' });
        PriceBTN.css({ backgroundColor: '#2dc997', color: 'white' });
    });

    DateBTN.on('click', function () {
        DateBTN.css({ backgroundColor: '#2dc997', color: 'white' });
        PriceBTN.css({ backgroundColor: '#ebebeb', color: '#666666' });
    });

    // Swiping Functionality
    $('.item-container').each(function () {
        let images = $(this).find('.background-image');
        if (images.length > 1) {
            let currentIndex = 0;

            $(this).find('.arrow').click(function () {
                images.eq(currentIndex).removeClass('active');
                if ($(this).hasClass('prev')) {
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                } else if ($(this).hasClass('next')) {
                    currentIndex = (currentIndex + 1) % images.length;
                }
                images.eq(currentIndex).addClass('active');
            });

            images.eq(0).addClass('active');
        }
    });

    // Ensure Isotope layout is refreshed after images are loaded
    container.imagesLoaded(function () {
        container.isotope('layout');
    });
});

    </script>
</body>
</html>
