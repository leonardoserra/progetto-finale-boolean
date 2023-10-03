import Chart from 'chart.js/auto';

const labels = [];

const data = {
    labels: labels,
    datasets: [{
        label: 'Guadagni Mensili',
        backgroundColor: 'rgb(0, 0, 255,0.2)',
        borderColor: 'rgb(0, 0, 255,0.5)',
        pointStyle: 'circle',
        pointRadius: 5,
        pointHoverRadius: 8,
        fill: true,
        tension: 0.1,
        data: [],
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
    type: 'line',
    data: data,
    options: {
      plugins: {
        customCanvasBackgroundColor: {
          color: '#fff',
        }
      }
    },
    plugins: [plugin],
  };

if ((typeof orderLabelsData) !== 'undefined'){
    orderLabelsData.forEach(order => {
        labels.push(order.month);
        data.datasets[0].data.push(order.earned);
    });
    new Chart(
        document.getElementById('myChart'),
        config
    );
}






