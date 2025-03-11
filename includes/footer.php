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


    		<!-- Custom JS --><script src="assets/js/theme-script.js"></script>	
		<script src="assets/js/script.js"></script>

	<!-- google maps api key and script -->
    <script>
    let mainMap, mainMarker, autocomplete, geoMap;

    function initMap() {
        // Default location (Nairobi)
        const defaultLocation = { lat: -1.286389, lng: 36.817223 };

        // Initialize main map
        mainMap = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 12,
        });

        // Create a marker
        mainMarker = new google.maps.Marker({
            map: mainMap,
            position: defaultLocation,
            title: "Selected Location",
        });

        // Try to get user's location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    mainMap.setCenter(userLocation);
                    mainMarker.setPosition(userLocation);

                    document.getElementById("latitude").value = userLocation.lat;
                    document.getElementById("longitude").value = userLocation.lng;
                },
                () => console.log("Geolocation permission denied or unavailable.")
            );
        } else {
            console.log("Geolocation not supported by this browser.");
        }

        // Initialize autocomplete
        let input = document.getElementById("autocomplete");
        autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo("bounds", mainMap);

        // Handle place selection
        autocomplete.addListener("place_changed", function () {
            let place = autocomplete.getPlace();
            if (!place.geometry) return;

            mainMap.setCenter(place.geometry.location);
            mainMap.setZoom(15);
            mainMarker.setPosition(place.geometry.location);

            document.getElementById("latitude").value = place.geometry.location.lat();
            document.getElementById("longitude").value = place.geometry.location.lng();
        });

        // Click event to update marker position
        mainMap.addListener("click", function (event) {
            mainMarker.setPosition(event.latLng);
            document.getElementById("latitude").value = event.latLng.lat();
            document.getElementById("longitude").value = event.latLng.lng();
        });
    }

    function initGeoMap() {
        // Default location
        const defaultLocation = { lat: -1.286389, lng: 36.817223 };

        // Initialize geo map
        geoMap = new google.maps.Map(document.getElementById("geoMap"), {
            center: defaultLocation,
            zoom: 10,
        });

        // Fetch customer locations
        fetch("get_customers.php")
            .then(response => response.json())
            .then(customers => {
                customers.forEach(customer => {
                    let position = { lat: parseFloat(customer.latitude), lng: parseFloat(customer.longitude) };

                    let marker = new google.maps.Marker({
                        position: position,
                        map: geoMap,
                        title: customer.customer_name,
                    });

                    let infoWindow = new google.maps.InfoWindow({
                        content: `<strong>${customer.customer_name}</strong><br>Phone: ${customer.phone}`
                    });

                    marker.addListener("click", () => {
                        infoWindow.open(geoMap, marker);
                    });
                });
            })
            .catch(error => console.log("Error loading customer locations:", error));
    }

    // Detect when the user clicks the Geo Mapping tab and initialize the geoMap
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("geoMapping-tab").addEventListener("click", function () {
            if (!geoMap) {
                initGeoMap();
            }
        });
    });
</script>



<!-- Load Google Maps API with Places Library -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_TQeuuvzWT8sjfyQ4NrsmqqzvrnTAEWo&libraries=places,marker&callback=initMap" async defer></script>





	