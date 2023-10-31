<template>
  <div class="card">
    <div class="pb-0 card-header mb-0">
      <h6>Invoice Overview</h6>
    </div>
    <div class="p-3 card-body">
      <div class="gradient-line-chart">
        <canvas ref="chartCanvas"></canvas>
      </div>
    </div>
  </div>
</template>

<script>
import Chart from "chart.js/auto";
import axios from "axios";

export default {
  name: "GradientLineChart",

  mounted() {
    this.getData();
  },

  methods: {
    getData() {
      axios
        .get("https://alfajri.arw.my.id/api/auth/displayTransaksi", {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("access_token"),
          },
        })
        .then((response) => {
          const transactions = Object.values(response.data); // Ubah objek respons menjadi array
          const monthlyData = {};

          transactions.forEach((entry) => {
            const createdDate = new Date(entry.created_at);
            const monthKey =
              createdDate.toLocaleString("default", { month: "short" }) +
              " " +
              createdDate.getFullYear();

            if (monthlyData[monthKey]) {
              entry.transaksi_produk.forEach((produk) => {
                monthlyData[monthKey] += produk.quantity;
              });
            } else {
              monthlyData[monthKey] = 0;
              entry.transaksi_produk.forEach((produk) => {
                monthlyData[monthKey] += produk.quantity;
              });
            }
          });
          function getMonthNumber(month) {
            const monthNames = [
              "Jan",
              "Feb",
              "Mar",
              "Apr",
              "May",
              "Jun",
              "Jul",
              "Aug",
              "Sep",
              "Oct",
              "Nov",
              "Dec",
            ];
            const index = monthNames.indexOf(month.split(" ")[0]);
            return index !== -1 ? index : Infinity;
          }

          const formattedData = Object.keys(monthlyData).map((key) => ({
            month: key,
            totalQuantity: monthlyData[key],
          }));
          formattedData.sort((a, b) => {
            const monthA = getMonthNumber(a.month);
            const monthB = getMonthNumber(b.month);

            if (monthA < monthB) {
              return -1;
            }
            if (monthA > monthB) {
              return 1;
            }
            return 0;
          });

          this.drawChart(formattedData);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    drawChart(data) {
      const ctx = this.$refs.chartCanvas.getContext("2d");
      const gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
      gradientStroke.addColorStop(1, "rgba(94, 114, 228, 0.2)");
      gradientStroke.addColorStop(0.2, "rgba(94, 114, 228, 0.0)");
      gradientStroke.addColorStop(0, "rgba(94, 114, 228, 0)");

      new Chart(ctx, {
        type: "line",
        data: {
          labels: data.map((entry) => entry.month),
          datasets: [
            {
              label: "Quantity",
              tension: 0.4,
              pointRadius: 0,
              borderColor: "#4BB543",
              backgroundColor: gradientStroke,
              borderWidth: 3,
              fill: true,
              data: data.map((entry) => entry.totalQuantity),
              maxBarThickness: 6,
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            },
          },
          interaction: {
            intersect: false,
            mode: "index",
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5],
              },
              ticks: {
                display: true,
                padding: 10,
                color: "#fbfbfb",
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: "normal",
                  lineHeight: 2,
                },
              },
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5],
              },
              ticks: {
                display: true,
                color: "#ccc",
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: "normal",
                  lineHeight: 2,
                },
              },
            },
          },
        },
      });
    },
  },
};
</script>

<style scoped>
.gradient-line-chart {
  width: 100%;
  height: 300px;
}
</style>
