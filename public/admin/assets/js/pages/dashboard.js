document.addEventListener("DOMContentLoaded", function() {
    if (typeof window.dashboardCharts === 'undefined') return;

    let data = window.dashboardCharts;
    let stats = window.dashboardStats || {};

    // 1. Products Added (Bar Chart - replaces Prompts Chart)
    if (document.getElementById('promptsChart')) {
        new CustomChartJs({
            selector: "#promptsChart",
            options: () => ({
                type: "bar",
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.products,
                        backgroundColor: ins("chart-primary"),
                        borderRadius: 4,
                        borderSkipped: !1
                    }]
                },
                options: {
                    plugins: { legend: { display: !1 }, tooltip: { enabled: !0 } },
                    scales: {
                        x: { display: !1, grid: { display: !1 } },
                        y: { display: !1, grid: { display: !1 } }
                    }
                }
            })
        });
    }

    // 2. Blogs Status (Pie Chart - replaces Accuracy Chart)
    if (document.getElementById('accuracyChart')) {
        let published = stats.published_blogs || 0;
        let drafts = (stats.total_blogs || 0) - published;
        
        new CustomChartJs({
            selector: "#accuracyChart",
            options: () => ({
                type: "pie",
                data: {
                    labels: ["Published", "Drafts"],
                    datasets: [{
                        data: [published, drafts],
                        backgroundColor: [ins("chart-success"), ins("chart-gray")],
                        borderColor: [ins("chart-success"), ins("chart-gray")],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: { 
                        legend: { display: !1 }, 
                        tooltip: { 
                            enabled: !0,
                            callbacks: {
                                label: function(r) { return r.label + `: ${r.parsed}`; }
                            }
                        } 
                    }
                }
            })
        });
    }

    // 3. Career Applications (Line Chart - replaces Token Chart)
    if (document.getElementById('tokenChart')) {
        new CustomChartJs({
            selector: "#tokenChart",
            options: () => ({
                type: "line",
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.applications,
                        backgroundColor: ins("chart-warning-rgb", .1),
                        borderColor: ins("chart-warning"),
                        tension: .4,
                        fill: !0,
                        pointRadius: 0,
                        borderWidth: 2
                    }]
                },
                options: {
                    plugins: { legend: { display: !1 }, tooltip: { enabled: !0 } },
                    scales: {
                        x: { display: !1, grid: { display: !1 } },
                        y: { display: !1, grid: { display: !1 } }
                    }
                }
            })
        });
    }

    // 4. Monthly Inquiries (Line Chart - replaces Active Users Chart)
    if (document.getElementById('activeUsersChart')) {
        new CustomChartJs({
            selector: "#activeUsersChart",
            options: () => ({
                type: "line",
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: "Monthly Inquiries",
                        data: data.inquiries,
                        fill: !0,
                        borderColor: ins("chart-primary"),
                        backgroundColor: ins("chart-primary-rgb", .2),
                        tension: .4,
                        pointRadius: 0,
                        borderWidth: 1
                    }]
                }
            })
        });
    }
});