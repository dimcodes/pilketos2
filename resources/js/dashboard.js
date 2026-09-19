import Chart from "chart.js/auto";

document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById("voteChart");
    if (!canvas) return;

    const ctx = canvas.getContext("2d");
    // Nerima data
    const paslonData = window.paslonData || [];

    const chartLabels = paslonData.map(
        (item) => `Paslon ${item.no_urut} (${item.nama})`,
    );
    const chartData = paslonData.map((item) => item.suara);
    const chartColors = paslonData.map((item) => item.badge_color);

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: chartLabels,
            datasets: [
                {
                    label: "Jumlah Suara",
                    data: chartData,
                    backgroundColor: chartColors,
                    borderRadius: 8,
                    maxBarThickness: 140,
                    categoryPercentage: 0.5,
                    barPercentage: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 },
                },
            },
        },
    });
});
