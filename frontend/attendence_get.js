var grade = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
var students = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
var date = [];


// var auth="BEARER eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjp7Im5hbWUiOiJKZW50ZWsgRGV2ZWxvcGVyIiwidXNlcm5hbWUiOiJkZXZlbG9wZXIiLCJlbWFpbCI6ImlzdXJ1LnJ1aHVAZ21haWwuY29tIiwiY29udGFjdCI6IjA3NzcxMTEyMjIiLCJpc0FkbWluIjpmYWxzZX0sImlhdCI6MTU2MzE2MjM2MCwiZXhwIjoxNTYzMTY5NTYwfQ.lo69VsVdn6J000kjtAa2SSwfmF-yOYOGz9fTioih5Hc" ;

// Token Grabber

//Function to pass the date and get reports by class
//*Goptions should be imported
function getDataByDate(fromDate, toDate) {
    console.log("Auth: " + auth)
    $.ajax({
        type: "GET",
        url: gOptions.serverUrl + "/protected/attendance/report?from=" + fromDate + "&to=" + toDate,
        dataType: 'json',
        contentType: 'application/json;charset=UTF-8',
        // Update Url
        headers: {
            Authorization: auth
        },
        success: function (response) { // Setting Token
            console.log(response);

            try {
                var reports = response["report"][fromDate]["attendanceByGrade"];
            } catch (error) {
                console.log("error: ", error)
            }
            try {
                var chart = response["report"][fromDate]["attendanceByGrade"]
            } catch (error) {
                grade = []
                students = [];
                console.log("error: ", error)
            }
            console.log(reports)
            populateTable(reports)
            populateGraph(chart)
            $("#attendenceDate").html("Reports for " + fromDate)
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
function getDatabyMonth(fromDate, toDate, selectedGrade) {

    $.ajax({
        type: "GET",
        url: gOptions.serverUrl + "/protected/attendance/report?from=" + fromDate + "&to=" + toDate,
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
                var keys = Object.keys(reports);
                students = [];
                date = [];
                for (i = 0; i <= Object.keys(reports).length; i++) {

                    reports = response["report"][keys[i]]["attendanceByGrade"];
                    createMonthlyData(selectedGrade, reports, keys[i]);
                    console.log("print" + date[0]);

                }
                populateMonthlyGraph(date, students);
            } catch (error) {
                console.log("error: ", error)
            }




            console.log(reports)
            /* populateTable(reports)
             populateGraph(chart)
             $("#attendenceDate").html("Reports for " + fromDate)
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
function createMonthlyData(grade, data, dateg) {


    for (var key in data) {

        var val = [];
        if (key == grade) {
            date.push(dateg);
            students.push(data[key]);

        }
    }
    console.log(date[1]);
    console.log(students[1]);
}
function createData(tableValues) {
    var data = [];
    for (var key in tableValues) {

        if (tableValues.hasOwnProperty(key)) {
            var val = [];
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
    $("#bootstrap-data-table-export").dataTable().fnDestroy();
    var data = createData(tableValues);
    $('#bootstrap-data-table-export').DataTable({

        data: data
    });

}

function populateGraph(chartValues) {

    console.log("Here");

    for (var key in chartValues) {
        if (chartValues.hasOwnProperty(key)) {
            console.log(key + " -> " + chartValues[key]);

            grade.push(key);
            students.push(chartValues[key]);


        }

    }
    console.log(grade)

    var ctx = document.getElementById("team-chart");
    ctx.height = 200;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: grade,
            type: 'bar',
            defaultFontFamily: 'Montserrat',
            datasets: [{
                data: students,
                label: "Students",
                backgroundColor: 'rgba(0,103,255,1)',
                borderColor: 'rgba(0,103,255,1)',
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
                        labelString: 'Grade'
                    }
                }],
                yAxes: [{
                    display: true,
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
}
function populateMonthlyGraph(gradeClass, students) {

    console.log("Populating Graph");

    console.log("Grade Data" + gradeClass[1])

    var ctx = document.getElementById("class-chart");
    ctx.height = 250;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: gradeClass,
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
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Date'
                    }
                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
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