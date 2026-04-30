<?php require_once '../vendor/autoload.php';

            use Dompdf\Dompdf;

            // instantiate and use the dompdf class
            $dompdf = new Dompdf();
            $dompdf->loadHtml('hello world');

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream();
        ?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/Reports.css">
        <title>Reports</title>  
    </head>
    <body>
        <div class="ReportBoxes">
        <div class="UsageBox">
           Member usage report 
           <table>
                <thead>
                    <tr>
                        <th>Request Date</th>
                        <th>Destination</th>
                        <th>Vehicle Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>31/03/2026</td>
                        <td>Blantyre</td>
                        <td>Saloon</td>
                        <td><span class="approved-status">Approved by Registrar</span></td>
                        <td><button class="pdf-download">Download PDF Report</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class= "OverviewBox">
            Overview
        </div>
        </div>
        
    </body>
</html>