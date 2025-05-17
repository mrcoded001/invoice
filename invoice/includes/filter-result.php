<?php
$filter_result = 'All Data'; // Default display

if (isset($_POST['sort-submit'])) {
    $month          = $_POST['month-sort'];
    $rangeFrom      = $_POST['range-from'];
    $rangeTo        = $_POST['range-to'];

    if (!empty($month)) {
        $filter_result = "Filtered by Month: " . date('F Y', strtotime($month));
    } else if (!empty($rangeFrom) && !empty($rangeTo)) {
        $filter_result = "Filtered from " . date('d M Y', strtotime($rangeFrom)) . " to " . date('d M Y', strtotime($rangeTo));
    } else {
        $filter_result = "<span class='text-danger'>Please select valid filter values</span>";
    }
}
?>