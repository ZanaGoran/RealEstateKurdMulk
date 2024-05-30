<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Property Listing Form</title>
    <style>
      body {
        font-family: "Arial", sans-serif;
        background-color: #cacaca;
        margin: 0;
        padding: 0;
      }

      .container {
        text-align: center;
      }

      /* Styles for the form */
      .property-form {
        margin-top: 50px;
        max-width: 1300px;
        width: 100%;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        position: relative;
        margin: auto;
      }

      .property-form div {
        margin-bottom: 20px;
      }

      .property-form label {
        display: block;
        margin-bottom: 5px;
        text-shadow: 17px 17px 26px #717171;
      }

      .property-form input,
      .property-form textarea,
      .property-form select {
        border: none;
        border-radius: 68px;
        background: #e0e0e0;
        box-shadow: 17px 17px 26px #a6a6a6, -9px -9px 45px #ffffff;
        width: 100%;
        padding: 12px;
        box-sizing: border-box;
      }

      /* Styles for the drop zone */
      .drop-zone {
        width: 100%;
        max-width: 400px;
        height: 150px;
        border: none;
        border-radius: 34px;
        background: #e0e0e0;
        box-shadow: 29px 29px 45px #777777, -20px -20px 65px #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        position: relative;

        color: #797c7d;
        font-size: 16px;
        margin-bottom: 20px;
        transition: 0.9s;
      }
      .drop-zone:hover {
        box-shadow: 29px -8px 45px #777777, -20px 7px 65px #ffffff;

        color: #484848;
        font-size: 17px;
      }

      .drop-zone.highlight {
        border-color: #00ffcc;
        color: #16a2ac;
        font-size: 20px;
      }

      /* Styles for the preview */
      .preview {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 10px;
      }

      .preview-item {
        position: relative;
      }

      .preview img {
        max-width: 100px;
        max-height: 100px;
        margin: 10px;
        border-radius: 5px;
      }

      .remove-button {
        position: absolute;
        top: -5px;
        right: -5px;

        color: #000000;
        border: none;
        background: transparent;
        cursor: pointer;
        padding: 7px;
        font-size: 14px;
        line-height: 1;
        transition: 0.4s;
      }
      .remove-button:hover {
        position: absolute;
        top: -5px;
        right: -5px;

        color: #ff0000;
        border: none;
        background: transparent;
        cursor: pointer;
        padding: 7px;
        font-size: 16px;
        line-height: 1;
      }
      /* Style for the file input button */
      #fileInputButton {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
      }

      /* Style for the submit button */
      #submitBtn {
        background: radial-gradient(circle, rgba(64,170,250,1) 7%, rgba(19,67,113,1) 84%);
        color: #ffffff;
        padding: 15px;
        padding-left: 25px;
        padding-right: 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        position: absolute;
        bottom: -60px;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: 7px 7px 45px #777777, -2px -2px 65px #ffffff;
        transition: 0.9s;
      }
      #submitBtn:hover {
        background: radial-gradient(circle, rgba(64,170,250,1) 7%, rgba(19,67,113,1) 84%);
        color: #ffffff;
        font-size: 14px;
      }

      /* Add styles for black-navbar class */
      .black-navbar #header #navbar a,
      .black-navbar #header #navbar a:focus {
        color: #000; /* Set the desired text color */
      }

      .black-navbar #header {
        background: #fff; /* Set the desired background color */
      }
    </style>
  </head>
  <body class="black-navbar">
    <div class="container">
      @include('navbar')
      <div id="error-messages"></div>
      <form action="{{ route('property.upload') }}" method="post" class="property-form" id="propertyForm" enctype="multipart/form-data">
        @csrf

        <div>
          <label for="title">Title:</label>
          <input type="text" id="title" name="title" required />
        </div>

        <div>
          <label for="location">Location:</label>
          <input type="text" id="location" name="location" required />
        </div>

        <div>
          <label for="type">Type:</label>
          <select id="type" name="type" required>
            <option value="house">House</option>
            <option value="building">Building</option>
            <option value="apartment">Apartment</option>
          </select>
        </div>

        <div>
          <label for="type_of_rent">Type of Rent:</label>
          <select id="type_of_rent" name="type_of_rent" required>
            <option value="sell">Sell</option>
            <option value="rent">Rent</option>
          </select>
        </div>

        <div>
          <label for="bedrooms">Bedrooms:</label>
          <input type="number" id="bedrooms" name="bedrooms" required />
        </div>

        <div>
          <label for="bathrooms">Bathrooms:</label>
          <input type="number" id="bathrooms" name="bathrooms" required />
        </div>

        <div>
          <label for="square_footage">Square Footage:</label>
          <input type="number" id="square_footage" name="square_footage" required />
        </div>

        <div>
          <label for="parking_spaces">Phone Number:</label>
          <input type="number" id="parking_spaces" name="parking_spaces" required />
        </div>

        <div>
          <label for="flooring">Flooring:</label>
          <input type="text" id="flooring" name="flooring" required />
        </div>

        <div>
          <label for="price">Price:</label>
          <input type="number" id="price" name="price" required />
        </div>

        <div>
          <label for="additional_information">Additional Information:</label>
          <textarea id="additional_information" name="description"></textarea>
        </div>

        <div id="drop-zone" class="drop-zone">
          Drag and drop photos here
          <input type="file" id="fileInputButton" name="photos[]" multiple />
        </div>

        <div id="preview" class="preview"></div>

        <button type="button" id="submitBtn" onclick="submitForm()">Submit</button>
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
      </form>
    </div>

    <script>
       const dropZone = document.getElementById("drop-zone");
const preview = document.getElementById("preview");
const fileInputButton = document.getElementById("fileInputButton");
const errorMessages = document.getElementById("error-messages");

function submitForm() {
    errorMessages.innerHTML = ""; // Clear previous error messages

    // Fetch the form data
    const form = document.getElementById("propertyForm");
    const formData = new FormData(form);

    fetch(form.action, {
        method: form.method,
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                // Display Laravel validation errors
                for (const field in data.error) {
                    displayErrorMessage(data.error[field][0]);
                }
            } else if (data.user_error) {
                // Display user-specific error
                displayErrorMessage(data.user_error);
            } else {
                // Your success handling logic here
                window.location.href = "{{ route('property.list') }}";
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

let totalFileSize = 0;

dropZone.addEventListener("dragover", handleDragOver, false);
dropZone.addEventListener("dragleave", handleDragLeave, false);
dropZone.addEventListener("drop", handleDrop, false);
fileInputButton.addEventListener("change", handleFiles, false);

function handleDragOver(event) {
    event.preventDefault();
    dropZone.classList.add("highlight");
}

function handleDragLeave(event) {
    event.preventDefault();
    dropZone.classList.remove("highlight");
}

function handleDrop(event) {
    event.preventDefault();
    dropZone.classList.remove("highlight");

    const files = Array.from(event.dataTransfer.files);

    files.forEach(function (file) {
        if (checkTotalFileSize(file.size)) {
            totalFileSize += file.size;
            previewFile(file);
        } else {
            displayErrorMessage("File size exceeds the limit (20 MB). Please choose smaller files.");
        }
    });
}

function handleFiles(event) {
    const files = Array.from(event.target.files);

    files.forEach(function (file) {
        if (checkTotalFileSize(file.size)) {
            totalFileSize += file.size;
            previewFile(file);
        } else {
            displayErrorMessage("File size exceeds the limit (20 MB). Please choose smaller files.");
        }
    });
}

function checkTotalFileSize(fileSize) {
    const maxSize = 20 * 1024 * 1024; // 20 MB
    return totalFileSize + fileSize <= maxSize;
}

function removeFile(fileSize) {
    totalFileSize -= fileSize;
}

function previewFile(file) {
    const reader = new FileReader();

    reader.onload = function (e) {
        const imgContainer = document.createElement("div");
        imgContainer.classList.add("preview-item");

        const img = document.createElement("img");
        img.src = e.target.result;

        const removeButton = document.createElement("button");
        removeButton.innerHTML = "x";
        removeButton.classList.add("remove-button");
        removeButton.addEventListener("click", function () {
            preview.removeChild(imgContainer);
            removeFile(file.size);
        });

        imgContainer.appendChild(img);
        imgContainer.appendChild(removeButton);
        preview.appendChild(imgContainer);
    };

    reader.readAsDataURL(file);
}

function displayErrorMessage(message) {
    const errorMessageElement = document.createElement("div");
    errorMessageElement.textContent = message;
    errorMessageElement.style.whiteSpace = "pre"; // Preserve whitespace
    errorMessageElement.style.color = "red";
    errorMessageElement.style.display = "inline-block"; // Display the message in a single line
    errorMessages.appendChild(errorMessageElement);
}
























    </script>
  </body>
</html>
