import Chart from 'chart.js/auto';

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