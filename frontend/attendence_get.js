var grade = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
var students = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];



// Token Grabber

//Function to pass the date and get reports by class
//*Goptions should be imported
function getDataByDate(fromDate, toDate) {

    $.ajax({
        type: "GET",
        url: gOptions.serverUrl+":3000/protected/attendance/report?from=" + fromDate + "&to=" + toDate,
        //url: gOptions.serverUrl+":3000/protected/attendance/report?from="+fromDate+"&to="+toDate,
        console.log(auth+"Auth");
        dataType: 'json',

        contentType: 'application/json;charset=UTF-8',
        // Update Url
        headers: {
            Authorization: auth

        },
        success: function (response) { // Setting Token
            console.log(response);

            try {
                var reports = response["report"][fromDate]["attendanceByClass"];
            } catch (error) {

            }
            try {
                var chart = response["report"][fromDate]["attendanceByGrade"]
            } catch (error) {
                grade = []
                students = [];

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
function createData(tableValues) {
var data = [];
 for (var key in tableValues) {
    
        if (tableValues.hasOwnProperty(key)) {
             var val=[];
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
    var data=createData(tableValues);
    $('#bootstrap-data-table-export').DataTable( {

    data: data
} );
    
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
    ctx.height = 250;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: grade,
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
                    }, ]
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
                        labelString: 'Grade'
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