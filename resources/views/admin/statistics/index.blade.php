<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistiek') }}
        </h2>
    </x-slot>
    @push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Cirkel diagram -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

       
        var data = google.visualization.arrayToDataTable([
          ['Cijfers', 'Aantal studenten'],
          ['8',     11],
          ['4',      2],
          ['6',  2],
          ['3', 2],
          ['9',    7]
        ]);
    
        var options = {
            title: 'Cijfers studenten',
            width: 500,
            height: 300,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <!-- Staaf diagram -->
    <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["Datum", "Hoeveel", { role: "style" } ],
            ["Copper", 8.94, "#b87333"],
            ["Silver", 10.49, "silver"],
            ["Gold", 19.30, "gold"],
            ["Platinum", 21.45, "color: #e5e4e2"]
          ]);

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);

          var options = {
            title: "Geregistreerde studenten per maand",
            width: 500,
            height: 300,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };
          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
          chart.draw(view, options);
      }
      </script>
    @endpush
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                      
                    </div>

                    <div class="mt-8 text-2xl">
                        <div id="piechart" style="width: 600px; height: 300px;"></div>
                        <div id="columnchart_values" style="width: 500px; height: 300px;"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
