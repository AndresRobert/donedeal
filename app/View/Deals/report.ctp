<h5 class="center-align">Amount Received</h5>
<h4 class="red-text center-align">$<?= $total_paid ?></h4>
<h5 class="center-align">Distribution</h5>
<canvas id="myChart" width="100px" height="100px"></canvas>
<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [<?= $data ?>],
                backgroundColor: ["#ef5350", "#ffd54f", "#81c784"]
            }],
            labels: [<?= $labels ?>]
        },
        options: {
            color: ['red','yellow','green']
        }
    });
</script>