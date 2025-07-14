class pageDashboard {
    static initCharts() {
        // Set global Chart.js config
        Chart.defaults.color = "#333";
        Chart.defaults.scale.grid.lineWidth = 1;
        Chart.defaults.scale.grid.color = "rgba(0,0,0,0.05)";
        Chart.defaults.scale.beginAtZero = true;
        Chart.defaults.datasets.bar.maxBarThickness = 45;
        Chart.defaults.elements.bar.borderRadius = 4;
        Chart.defaults.elements.bar.borderSkipped = false;
        Chart.defaults.plugins.tooltip.radius = 3;
        Chart.defaults.plugins.legend.labels.boxWidth = 12;

        // DOM Chart Containers
        let chartEarningsCon = document.getElementById("js-chartjs-earnings");
        let chartTotalOrdersCon = document.getElementById(
            "js-chartjs-total-orders"
        );
        let chartTotalEarningsCon = document.getElementById(
            "js-chartjs-total-earnings"
        );
        let chartNewCustomersCon = document.getElementById( 
            "js-chartjs-new-customers"
        );

        // Bar Chart for Earnings (This Week vs Last Week)
        if (chartEarningsCon !== null) {
            new Chart(chartEarningsCon, {
                type: "bar",
                data: {
                    labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                    datasets: [
                        {
                            label: "Bekerja",
                            backgroundColor: "#64748b",
                            data: [716, 628, 1056, 560, 956, 890, 790],
                        },
                        {
                            label: "Belum Bekerja",
                            backgroundColor: "#cbd5e1",
                            data: [1160, 923, 1052, 1300, 880, 926, 963],
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: (context) =>
                                    `${context.dataset.label}: $${context.parsed.y}`,
                            },
                        },
                        legend: {
                            position: "top",
                        },
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: "Day",
                            },
                        },
                        y: {
                            title: {
                                display: true,
                                text: "Earnings ($)",
                            },
                        },
                    },
                },
            });
        }

        // Total Orders Chart - Change to Bar Chart
        if (chartTotalOrdersCon !== null) {
            new Chart(chartTotalOrdersCon, {
                type: "bar",
                data: {
                    labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                    datasets: [
                        {
                            label: "Total Orders",
                            backgroundColor: "#dc2626",
                            data: [33, 29, 32, 37, 38, 30, 34],
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: (context) =>
                                    `${context.parsed.y} Orders`,
                            },
                        },
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: "Day",
                            },
                        },
                        y: {
                            title: {
                                display: true,
                                text: "Orders",
                            },
                        },
                    },
                },
            });
        }

        // Total Earnings Chart - Change to Bar Chart
        if (chartTotalEarningsCon !== null) {
            new Chart(chartTotalEarningsCon, {
                type: "bar",
                data: {
                    labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                    datasets: [
                        {
                            label: "Total Earnings",
                            backgroundColor: "#65a30d",
                            data: [716, 1185, 750, 1365, 956, 890, 1200],
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: (context) => `$${context.parsed.y}`,
                            },
                        },
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: "Day",
                            },
                        },
                        y: {
                            title: {
                                display: true,
                                text: "Earnings ($)",
                            },
                        },
                    },
                },
            });
        }

        // New Customers Chart - Change to Bar Chart
        if (chartNewCustomersCon !== null) {
            new Chart(chartNewCustomersCon, {
                type: "bar",
                data: {
                    labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                    datasets: [
                        {
                            label: "New Customers",
                            backgroundColor: "#0ea5e9",
                            data: [25, 15, 36, 14, 29, 19, 36],
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: (context) =>
                                    `${context.parsed.y} Customers`,
                            },
                        },
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: "Day",
                            },
                        },
                        y: {
                            title: {
                                display: true,
                                text: "Customers",
                            },
                        },
                    },
                },
            });
        }
    }

    static init() {
        this.initCharts();
    }
}

One.onLoad(pageDashboard.init());
