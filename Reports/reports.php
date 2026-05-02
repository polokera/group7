<?php require_once '../vendor/autoload.php';
      use Dompdf\Dompdf;
      ob_start();
            $conn = mysqli_connect("localhost", "root", "", "Login");
                        

            if (isset($_GET['generate_pdf'])) {
                $id = $_GET['generate_pdf'];

                $generatequery = "SELECT * FROM reports WHERE id = $id";
                $generateresult = mysqli_query($conn, $generatequery);
                $row = mysqli_fetch_assoc($generateresult);

                echo $row['requestdate'];

                if($row) {
                    $html = "
                    <h2> Your car report </h2>
                    <p>Request Date: {$row['requestdate']}</p>
                    <p>Vehicle Type: {$row['vehicletype']}</p>
                    <p>Destination: {$row['destination']}</p>
                    <p>Status: {$row['status']}</p>
                    ";
                    // instantiate and use the dompdf class
                    $dompdf = new Dompdf();
                    $dompdf->loadHtml($html);

                    // (Optional) Setup the paper size and orientation
                    $dompdf->setPaper('A4', 'portrait');

                    // Render the HTML as PDF
                    $dompdf->render();
                    // Output the generated PDF to Browser

                    ob_clean();
                    $dompdf->stream();
                    exit;
                
                }

            }

            
        ?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/Reports.css">
        <title>Reports</title>  
    </head>
    <body>
        <script>
            function generatePDF(id) {
                window.location.href = "reports.php?generate_pdf=" + id;
                console.log("Generating pdf for id:" + id);
            }
        </script>
        <div class="ReportBoxes">
        <div class="UsageBox">
           Member usage report 

           <div class="tablescroll">
           <table>
                <thead>
                    <tr>
                        <?php

                            $query = "SELECT id,requestdate, status, vehicletype, destination
                            FROM reports";

                            $result = mysqli_query($conn,$query);
                        ?>
                        <th>Request Date</th>
                        <th>Destination</th>
                        <th>Vehicle Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php
                            if($result && mysqli_num_rows($result) > 0)
                                {
                                while ($row = mysqli_fetch_assoc($result)) {
                                     echo "<tr>";
                                    echo "<td>" . $row['requestdate'] . "</td>";
                                    echo "<td>" . $row['vehicletype'] . "</td>";
                                    echo "<td>" . $row['destination'] . "</td>";
                                    echo "<td>" . $row['status'] . "</td>";
                                    echo "<td>" . "<button class='pdf-download' onclick=\"generatePDF(" . $row['id'] . ")\">
                                    Download PDF Report</button> " . "</td>";
                                    echo "</tr>";
                                }
                                }

                        ?>
                   
                </tbody>
            </table>
            </div>
        </div>

        <div class= "OverviewBox">
            Overview
        </div>
        </div>
        
    </body>
</html>