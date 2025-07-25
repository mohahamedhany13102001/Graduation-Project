<?php
require_once('functions.php');

if (!isUserLoggedIn()) {
    $errMsg =  "Please login first to user the service";
    echo '<center><h1 style="color:red;">' . $errMsg . '</h1></center>';
    exit();
}

if (!isset($_GET["report_id"])) {
    exit();
}
if ($_GET["report_id"] == "") {
    echo '<center><h1>Waiting for uploading image</h1></center>';
    exit();
}

$reportid = $_GET["report_id"];

$report = $GLOBALS['db']->readTable("services", "WHERE report_id='{$reportid}'")[0];
$user = $GLOBALS['db']->readTable("users", "WHERE id = '{$report["user_id"]}'")[0];

$currentuser = getLogginInUser();

if ($user["id"] != $currentuser["id"] && $currentuser["id"] != 1) {
    $errMsg =  "You do not have permission to view this report";
    echo '<center><h1 style="color:red;">' . $errMsg . '</h1></center>';
    exit();
}

// display results to user
$arr[5] = [
    0 => 'this',
    1 => 'that',
    2 => 'those',
    3 => 'a7a',
    4 => 'edi',
];
$degree = '';
foreach ($arr as $key => $value) {
    if ($report['level'] == $key) {
        $degree = 'correct';
    }
}

?>
<!DOCTYPE html>
<html>
<?php showHead(); ?>

<div class="container justify-content-center justify-content-end mt-3">

    <div class="row">
        <div class="col-md-4">
            <span>DRD</span>
        </div>
        <div class="col-md-6">
            <img src="images/project logo.png" style="height:80px;" alt="">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3">Report ID:</div>
        <div class="col-md-9"><?php echo $report["report_id"]; ?></div>
        <div class="col-md-3">Name:</div>
        <div class="col-md-9"><?php echo $user["name"]; ?></div>
        <div class="col-md-3">Report Date:</div>
        <div class="col-md-9"><?php echo $report["datetime"]; ?></div>
        <div class="col-md-3">Phone:</div>
        <div class="col-md-9"><?php echo $user["phone"]; ?></div>
        <div class="col-md-3">Age:</div>
        <div class="col-md-9"><?php echo $user["age"]; ?></div>
    </div>
    <hr>
    <center>
        <h1>DRD</h1>
    </center>
    <hr>
    <div class="row" style="margin-bottom:20px; margin-top:10px;">
        <div class="col-md-4">Test</div>
        <div class="col-md-8">Result</div>
    </div>
    <hr>
    <div class="row" style="margin-bottom:20px; margin-top:10px;">
        <div class="col-md-4">Severity Level</div>
        <div class="col-md-8"><?php echo $report["level"]; ?></div>
    </div>
    <div class="row" style="margin-bottom:20px; margin-top:10px;">
        
            <div><strong class="text-center" style=""><?php
                                                                    switch ($report['level']) {
                                                                        case '0':
                                                                            echo 'Baseline – No Diabetic Retinopathy is found: Non-proliferative diabetic retinopathy (NPDR)';
                                                                            break;
                                                                        case '1':
                                                                            echo '1. Mild NPDR: The first of the diabetic retinopathy stages is characterized by a balloon-like swelling in certain <br> areas of the blood vessels in the retina called microaneurysms. This stage rarely affects vision or needs treatment, but it does signal diabetes damage has occurred and an increased risk of disease progression.
                                                                                At this stage,<br> the patient must become educated on the possible ramifications of diabetes, while taking steps to better control their blood sugar and diet and decrease the risk of diabetic retinopathy progression and vision loss. Entities like health systems, health risk assessment companies, and insurance payors should ensure that patients are getting regularly tested for the presence of diabetic retinopathy to catch it as early as possible. Preventative screenings performed by healthcare professionals during in-home health evaluations or in primary care visits are excellent ways to catch diabetic retinopathy as early as possible in a way that saves money and patient time.
                                                                                ';
                                                                            break;
                                                                        case '2':
                                                                            echo 'Moderate NPDR: The next diabetic retinopathy stage is characterized by damage to some of the blood vessels in the retina, resulting in leakage of blood and fluid into the retina tissue. This fluid can cause a loss of vision. 

                                                                                The use of fundus photography during a retinal screening, either as a part of an in-home evaluation or at a healthcare organization, can allow patients to receive a quick and accurate evaluation. When needed, referral to a specialist for further evaluation and possible treatment may be appropriate and recommended. Better control of blood sugar and obtaining further evaluation are key to potentially improving and ultimately saving the patient’s sight.';
                                                                            break;
                                                                        case '3':
                                                                            echo 'Severe NPDR : If there is continued inadequate control of diabetes, more blood vessels are damaged and blocked with even more leakage of blood and fluid into the retina, resulting in a much greater impact on vision. At this stage, a timely referral to an eye specialist is nearly always appropriate. The good news is that often, some, if not all, of the lost vision can be improved with appropriate treatment.';
                                                                            break;
                                                                        case '4':
                                                                            echo 'Proliferative Diabetic Retinopathy : Proliferative Diabetic RetinopathyProliferative Diabetic Retinopathy.The final stage of Diabetic Retinopathy is Proliferative Diabetic Retinopathy. At this point, the disease has advanced significantly and is very threatening to one’s vision. Because of additional damage to the eye’s blood vessels, there is worsening circulation inside the eye. In response, the retina then grows new blood vessels; however, they are abnormal and can cause severe damage, possibly resulting in vision loss and potentially blindness.
                                                                                At this stage, patients require immediate referral to a retina specialist for further examination and treatment';
                                                                            break;

                                                                        default:
                                                                            break;
                                                                    }
                                                                    echo $degree;
                                                                    ?></strong></strong>
            </div>
        
    </div>
    <div class="row" style="margin-bottom:20px; margin-top:10px;">
        <div class="col-md-4 ">Image</div>
        <div class="col-md-8"><img src="<?php echo $report["image"]; ?>" style=" max-height:550px; " /></div>
    </div>


</div>


<button class="custom_botton" onclick="window.print();">Print Report</button>

</div>



<?php endBodyScripts(); ?>