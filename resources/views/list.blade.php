<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/list-style.css') }}">
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

        .container ul {
    list-style: none; /* Remove bullet points from the list */
}

        .item-container {
            list-style:none;
    position: relative;
    overflow: hidden;
    list-style: none;
    margin-bottom: 20px;
    margin-left: 1.85%;
    border: none;
    border-radius: 4px;
    background-color: #f9f9f9;
    width: 23%;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: all ease-in-out 0.3s;
}

.item-container .background-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transition: transform 0.3s;
}

.item-container:hover{

    box-shadow: 0 0 40px #2dc997;


}
.item-container img {
    width: 100%;
    height: 100%;
    min-width: 100%; /* Ensure minimum width */
    min-height: 100%; /* Ensure minimum height */
    object-fit: cover; /* Maintain aspect ratio and cover container */
    transition: transform 0.4s; /* Add transition for smooth scaling */
}




.item-container:hover .background-image {
    transform: scale(1.1); /* Scale the image on hover */
}











        .item-container a {
            text-decoration: none;
            color: #555555;
        }

        .item-container .item-date {
            text-decoration: none;
            font-size: 16px;
        }

        .item-container .location {
            display: flex;
            flex-direction: row;
            text-decoration: none;
            font-size: 20px;
            white-space: nowrap;
        }

        .item-container .item-price {
            text-decoration: none;
            font-size: 22px;
        }

        .item-container img {
    object-fit: cover; /* Ensure the image covers the entire container */
    width: 100%;
    height: 100%; /* Use 100% height to cover the container */
    transition: transform 0.3s;
}


        

        .detail-of-home {
    position: absolute;
    margin-top: 0px;
    top: 88%;
    left: 50%;
    padding-top: 5%;
    padding-bottom: 5%;
    transform: translate(-50%, -50%);
    z-index: 1;
    background: rgba(18, 48, 38, 0.7);
    color: white;
    padding-right: 50%;
    padding-left: 50%;
    border-radius: 4px;
    transition: all ease-in-out 0.3s;
    white-space: nowrap; /* Prevent text from wrapping */
    overflow: hidden; /* Hide overflow text */
    text-align: center;
}


        .sort-buttons button {
            border: none;
            cursor: pointer;
            display: inline-block;
            padding: 12px 18px 14px 18px;
            font-size: 14px;
            font-weight: 500;
            line-height: 1;
            color: #666666;
            margin: 0 5px 10px 5px;
            transition: all ease-in-out 0.3s;
            background: white;
            border-radius: 4px;
        }

        .sort-buttons {
            margin-top: 40px;
            margin-left: 40%;
            border: none;
            align-items: center;
            align-content: center;
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .sort-buttons #sort-by-date-button {
            align-items: center;
            align-content: center;
            color: #fff;
            background: #2dc997;
            border: none;
        }

        .sort-buttons #sort-by-date-button:hover {
            color: #fff;
            background: #2dc997;
            border: none;
        }

        .sort-buttons #sort-by-price-button {
            background-color: #ebebeb;
            color: rgb(82, 82, 82);
            transition: all ease-in-out 0.3s;
        }

        .sort-buttons #sort-by-price-button:hover {
            color: rgb(255, 255, 255);
            background-color: #2dc997;
        }

        .item-container img:hover {
            top: -30px;
        }

        .search-sort-container {
            padding: 25px;
            height: 40px;
            background-color:#416a6e;
            text-align: center;
        }

        .search-sort-container .search-input,
        .search-sort-container .search-button,
        .search-sort-container #sort-by-date-button,
        .search-sort-container #sort-by-price-button {
            border: none;
            cursor: pointer;
            display: inline-block;
            padding: 12px 18px 14px 18px;
            font-size: 14px;
            font-weight: 500;
            line-height: 1;
            margin: 0 5px;
            transition: all ease-in-out 0.3s;
            border-radius: 4px;
        }

        .search-sort-container .search-input {
            padding: 13px;
            width: 200px; /* Adjust the width as needed */
            border: none;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .search-sort-container .search-button,
        .search-sort-container #sort-by-price-button {
            background-color: #ebebeb;
            color: rgb(82, 82, 82);
            transition: all ease-in-out 0.3s;
        }

        .search-sort-container .search-button:hover,
        .search-sort-container #sort-by-price-button:hover {
            color: rgb(255, 255, 25f5);
            background-color: #2dc9d7;
        }

        .search-sort-container #sort-by-date-button {
            color: #fff;
            background: #2dc997;
        }

        .search-sort-container #sort-by-date-button:hover {
            color: #fff;
            background: #2dc997;
        }
       .navnav{
        text-decoration: none;
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
    </div>

    <div class="container">
    <ul>
        @foreach($properties as $property)
            <li>
                <div class="item-container">
                    <a href="{{ isset($property) ? route('property.portfolio', ['id' => $property->id]) : '#' }}" class="details-link" title="More Details">
                        @if (!empty($property->photos) && is_array($property->photos))
                            <!-- Display the first photo as the thumbnail -->
                            @if (!empty($property->photos[0]))
                                <div class="background-image" style="background-image: url('{{ asset($property->photos[0]) }}');"></div>
                            @else
                                <p>No photo available</p>
                            @endif
                        @else
                            <p>No photo available</p>
                        @endif
                        <div class="detail-of-home">
                            <div class="title">{{ $property->title }}</div>
                            <div class="item-price">{{ $property->price }}</div>
                            <div class="item-date">{{ $property->created_at->format('d/m/Y') }}</div>
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

        function initializeIsotope() {
            container.isotope({
                itemSelector: '.item-container',
                getSortData: {
                    date: function (item) {
                        const dateStr = $(item).find('.item-date').text()
                        const dateParts = dateStr.split('/')
                        const year = parseInt(dateParts[2])
                        const month = parseInt(dateParts[1]) - 1
                        const day = parseInt(dateParts[0])
                        return new Date(year, month, day)
                    },
                    number: function (item) {
                        const priceStr = $(item).find('.item-price').text()
                        const price = parseFloat(priceStr.replace('$', ''))
                        return price
                    }
                }
            })
            container.isotope({ sortBy: 'date', sortAscending: false })
        }

        function sortBYdate() {
            container.isotope({ sortBy: 'date', sortAscending: false })
        }

        function sortBYprice() {
            container.isotope({ sortBy: 'number', sortAscending: true })
        }

        function performSearch() {
    let searchTerm = $('#search-input').val().toLowerCase();
    container.isotope({
        filter: function () {
            let propertyTitle = $(this).find('.title').text().toLowerCase();
            return propertyTitle.includes(searchTerm);
        }
    });
}


        initializeIsotope();

        // Update the click event handler
        $('.details-link').click(function (event) {
            // Stop the click event from propagating up to the parent li
            event.stopPropagation();

            let propertyId = $(this).attr('href').split('/').pop();

            // Redirect to the portfolio page with the property ID
            window.location.href = '{{ url("portfolio") }}/' + propertyId;
        });

        $('#sort-by-date-button').click(sortBYdate)
        $('#sort-by-price-button').click(sortBYprice)

        $('#search-input').on('input', performSearch);

        $(window).on('load', function () {
            container.isotope('layout')
        })
    })

    let DateBTN = document.getElementById('sort-by-date-button')
    let PriceBTN = document.getElementById('sort-by-price-button')

    PriceBTN.addEventListener('click', function () {
        DateBTN.style.backgroundColor = '#ebebeb'
        DateBTN.style.color = '#666666'

        PriceBTN.style.backgroundColor = '#2dc997'
        PriceBTN.style.color = 'white'
    })

    DateBTN.addEventListener('click', function () {
        DateBTN.style.backgroundColor = '#2dc997'
        DateBTN.style.color = 'white'

        PriceBTN.style.backgroundColor = '#ebebeb'
        PriceBTN.style.color = '#666666'
    })
</script>


    <script src="list-java.js"></script>
</body>
</html>