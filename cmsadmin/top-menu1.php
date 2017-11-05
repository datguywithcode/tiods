 <?php
$d = strtotime("today");
$start_week = strtotime("last sunday midnight",$d);
$end_week = strtotime("next saturday",$d);
$start = date("Y-m-d",$start_week); 
$end = date("Y-m-d",$end_week);  
$dt=date('m');
$dt1=date('Y');
$ms1=$dt1."-".$dt."-".'01';
$ms2=$dt1."-".$dt."-".'31';
$ms3=$dt1."-".'01'."-".'01';
$ms4=$dt1."-".'12'."-".'31';
?>
          
 <?php $query5=mysql_num_rows(mysql_query("select * from user_registration where registration_date='".date('Y-m-d')."'"));?>
<?php $query6=mysql_num_rows(mysql_query("select * from user_registration where registration_date between '$start' and '$end'"));?>
<?php $query7=mysql_num_rows(mysql_query("select * from user_registration where registration_date between '$ms1' and '$ms2'"));?>
<?php $query8=mysql_num_rows(mysql_query("select * from user_registration where registration_date between '$ms3' and '$ms4'"));?>
   
                <span class="sub-title">Welcome to Admin dashboard</span>
                <div class="state-information">
                <div class="state-graph">
                        <div id="balance" class="chart"></div>
                        <div class="info">This Year Register ( <?php echo $query8;?> )</div>
                    </div>
                    <div class="state-graph">
                        <div id="balance1" class="chart"></div>
                        <div class="info">This Month Register ( <?php echo $query7;?> )</div>
                    </div>
                    <div class="state-graph">
                        <div id="item-sold" class="chart"></div>
                        <div class="info">This Week Register ( <?php echo $query6;?> )</div>
                    </div>
                     <div class="state-graph">
                        <div id="item-sold1" class="chart"></div>
                        <div class="info">Today Register ( <?php echo $query5;?> )</div>
                    </div>
                </div>
            </div>