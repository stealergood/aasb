<script>
    $.getJSON("http://localhost:8080/pie/data-produk.php", function(data) {
        //array untuk chart label dan chart data
        var isi_labels = [];
        var isi_data = [];
        var TotalJml = 0;
        //menghitung total jumlah item
        data.forEach(function(obj) {
            TotalJml += Number(obj["JmlItem"]);
        });

        //push ke dalam array isi label dan isi data
        var JmlItem = 0;
        $(data).each(function(i) {
            isi_labels.push(data[i].NamaProduk);
            //jml item dalam persentase
            isi_data.push(((data[i].JmlItem / TotalJml) * 100).toFixed(2));
        });

        //deklarasi chartjs untuk membuat grafik 2d di id mychart   
        var ctx = document.getElementById('myChart').getContext('2d');

        var myPieChart = new Chart(ctx, {
            //chart akan ditampilkan sebagai pie chart
            type: 'pie',
            data: {
                //membuat label chart
                labels: isi_labels,
                datasets: [{
                    label: 'Data Produk',
                    //isi chart
                    data: isi_data,
                    //membuat warna pada chart
                    backgroundColor: [
                        'rgb(26, 214, 13)',
                        'rgb(235, 52, 110)',
                        'rgb(52, 82, 235)',
                        'rgb(138, 4, 113)',
                        'rgb(214, 134, 13)'
                    ],
                    //borderWidth: 0, //this will hide border
                }]
            },
            options: {
                //konfigurasi tooltip
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var labels = data.labels[tooltipItem.index];
                            var currentValue = dataset.data[tooltipItem.index];
                            return labels + ": " + currentValue + " %";
                        }
                    }
                }
            }
        });
    });

    $.getJSON("<?php echo site_url('home/jumlah_kehadiran') ?>", function(anu) {
        echarts.init(document.querySelector("#trafficChart")).setOption({
            tooltip: {
                trigger: 'item'
            },
            legend: {
                top: '5%',
                left: 'center'
            },
            series: [{
                name: 'Kehadiran',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: '18',
                        fontWeight: 'bold'
                    }
                },
                labelLine: {
                    show: false
                },
                data: anu
            }]
        });
    });
</script>