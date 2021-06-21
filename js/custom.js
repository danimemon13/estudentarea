// header menu

$(document).ready(function() {

// sidebar Custom

$('.sidebar_icon').click(function(){
  $('.sidebar_nav').toggleClass('sidebar_collapse');

      $('span').each(function(){
        if($(this).hasClass('sidebar_link')){

          $(this).toggleClass('sidebar_link_show');

        }
      });

      if(!$(this).hasClass('sidebar_collapse')){

        $('a.list-group-item-action').toggleClass('disabled'); 
        $('.sidebar-submenu').removeClass('show'); 

      }

  });

    $('div').each(function(){
      if($(this).hasClass('sidebar_nav')){
        $('a.list-group-item-action').addClass('disabled');          
      }
    });




        

// leads-us

    //$('#leads_us,#leads_uk,#total_pymnt,#aug_regvce,#ppc_dtls,#tble_dly,#sale_dtl,spndng_dtls').DataTable();



// chart 1
// google.charts.load("current", {packages:["corechart"]});
//       google.charts.setOnLoadCallback(drawChart);
//       function drawChart() {
//         var data = google.visualization.arrayToDataTable([
//           ['Total Sales', 'PPC'],
//           ['Total PPC Spending',     2500],
//           ['Total PPC Revenue',      1500],
//           ['Total PPC Leads',  1200],
//           ['Cost Per Leads', 12],
//           ['Cost Per Clicks',    300]
//         ]);

//         var options = {
//   'legend':'bottom',
//   'is3D':true,
//   'width':350,
//   'height':350
// };

//     var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
//     chart.draw(data, options);
//   }


  });