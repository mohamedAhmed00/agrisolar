$(function () {
    getChartLine();
    getSparklines();
});


function getChartLine() {
    var options = {
        type: 'line',
        data: {
            labels: ["January", "February", "March",
                "April", "May", "June",
                "July", "August"],
            datasets: [
                {
                    label: 'Positive',
                    data: [10, 14, 3, 5, 4, 3, 12, 10],
                    borderWidth: 1,
                    lineTension: 0.1,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10
                },
                {
                    label: 'Negative',
                    data: [7, 11, 5, 8, 4, 7, 4, 2],
                    borderWidth: 1,
                    lineTension: 0.1,
                    backgroundColor: "rgba(74, 117, 191, 0.4)",
                    borderColor: "rgba(74, 117, 191, 1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(74, 117, 191, 1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(74, 117, 191, 1)",
                    pointHoverBorderColor: "rgba(74, 117, 191, 1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            reverse: false
                        }
                    }]
            }
        }
    }

    var ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, options);
}

function getSparklines() {
    var sparkline1 = function () {
        $("#sparkline1").sparkline([2, 4, 4, 6, 8, 5, 6, 4, 8, 6, 6, 2], {
            type: 'line',
            width: '100%',
            height: '130',
            lineColor: '#00c292',
            fillColor: 'rgba(0, 194, 146, 0.2)',
            maxSpotColor: '#00c292',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#00c292'
        });
    }

    var sparkline2 = function () {
        $("#sparkline2").sparkline([2, 4, 4, 6, 8, 5, 6, 4, 8, 6, 6, 2], {
            type: 'line',
            width: '100%',
            height: '130',
            lineColor: '#fb9678',
            fillColor: 'rgba(251, 150, 120, 0.2)',
            maxSpotColor: '#fb9678',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#fb9678'
        });
    }

    var sparkline3 = function () {
        $("#sparkline3").sparkline([2, 4, 8, 6, 8, 5, 6, 4, 8, 6, 6, 2], {
            type: 'line',
            width: '100%',
            height: '130',
            lineColor: '#03a9f3',
            fillColor: 'rgba(3, 169, 243, 0.2)',
            minSpotColor: '#03a9f3',
            maxSpotColor: '#03a9f3',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#03a9f3'
        });
    }

    var sparkResize;
    $(window).resize(function (e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(sparkline1, 100);
        sparkResize = setTimeout(sparkline2, 100);
        sparkResize = setTimeout(sparkline3, 100);
    });

    for (i = 1; i <= 7; i++) {
        $("#sparkline-bar" + i).sparkline([3, 5, 4, 2, 1, 4, 2, 4], {
            type: 'bar'});
    }

    sparkline1();
    sparkline2();
    sparkline3();
}

