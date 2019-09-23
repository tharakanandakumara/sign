/**
 * This file contacins js functions for fetching and populating data for grade reports
 */
// var grade = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]

/**
 * Function to pass the date and get daily reports by grade
 * @param {*} fromDate 
 * @param {*} toDate 
 */
function getDataByDate(reportDate) {
    $.ajax({
        type: "GET",
        url: gOptions.serverUrl + "/protected/attendance/report?from=" + reportDate + "&to=" + reportDate,
        dataType: 'json',
        contentType: 'application/json;charset=UTF-8',
        headers: {
            Authorization: auth
        },
        success: function (response) {
            console.log(response);
            if (!response["report"][reportDate]) return;

            try {
                var reports = response["report"][reportDate]["attendanceByGrade"];
                var chart = response["report"][reportDate]["attendanceByGrade"]
            } catch (error) {
                console.log("error: ", error)
            }
            console.log(reports)
            populateTable(reports, reportDate)
            populateGraph(chart)
            $("#attendenceDate").html("Reports for " + reportDate)
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

/**
 * Get data from server for monthly grade report
 * Populate graph and data table
 * @param {*} fromDate 
 * @param {*} toDate 
 * @param {*} selectedYear 
 * @param {*} selectedMonth 
 * @param {*} selectedGrade 
 */
function getDatabyMonth(fromDate, toDate, selectedYear, selectedMonth, selectedGrade) {
    $.ajax({
        type: "GET",
        url: gOptions.serverUrl + "/protected/attendance/report?from=" + fromDate + "&to=" + toDate,
        dataType: 'json',
        contentType: 'application/json;charset=UTF-8',
        headers: {
            Authorization: auth
        },
        success: function (response) {
            console.log("grade getDatabyMonth response: ", response);
            try {
                var report = response["report"];
                var keys = Object.keys(report); // date strings as keys in report

                var students = [];
                var dates = [];
                for (var i = 0; i < keys.length; i++) {
                    var gradeReport = response["report"][keys[i]]["attendanceByGrade"];

                    for (var key in gradeReport) {
                        if (key == selectedGrade) {
                            dates.push(keys[i]);
                            students.push(gradeReport[key]);
                        }
                    }
                }
                populateMonthlyGraph(dates, students);
                populateMonthlyTable(dates, students, selectedYear, selectedMonth, selectedGrade);
            } catch (error) {
                console.log("error: ", error)
            }
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

function populateMonthlyTable(dates, students, selectedYear, selectedMonth, selectedGrade) {
    $("#grade-monthly-report-table").dataTable().fnDestroy();
    var data = createMonthlyData(dates, students);
    $('#grade-monthly-report-table').DataTable({
        data: data
    });

    $("#report-year").text("- " + selectedYear);
    $("#report-month").text(" - " + selectedMonth);
    $("#report-grade").text(" - Grade " + selectedGrade);
}

/**
 * Create data for monthly grade report table
 */
function createMonthlyData(dates, students) {
    var data = [];
    for (var index in dates) {
        console.log("index ", index);
        if (students[index]) {
            var val = [];
            val.push(dates[index])
            val.push(students[index])
        }
        data.push(val);
    }
    return data;
}

/**
 * Create data for daily grade report table
 * @param {*} tableValues 
 */
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

function populateTable(tableValues, reportDate) {
    $("#grade-daily-report-table").dataTable().fnDestroy();
    var data = createData(tableValues);
    $('#grade-daily-report-table').DataTable({
        data: data
    });

    $("#report-date").text("- " + reportDate);
}

// define a variable to store the chart instance (this must be outside of your function)
// so that it can be destroyed before creating a new one
var myChart;
function populateGraph(chartValues) {
    console.log("populateGraph");
    var gradeLabels = [];
    var noOfStudentsInGrades = [];
    for (var key in chartValues) {
        if (chartValues.hasOwnProperty(key)) {
            console.log(key + " -> " + chartValues[key]);
            gradeLabels.push(key);
            noOfStudentsInGrades.push(chartValues[key]);
        }
    }
    console.log("gradeLabels: ", gradeLabels)

    // if the chart is not undefined (e.g. it has been created)
    // then destory the old one so we can create a new one later
    if (myChart) {
        myChart.destroy();
    }
    var ctx = document.getElementById("team-chart");
    ctx.height = 200;
    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: gradeLabels,
            type: 'bar',
            defaultFontFamily: 'Montserrat',
            datasets: [{
                data: noOfStudentsInGrades,
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
                    ticks: {
                        precision: 0,
                        beginAtZero: true
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
}

function populateMonthlyGraph(dateList, studentList) {
    console.log("Populating monthly Graph");
    console.log("studentList", studentList);
    console.log("dateList", dateList);

    // if the chart is not undefined (e.g. it has been created)
    // then destory the old one so we can create a new one later
    if (myChart) {
        myChart.destroy();
    }
    var ctx = document.getElementById("class-chart");
    ctx.height = 250;
    myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dateList,
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [{
                data: studentList,
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
                    ticks: {
                        beginAtZero: true,
                        precision: 0
                    },
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
}

/**
 * Export Report as a file
 * @param {*} tableId 
 * @param {*} filename 
 * @param {*} extension 
 */
function exportReport(tableId, filename, extension) {
    var tbl = document.getElementById(tableId);
    var wb = XLSX.utils.table_to_book(tbl, {
        sheet: "Attendance Report"
    });
    XLSX.writeFile(wb, filename, {
        bookType: extension,
        type: 'binary'
    });
}