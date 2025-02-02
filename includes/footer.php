	<!-- jQuery -->
	<script src="assets/js/jquery-3.7.1.min.js"></script>

	<!-- Feather Icon JS -->
	<script src="assets/js/feather.min.js"></script>

	<!-- Slimscroll JS -->
	<script src="assets/js/jquery.slimscroll.min.js"></script>
	

	<!-- Datatable JS -->
	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/dataTables.bootstrap5.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>

	<!-- Select2 JS -->
	<script src="assets/plugins/select2/js/select2.min.js"></script>

	<!-- Datetimepicker JS -->
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Bootstrap Tagsinput JS -->
	<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

	<!-- Sweetalert 2 -->
	<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
	<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

	<!-- Custom JS -->
    
	<script src="assets/js/theme-script.js"></script>
	<script src="assets/js/script.js"></script>

	<!-- google maps api key and script -->
	<script>
    let map, marker, autocomplete;

    function initMap() {
        // Default location (Nairobi)
        const defaultLocation = { lat: -1.286389, lng: 36.817223 };

        // Initialize map
        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 12,
        });

        // Create a new Marker
        marker = new google.maps.Marker({
            map: map,
            position: defaultLocation,
            title: "Selected Location",
        });

        // Try to get the user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    // Move map and marker to user's location
                    map.setCenter(userLocation);
                    marker.setPosition(userLocation);  // Update marker position

                    // Update hidden fields
                    document.getElementById("latitude").value = userLocation.lat;
                    document.getElementById("longitude").value = userLocation.lng;
                },
                () => {
                    console.log("Geolocation permission denied or unavailable.");
                }
            );
        } else {
            console.log("Geolocation not supported by this browser.");
        }

        // Initialize autocomplete
        let input = document.getElementById("autocomplete");
        autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo("bounds", map);

        // Handle place selection from autocomplete
		autocomplete.addListener("place_changed", function () {
    let place = autocomplete.getPlace();
    if (!place.geometry) return; // Ensure a valid place is selected

    // Move map and update marker
    map.setCenter(place.geometry.location);
    map.setZoom(15); // Zoom in after place selection
    marker.setPosition(place.geometry.location); // Update the marker's position

    // Update hidden fields for latitude & longitude
    document.getElementById("latitude").value = place.geometry.location.lat();
    document.getElementById("longitude").value = place.geometry.location.lng();
});


        // Allow user to click on map to set location
        map.addListener("click", function (event) {
            marker.setPosition(event.latLng); // Move the marker to the clicked location
            document.getElementById("latitude").value = event.latLng.lat();
            document.getElementById("longitude").value = event.latLng.lng();
        });
    }
</script>



<!-- Load Google Maps API with Places Library -->


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_TQeuuvzWT8sjfyQ4NrsmqqzvrnTAEWo&libraries=places,marker&callback=initMap" async defer></script>





	