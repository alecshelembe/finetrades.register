// import './bootstrap';

console.log("hello world");

function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('image-preview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
    } 
}
 // Function to initialize the Google Maps Places Autocomplete
 function initializeAutocomplete() {
    var input = document.getElementById('floating_address');

    var autocomplete = new google.maps.places.Autocomplete(input, {
        types: ['geocode'],
        componentRestrictions: { country: 'ZA' }
    });

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();

        // Update address
        if (place.formatted_address) {
            document.getElementById('google_location').value = place.formatted_address;
        }

        // Update latitude and longitude
        if (place.geometry) {
            document.getElementById('google_latitude').value = place.geometry.location.lat();
            document.getElementById('output_google_latitude').value = place.geometry.location.lat();
            document.getElementById('google_longitude').value = place.geometry.location.lng();
            document.getElementById('output_google_longitude').value = place.geometry.location.lng();
        }

        // Update location type
        if (place.types.length > 0) {
            document.getElementById('google_location_type').value = place.types[0];
        }

        // Update postal code
        var postalCode = place.address_components.find(component => component.types.includes("postal_code"));
        if (postalCode) {
            document.getElementById('google_postal_code').value = postalCode.long_name;
        }

        // Update city
        var city = place.address_components.find(component => component.types.includes("locality"));
        if (city) {
            document.getElementById('google_city').value = city.long_name;
        }

        // Update additional fields
        document.getElementById('package_selected').value = "package_value"; // Update as needed
        document.getElementById('output_package_selected').textContent = "package_value"; // Update as needed
        document.getElementById('web_source').value = "web_source_value";   // Update as needed
        document.getElementById('output_web_source').textContent = "web_source_value";   // Update as needed

        // Update location ID
        if (place.place_id) {
            document.getElementById('location_id').value = place.place_id;
            document.getElementById('output_location_id').textContent = place.place_id;
        }
    });

    console.log('Autocomplete initialized');
}

// Ensure the script runs after the Google Maps API is loaded
document.addEventListener('DOMContentLoaded', function() {
    
    // Check if the Google Maps API and Places library are available
    if (typeof google !== 'undefined' && google.maps && google.maps.places) {
        initializeAutocomplete(); // Initialize the autocomplete functionality
    } else {
        console.error('Google Maps API or Places library is not available.'); // Debugging: Error if API is not loaded
    }

    // For first name
    document.getElementById('floating_first_name').addEventListener('input', function() {
        var inputVal = this.value; // Get the value from input field
        document.getElementById('output-card-person-firstname').textContent = inputVal; // Set the value of output field
    });

    // For last name
    document.getElementById('floating_last_name').addEventListener('input', function() {
        var inputVal = this.value; // Get the value from input field
        document.getElementById('output-card-person-lastname').textContent = ' ' + inputVal; // Set the value of output field with space
    });
    
});
// // Function to initialize the map
// function initMap() {
//     var map = new google.maps.Map(document.getElementById('map'), {
//         center: { lat: -34.397, lng: 150.644 }, // Default location
//         zoom: 8
//     });
// }

// // Initialize the map after the API script is loaded
// document.addEventListener('DOMContentLoaded', function() {
//     if (typeof google !== 'undefined') {
//         initMap();
//     } else {
//         console.error('Google Maps API is not loaded.');
//     }
// });




