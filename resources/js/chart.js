import Chart from 'chart.js/auto';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('canvas[data-type]').forEach(ctx => {
        const type = ctx.dataset.type;
        const labels = JSON.parse(ctx.dataset.labels || '[]');
        const data = JSON.parse(ctx.dataset.data || '[]');

        new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: ctx.dataset.label,
                    data: data,
                    borderWidth: 5
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        align: 'left',
                        maxWidth: 30,
                        labels: {
                            boxWidth: 30,
                            boxHeight: 15,
                            borderRadius: 6,
                            useBorderRadius: true,
                            padding: 20,
                            font: {
                                size: 20,
                            }
                        }
                    }
                }
            }
        });
    })
});

document.addEventListener('DOMContentLoaded', function () {
    initErrorTrend('errorTrendChart');
    initErrorRegion('errorRegionChart');
    initErrorByProject('errorByProjectChart');
});

async function initErrorTrend(id) {
    const ctx = document.getElementById(id);
    if (!ctx) return;

    try {
        const response = await axios.get('dashboard/errortrend', {
            headers: {
                'Accept': 'application/json',
            }
        });

        const { labels, values } = response.data.data;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: '4 hours interval',
                    data: values,
                    borderWidth: 2,
                    fill: true,
                    tension: 0.6,
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { display: false }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }

    catch (error) {
        console.error('Error!!!!', error);
    }
}

async function initErrorRegion(id) {
    const ctx = document.getElementById(id);
    if (!ctx) return;

    try {
        const responseregion = await axios.get('dashboard/errorbyregion', {
            headers: {
                'Accept': 'application/json',
            }
        });

        const { labels, values } = responseregion.data.data;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: ' Errors Reported ',
                    data: values,
                    fill: true,
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
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { display: false }
                    },
                    x: {
                        ticks: { stepSize: 1 },
                        grid: { display: false }
                    }
                }
            }
        });
    } catch (error) {
        console.error('Chart Error:', error);
    }
}

async function initErrorByProject(id) {
    const ctx = document.getElementById(id);
    if (!ctx) return;

    try {
        const responseproject = await axios.get('dashboard/errorbyproject', {
            headers: {
                'Accept': 'application/json'
            }
        });

        const { labels, values } = responseproject.data.data;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    axis: 'y',
                    label: ' Errors Reported ',
                    data: values,
                    fill: true,
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
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { display: false }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    } catch (error) {
        console.log('Chart Error:', error);
    }
}