jQuery(document).ready(function($){
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
                            return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage) +' %';
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
    jQuery.each(jQuery('.top_urls li'), function(index, value) {
        var name = jQuery(value).find('.original_url').text();
        var count = parseInt(jQuery(value).find('.all_time_clicks').text(), 10);
        if (count > 0) {
            data.push([name, count]);
        }
    });

    return data;
}