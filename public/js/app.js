

(function(Chart, ctx, moment, axios) {
    //taken from Chart.js
    window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    };
    ctx.canvas.width = 1000;
    ctx.canvas.height = 300;
    let color = Chart.helpers.color;

    //this is the chartjs instance
    window.chart = void 0;

    //input fields
    window.toDateInput = function(){ return document.querySelector('#toDate'); };
    window.toTimeInput = function(){ return document.querySelector('#toTime'); };
    window.fromDateInput = function(){ return document.querySelector('#fromDate'); };
    window.fromTimeInput = function(){ return document.querySelector('#fromTime'); };

    //setup values
    window.setToHour = function(){
        fromDateInput().value = moment().subtract(1,"hour").format("YYYY-MM-dd");
        toDateInput().value = moment().format("YYYY-MM-dd");
        fromTimeInput().value = moment().subtract(1,"hour").format("HH:mm");
        toTimeInput().value = moment().format("HH:mm");

        updateChart();
    };
    window.setToDay = function(){
        fromDateInput().value = moment().subtract(1,"day").format("YYYY-MM-dd");
        toDateInput().value = moment().format("YYYY-MM-dd");
        fromTimeInput().value = moment().subtract(1,"day").format("HH:mm");
        toTimeInput().value = moment().format("HH:mm");

        updateChart();
    };
    window.setToMonth = function(){
        fromDateInput().value = moment().subtract(1,"month").format("YYYY-MM-dd");
        toDateInput().value = moment().format("YYYY-MM-dd");
        fromTimeInput().value = moment().subtract(1,"month").format("HH:mm");
        toTimeInput().value = moment().format("HH:mm");

        updateChart();
    };
    window.updateChart = function() {
        if(window.chart) {
            let dataset = chart.config.data.datasets[0];
            dataset.data = getData();
            chart.update();
        }
    };

    //init value
    setToHour();

    let to = function() {
        return moment([
            toDateInput().value,
            toTimeInput().value + ':00'
        ].join(" "), 'dd/MM/YYYY HH:mm:ss')
    };
    let from = function() {
        return moment([
            fromDateInput().value,
            fromTimeInput().value + ':59'
        ].join(" "), 'dd/MM/YYYY HH:mm:ss')
    };
    let url = function() {
        let url ='/api/server-load?';
        let to = to();
        let from = from();
        console.log("to",to.isValid,to.toISOString());
        console.log("from",from.isValid,from.toISOString());

        if(to.isValid) { url += `&to=${ to.toISOString() }` }
        if(from.isValid) { url += `&from=${ from.toISOString() }` }

        return url;
    };

    let getData = async function() {
        let data = await axios.get( url() );

        console.log("fetched",data);
        return data;
    };

    /**
     * taken from chartJS sample with slight modifications
     * https://www.chartjs.org/samples/latest/scales/time/financial.html
     */
    let cfg = {
        data: {
            datasets: [{
                label: 'Server load - all data',
                backgroundColor: color(chartColors.blue).alpha(0.3).rgbString(),
                borderColor: chartColors.blue,
                data: getData(),
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }]
        },
        options: {
            animation: {
                duration: 0
            },
            scales: {
                xAxes: [{
                    type: 'time',
                    distribution: 'series',
                    offset: true,
                    ticks: {
                        major: {
                            enabled: true,
                            fontStyle: 'bold'
                        },
                        source: 'data',
                        autoSkip: true,
                        autoSkipPadding: 75,
                        maxRotation: 0,
                        sampleSize: 100
                    },
                    afterBuildTicks: function(scale, ticks) {
                        var majorUnit = scale._majorUnit;
                        var firstTick = ticks[0];
                        var i, ilen, val, tick, currMajor, lastMajor;

                        val = moment(ticks[0].value);
                        if ((majorUnit === 'minute' && val.second() === 0)
                            || (majorUnit === 'hour' && val.minute() === 0)
                            || (majorUnit === 'day' && val.hour() === 9)
                            || (majorUnit === 'month' && val.date() <= 3 && val.isoWeekday() === 1)
                            || (majorUnit === 'year' && val.month() === 0)) {
                            firstTick.major = true;
                        } else {
                            firstTick.major = false;
                        }
                        lastMajor = val.get(majorUnit);

                        for (i = 1, ilen = ticks.length; i < ilen; i++) {
                            tick = ticks[i];
                            val = moment(tick.value);
                            currMajor = val.get(majorUnit);
                            tick.major = currMajor !== lastMajor;
                            lastMajor = currMajor;
                        }
                        return ticks;
                    }
                }],
                yAxes: [{
                    gridLines: {
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Closing price ($)'
                    }
                }]
            },
            tooltips: {
                intersect: false,
                mode: 'index',
                callbacks: {
                    label: function(tooltipItem, myData) {
                        var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                        if (label) {
                            label += ': ';
                        }
                        label += parseFloat(tooltipItem.value).toFixed(2);
                        return label;
                    }
                }
            }
        }
    };

    window.chart = new Chart(ctx, cfg);
})(
    Chart,
    document.querySelector('canvas#chart').getContext('2d'),
    moment,
    axios
);




