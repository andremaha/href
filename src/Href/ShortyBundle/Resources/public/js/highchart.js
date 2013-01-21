$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Statistics for URL clicks'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage}</b>',
                percentageDecimals: 0
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Amount of clicks',
                data: getDataFromList()
            }]
        });
    });
});

function getDataFromList() {
    var data = [];
    $.each($('.top_urls li'), function(index, value) {
        var name = $(value).find('em').text();
        var count = $(value).find('strong').text();
        data.push([name, parseInt(count, 10)]);
    });

    return data;
}