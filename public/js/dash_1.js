var options = {
  chart: {
      fontFamily: 'Nunito, sans-serif',
      height: 365,
      type: 'bar',
  },
  dataLabels: {
      enabled: false
  },
  series: [],
  labels: [],
  title: {
    text: 'Total Visits per Month',
    align: 'left',
    margin: 0,
    offsetX: -10,
    offsetY: 0,
    floating: false,
    style: {
      fontSize: '25px',
      color:  '#000'
    },
  },
  fill: {
    colors: ['#E91E63']
  },
  dataLabels: {
    enabled: true,
    style: {
      fontSize: '12px',
      colors: ['#fff']
    }
  },
  noData: {
    text: 'Loading...'
  }
}

var chart1 = new ApexCharts(
    document.querySelector("#revenueMonthly"),
    options
);

chart1.render();

var url = '/getvisitsbymonth';

$.getJSON(url, function(response) {
    //alert(JSON.stringify(response));
  chart1.updateSeries([{
    name: 'months',
    data: response
  }])
});

