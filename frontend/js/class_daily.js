var gradeClass = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
var gradeStudents = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
var students = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
var grade = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]


// Token Grabber

//Function to pass the date and get reports by class
//*Goptions should be imported
function getDataByDate(fromDate, toDate, selectedGrade) {

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
            console.log("Daily class getDataByDate response: ", response);
            try {
                // reports - attendanceByClass report
                var reports = response["report"][toDate]["attendanceByClass"];
                console.log(reports)
            } catch (error) {
                console.log("error: ", error)
            }

            try {
                gradeClass = [];
                gradeStudents = [];
                var data = [];
                var recievedClass;
                for (var key in reports) {
                    recievedGrade = key.replace(/\D/g, '');
                    // recievedClass = key.replace(/[0-9]/g, '');
                    recievedClass = key;
                    var val = [];
                    if (recievedGrade == selectedGrade) {
                        gradeClass.push(recievedClass);
                        gradeStudents.push(reports[key]);
                        val.push(key);
                        val.push(reports[key]);
                        data.push(val);
                    }
                }

                populateTable(data)
                populateGraph(gradeClass, gradeStudents)
                console.log("Table Data" + data);
            } catch (error) {
                console.log("error: ", error)
            }

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

function populateTable(data) {
    grade = [];
    students = [];
    $("#bootstrap-data-table-export").dataTable().fnDestroy();

    $('#bootstrap-data-table-export').DataTable({

        data: data
    });

}

function populateGraph(gradeClass, students) {

    console.log("Populating Graph");

    console.log("Grade Data" + gradeClass[0])

    var ctx = document.getElementById("class-chart");
    ctx.height = 250;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: gradeClass,
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [{
                data: gradeStudents,
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
                        labelString: 'Class'
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