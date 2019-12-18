/**
 * This file contains data fetch and graph populating functions for class reports
 */
// var gradeClass = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
var classes = {
    "1": ["1A", "1B", "1C", "1D", "1E", "1F", "1G"],
    "2": ["2A", "2B", "2C", "2D", "2E", "2F", "2G"],
    "3": ["3A", "3B", "3C", "3D", "3E", "3F", "3G"],
    "4": ["4A", "4B", "4C", "4D", "4E", "4F", "4G"],
    "5": ["5A", "5B", "5C", "5D", "5E", "5F", "5G"],
    "6": ["6A", "6B", "6C", "6D", "6E", "6F", "6G"],
    "7": ["7A", "7B", "7C", "7D", "7E", "7F", "7G"],
    "8": ["8A", "8B", "8C", "8D", "8E", "8F", "8G"],
    "9": ["9A", "9B", "9C", "9D", "9E", "9F", "9G"],
    "10": ["10A", "10B", "10C", "10D", "10E", "10F", "10G"],
    "11": ["11A", "11B", "11C", "11D", "11E", "11F", "11G"],
    "12": ["12A", "12B", "12C", "12D", "12E", "12F", "12G"],
    "13": ["13A", "13B", "13C", "13D", "13E", "13F", "13G"]
}

/**
 * Function to pass the date and get reports by class
 * @param {*} reportDate 
 * @param {*} selectedGrade 
 */
function getDataByDate(reportDate, selectedGrade) {
    $.ajax({
        type: "GET",
        url: gOptions.serverUrl + "/protected/attendance/report?from=" + reportDate + "&to=" + reportDate,
        dataType: 'json',
        contentType: 'application/json;charset=UTF-8',
        headers: {
            Authorization: auth
        },
        success: function (response) {
            console.log("Daily class getDataByDate response: ", response);
            try {
                if (!response["report"][reportDate]) return;
                // reports - attendanceByClass report
                var reports = response["report"][reportDate]["attendanceByClass"];
                console.log(reports);

                var gradeClass = [];
                var gradeStudents = [];
                var data = [];
                var total = 0;
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
                        total += reports[key];
                        data.push(val);
                    }
                }
                console.log("Total", total);
                // Add total to the last row of the table
                data.push(["Total", total]);
                console.log("data ", data);

                populateTable(data, reportDate, selectedGrade);
                // reverse data in order to show in proper order in graph
                populateGraph(gradeClass.reverse(), gradeStudents.reverse());
                console.log("Table Data" + data);
            } catch (error) {
                console.log("error: ", error);
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

/**
 * Function to pass the month and fetch data for reports by class
 * @param {*} fromDate 
 * @param {*} toDate 
 * @param {*} selectedYear 
 * @param {*} selectedMonth 
 * @param {*} selectedClass 
 */



function getAllDays(fromDate, toDate){  // function to get array with all dates between fromDate and toDate                     P*
    var fDate = new Date(fromDate);
    var tDate = new Date(toDate);
    var getDateArray = function(start, end) {
        var daysArray = [];
        var stDate = new Date(start);
        while (stDate <= end) {
            daysArray.push(convertDateToString(stDate));
            stDate.setDate(stDate.getDate() + 1);
        }
        return daysArray;
    }
    var dateArray = getDateArray(fDate, tDate);
    return dateArray;
}

function convertDateToString(unconvertedDate){
    var convertedDate = new Date(unconvertedDate).toISOString().split('T')[0]
    return convertedDate;
}

var mock_date = new Date("2019-01-01"); // test double (mock) to test conversion from Date to String                      P*
var mock_date_converted = convertDateToString(mock_date);
test_dateConversionToString(mock_date, mock_date_converted);

//-TEST- tests ajax response on empty GET                                                                                       SSP*
function test_ajaxGetResponse() {
    $.ajax({
        type: "GET",
        url: gOptions.serverUrl,
        dataType: 'json',
        contentType: 'application/json;charset=UTF-8',
        headers: {
            Authorization: auth
        },
        success: function () {
            try {
                console.log("TEST: test_ajaxGetResponse PASSED!");
            } catch (error) {
                console.log("TEST: test_ajaxGetResponse FAILED! Error:" + error);
            }
        },
        statusCode: {
            404: function () {
                console.log("TEST: test_ajaxGetResponse FAILED! Server response code: 404");
            },
            401: function () {
                console.log("TEST: test_ajaxGetResponse FAILED! Server response code: 401");
            }
        }
    });
}
//-TEST- tests if length of both arrays is same                                                                                 P*
function test_numberOfIndexes(firstArray, secondArray){
    if (firstArray.length === secondArray.length){
        console.log("TEST: test_numberOfIndexes PASSED!"+
            "\n\tfirstArray.length=" + firstArray.length+
            "\n\tsecondArray.length=" + secondArray.length);
    }
    else {
        console.log("TEST: test_numberOfIndexes FAILED!"+
            "\n\tfirstArray.length=" + firstArray.length+
            "\n\tsecondArray.length=" + secondArray.length);
    }
}

//-TEST- tests if length of date array is right                                                                                 P*
function test_lengthOfDateArray(fromDate, toDate, testArray){
    var newArray = getAllDays(fromDate, toDate);
    if (newArray.length === testArray.length){
        console.log("TEST: test_lengthOfDateArray PASSED!"+
            "\n\ttestArray.length=" + testArray.length+
            "\n\tcalculatedArray.length=" + newArray.length);
    }
    else {
        console.log("TEST: test_lengthOfDateArray FAILED!"+
            "\n\ttestArray.length=" + testArray.length+
            "\n\tcalculatedArray.length=" + newArray.length);
    }
}

//-TEST- tests if date array has right dates                                                                                     P*
function test_dateArrayDates(fromDate, toDate, dateArray){
    var newArray = getAllDays(fromDate, toDate);
    if (newArray.length !== dateArray.length) {
        console.log("TEST: test_dateArrayDates FAILED!" +
            "\n\tdateArray.length=" + dateArray.length +
            "\n\tcalculatedArray.length=" + newArray.length);
    }
    else{
        var testNum = 0;
        var indexArray = [];
        for (var i=0; i<newArray.length; i++){
            if (newArray[i] !== dateArray[i]) {
                if (testNum === 0) {console.log("TEST: test_dateArrayDates FAILED!");}
                testNum=1;
                indexArray.push(i);
                console.log("\tindex[" + i + "] dateArray=" + dateArray[i] + "SHOULD BE=" + newArray[i] );
            }
            else{console.log("\tindex[" + i + "] dateArray=" + dateArray[i] + " is right date" );}
        }

        if (testNum === 0){
            console.log("TEST: test_dateArrayDates PASSED!");
        }
    }
}

//-TEST- tests date conversion                                                                                                  P*
function test_dateConversionToString(originalDate, testString){
    var convertedDate = new Date(testString);
    if (originalDate.toString() == convertedDate.toString()) {
        console.log("TEST: test_dateConversionToString PASSED!" +
                    "\n\toriginal= " + originalDate +
                    "\n\tconvertedBackFromString= " + convertedDate +
                    "\n\tstringDate = " + testString);
    }
    else {
        console.log("TEST: test_dateConversionToString FAILED!" +
            "\n\toriginal= " + originalDate +
            "\n\tconvertedBackFromString= " + convertedDate +
            "\n\tstringDate = " + testString);
    }
}




function getDataByMonth(fromDate, toDate, selectedYear, selectedMonth, selectedClass) {
    $.ajax({
        type: "GET",
        url: gOptions.serverUrl + "/protected/attendance/report?from=" + fromDate + "&to=" + toDate,
        dataType: 'json',
        contentType: 'application/json;charset=UTF-8',
        headers: {
            Authorization: auth
        },
        success: function (response) {
            console.log("Monthly class getDataByMonth response: ", response);
            try {
                var report = response["report"];
                console.log("report ", report);
                var keys = Object.keys(report); // date strings as keys in report

                var students = [];
                var dates = [];
                for (var i = 0; i < keys.length; i++) {
                    var classReport = response["report"][keys[i]]["attendanceByClass"];

                    for (var key in classReport) {
                        if (key == selectedClass) {
                            dates.push(keys[i]);
                            students.push(classReport[key]);
                        }
                    }
                }

                var graphDates = getAllDays(fromDate, toDate); //making array of all days to add to populateMonthlyGraph       P*
                var graphStudents = []; //making array of students which will be copy of original but with right indexes       P*

                for (i = 0; i < graphDates.length; i++) { //matching data indexes with new date indexes                        P*
                    graphStudents[i] = 0;
                    for (j = 0; j < dates.length; j++){
                        if (dates[j] == graphDates[i]){
                            graphStudents[i] = students[j];
                        }
                    }
                }
                test_ajaxGetResponse();
                test_numberOfIndexes(dates, graphDates);
                test_lengthOfDateArray(fromDate, toDate, graphDates);
                test_dateArrayDates(fromDate, toDate, dates);
                test_dateArrayDates(fromDate, toDate, graphDates);
                populateMonthlyGraph(graphDates, graphStudents); //changed dates to graphDates to add all days                  P*
                populateMonthlyTable(dates, students, selectedYear, selectedMonth, selectedClass);
            } catch (error) {
                console.log("error: ", error);
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

function populateMonthlyTable(dates, students, selectedYear, selectedMonth, selectedClass) {
    $("#class-monthly-report-table").dataTable().fnDestroy();
    var data = createMonthlyData(dates, students);
    $('#class-monthly-report-table').DataTable({
        data: data
    });

    $("#report-year").text("- " + selectedYear);
    $("#report-month").text(" - " + selectedMonth);
    $("#report-class").text(" - " + selectedClass);
}

/**
 * Create data for monthly grade report table
 */
function createMonthlyData(dates, students) {
    var data = [];

    for (var index in dates) {
        if (students[index]) {
            var val = [];
            val.push(dates[index]);
            val.push(students[index]);
        }
        data.push(val);
    }

    return data;
}

/**
 * function to generate classes for the selected grade
 */
function classGenerator(selectedGrade, classDropdown) {
    classDropdown.options.length = 0;

    for (var i = 0; i < classes[selectedGrade].length; i++) {
        var opt = document.createElement('option');
        opt.value = classes[selectedGrade][i];
        opt.innerHTML = classes[selectedGrade][i];
        classDropdown.appendChild(opt);
    }
}

function populateTable(data, reportDate, selectedGrade) {
    $("#class-daily-report-table").dataTable().fnDestroy();

    $('#class-daily-report-table').DataTable({
        data: data
    });

    $("#report-date").text("- " + reportDate);
    $("#report-grade").text(" - Grade " + selectedGrade);
}

// define a variable to store the chart instance (this must be outside of your function)
// so that it can be destroyed before creating a new one
var myChart;
function populateGraph(gradeClass, gradeStudents) {
    console.log("Populating Graph");
    console.log("Grade Data" + gradeClass[0])

    // if the chart is not undefined (e.g. it has been created)
    // then destory the old one so we can create a new one later
    if (myChart) {
        myChart.destroy();
    }
    var ctx = document.getElementById("class-chart");
    ctx.height = 250;
    myChart = new Chart(ctx, {
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
                    ticks: {
                        beginAtZero: true,
                        // stepSize: 5,
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
};

function populateMonthlyGraph(dateList, studentList) {
    console.log("Populating monthly Graph");
    //console.log("studentList", studentList);
    //console.log("dateList", dateList);

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
};

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