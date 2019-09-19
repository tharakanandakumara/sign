var date = []
var students = [];


function getDate() {

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    return today;
}

function getlastweekDate() {

    var oneWeekAgo = new Date();
    oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
    var dd = String(oneWeekAgo.getDate()).padStart(2, '0');
    var mm = String(oneWeekAgo.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = oneWeekAgo.getFullYear();
    oneWeekAgo = yyyy + '-' + mm + '-' + dd;
    return oneWeekAgo;
}

function getDataByDate() {
    var today = getDate();
    $.ajax({
        type: "GET",
        url: gOptions.serverUrl + "/protected/attendance/report?from=" + today + "&to=" + today,
        dataType: 'json',
        contentType: 'application/json;charset=UTF-8',
        // Update Url
        headers: {
            Authorization: auth

        },
        success: function (response) { // Setting Token
            console.log(response);

            try {
                var reports = response["report"][today]["total"];
            } catch (error) {
                console.log("error: ", error)
            }
            try {
                var tablereports = response["report"][today]["attendanceByGrade"];
            } catch (error) {
                console.log("error: ", error)
            }
            populateTable(tablereports)

            $("#studentsIn").text(reports);
            // $("#studentCount").text("Not Supported");
            $("#studentsOut").text("Not Supported");
            $("#staffCount").text("Not Supported")
            $("#teacherCount").text("Not Supported")
            $("#manualCount").text("Not Supported")

            getDataByWeek();
            getTotalNoOfStudents();

        },
        statusCode: {
            404: function () {
                notifyMe('.notify_panel', 'Invalid Username', '0');
            },
            401: function () {
                notifyMe('.notify_panel', 'Invalid password', '0');
            }
        }
    });

}
function createData(tableValues) {
    var data = [];
    console.log("tab" + tableValues);
    for (var key in tableValues) {

        if (tableValues.hasOwnProperty(key)) {
            var val = [];
            console.log(key + "key")
            val.push(key)
            val.push(tableValues[key])

        }
        data.push(val);
    }
    return data;
}
function populateTable(tableValues) {
    grade = [];
    students = [];
    $("#live-attendence").dataTable().fnDestroy();
    var data = createData(tableValues);
    $('#live-attendence').DataTable({
        "searching": false,
        "paging": false,
        data: data
    });

}
function getDataByWeek() {

    var today = getDate();
    var lastweek = getlastweekDate();
    $.ajax({
        type: "GET",
        url: gOptions.serverUrl + "/protected/attendance/report?from=" + lastweek + "&to=" + today,
        dataType: 'json',
        contentType: 'application/json;charset=UTF-8',
        // Update Url
        headers: {
            Authorization: auth

        },
        success: function (response) { // Setting Token
            console.log(response);

            try {
                var reports = response["report"];
                var countofDays = Object.keys(reports).length;
                var keys = Object.keys(reports);
                for (i = 0; i < countofDays; i++) {
                    var newData = response["report"][keys[i]];
                    console.log("date" + keys[i]);


                    date.push(keys[i]);
                    students.push(response["report"][keys[i]]["total"]);

                    console.log(date);
                    console.log(students);

                }
                populateWeekGraph();
            } catch (error) {
                console.log("error: ", error)
            }

            console.log(reports)


            /*  if (response.token) {
                  ajaxCallBack(response.token);
                  


              } else {

                  notifyMe('.notify_panel', 'Invalid Credentials Entered', '0');
              }*/
        },
        statusCode: {
            404: function () {
                notifyMe('.notify_panel', 'Invalid Username', '0');
            },
            401: function () {
                notifyMe('.notify_panel', 'Invalid password', '0');
            }
        }
    });

}

function populateWeekGraph() {
    var ctx = document.getElementById("team-chart");
    ctx.height = 200;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: date,
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [{
                data: students,
                label: "Students",
                backgroundColor: 'rgba(0,103,255,.15)',
                borderColor: 'rgba(0,103,255,0.5)',
                borderWidth: 3.5,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'rgba(0,103,255,0.5)',
            },]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                display: false,
                position: 'top',
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Montserrat',
                },
            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Date'
                    }
                }],
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true,
                        precision: 0
                    },
                    gridLines: {
                        display: true,
                        drawBorder: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Students'
                    }
                }]
            },
            title: {
                display: false,
            }
        }
    });

    grade = []
    students = [];

}

/**
 * function to get the total no. of students
 */
function getTotalNoOfStudents() {
    // var today = getDate();
    $.ajax({
        type: "GET",
        url: gOptions.serverUrl + "/protected/students",
        dataType: 'json',
        contentType: 'application/json;charset=UTF-8',
        // Update Url
        headers: {
            Authorization: auth
        },
        success: function (response) { // Setting Token
            console.log("getTotalNoOfStudents response: ", response);
            try {
                var total = response.length;
            } catch (error) {
                console.log("error: ", error)
            }

            // $("#studentsIn").text(reports);
            $("#studentCount").text(total);
            // $("#studentsOut").text("Not Supported");
            // $("#staffCount").text("Not Supported")
            // $("#teacherCount").text("Not Supported")
            // $("#manualCount").text("Not Supported")
        },
        statusCode: {
            404: function () {
                notifyMe('.notify_panel', 'Invalid Username', '0');
            },
            401: function () {
                notifyMe('.notify_panel', 'Invalid password', '0');
            }
        }
    });

}
