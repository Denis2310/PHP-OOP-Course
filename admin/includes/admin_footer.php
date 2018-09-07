  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script type="text/javascript" src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

   	<script>

   	  google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([

          ['Data', 'Count'],
          ['Views', <?php echo $session->count; ?>],
          ['Comments', <?php echo $number_of_comments; ?>],
          ['Users', <?php echo $number_of_users; ?>],
          ['Photos', <?php echo $number_of_photos; ?>]


        ]);

        var options = {
        	legend: 'none',
        	pieSliceText: 'label',
        	backgroundColor: 'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }	


   	</script>

</body>

</html>
