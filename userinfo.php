<?php $show_title = "사용자 정보 - $OJ_NAME"; ?>
<?php include("template/$OJ_TEMPLATE/header.php"); ?>
<style>
    #avatar_container:before {
        content: "";
        display: block;
        padding-top: 100%;
    }
</style>

<div class="padding">
    <div class="ui grid">
        <div class="row">
            <div class="five wide column">
                <div class="ui card" style="width: 100%; " id="user_card">
                    <div class="blurring dimmable image" id="avatar_container" style="height:325px">
                        <?php $default = "";
                        $profile = "/upload/" . $user . ".webp";
                        $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=500";
                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $profile)) {
                            $grav_url = $profile;
                        } ?>

                        <img style="margin-top: -100%; " src="<?php echo $grav_url; ?>">
                    </div>
                    <div class="content">
                        <div class="header">
                            <?php echo $nick ?>
                        </div>
                        <div class="meta">
                            <a class="group">
                                <?php echo $school ?>
                            </a>
                        </div>
                    </div>
                    <div class="extra content">
                        <a><i class="check icon"></i>맞춘 문제 :
                            <?php echo $AC ?> 개
                        </a>
                        <a style="float: right; "><i class="star icon"></i>순위 :
                            <?php echo $Rank ?> 위
                        </a>

                        <?php if ($email != "") { ?>
                            <div style="margin-top:10px;margin-bottom:10px">
                                <a href="mailto:<?php echo $email ?>">
                                    <i class="icon large envelope"></i>
                                    <span style="display:inline-block; vertical-align:middle">
                                        <?php echo $email ?>
                                    </span>
                                </a>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </div>
            <div class="eleven wide column">
                <div class="ui grid" style="padding-left: 20px;">
                    <div class="row">
                        <div class="column">
                            <h4 class="ui top attached block header">제출 횟수</h4>
                            <div class="ui bottom attached segment">
                                <div id="sub_date_chart" style="width:100%;height:210px"></div>
                                <a href="/status.php?user_id=<?php echo $user ?>"><i class="search icon"></i>상세 채점 기록
                                    보기</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <h4 class="ui top attached block header">통계</h4>
                            <div class="ui bottom attached segment">
                                <div class="ui grid">
                                    <div class="row">
                                        <div id="pie_chart_legend" class="six wide column"></div>
                                        <div class="ten wide column">
                                            <canvas id="pie_chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <h4 class="ui top attached block header">해결한 문제</h4>
                            <div class="ui bottom attached segment">
                                <script language='javascript'>
                                    function p(id, c) {
                                        document.write("<a href=problem.php?id=" + id + " class=\"ui green basic label\" id=\"show-problem-id\">" + id + " </a>");
                                    }

                                    function ptot(len) {
                                        document.write("<div style='text-align:right;margin-bottom:10px'><div class='ui green small horizontal statistic'><div class='value'>" + len + "</div><div class='label'>AC</div></div></div>");
                                    }
                                    <?php
                                    $sql = "SELECT `problem_id`,count(1) from solution where `user_id`=? and result=4 and problem_id != 0 group by `problem_id` ORDER BY `problem_id` ASC";
                                    if ($ret = pdo_query($sql, $user)) {
                                        $len = count($ret);
                                        echo "ptot($len);";
                                        foreach ($ret as $row) {
                                            if (isset($acc_arr[$row['problem_id']]))
                                                echo "p($row[0],$row[1]);";
                                            else
                                                echo "p($row[0],0);";
                                        }
                                    }
                                    ?>
                                </script>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <h4 class="ui top attached block header">실패한 문제</h4>
                            <div class="ui bottom attached segment">
                                <script language='javascript'>
                                        function p(id, c) {
                                            document.write("<a href=problem.php?id=" + id + " class=\"ui red basic label\" id=\"show-problem-id\">" + id + " </a>");
                                        }
                                        <?php
                                        $sql = "SELECT `sol`.`problem_id`, count(1) from solution sol where `sol`.`user_id`=? and `sol`.`result`!=4 and sol.problem_id != 0 and not exists (select * from solution s where s.user_id=sol.user_id and s.problem_id = sol.problem_id and s.result = 4) group by `sol`.`problem_id` ORDER BY `sol`.`problem_id` ASC";
                                        if ($result = pdo_query($sql, $user)) {
                                            foreach ($result as $row)
                                                echo "p($row[0],$row[1]);";
                                        }
                                        ?>
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
            $(function () {
                $('#user_card .image').dimmer({
                    on: 'hover'
                });
                var pie = new Chart(document.getElementById('pie_chart').getContext('2d'), {
                    aspectRatio: 1,
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: [
                                <?php foreach ($view_userstat as $row) {
                                    echo $row[1] . ",\n";
                                }
                                ?>
                            ],
                            backgroundColor: [
                                "#32CD32",
                                "#FA8072",
                                "#DC143C",
                                "#FF9912",
                                "#8A2BE2",
                                "#4169E1",
                                "#DB7093",
                                "#082E54",
                                "#FFFF00",
                            ]
                        }],
                        labels: [
                            <?php
                            foreach ($view_userstat as $row) {
                                echo "\"" . $jresult[$row[0]] . "\",\n";
                            }
                            ?>
                        ]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false
                        },
                        legendCallback: function (chart) {
                            var text = [];
                            text.push(
                                '<ul style="list-style: none; padding-left: 20px; margin-top: 0; " class="' +
                                chart.id + '-legend">');

                            var data = chart.data;
                            var datasets = data.datasets;
                            var labels = data.labels;

                            if (datasets.length) {
                                for (var i = 0; i < datasets[0].data.length; ++i) {
                                    text.push(
                                        '<li style="font-size: 15px; color: #666; margin:10px 20px"><span style="width: 12px; height: 12px; display: inline-block; border-radius: 50%; margin-right: 5px; background-color: ' +
                                        datasets[0].backgroundColor[i] + '; "></span>');
                                    if (labels[i]) {
                                        text.push(labels[i]);
                                        text.push(' : ' + datasets[0].data[i]);
                                    }
                                    text.push('</li>');
                                }
                            }

                            text.push('</ul>');
                            return text.join('');
                        }
                    },
                });
                document.getElementById('pie_chart_legend').innerHTML = pie.generateLegend();
            });
    </script>

    <?php
    $sub_data = [];
    $max_count = 0;
    $sql = "SELECT DATE(in_date),count(*) FROM solution WHERE user_id=? AND  in_date >= DATE_SUB(CURDATE(),INTERVAL 1 YEAR) AND result < 13 GROUP BY DATE(in_date);";
    $ret = pdo_query($sql, $user);
    foreach ($ret as $row) {
        array_push($sub_data, [$row[0], (int) $row[1]]);
        $max_count = max($max_count, (int) $row[1]);
    }
    // $max_count = ceil($max_count / 100) * 100;
    date_default_timezone_set('PRC');
    $today = date('Y-m-d', time());
    $beg_time = date('Y-m-d', strtotime("-6 month"));
    // echo json_encode($sub_data, false);
    ?>
    <script src="<?php echo $OJ_CDN_URL . $path_fix . "template/$OJ_TEMPLATE" ?>/js/echarts.min.js"></script>
    <!--<script src="https://cdn.staticfile.org/echarts/5.1.2/echarts.min.js"></script>-->

    <script type="text/javascript">
        var chartDom = document.getElementById('sub_date_chart');
        var myChart = echarts.init(chartDom);
        var option;
        var today = new Date();
        console.log(today.getFullYear() + '-' + today.getMonth() + '-' + today.getDay());
        option = {
            title: {
                top: 30,
                left: 'center',
            },
            tooltip: {
                formatter: function (params) {
                    return params.value[0] + '<br>제출 횟수：' + params.value[1];
                }
            },
            visualMap: {
                min: 0,
                max: <?php echo $max_count ?>,
            show: false,
            type: 'piecewise',
            orient: 'horizontal',
            left: 'center',
            top: 10,
            inRange: {
                color: ['#80d596', '#156344']
            }
        },
            calendar: {
            top: 30,
                left: 40,
                    right: 30,
                        cellSize: [20, 20],
                            range: ['<?php echo $beg_time ?>', '<?php echo $today ?>'],
                                itemStyle: {
                borderWidth: 0.5,
                
            },
            lineStyle: {
                color: '#D10E00',
                    width: 1,
                        opacity: 1
            },
            yearLabel: {
                show: false
            },
            dayLabel: {
                firstDay: 1,
                    nameMap: 'ko',
                        margin: '8px'
            },
            monthLabel: {
                nameMap: 'ko',
                    margin: 15,
                        fontSize: 14,
                            color: 'gray'
            },
            splitLine: {
                show: false
            },

        },
        series: {
            name: '제출 횟수',
                type: 'heatmap',
                    coordinateSystem: 'calendar',
                        data: <?php echo json_encode($sub_data, false); ?>,
        }
    };

        option && myChart.setOption(option);
    </script>

    <?php include("template/$OJ_TEMPLATE/footer.php"); ?>