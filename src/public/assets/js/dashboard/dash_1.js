try {


    /*
        ==============================
        |    @Options Charts Script   |
        ==============================
    */

    /*
        ======================================
            Visitor Statistics | Options
        ======================================
    */


    // Total Visits

    var spark1 = {
        chart: {
            id: 'unique-visits', group: 'sparks2', type: 'line', height: 58, sparkline: {
                enabled: true
            }, dropShadow: {
                enabled: true, top: 3, left: 1, blur: 3, color: '#009688', opacity: 0.7,
            }
        }, series: [{
            data: [21, 9, 36, 12, 44, 25, 59, 41, 66, 25].reverse()
        }], stroke: {
            curve: 'smooth', width: 2,
        }, markers: {
            size: 0
        }, grid: {
            padding: {
                top: 0, bottom: 0, left: 0
            }
        }, colors: ['#009688'], tooltip: {
            x: {
                show: false
            }, y: {
                title: {
                    formatter: function formatter(val) {
                        return '';
                    }
                }
            }
        }, responsive: [{
            breakpoint: 576, options: {
                chart: {
                    height: 95,
                }, grid: {
                    padding: {
                        top: 45, bottom: 0, left: 0
                    }
                },
            },
        }

        ]
    }

    // Paid Visits

    var spark2 = {
        chart: {
            id: 'total-users', group: 'sparks1', type: 'line', height: 58, sparkline: {
                enabled: true
            }, dropShadow: {
                enabled: true, top: 1, left: 1, blur: 2, color: '#e2a03f', opacity: 0.7,
            }
        }, series: [{
            data: [22, 19, 30, 47, 32, 44, 34, 55, 41, 69].reverse()
        }], stroke: {
            curve: 'smooth', width: 2,
        }, markers: {
            size: 0
        }, grid: {
            padding: {
                top: 0, bottom: 0, left: 0
            }
        }, colors: ['#e2a03f'], tooltip: {
            x: {
                show: false
            }, y: {
                title: {
                    formatter: function formatter(val) {
                        return '';
                    }
                }
            }
        }, responsive: [{
            breakpoint: 576, options: {
                chart: {
                    height: 95,
                }, grid: {
                    padding: {
                        top: 35, bottom: 0, left: 0
                    }
                },
            },
        }]
    }


    /*
        ==============================
            Statistics | Options
        ==============================
    */

    // Followers

    var d_1options3 = {
        chart: {
            id: 'sparkline1', type: 'area', height: 160, sparkline: {
                enabled: true
            },
        }, stroke: {
            curve: 'smooth', width: 2,
        }, series: [{
            name: 'Sales', data: [38, 60, 38, 52, 36, 40, 28].reverse()
        }], labels: ['1', '2', '3', '4', '5', '6', '7'].reverse(), yaxis: {
            min: 0
        }, colors: ['#4361ee'], tooltip: {
            x: {
                show: false,
            }
        },
    }

    // Referral

    var d_1options4 = {
        chart: {
            id: 'sparkline1', type: 'area', height: 160, sparkline: {
                enabled: true
            },
        }, stroke: {
            curve: 'smooth', width: 2,
        }, series: [{
            name: 'Sales', data: [60, 28, 52, 38, 40, 36, 38].reverse()
        }], labels: ['1', '2', '3', '4', '5', '6', '7'].reverse(), yaxis: {
            min: 0
        }, colors: ['#e7515a'], tooltip: {
            x: {
                show: false,
            }
        }
    }

    // Engagement Rate

    var d_1options5 = {
        chart: {
            id: 'sparkline1', type: 'area', height: 160, sparkline: {
                enabled: true
            },
        }, stroke: {
            curve: 'smooth', width: 2,
        }, fill: {
            opacity: 1,
        }, series: [{
            name: 'Sales', data: [28, 50, 36, 60, 38, 52, 38].reverse()
        }], labels: ['1', '2', '3', '4', '5', '6', '7'].reverse(), yaxis: {
            min: 0
        }, colors: ['#1abc9c'], tooltip: {
            x: {
                show: false,
            }
        }
    }


    /*
        ==============================
        |    @Render Charts Script    |
        ==============================
    */


    /*
        ======================================
            Visitor Statistics | Script
        ======================================
    */

    // Total Visits
    d_1C_1 = new ApexCharts(document.querySelector("#total-users"), spark1);
    d_1C_1.render();

    // Paid Visits
    d_1C_2 = new ApexCharts(document.querySelector("#paid-visits"), spark2);
    d_1C_2.render();

    /*
        ==============================
            Statistics | Script
        ==============================
    */


    // Followers

    var d_1C_5 = new ApexCharts(document.querySelector("#hybrid_followers"), d_1options3);
    d_1C_5.render()

    // Referral

    var d_1C_6 = new ApexCharts(document.querySelector("#hybrid_followers1"), d_1options4);
    d_1C_6.render()

    // Engagement Rate

    var d_1C_7 = new ApexCharts(document.querySelector("#hybrid_followers3"), d_1options5);
    d_1C_7.render()


    /*
        =============================================
            Perfect Scrollbar | Notifications
        =============================================
    */
    const ps = new PerfectScrollbar(document.querySelector('.mt-container'));


} catch (e) {
// statements
    console.log(e);
}
