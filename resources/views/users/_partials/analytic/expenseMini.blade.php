<script>
    'use strict';
    (function() {
        let cardColor, headingColor, axisColor, shadeColor, borderColor;

        cardColor = config.colors.white;
        headingColor = config.colors.headingColor;
        axisColor = config.colors.axisColor;
        borderColor = config.colors.borderColor;
        // Expenses Mini Chart - Radial Chart
        // --------------------------------------------------------------------
        const weeklyExpensesEl = document.querySelector('#expensesOfWeek'),
            weeklyExpensesConfig = {
                series: [65],
                chart: {
                    width: 60,
                    height: 60,
                    type: 'radialBar'
                },
                plotOptions: {
                    radialBar: {
                        startAngle: 0,
                        endAngle: 360,
                        strokeWidth: '8',
                        hollow: {
                            margin: 2,
                            size: '45%'
                        },
                        track: {
                            strokeWidth: '50%',
                            background: borderColor
                        },
                        dataLabels: {
                            show: true,
                            name: {
                                show: false
                            },
                            value: {
                                formatter: function(val) {
                                    return '$' + parseInt(val);
                                },
                                offsetY: 5,
                                color: '#697a8d',
                                fontSize: '13px',
                                show: true
                            }
                        }
                    }
                },
                fill: {
                    type: 'solid',
                    colors: config.colors.primary
                },
                stroke: {
                    lineCap: 'round'
                },
                grid: {
                    padding: {
                        top: -10,
                        bottom: -15,
                        left: -10,
                        right: -10
                    }
                },
                states: {
                    hover: {
                        filter: {
                            type: 'none'
                        }
                    },
                    active: {
                        filter: {
                            type: 'none'
                        }
                    }
                }
            };
        if (typeof weeklyExpensesEl !== undefined && weeklyExpensesEl !== null) {
            const weeklyExpenses = new ApexCharts(weeklyExpensesEl, weeklyExpensesConfig);
            weeklyExpenses.render();
        }
    });
</script>
