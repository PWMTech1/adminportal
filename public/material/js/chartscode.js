function initDashboardPageCharts() {
    $.ajax({
        url: '/visit/payertotals',
        type: 'GET',
        async: true,
        dataType: "json",
        beforeSend:function(){
          $("#dailySalesChart").html("<i class=\"fas fa-cog fa-spin\"></i>");  
        },
        success: function(data){
            Highcharts.chart('dailySalesChart', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Payer Type Performance'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },
                series: [{
                    showInLegend: false,             
                    name: "",
                    colorByPoint: true,
                    data: data.series
                }]
            });
        }
    })
    
    
    
      $.ajax({
         url: '/visit/monthlycounts',
         type: 'GET',
        async: true,
        dataType: "json",
          success: function(data){
             
              Highcharts.chart('websiteViewsChart', {

                title: {
                    text: 'Total Visits per Month'
                },

                subtitle: {
                    text: 'Encounter Perfomance'
                },

                yAxis: {
                    title: {
                        text: 'Number of Visits'
                    }
                },
                xAxis: {
                    categories: data.labels,
                    title:{
                        text: 'Months'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                    }
                },

                series: [{
                    showInLegend: false,             
                    name: "",
                    data: data.series
                }],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        
                    }]
                }

            });
          } 
      });
      
    }
    
  $(document).ready(function(){
     initDashboardPageCharts();
  });