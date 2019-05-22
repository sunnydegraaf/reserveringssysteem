// on load
$(function() {
    // date element ophalen
    //let dateElement = document.getElementById('date');
    let dateElement = $('#date');

    // on change
    dateElement.on("change", function(e) {
        // datum ophalen (value)
        // let selectedDate = e.target.value;

        // console.log(selectedDate);

        let d = new Date(e.target.value);
        let selectedDate = d.getFullYear() + '/' + (d.getMonth() + 1) + '/' + d.getDate();
        console.log(selectedDate);
        // ajax call
        $.get("/reserveringssysteem/available_dates.php?date="+selectedDate, function(data) {
            $("#time").empty();
            $.each(data, function (index, val) {
                // option toevoegen aan time (select) element
                $("#time").append('<option value="'+val+'">'+val+'</option>');
            });
        })
    })
});