<x-MainLayout>
    <x-slot name="titlePage">
        Dashboard
    </x-slot>
    <x-slot name="activePage">
        dashboard
    </x-slot>
    @section('content')
    <link href="/css/dash_1.css" rel="stylesheet">
    <link href="/css/apexcharts.css" rel="stylesheet">
    <div class="d-flex">
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 pb-10">
            <div class="w-full rounded overflow-hidden shadow-lg bg-blue-200">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Total Facilities</div>
                    <p class="text-gray-700 text-base">
                        Active/Inactive: <strong>{{$objects->TotalFacilities . "/" . $objects->TotalActiveFacilities}}</strong>
                    </p>
                </div>
            </div>
            <div class="w-full rounded overflow-hidden shadow-lg bg-red-200">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Total Visits last month</div>
                    <p class="text-gray-700 text-base">
                        Total: <strong>{{$visit->count()}}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="">
        <div class="widget widget-chart-one p-3 bg-purple-50">
            <div class="widget-heading">
                <h5 class="">Statistics</h5>
                <ul class="tabs tab-pills">
                    <li><a id="tb_1" class="tabmenu">Monthly</a></li>
                </ul>
            </div>

            <div class="widget-content">
                <div class="tabs tab-content">
                    <div id="content_1" class="tabcontent"> 
                        <div id="revenueMonthly"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function LoadPDF(_url){
            $.ajax({
                url: _url,
                type: 'GET',
                success: function(data){
                    let pdfWindow = window.open("");
                    pdfWindow.document.write(
                        "<iframe width='100%' height='100%' src='" +
                        data.notes + "'></iframe>"
                    );
                }
            })
            
        }
    </script>
    <script src="/js/apexcharts.min.js" type="text/javascript"></script>
    <script src="/js/dash_1.js" type="text/javascript"></script>
    @endsection

</x-MainLayout>