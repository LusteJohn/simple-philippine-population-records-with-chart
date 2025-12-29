$(document).ready(function() {
    // First Chart displays the population of isand_group per year
    var pieCtx = document.getElementById('myPieChart').getContext('2d');
    var pieChart;

    function getYearData(year) {
        $.ajax ({
            'type' : 'POST',
            'url' : 'includes/fetch_data.php',
            'data' :{action: 'getData', year: year},
            'dataType' : 'json',
            success: function(response) {
                reloadPieChart(response.labels, response.data, response.backgroundColor);
            },
            error: function(xhr, status, error) {
                // do nothing
            }
        })
    }

    function reloadPieChart(labels, datasets, backColor) {
        if (pieChart) {
            pieChart.destroy();
        }

        pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: datasets,
                    backgroundColor: backColor,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'left', // Adjust legend position
                        labels: {
                            usePointStyle: true, // Enable custom point style
                            pointStyle: 'circle', // change point style
                            font: {
                                size: 14, // djust font size
                                // weight: 'bold', // weight text bold
                            },
                            padding: 20,
                            boxWidth: 20,
                            boxHeight: 20,
                            generateLabels: function(chart) {
                                return chart.data.labels.map(function(label, index) {
                                    return {
                                        text: label,
                                        fillStyle: chart.data.datasets[0].backgroundColor[index]  // Color corresponding to each label
                                    };
                                });
                            }
                        }
                    }
                }
            }
        });
    }

    $('#filterYear button').click(function(e) {
        e.preventDefault();  // Prevent the default form submission

        // Remove the 'active' class from all buttons
        $('#filterYear button').removeClass('active');

        // Add 'active' class to the clicked button
        $(this).addClass('active');

        // Get the year associated with the clicked button
        var year = $(this).data('group');

        // Send request for the selected year
        getYearData(year);
    });
    
    getYearData('year_2000');

    // Second Chart displays the number of provinces per region
    var lineBarCtx = document.getElementById('myLineBarChart').getContext('2d')
    var lineBarChart;

    function getProvince() {
        $.ajax ({
            'type' : 'POST',
            'url' : 'includes/fetch_data.php',
            'data' : {action: 'getProvinces'},
            'dataType' : 'json',
            success: function(response) {
                reloadLineBarChart(response.labels, response.data, response.backgroundColor);
            },
            error: function(xhr, status, error) {
                // do nothing
            }
        })
    }

    function reloadLineBarChart(labels, datasets, backColor) {
        if (lineBarChart) {
            lineBarChart.destroy();
        }

            lineBarChart = new Chart(lineBarCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        data: datasets,
                        backgroundColor: backColor,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top', // Adjust legend position
                            labels: {
                                usePointStyle: true, // Enable custom point style
                                pointStyle: 'circle', // change point style
                                font: {
                                    size: 12, // djust font size
                                    // weight: 'bold', // weight text bold
                                },
                                padding: 20,
                                boxWidth: 20,
                                boxHeight: 20,
                                generateLabels: function(chart) {
                                    return chart.data.labels.map(function(label, index) {
                                        return {
                                            text: label,
                                            fillStyle: chart.data.datasets[0].backgroundColor[index]  // Color corresponding to each label
                                        };
                                    });
                                }
                            }
                        }
                    }
                }
            });
    }
    getProvince();

    // Third chart displays the population of provinces from 2000-2020
    var barCtx = document.getElementById('myBarChart').getContext('2d');
    var barChart;

    function getProvinceData(provinceList) {
        $.ajax ({
            'type' : 'POST',
            'url' : 'includes/fetch_data.php',
            'data' : {action: 'getYear', provinceList: provinceList},
            'dataType' : 'json',
            success: function(response) {
                reloadBarChart(response.labels, response.datasets);
            },
            error: function(xhr, status, error) {
                // do nothing
            }
        })
    }

    function reloadBarChart(labels, datasets) {
        if (barChart) {
            barChart.destroy();
        }

        barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets.map(function(dataset) {
                    return {
                        label: dataset.label,
                        data: dataset.data,
                        backgroundColor: dataset.backgroundColor // Ensure individual colors for bars
                    };
                })
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            generateLabels: function(chart) {
                                return chart.data.labels.map(function(label, index) {
                                    return {
                                        text: label,
                                        fillStyle: chart.data.datasets[0].backgroundColor[index]  // Color corresponding to each label
                                    };
                                });
                            }
                        }
                    }
                }
            }
        });
    }

    $("#provinceList").change(function() {
        var selectedProvince = $(this).val();
        getProvinceData(selectedProvince); // Pass the selected value
    });
    getProvinceData('Metro Manila');
    

    // Four chart display the top 5 most populated provinces in 2020
    var donutCtx = document.getElementById('myDonutChart').getContext('2d');
    var donutChart;

    function getTopProvince() {
        $.ajax ({
            'type' : 'POST',
            'url' : 'includes/fetch_data.php',
            'data' : {action: 'getTopProvinces'},
            'dataType' : 'json',
            success: function(response) {
                reloadDonutChart(response.labels, response.data, response.backgroundColor);
            },
            error: function(xhr, status, error) {
                // do nothing
            }
        })
    }

    function reloadDonutChart(labels, datasets, backColor) {
        if (donutChart) {
            donutChart.destroy();
        }

        donutChart = new Chart(donutCtx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: datasets,
                    backgroundColor: backColor,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 20,
                            boxWidth: 20,
                            boxHeight: 20,
                            generateLabels: function(chart) {
                                return chart.data.labels.map(function(label, index) {
                                    return {
                                        text: label,
                                        fillStyle: chart.data.datasets[0].backgroundColor[index]  // Color corresponding to each label
                                    };
                                });
                            }
                        }
                    },
                    datalabels: {
                        // show the value inside each section of the donut chart
                        formatter: function(value, context) {
                            return value; // Display the numberical value
                        },
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: '12',
                        },
                        align: 'center', // Positioning of the label
                        anchor: 'center', // Anchor the label in the  center of each section
                    }
                }
            }
        });
    }
    getTopProvince();
    
    // Sixth chart displays the the total population of region each year
    var lineCtx = document.getElementById('mylineChart').getContext('2d');
    var lineChart;

    function getRegionData(regionList) {
        $.ajax ({
            'type' : 'POST',
            'url' : 'includes/fetch_data.php',
            'data' : {action: 'getRegion', regionList: regionList},
            'dataType' : 'json',
            success: function(response) {
                reloadLineChart(response.labels, response.datasets);
            },
            error: function(xhr, status, error) {
                // do nothing
            }
        })
    }

    function reloadLineChart(labels, datasets) {
        if (lineChart) {
            lineChart.destroy();
        }

        lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets.map(function(dataset) {
                    return {
                        label: dataset.label,
                        data: dataset.data,
                        borderColor: dataset.borderColor, // Fix: Use borderColor instead of backgroundColor
                        fill: dataset.fill,
                        pointBackgroundColor: dataset.borderColor, // Match line color
                        pointRadius: 5 // Make points more visible
                    };
                })
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14,
                                weight: 'bold'
                            },
                            color: '#000000',
                            usePointStyle: true,
                            boxWidth: 10
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    $("#regionList").change(function() {
        var selectedRegion = $(this).val();
        getRegionData(selectedRegion); // Pass the selected value
    });
    
    getRegionData('NCR');

    // Fifth chart displays the table list of capital and region based on island_group
    function loadData(island_group) {
        $.ajax ({
            'type' : 'GET',
            'url' : 'includes/fetch_data.php',
            'data' : {action: 'getData', island_group: island_group},
            'dataType' : 'json',
            success: function(response) {
                console.log("Full Response:", response); // Debugging
            
                if (response.success) {
                    console.log("Received Data:", response.data); // Log the data
            
                    let tableBody = $("#tbl_display tbody");
                    tableBody.empty();
            
                    $.each(response.data, function(index, data) {
                        console.log("Appending Row:", data); // Debug each row before appending
            
                        let row = `<tr>
                            <td>${data.capital}</td>
                            <td>${data.region}</td>
                        </tr>`;
                        tableBody.append(row);
                    });
                } else {
                    console.error("Error Message:", response.message);
                }
            },
            error: function(xhr, status, error) {
            }            
        })
    }

    $(document).on('click', '#filterIsland button', function (e) {
        e.preventDefault(); // Prevent form submission
    
        // Remove 'active' class from all buttons
        $('#filterIsland button').removeClass('active');
    
        // Add 'active' class to clicked button
        $(this).addClass('active');
    
        // Get the island group from button
        var island_group = $(this).data('group');
    
        // Fetch data
        loadData(island_group);
    });
    
    loadData("Luzon");
    // end of the function
});