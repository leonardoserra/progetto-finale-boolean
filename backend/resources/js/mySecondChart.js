import Chart from 'chart.js/auto';

const labels = [];
const data = {
  labels: labels,
  datasets: [{
    label: 'Guadagni annuali',
    data: [],
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};
const plugin = {
    id: 'customCanvasBackgroundColor',
    beforeDraw: (chart, args, options) => {
      const {ctx} = chart;
      ctx.save();
      ctx.globalCompositeOperation = 'destination-over';
      ctx.fillStyle = options.color || '#99ffff';
      ctx.fillRect(0, 0, chart.width, chart.height);
      ctx.restore();
    }
  };
const config = {
    type: 'bar',
    data: data,
    options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
      plugins: {
        customCanvasBackgroundColor: {
            color: '#fff',
        }
      }
    },
    plugins: [plugin],
  };

  if ((typeof orderLabelsYearData) !== 'undefined'){
    orderLabelsYearData.forEach(order => {
        labels.push(order.year);
        data.datasets[0].data.push(order.earned);
    });
    new Chart(
        document.getElementById('mySecondChart'),
        config
    );
}


