document.addEventListener("DOMContentLoaded", function () {
    const navItems = document.querySelectorAll(".nav-item");
    const buttons = document.querySelectorAll(".button");
    let activeCategory = "drinks";
    let activeSubcategory = "cold";

    function updateMenu() {
        document.querySelectorAll(".item").forEach(item => {
            item.style.display = "none";
        });

        document.querySelectorAll(`.item[data-category='${activeCategory}'][data-subcategory='${activeSubcategory}']`).forEach(item => {
            item.style.display = "flex";
        });
    }

    navItems.forEach(item => {
        item.addEventListener("click", function () {
            navItems.forEach(nav => nav.classList.remove("active"));
            item.classList.add("active");

            activeCategory = item.getAttribute("data-category");
            updateMenu();
        });
    });

    buttons.forEach(button => {
        button.addEventListener("click", function () {
            buttons.forEach(btn => btn.classList.remove("active"));
            button.classList.add("active");

            activeSubcategory = button.getAttribute("data-subcategory");
            updateMenu();
        });
    });

    updateMenu();
});

$(document).ready(function() {
    // Attach change event handler to the select element with id "mySelect"
    $('#faculty').change(function() {
        var facultyId = $(this).val();
        // Retrieve the selected value
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/fetch-majors', // Replace with your endpoint URL
            method: 'GET',
            data: {
                faculty_id: facultyId,
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                // Clear existing options in the major select element
                console.log(response.majors.length)
                if (response.majors.length == 0) {
                    $('#majorSelect').empty();
                    $('#majorSelect').append('<option value="">' + 'Select Major' +
                        '</option>');
                } else {
                    // Populate the major select element with fetched majors
                    $('#majorSelect').empty();
                    $('#majorSelect').append('<option value="">' + 'Select Major' +
                        '</option>');
                    $.each(response.majors, function(key, value) {
                        $('#majorSelect').append('<option value="' + value
                            .major_id + '">' + value.major_name +
                            '</option>');
                    });
                }

            },
            error: function(xhr, status, error) {
                console.error(error);
                // Handle error if necessary
            }
        });
    });
});
