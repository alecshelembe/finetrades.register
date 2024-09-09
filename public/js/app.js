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
    // Get the input element by its ID
    var input = document.getElementById('floating_address');

    // Set up options for the autocomplete
    var options = {
        types: ['geocode'], // Restrict to geocoding
        componentRestrictions: { country: 'ZA' } // Restrict to South Africa
    };

    // Create an autocomplete instance
    var autocomplete = new google.maps.places.Autocomplete(input, options);

    // Add an event listener for when the user selects a place
    autocomplete.addListener('place_changed', function() {
        // Get the place details from the autocomplete instance
        var place = autocomplete.getPlace();
        console.log('Place details:', place); // Debugging: Output place details

        // Check if the place has a formatted address
        if (place.formatted_address) {
            var address = place.formatted_address;
            console.log("Selected Address: " + address); // Debugging: Output selected address
            input.value = address; // Update input field with the formatted address
        } else {
            console.log('No address found'); // Debugging: Inform if no address found
        }
    });

    // Debugging: Confirm that autocomplete is initialized
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

// Initialize the autocomplete when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function () {
    initializeAutocomplete();
});




