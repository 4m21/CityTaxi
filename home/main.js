var map;

function initMap() {
    // Set Map Option
    var myLatLng = { lat: 7.8730, lng: 80.7717 };
    var mapOptions = {
        center: myLatLng,
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    // Create Map
    map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);


    var options = {
        types: ['(cities)']
    }

    var input1 = document.getElementById("from");
    var autoComplete1 = new google.maps.places.Autocomplete(input1, options);

    var input2 = document.getElementById("to");
    var autoComplete2 = new google.maps.places.Autocomplete(input2, options);
}

function calcRoute() {
    var directionsService = new google.maps.DirectionsService();
    var directionsDisplay = new google.maps.DirectionsRenderer();
    directionsDisplay.setMap(map);

    var request = {
        origin: document.getElementById("from").value,
        destination: document.getElementById("to").value,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC
    }

    directionsService.route(request, function (result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(result);
            alert("Driving Distance : " + result.routes[0].legs[0].distance.text + "\nDuration : " + result.routes[0].legs[0].duration.text);
            
        } else {
            directionsDisplay.setDirections({ routes: [] });

            map.setCenter(myLatIng);

            alert("There was an error\nYour request is a bit too much for us to handle. Please try changing the pick-up or drop-off location.");
        }
    });
}


function toggleActive(class_name){
    var carDiv = document.querySelectorAll(".divi");
    carDiv.forEach(item => {
        item.classList.remove("active");
        var className = item.classList[1];
        if(class_name == className){
            item.classList.add("active");
        }
    });

    var orgin = document.getElementById("from").value.split(",");
    var distination = document.getElementById("to").value.split(",");

    var output3 = document.querySelector(".choose-car-header-p");
    var output2 = document.querySelector(".choose-car-header-p-2");

    var output = document.querySelector(".choose-car-header");

    // var test2 = orgin.split(","); 

    // var test = orgin.slice(0, orgin.indexOf(","));

    console.log(orgin[0]);
    console.log(distination[0]);
    // output.innerHTML = orgin;
    // output2.innerHTML = distination;

    output.innerHTML = "<h4>"+ orgin[0] +"</h4><i class='fa-solid fa-arrow-right'></i><h4>"+ distination[0] +"</h4>";
}


function toggleSelection(x){
    var carDiv = document.querySelectorAll(".listOfCar");

    carDiv.forEach(item => {
        item.classList.remove("active-choose");
            var className = item.classList[1];
            if(x == className){
                item.classList.add("active-choose");
            }
    });
}




// Script for admin



const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

const contents = document.querySelectorAll('.contents');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});

function viewContent(x){
	contents.forEach(item => {
		item.classList.remove("active-content");
		const className = item.classList[1];
		if(x == className){
			var my =item.classList.add("active-content");
			console.log(my);
		}
	})
}



// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})



$(document).ready(function() {
    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please enter your First Name'
                    }
                }
            },
             last_name: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please enter your Last Name'
                    }
                }
            },
			 user_name: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please enter your Username'
                    }
                }
            },
			 user_password: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please enter your Password'
                    }
                }
            },
			confirm_password: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please confirm your Password'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your Email Address'
                    },
                    emailAddress: {
                        message: 'Please enter a valid Email Address'
                    }
                }
            },
            contact_no: {
                validators: {
                  stringLength: {
                        min: 12, 
                        max: 12,
                    notEmpty: {
                        message: 'Please enter your Contact No.'
                     }
                }
            },
			 department: {
                validators: {
                    notEmpty: {
                        message: 'Please select your Department/Office'
                    }
                }
            },
                }
            }
        })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});